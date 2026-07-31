<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Permission;

class NewReport extends Command
{
    protected $signature = 'new:report {group}';
    protected $description = 'Generates a Minimalist & Professional Analytics Dashboard';

    public function handle()
    {
        $group = $this->argument('group');
        $groupStudly = Str::studly($group);
        $groupKebab = Str::kebab($group);

        $this->info("💎 Crafting Minimalist Dashboard for: $group");

        $modelsDir = app_path("Models/$groupStudly");
        if (!File::isDirectory($modelsDir)) {
            $this->error("Group folder not found.");
            return 1;
        }

        $this->ensureTranslations($group);

        $models = collect(File::files($modelsDir))
            ->map(fn($f) => pathinfo($f, PATHINFO_FILENAME))
            ->toArray();

        $modelData = [];
        foreach ($models as $modelName) {
            $fullModel = "\\App\\Models\\$groupStudly\\$modelName";
            $modelInstance = new $fullModel;
            $table = $modelInstance->getTable();
            $columns = Schema::getColumnListing($table);

            $numericField = collect($columns)->first(fn($c) => in_array(strtolower($c), ['total', 'amount', 'price', 'balance']));

            $modelData[] = [
                'name' => $modelName,
                'var' => Str::camel(Str::plural($modelName)),
                'label' => Str::title(Str::snake(Str::plural($modelName), ' ')),
                'pluralKebab' => Str::kebab(Str::plural($modelName)),
                'numericField' => $numericField,
                'isMain' => (bool)$numericField,
            ];
        }

        $this->generateLivewireComponent($groupStudly, $groupKebab, $modelData);
        $this->generateView($group, $groupStudly, $groupKebab, $modelData);
        $this->registerRoute($groupStudly, $groupKebab);
        $this->addPermissions($group);
        $this->addNavigationLink($group, $groupKebab);

        $this->info("✅ Minimalist Dashboard is ready!");
    }

    protected function addPermissions($group)
    {
        $groupSnake = Str::snake($group);
        Permission::firstOrCreate(
            ['name' => "view_{$groupSnake}_dashboard"],
            ['label' => "View $group Dashboard", 'module' => $group]
        );
    }

    protected function ensureTranslations($group)
    {
        foreach (['en', 'sq'] as $lang) {
            $path = lang_path("$lang/admin.php");
            if (!File::exists($path)) continue;

            $translations = include $path;
            $changed = false;

            // Group label translation
            if (!isset($translations[$group])) {
                $translations[$group] = $group;
                $changed = true;
            }

            // Dashboard title translation
            $dashKey = "$group Dashboard";
            if (!isset($translations[$dashKey])) {
                $translations[$dashKey] = $dashKey;
                $changed = true;
            }

            if ($changed) {
                $content = "<?php\n\nreturn " . var_export($translations, true) . ";\n";
                $content = str_replace(['array (', ')'], ['[', ']'], $content);
                File::put($path, $content);
            }
        }
    }

    protected function generateLivewireComponent($groupStudly, $groupKebab, $modelData)
    {
        $dir = app_path("Livewire/Admin/$groupStudly");
        File::makeDirectory($dir, 0755, true, true);

        $statsLogic = "";
        $chartDataLogic = "";

        foreach ($modelData as $m) {
            $modelClass = "\\App\\Models\\$groupStudly\\{$m['name']}";
            $var = $m['var'];
            $statsLogic .= "            '$var' => $modelClass::count(),\n";
            if ($m['numericField']) {
                $nf = $m['numericField'];
                $statsLogic .= "            '{$var}_sum' => (float) $modelClass::sum('$nf'),\n";
                $chartDataLogic .= "        \$chartData['$var'] = collect(range(6, 0))->map(fn(\$i) => (float) $modelClass::whereDate('created_at', now()->subDays(\$i))->sum('$nf'))->toArray();\n";
            } else {
                $chartDataLogic .= "        \$chartData['$var'] = collect(range(6, 0))->map(fn(\$i) => $modelClass::whereDate('created_at', now()->subDays(\$i))->count())->toArray();\n";
            }
        }

        $stub = "<?php\n\nnamespace App\Livewire\Admin\\$groupStudly;\n\nuse Livewire\Component;\nuse Livewire\Attributes\Title;\n\n#[Title('$groupStudly Dashboard')]\nclass Dashboard extends Component\n{\n    public function render()\n    {\n        \$chartData = [];\n$chartDataLogic\n        return view('livewire.admin.$groupKebab.dashboard', [\n            'stats' => [\n$statsLogic            ],\n            'chartData' => \$chartData,\n            'days' => collect(range(6, 0))->map(fn(\$i) => now()->subDays(\$i)->format('D'))->toArray()\n        ])->layout('components.layouts.app');\n    }\n}";
        File::put("$dir/Dashboard.php", $stub);
    }

