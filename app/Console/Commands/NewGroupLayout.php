<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class NewGroupLayout extends Command
{
    protected $signature = 'new:group-layout {group}';
    protected $description = 'Creates a standalone layout for a specific module group';

    public function handle()
    {
        $groupRaw = $this->argument('group');
        $groupKebab = Str::kebab($groupRaw);
        $groupStudly = Str::studly($groupRaw);

        $layoutPath = resource_path("views/components/layouts/groups/{$groupKebab}.blade.php");
        $navPath = resource_path("views/components/layouts/groups/{$groupKebab}/navigation.blade.php");

        File::ensureDirectoryExists(dirname($layoutPath));
        File::ensureDirectoryExists(dirname($navPath));

        // 1. Create specialized Navigation
        $this->generateNavigation($navPath, $groupRaw, $groupKebab);

        // 2. Create specialized Layout
        $this->generateLayout($layoutPath, $groupKebab);

        $this->info("✅ Standalone Layout created for: $groupRaw");
        $this->line("📍 Layout: $layoutPath");
        $this->line("📍 Navigation: $navPath");
        $this->info("🚀 Use 'modular/$groupKebab/...' in URL to access the standalone version.");

        return 0;
    }

    protected function generateNavigation($path, $groupRaw, $groupKebab)
    {
        $mainNav = File::get(resource_path('views/components/layouts/app/navigation.blade.php'));

        // Robust matching: find the x-nav.group that contains the group label
        $escapedGroup = preg_quote("{{ __('admin.{$groupRaw}') }}", '/');
        $pattern = "/<x-nav\.group label=['\"]([0-9]+\. )?{$escapedGroup}['\"].*?<\/x-nav\.group>/s";

        if (preg_match($pattern, $mainNav, $matches)) {
            $groupContent = $matches[0];

            // Extract only the inner links, ignoring the group wrapper itself to simplify
            preg_match_all("/<x-nav\.link route=\"admin\.(.*?)\".*?>(.*?)<\/x-nav\.link>/s", $groupContent, $linkMatches, PREG_SET_ORDER);

            $newLinks = "";
            foreach ($linkMatches as $link) {
                $label = trim($link[2]);

                // Convert to a plain <a> tag with modular URL to be bulletproof
                // URL structure: /modular/{group}/{original_admin_path}
                $url = "/modular/{$groupKebab}/" . str_replace('.', '/', $link[1]);
                $url = preg_replace('#/+#', '/', $url); // Remove duplicate slashes
                $url = str_replace('/index', '', $url);

                $newLinks .= "    <a href=\"{$url}\" class=\"group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200\">\n";
                $newLinks .= "        <div class=\"ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700\"></div>\n";
                $newLinks .= "        <span class=\"truncate\">{$label}</span>\n";
                $newLinks .= "    </a>\n";
            }

            $content = $newLinks;
        } else {
            $this->warn("Could not find navigation group for '$groupRaw'.");
            $content = "<!-- Add your specific links here -->";
        }

        File::put($path, "<div>\n    <a href=\"/admin\" class=\"group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4\">\n        <x-heroicon-o-arrow-left class=\"size-5 shrink-0\" />\n        <span class=\"truncate\">Kthehu te Paneli Kryesor</span>\n    </a>\n    <x-nav.divider>{$groupRaw}</x-nav.divider>\n    $content\n</div>");
    }

    protected function generateLayout($path, $groupKebab)
    {
        $baseApp = File::get(resource_path('views/components/layouts/app.blade.php'));

        // Replace the navigation include with the modular one
        $specializedNav = "components.layouts.groups.{$groupKebab}.navigation";
        $newLayout = str_replace("@include('components.layouts.app.navigation')", "@include('{$specializedNav}')", $baseApp);

        File::put($path, $newLayout);
    }
}
