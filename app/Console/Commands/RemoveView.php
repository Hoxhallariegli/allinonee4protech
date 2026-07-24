<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class RemoveView extends Command
{
    protected $signature = 'remove:view {name}';
    protected $description = 'Remove all generated files and data for a specific CRUD';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $pluralName = Str::plural($name);
        $pluralKebab = Str::kebab($pluralName);
        $pluralSnake = Str::snake($pluralName);
        $tableName = Str::snake(Str::pluralStudly($name));

        $this->warn("🗑️ Removing CRUD for $name...");

        // 1. Delete Model
        $modelPath = app_path("Models/$name.php");
        if (File::exists($modelPath)) {
            File::delete($modelPath);
            $this->info("Deleted Model: $modelPath");
        }

        // 2. Delete Livewire Components
        $livewirePath = app_path("Livewire/Admin/$pluralName");
        if (File::isDirectory($livewirePath)) {
            File::deleteDirectory($livewirePath);
            $this->info("Deleted Livewire Components: $livewirePath");
        }

        // 3. Delete Views
        $viewPath = resource_path("views/livewire/admin/$pluralKebab");
        if (File::isDirectory($viewPath)) {
            File::deleteDirectory($viewPath);
            $this->info("Deleted Views: $viewPath");
        }

        // 4. Delete Route File
        $routeFile = base_path("routes/admin/$pluralKebab.php");
        if (File::exists($routeFile)) {
            File::delete($routeFile);
            $this->info("Deleted Route File: $routeFile");
        }

        // 5. Delete Migration (Find by table name)
        $migrations = File::files(database_path('migrations'));
        foreach ($migrations as $migration) {
            if (str_contains($migration->getFilename(), "create_{$tableName}_table")) {
                File::delete($migration->getPathname());
                $this->info("Deleted Migration: " . $migration->getFilename());

                // Also remove from migrations table in DB so it can be re-run
                DB::table('migrations')->where('migration', 'like', '%' . str_replace('.php', '', $migration->getFilename()) . '%')->delete();
            }
        }

        // 6. Remove Navigation Link
        $navPath = resource_path('views/components/layouts/app/navigation.blade.php');
        if (File::exists($navPath)) {
            $content = File::get($navPath);
            $pattern = "/@can\('view_{$pluralSnake}'\).*?@endcan/s";
            $newContent = preg_replace($pattern, '', $content);
            if ($content !== $newContent) {
                File::put($navPath, trim($newContent));
                $this->info("Removed navigation link.");
            }
        }

        // 7. Remove Permissions from DB
        Permission::where('module', $pluralName)->delete();
        $this->info("Removed permissions from database.");

        // 8. Remove lines from RolesDatabaseSeeder
        $seederPath = database_path('seeders/RolesDatabaseSeeder.php');
        if (File::exists($seederPath)) {
            $content = File::get($seederPath);
            $lines = explode("\n", $content);
            $newLines = array_filter($lines, function($line) use ($pluralName) {
                return !str_contains($line, "'module' => '$pluralName'");
            });
            File::put($seederPath, implode("\n", $newLines));
            $this->info("Removed permission lines from RolesDatabaseSeeder.");
        }

        $this->info("✅ All components for $name have been removed!");
        $this->warn("Note: If the table was already migrated, you might want to drop it manually: DROP TABLE $tableName;");
    }
}