    protected function generateView($group, $groupStudly, $groupKebab, $modelData)
    {
        $dir = resource_path("views/livewire/admin/$groupKebab");
        File::makeDirectory($dir, 0755, true, true);

        $mainCards = "";
        $operationalCards = "";
        $chartSeries = "";

        $mainCounter = 0;
        $chartCounter = 0;
        $accentColors = ['border-blue-500', 'border-emerald-500', 'border-amber-500', 'border-rose-500'];

        foreach ($modelData as $m) {
            $var = $m['var'];
            $label = $m['label'];
            $routeName = "admin.$groupKebab.{$m['pluralKebab']}.index";

            if ($m['numericField'] && $mainCounter < 4) {
                $color = $accentColors[$mainCounter];
                $mainCards .= "
                <div class=\"bg-white dark:bg-gray-800 p-6 rounded-[2rem] border-l-4 $color shadow-sm border-y border-r border-gray-100 dark:border-gray-700/50\">
                    <p class=\"text-[10px] font-black uppercase tracking-[0.1em] text-gray-400 dark:text-gray-500 mb-1\">$label Total</p>
                    <p class=\"text-2xl font-bold dark:text-white tracking-tight\">€{{ number_format(\$stats['{$var}_sum'] ?? 0, 2) }}</p>
                </div>";
                $mainCounter++;
            }

            $operationalCards .= "
            <a href=\"{{ route('$routeName') }}\" wire:navigate class=\"group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all\">
                <div class=\"flex items-center justify-between mb-3\">
                    <div class=\"p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors\"><x-heroicon-o-cube class=\"size-4\"/></div>
                    <span class=\"text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400\">View All</span>
                </div>
                <p class=\"text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5\">$label</p>
                <p class=\"text-lg font-bold dark:text-white\">{{ \$stats['$var'] }}</p>
            </a>";

            if ($chartCounter < 6) {
                $chartLabel = $m['numericField'] ? "$label (€)" : "$label";
                $chartSeries .= "{ name: '$chartLabel', data: @js(\$chartData['$var']) }, ";
                $chartCounter++;
            }
        }

        $mainCardsSection = $mainCards ? "<div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6\">$mainCards</div>" : "";

        $stub = "
<div class=\"space-y-8\" x-data=\"{ init() {
    new ApexCharts(this.\$refs.chart, {
        series: [$chartSeries],
        chart: { height: 350, type: 'area', toolbar: {show:false}, zoom: {enabled:false}, fontFamily: 'inherit' },
        stroke: { curve: 'smooth', width: 3 },
        dataLabels: { enabled: false },
        fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.2, opacityTo: 0 } },
        xaxis: { categories: @js(\$days), axisBorder: {show:false}, axisTicks: {show:false} },
        yaxis: { labels: { show: false } },
        grid: { borderColor: '#f1f1f1', strokeDashArray: 4, padding: {left:10, right:10} },
        colors: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#6366f1'],
        legend: { position: 'top', horizontalAlign: 'right', fontWeight: 600, fontSize: '12px' }
    }).render();
}}\">
    <script src=\"https://cdn.jsdelivr.net/npm/apexcharts\"></script>

    <div class=\"flex items-end justify-between\">
        <div>
            <x-h1>{{ __('admin.$group Dashboard') }}</x-h1>
            <x-short-description class=\"dark:text-gray-400\">{{ __('Operational and financial insights for') }} $group</x-short-description>
        </div>
        <div class=\"hidden md:block\">
            <div class=\"flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl text-[10px] font-black uppercase text-gray-400 tracking-widest\">
                <span class=\"size-2 rounded-full bg-blue-500 animate-pulse\"></span>
                {{ __('Real-time Analytics') }}
            </div>
        </div>
    </div>

    $mainCardsSection

    <div class=\"bg-white dark:bg-gray-800 p-8 rounded-[2.5rem] border border-gray-100 dark:border-gray-700/50 shadow-sm\">
        <div class=\"flex items-center justify-between mb-8\">
            <h3 class=\"text-sm font-black uppercase tracking-widest text-gray-400\">{{ __('Growth Trend (Last 7 Days)') }}</h3>
        </div>
        <div x-ref=\"chart\" class=\"min-h-[350px]\"></div>
    </div>

    <div class=\"space-y-6\">
        <h4 class=\"text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 dark:text-gray-500\">{{ __('Operational Metrics') }}</h4>
        <div class=\"grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-4\">$operationalCards</div>
    </div>
