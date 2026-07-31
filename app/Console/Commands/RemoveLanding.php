<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RemoveLanding extends Command
{
    protected $signature = 'remove:landing {group}';
    protected $description = 'Removes the Public Landing Page for a module group';

    public function handle()
    {
        $group = $this->argument('group');
        $groupStudly = Str::studly($group);
        $groupKebab = Str::kebab($group);

        $this->warn("🗑️ Removing Landing Page for: $group");

        // 1. Delete Livewire Component
        $componentPath = app_path("Livewire/Front/$groupStudly");
        if (File::isDirectory($componentPath)) {
            File::deleteDirectory($componentPath);
            $this->info("✓ Deleted Livewire Component: $componentPath");
        }

        // 2. Delete View
        $viewPath = resource_path("views/livewire/front/$groupKebab");
        if (File::isDirectory($viewPath)) {
            File::deleteDirectory($viewPath);
            $this->info("✓ Deleted View: $viewPath");
        }

        // 3. Delete Translations
        foreach (['en', 'sq'] as $lang) {
            $langPath = lang_path("{$lang}/front/$groupKebab.php");
            if (File::exists($langPath)) {
                File::delete($langPath);
                $this->info("✓ Deleted Translation: $langPath");
            }
        }

        // 4. Remove Route
        $this->removeRoute($groupKebab);

        // 5. Remove Navigation Link
        $this->removeNavigationLink($groupKebab);

        $this->info("✅ Landing Page for $group removed.");
    }

    protected function removeRoute($groupKebab)
    {
        $path = base_path("routes/front.php");
        if (File::exists($path)) {
            $content = File::get($path);
            $pattern = "/\nRoute::get\('\/{$groupKebab}',.*?\)->name\('front\.{$groupKebab}'\);/s";
            $content = preg_replace($pattern, "", $content);
            File::put($path, $content);
            $this->info("✓ Removed Route from routes/front.php");
        }
    }

    protected function removeNavigationLink($groupKebab)
    {
        $navPath = resource_path('views/components/layouts/app/navigation.blade.php');
        if (File::exists($navPath)) {
            $content = File::get($navPath);
            $pattern = "/\n\s*<x-nav\.link route=\"front\.{$groupKebab}\".*?<\/x-nav\.link>/s";
            $content = preg_replace($pattern, "", $content);
            File::put($navPath, $content);
            $this->info("✓ Removed Navigation Link");
        }
    }
}
