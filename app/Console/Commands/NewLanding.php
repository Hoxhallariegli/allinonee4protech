<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class NewLanding extends Command
{
    protected $signature = 'new:landing {group}';
    protected $description = 'Generates a Stunning & Modern Public Landing Page for a module group';

    public function handle()
    {
        $group = $this->argument('group');
        $groupStudly = Str::studly($group);
        $groupKebab = Str::kebab($group);

        $this->info("🎨 Designing High-End Landing Page for: $group");

        $modelsDir = app_path("Models/$groupStudly");
        if (!File::isDirectory($modelsDir)) {
            $this->error("Group folder not found in app/Models.");
            return 1;
        }

        $this->ensureTranslations($groupKebab, $group);

        $models = collect(File::files($modelsDir))
            ->map(fn($f) => pathinfo($f, PATHINFO_FILENAME))
            ->toArray();

        $sections = [];
        foreach ($models as $modelName) {
            $fullModel = "\\App\\Models\\$groupStudly\\$modelName";
            $modelInstance = new $fullModel;
            $table = $modelInstance->getTable();
            $columns = Schema::getColumnListing($table);

            $hasPrice = collect($columns)->contains(fn($c) => in_array(strtolower($c), ['price', 'amount', 'cost']));
            $hasPhoto = collect($columns)->contains(fn($c) => in_array(strtolower($c), ['photo', 'image', 'picture']));
            $hasDesc = collect($columns)->contains(fn($c) => in_array(strtolower($c), ['description', 'specialization', 'bio', 'notes']));
            $nameField = collect($columns)->first(fn($c) => in_array(strtolower($c), ['name', 'title', 'label'])) ?? 'id';

            $sections[] = [
                'model' => $modelName,
                'class' => $fullModel,
                'var' => Str::camel(Str::plural($modelName)),
                'label' => Str::title(Str::snake(Str::plural($modelName), ' ')),
                'hasPrice' => $hasPrice,
                'hasPhoto' => $hasPhoto,
                'hasDesc' => $hasDesc,
                'nameField' => $nameField,
                'priceField' => collect($columns)->first(fn($c) => in_array(strtolower($c), ['price', 'amount'])),
                'photoField' => collect($columns)->first(fn($c) => in_array(strtolower($c), ['photo', 'image'])),
                'descField' => collect($columns)->first(fn($c) => in_array(strtolower($c), ['description', 'specialization', 'bio'])),
            ];
        }

        $this->generateLivewireComponent($groupStudly, $groupKebab, $sections);
        $this->generateView($group, $groupStudly, $groupKebab, $sections);
        $this->registerRoute($groupKebab, $groupStudly);
        $this->addNavigationLink($group, $groupKebab);

        $this->info("🚀 Landing Page is LIVE at: /$groupKebab");
    }

    protected function ensureTranslations($groupKebab, $groupName)
    {
        foreach (['en', 'sq'] as $lang) {
            $langDir = lang_path($lang . '/front');
            File::ensureDirectoryExists($langDir);
            $path = "$langDir/$groupKebab.php";

            $defaults = [
                'welcome_to' => 'Welcome to',
                'elevate_experience' => 'Elevate your Experience.',
                'hero_subtitle' => 'Unlock the full potential of your lifestyle with our premium services tailored just for you. Quality, precision, and passion in every detail.',
                'book_now' => 'Book Now',
                'view_portfolio' => 'View Portfolio',
                'our_services' => 'Our Services',
                'services_subtitle' => 'Experience the best services with transparent pricing and professional touch.',
                'meet_team' => 'Meet our Team',
                'team_subtitle' => 'Our professionals are dedicated to delivering excellence and style.',
                'select_service' => 'Select Service',
                'about_us' => 'About Us',
                'contact' => 'Contact',
                'links' => 'Links',
                'footer_text' => 'Building the future of service management with minimalist design and powerful technology.',
            ];

            if ($lang === 'sq') {
                $defaults = [
                    'welcome_to' => 'Mirësevini në',
                    'elevate_experience' => 'Lartësoni Eksperiencën Tuaj.',
                    'hero_subtitle' => 'Zbuloni potencialin e plotë të stilit tuaj të jetesës me shërbimet tona premium të përshtatura vetëm për ju. Cilësi, saktësi dhe pasion në çdo detaj.',
                    'book_now' => 'Rezervo Tani',
                    'view_portfolio' => 'Shiko Portofolin',
                    'our_services' => 'Shërbimet Tona',
                    'services_subtitle' => 'Përjetoni shërbimet më të mira me çmime transparente dhe prekje profesionale.',
                    'meet_team' => 'Njihuni me Ekipin',
                    'team_subtitle' => 'Profesionistët tanë janë të përkushtuar për të ofruar ekselencë dhe stil.',
                    'select_service' => 'Zgjidh Shërbimin',
                    'about_us' => 'Rreth Nesh',
                    'contact' => 'Kontakt',
                    'links' => 'Linqe',
                    'footer_text' => 'Ndërtojmë të ardhmen e menaxhimit të shërbimeve me dizajn minimalist dhe teknologji të fuqishme.',
                ];
            }

            if (!File::exists($path)) {
                $content = "<?php\n\nreturn " . var_export($defaults, true) . ";\n";
                $content = str_replace(['array (', ')'], ['[', ']'], $content);
                File::put($path, $content);
            }
        }
    }

    protected function generateLivewireComponent($groupStudly, $groupKebab, $sections)
    {
        $dir = app_path("Livewire/Front/$groupStudly");
        File::makeDirectory($dir, 0755, true, true);

        $dataLogic = "";
        foreach ($sections as $s) {
            $class = ltrim($s['class'], '\\');
            $dataLogic .= "            '{$s['var']}' => \\{$class}::where('active', true)->get(),\n";
        }

        $stub = "<?php\n\nnamespace App\Livewire\Front\\$groupStudly;\n\nuse Livewire\Component;\nuse Livewire\Attributes\Title;\n\n#[Title('$groupStudly')] \nclass Landing extends Component\n{\n    public function render()\n    {\n        return view('livewire.front.$groupKebab.landing', [\n$dataLogic        ])->layout('components.layouts.front');\n    }\n}";
        File::put("$dir/Landing.php", $stub);
    }

    protected function generateView($group, $groupStudly, $groupKebab, $sections)
    {
        $dir = resource_path("views/livewire/front/$groupKebab");
        File::makeDirectory($dir, 0755, true, true);

        $trans = "front/$groupKebab";

        $htmlSections = "";
        foreach ($sections as $s) {
            $descField = $s['descField'];
            $nameField = $s['nameField'];
            $priceField = $s['priceField'];
            $photoField = $s['photoField'];
            $var = $s['var'];

            if ($s['hasPrice']) {
                $descHtml = $descField ? "
                        @if(\$item->$descField)
                            <p class=\"text-gray-500 text-sm leading-relaxed mb-6\">{{ \$item->$descField }}</p>
                        @endif" : "";

                $htmlSections .= "
        {{-- {$s['label']} Section --}}
        <section class=\"py-20 border-t border-gray-100\">
            <div class=\"text-center mb-16\">
                <h2 class=\"text-4xl font-black text-gray-900 mb-4\">{{ __('$trans.our_services') }}</h2>
                <p class=\"text-gray-500 max-w-2xl mx-auto\">{{ __('$trans.services_subtitle') }}</p>
            </div>
            <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8\">
                @foreach(\$$var as \$item)
                    <div class=\"group p-8 bg-white rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300\">
                        <div class=\"mb-6 flex items-center justify-between\">
                            <div class=\"p-3 bg-blue-50 text-blue-600 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-colors\">
                                <x-dynamic-component component=\"heroicon-o-sparkles\" class=\"size-6\"/>
                            </div>
                            <span class=\"text-2xl font-black text-blue-600\">L {{ number_format(\$item->$priceField, 0) }}</span>
                        </div>
                        <h3 class=\"text-xl font-bold text-gray-900 mb-2\">{{ \$item->$nameField }}</h3>
                        $descHtml
                        <button class=\"w-full py-3 text-sm font-bold text-gray-400 group-hover:text-blue-600 border border-gray-100 group-hover:border-blue-100 rounded-2xl transition-all\">{{ __('$trans.select_service') }}</button>
                    </div>
                @endforeach
            </div>
        </section>";
            } elseif ($s['hasPhoto']) {
                $descHtml = $descField ? "
                        @if(\$item->$descField)
                            <p class=\"text-blue-600 font-bold text-sm uppercase tracking-widest mt-1\">{{ \$item->$descField }}</p>
                        @endif" : "";

                $htmlSections .= "
        {{-- {$s['label']} Section --}}
        <section class=\"py-20 border-t border-gray-100\">
            <div class=\"text-center mb-16\">
                <h2 class=\"text-4xl font-black text-gray-900 mb-4\">{{ __('$trans.meet_team') }}</h2>
                <p class=\"text-gray-500 max-w-2xl mx-auto\">{{ __('$trans.team_subtitle') }}</p>
            </div>
            <div class=\"grid grid-cols-1 md:grid-cols-3 gap-10\">
                @foreach(\$$var as \$item)
                    <div class=\"flex flex-col items-center group\">
                        <div class=\"size-48 rounded-[3rem] overflow-hidden mb-6 shadow-lg rotate-3 group-hover:rotate-0 transition-transform\">
                            @if(\$item->$photoField)
                                <img src=\"{{ asset('storage/'.\$item->$photoField) }}\" class=\"w-full h-full object-cover\">
                            @else
                                <div class=\"w-full h-full bg-gray-100 flex items-center justify-center text-4xl font-black text-gray-300\">{{ substr(\$item->$nameField, 0, 1) }}</div>
                            @endif
                        </div>
                        <h3 class=\"text-2xl font-black text-gray-900\">{{ \$item->$nameField }}</h3>
                        $descHtml
                    </div>
                @endforeach
            </div>
        </section>";
            }
        }

        $stub = "
<div class=\"bg-white selection:bg-blue-100 selection:text-blue-900\">
    {{-- Hero Section --}}
    <section class=\"relative pt-32 pb-20 overflow-hidden\">
        <div class=\"absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-[radial-gradient(circle_at_top,_var(--tw-gradient-stops))] from-blue-50/50 via-white to-transparent -z-10\"></div>
        <div class=\"container mx-auto px-6 text-center\">
            <div class=\"inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-xs font-black uppercase tracking-widest mb-8\">
                <span class=\"size-2 rounded-full bg-blue-600 animate-pulse\"></span>
                {{ __('$trans.welcome_to') }} $group
            </div>
            <h1 class=\"text-6xl md:text-8xl font-black text-gray-900 tracking-tighter mb-8\">
                {{ __('$trans.elevate_experience') }}
            </h1>
            <p class=\"text-xl text-gray-500 max-w-2xl mx-auto mb-12 leading-relaxed\">
                {{ __('$trans.hero_subtitle') }}
            </p>
            <div class=\"flex flex-col sm:flex-row items-center justify-center gap-4\">
                <button class=\"px-10 py-5 bg-gray-900 text-white rounded-[2rem] font-bold text-lg hover:bg-blue-600 hover:shadow-2xl hover:shadow-blue-200 transition-all duration-300\">{{ __('$trans.book_now') }}</button>
                <button class=\"px-10 py-5 bg-white text-gray-900 border border-gray-100 rounded-[2rem] font-bold text-lg hover:border-gray-300 transition-all\">{{ __('$trans.view_portfolio') }}</button>
            </div>
        </div>
    </section>

    <div class=\"container mx-auto px-6\">
        $htmlSections
    </div>

    {{-- Footer --}}
    <footer class=\"py-20 bg-gray-50 mt-20\">
        <div class=\"container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12\">
            <div class=\"col-span-1 md:col-span-2\">
                <h2 class=\"text-2xl font-black text-gray-900 mb-6\">$group</h2>
                <p class=\"text-gray-500 max-w-sm\">{{ __('$trans.footer_text') }}</p>
            </div>
            <div>
                <h4 class=\"font-bold text-gray-900 mb-6\">{{ __('$trans.links') }}</h4>
                <ul class=\"space-y-4 text-gray-500\">
                    <li><a href=\"#\" class=\"hover:text-blue-600 transition-colors\">{{ __('$trans.about_us') }}</a></li>
                    <li><a href=\"#\" class=\"hover:text-blue-600 transition-colors\">{{ __('$trans.our_services') }}</a></li>
                    <li><a href=\"#\" class=\"hover:text-blue-600 transition-colors\">{{ __('$trans.contact') }}</a></li>
                </ul>
            </div>
            <div>
                <h4 class=\"font-bold text-gray-900 mb-6\">{{ __('$trans.contact') }}</h4>
                <ul class=\"space-y-4 text-gray-500 text-sm\">
                    <li class=\"flex items-center gap-2\"><x-dynamic-component component=\"heroicon-o-map-pin\" class=\"size-4\"/> Tirana, Albania</li>
                    <li class=\"flex items-center gap-2\"><x-dynamic-component component=\"heroicon-o-phone\" class=\"size-4\"/> +355 6X XXX XXXX</li>
                </ul>
            </div>
        </div>
    </footer>
</div>";

        File::put("$dir/landing.blade.php", $stub);
    }

    protected function registerRoute($groupKebab, $groupStudly)
    {
        $path = base_path("routes/front.php");
        if (!File::exists($path)) {
            File::put($path, "<?php\n\nuse Illuminate\Support\Facades\Route;\n");
        }

        $route = "\nRoute::get('/$groupKebab', \\App\\Livewire\\Front\\{$groupStudly}\\Landing::class)->name('front.$groupKebab');";

        $content = File::get($path);
        if (!str_contains($content, "front.$groupKebab")) {
            File::append($path, $route);
        }
    }

    protected function addNavigationLink($group, $groupKebab)
    {
        $navPath = resource_path('views/components/layouts/app/navigation.blade.php');
        if (!File::exists($navPath)) return;
        $content = File::get($navPath);

        $newLink = "\n    <x-nav.link route=\"front.$groupKebab\" icon=\"globe-alt\" target=\"_blank\">{{ __('admin.Landing Page') }}</x-nav.link>";

        $escapedGroup = preg_quote("{{ __('admin.$group') }}", '/');
        $groupPattern = "/<x-nav\.group label=['\"]([0-9]+\. )?{$escapedGroup}['\"].*?>/s";

        if (preg_match($groupPattern, $content, $matches)) {
            $groupStartTag = $matches[0];

            if (str_contains($content, "route=\"front.$groupKebab\"")) {
                return;
            }

            $content = str_replace($groupStartTag, $groupStartTag . $newLink, $content);
            File::put($navPath, $content);
        }
    }
}
