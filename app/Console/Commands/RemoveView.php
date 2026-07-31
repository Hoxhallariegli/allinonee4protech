<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Permission;

class RemoveView extends Command
{
    protected $signature = 'remove:view {name} {--group= : Group the model was scaffolded under — required if it was created with one} {--force : Skip confirmations, including dropping the table}';
    protected $description = 'Reverses new:view for one specific, group-scoped resource. Uses the same prefix registry as new:view, so it targets that exact group\'s files/table only — never a same-named model in a different group.';

    public function handle()
    {
        try {
            return $this->remove();
        } catch (\Throwable $e) {
            $this->error('Removal failed: ' . $e->getMessage());
            $this->line($e->getFile() . ':' . $e->getLine());
            return 1;
        }
    }

    protected function remove()
    {
        $rawName = trim((string) $this->argument('name'));
        $name = Str::studly((string) preg_replace('/[^A-Za-z0-9_\- ]/', '', $rawName));
        if (!$name) {
            $this->error("Invalid model name '$rawName'.");
            return 1;
        }

        $pluralName = Str::plural($name);
        $pluralKebab = Str::kebab($pluralName);
        $pluralSnake = Str::snake($pluralName);

        // Try to auto-discover group if not provided
        $group = $this->option('group');
        if (!$group) {
            $modelsDir = app_path('Models');
            $it = new \RecursiveDirectoryIterator($modelsDir);
            foreach (new \RecursiveIteratorIterator($it) as $file) {
                if ($file->getFilename() === "$name.php") {
                    $relativePath = str_replace([$modelsDir, DIRECTORY_SEPARATOR], ['', '/'], $file->getPath());
                    $relativePath = trim($relativePath, '/');
                    if ($relativePath) {
                        // Infer group name from folder (e.g. SchoolManagement -> School Management)
                        $group = str_replace('/', ' ', preg_replace('/(?<!^)[A-Z]/', ' $0', $relativePath));
                        $this->info("✓ Auto-discovered group '$group' from model path.");
                    }
                    break;
                }
            }
        }

        $groupStudly = $group ? Str::studly($group) : '';
        $groupKebab = $group ? Str::kebab($group) : '';
        $groupPath = $groupStudly ? "$groupStudly/" : "";
        $groupViewPath = $groupKebab ? "$groupKebab/" : "";

        // Table prefix cleanup logic:
        // We find the prefix from the manifest.
        $prefix = '';
        if ($group) {
            $manifestPath = storage_path('app/scaffold-groups.json');
            $manifest = File::exists($manifestPath) ? (json_decode(File::get($manifestPath), true) ?: []) : [];
            if (isset($manifest[$groupStudly])) {
                $prefix = $manifest[$groupStudly]['prefix'];
            }
        }

        $tableName = $prefix . Str::snake(Str::pluralStudly($name));

        // FALLBACK: If prefix-based table doesn't exist, try common variations (with or without numbers)
        if (!Schema::hasTable($tableName)) {
            $variations = [
                Str::snake(Str::pluralStudly($name)), // No prefix
                preg_replace('/^[0-9]+/', '', $prefix) . Str::snake(Str::pluralStudly($name)), // Prefix without leading number
            ];
            foreach ($variations as $v) {
                if (Schema::hasTable($v)) {
                    $tableName = $v;
                    break;
                }
            }
        }

        $modelPath = app_path("Models/{$groupPath}$name.php");
        $domainPath = app_path("Domain/{$groupPath}$name");
        $livewirePath = app_path("Livewire/Admin/{$groupPath}$pluralName");
        $viewsPath = resource_path("views/livewire/admin/{$groupViewPath}" . Str::kebab($pluralName));
        $routePath = base_path("routes/admin/{$groupViewPath}$pluralKebab.php");
        $apiControllerPath = app_path("Http/Controllers/Api/{$name}Controller.php");

        $this->warn("About to remove '$name' (group: " . ($group ?: '— ungrouped') . "):");
        foreach ([
            'Model'          => $modelPath,
            'Domain'         => $domainPath,
            'Livewire'       => $livewirePath,
            'Views'          => $viewsPath,
            'Route file'     => $routePath,
            'API controller' => $apiControllerPath,
            'Table'          => "$tableName (exact name match only — no wildcard)",
        ] as $label => $p) {
            $this->line(" - $label: $p");
        }

        if (!$this->option('force') && !$this->confirm('Proceed with removal? This cannot be undone.', true)) {
            $this->info('Aborted. Nothing was changed.');
            return 1;
        }

        if (File::exists($modelPath)) {
            File::delete($modelPath);
        }
        if (File::isDirectory($domainPath)) {
            File::deleteDirectory($domainPath);
        }
        if (File::isDirectory($livewirePath)) {
            File::deleteDirectory($livewirePath);
        }
        if (File::isDirectory($viewsPath)) {
            File::deleteDirectory($viewsPath);
        }
        if (File::exists($routePath)) {
            File::delete($routePath);
        }
        if (File::exists($apiControllerPath)) {
            File::delete($apiControllerPath);
        }

        // Strip the apiResource(...) line for this specific model from routes/api.php
        $apiRoutePath = base_path('routes/api.php');
        if (File::exists($apiRoutePath)) {
            $content = File::get($apiRoutePath);
            $pattern = "/\\n?Route::apiResource\\('$pluralKebab',\\s*\\\\App\\\\Http\\\\Controllers\\\\Api\\\\{$name}Controller::class\\);/";
            File::put($apiRoutePath, (string) preg_replace($pattern, '', $content));
        }

        foreach (['en', 'sq'] as $lang) {
            $langPath = lang_path($lang);
            if ($groupKebab) {
                $langPath .= '/' . $groupKebab;
            }
            $langFile = "$langPath/$pluralKebab.php";
            if (File::exists($langFile)) {
                File::delete($langFile);
                $this->info("✓ Deleted Translation File: $langFile");
            }

            // Clean up group folder if empty
            if ($groupKebab && File::isDirectory($langPath) && count(File::files($langPath)) === 0) {
                File::deleteDirectory($langPath);
                $this->info("✓ Deleted empty translation group folder: $langPath");
            }
        }

        // Aggressive Cleanup of DB logs and trails
        DB::table('audit_trails')->where('section', $pluralName)->delete();
        DB::table('notifications')->where('link', 'like', "%/$pluralKebab%")->delete();
        DB::table('settings')->where('key', 'like', "%$pluralSnake%")
            ->orWhere('key', 'like', "%$groupStudly%")
            ->delete();

        // Aggressive Permission cleanup
        Permission::where('name', 'like', "%_{$pluralSnake}")
            ->orWhere('module', $pluralName)
            ->orWhere('module', $name)
            ->orWhere('module', $group)
            ->delete();

        $this->removeNavigation($pluralKebab, $pluralSnake, $groupKebab);

        // Cleanup migrations
        foreach (File::glob(database_path("migrations/*_create_{$tableName}_table.php")) as $m) {
            $migrationName = pathinfo($m, PATHINFO_FILENAME);
            File::delete($m);
            DB::table('migrations')->where('migration', $migrationName)->delete();
        }

        if (Schema::hasTable($tableName)) {
            Schema::dropIfExists($tableName);
            $this->info("Table '$tableName' dropped.");
        }

        // Deep Cleanup of empty parent directories
        $this->cleanupEmptyDirs(app_path('Domain'));
        $this->cleanupEmptyDirs(app_path('Livewire/Admin'));
        $this->cleanupEmptyDirs(app_path('Models'));
        $this->cleanupEmptyDirs(resource_path('views/livewire/admin'));
        $this->cleanupEmptyDirs(base_path('routes/admin'));

        $this->info("✅ $name removed.");
        return 0;
    }