</div>";

        File::put("$dir/dashboard.blade.php", $stub);
    }

    protected function registerRoute($groupStudly, $groupKebab)
    {
        $path = base_path("routes/admin/$groupKebab/dashboard.php");
        File::ensureDirectoryExists(dirname($path));
        File::put($path, "<?php\n\nuse Illuminate\Support\Facades\Route;\nuse App\Livewire\Admin\\$groupStudly\\Dashboard;\nRoute::get('/$groupKebab/dashboard', Dashboard::class)->name('admin.$groupKebab.dashboard');");
    }

    protected function addNavigationLink($group, $groupKebab)
    {
        $navPath = resource_path('views/components/layouts/app/navigation.blade.php');
        $content = File::get($navPath);

        $groupSnake = Str::snake($group);
        $permission = "view_{$groupSnake}_dashboard";

        $newLink = "\n    @can('$permission')\n        <x-nav.link route=\"admin.$groupKebab.dashboard\" icon=\"presentation-chart-bar\">{{ __('admin.Dashboard') }}</x-nav.link>\n    @endcan\n";

        // Remove ANY existing dashboard link for this group to avoid duplicates
        $pattern = "/\s*@can\('$permission'\)\s*<x-nav\.link route=\"admin\.{$groupKebab}\.dashboard\".*?<\/x-nav\.link>\s*@endcan/s";
        $content = preg_replace($pattern, '', $content);

        $escapedGroup = preg_quote("{{ __('admin.$group') }}", '/');
        // Pattern to match the group with its potential @if wrapper
        $groupPattern = "/(@if\(.*?\)\s*)?<x-nav\.group label=['\"]([0-9]+\. )?{$escapedGroup}['\"].*?<\/x-nav\.group>(\s*@endif)?/s";

        if (preg_match($groupPattern, $content, $matches)) {
            $matchedFullGroup = $matches[0];
            $ifWrapper = $matches[1] ?? '';

            // Update @if condition if it exists
            if ($ifWrapper) {
                if (!str_contains($ifWrapper, "'$permission'")) {
                    $newIf = preg_replace("/\)\s*$/", " || can('$permission'))", trim($ifWrapper));
                    $content = str_replace($ifWrapper, $newIf . "\n", $content);
                }
            } else {
                // Wrap existing group in @if
                preg_match_all("/@can\('(view_[a-z_]+)'\)/", $matchedFullGroup, $perms);
                $allPerms = array_unique(array_merge($perms[1] ?? [], [$permission]));
                $ifCond = "@if(" . collect($allPerms)->map(fn($p) => "can('$p')")->implode(' || ') . ")";
                $updatedGroup = "$ifCond\n" . $matchedFullGroup . "\n@endif";
                $content = str_replace($matchedFullGroup, $updatedGroup, $content);
            }

            // Insert the new link inside the group (re-read content because we might have changed it above)
            if (preg_match($groupPattern, $content, $newMatches)) {
                $matchedGroupPart = $newMatches[0];
                // Insert after the group opening tag (which contains the label)
                $updatedGroup = preg_replace("/(<x-nav\.group.*?>)/", "$1" . $newLink, $matchedGroupPart);
                $content = str_replace($matchedGroupPart, $updatedGroup, $content);
            }

            File::put($navPath, $content);
        }
    }
}