    protected function cleanupEmptyDirs($dir)
    {
        if (!File::isDirectory($dir)) return;

        $items = File::directories($dir);
        foreach ($items as $item) {
            $this->cleanupEmptyDirs($item);
            if (count(File::allFiles($item)) === 0 && count(File::directories($item)) === 0) {
                File::deleteDirectory($item);
                $this->info("✓ Removed empty directory: " . str_replace(base_path(), '', $item));
            }
        }
    }

    protected function removeNavigation($pluralKebab, $pluralSnake, $groupKebab = '')
    {
        $navPath = resource_path('views/components/layouts/app/navigation.blade.php');
        if (!File::exists($navPath)) {
            return;
        }
        $content = File::get($navPath);

        // Match the *exact* route name addNavigation() would have generated
        $routeName = $groupKebab ? "admin.$groupKebab.$pluralKebab.index" : "admin.$pluralKebab.index";

        // Remove the link block entirely (flexible with indentation)
        $linkPattern = "/\s*@can\('view_{$pluralSnake}'\)\s*<x-nav\.link route=\"$routeName\".*?<\/x-nav\.link>\s*@endcan/s";
        $content = preg_replace($linkPattern, "", $content);

        // Clean up @if condition for the group
        $permission = "view_{$pluralSnake}";
        preg_match_all("/@if\((.*?)\)/s", $content, $matches);
        foreach ($matches[1] as $fullCond) {
            if (str_contains($fullCond, "can('$permission')")) {
                // Remove the specific can() check and handle the || logic
                $newCond = preg_replace("/\s*\|\|\s*can\('$permission'\)/", "", $fullCond);
                $newCond = preg_replace("/can\('$permission'\)\s*\|\|\s*/", "", $newCond);
                $newCond = str_replace("can('$permission')", "", $newCond);

                $content = str_replace($fullCond, $newCond, $content);
            }
        }

        // Auto-remove empty groups AND their empty @if wrappers
        $emptyGroupPattern = "/(@if\(\s*\)\s*)?<x-nav\.group label=\".*?\".*?>\s*<\/x-nav\.group>(\s*@endif)?/s";
        while (preg_match($emptyGroupPattern, $content)) {
            $content = preg_replace($emptyGroupPattern, '', $content);
        }

        File::put($navPath, $content);
    }
}
