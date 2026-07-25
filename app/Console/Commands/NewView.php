<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Permission;

class NewView extends Command
{
    protected $signature = 'new:view {name} {--api : Generate API layer automatically} {--firebase : Enable Firebase notifications}';
    protected $description = 'Enterprise DDD Scaffolder with Events, Listeners, API and Firebase';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $tableName = Str::snake(Str::pluralStudly($name));
        $pluralName = Str::plural($name);
        $pluralKebab = Str::kebab($pluralName);
        $pluralSnake = Str::snake($pluralName);

        $fields = [];
        $this->info("🏗️ Starting Enterprise Automation for $name");

        while (true) {
            $fieldName = $this->ask('Field name (leave empty to finish)');
            if (!$fieldName) break;

            $type = $this->choice('Field type', [
                'string', 'text', 'integer', 'bigInteger', 'boolean', 'decimal', 'date', 'datetime', 'foreignId', 'enum'
            ], 0);

            $extra = '';
            $relatedModel = '';
            $options = [];
            if ($type === 'foreignId') {
                $extra = $this->ask('Constrained table (e.g. users)', Str::snake(Str::pluralStudly(str_replace('_id', '', $fieldName))));
                $relatedModel = Str::studly(Str::singular($extra));
            }

            if ($type === 'enum') {
                $optRaw = $this->ask('Enum options (comma separated)');
                $options = array_map('trim', explode(',', $optRaw));
            }

            $fields[] = [
                'name' => $fieldName,
                'type' => $type,
                'constrained' => $extra,
                'relatedModel' => $relatedModel,
                'options' => $options,
                'nullable' => $this->confirm('Nullable?', false)
            ];
        }

        $icon = $this->ask('Menu icon (Heroicon name)', 'chevron-right');

        $withApi = $this->option('api') || ($this->choice('Do you want to generate an API layer?', ['No', 'Yes'], 0) === 'Yes');
        $withFirebase = $this->option('firebase') || ($this->choice('Enable Firebase Notifications for this module?', ['No', 'Yes'], 0) === 'Yes');

        // DDD Domain Structure
        $this->generateDomainStructure($name, $fields, $withFirebase);

        // Core Files
        $this->generateMigration($tableName, $fields);
        $this->generateModel($name, $fields);

        // UI Layer
        $this->generateLivewireComponents($name, $pluralSnake, $pluralName, $pluralKebab, $fields);
        $this->generateViews($name, $fields, $pluralSnake, $pluralName);

        // API Layer
        if ($withApi) {
            $this->generateApiLayer($name, $pluralName, $pluralKebab, $fields);
        }

        $this->info("💾 Migrating...");
        $this->call('migrate');

        $this->addPermissions($name, $pluralSnake);
        $this->generateTranslationFiles($pluralKebab, $name, $fields);
        $this->generateRouteFile($pluralName, $pluralKebab, $name, $pluralSnake);
        $this->addNavigation($pluralName, $pluralKebab, $pluralSnake, $icon);

        $this->info("✅ DONE! Enterprise Module $name is ready.");
    }

    protected function generateDomainStructure($name, $fields, $withFirebase = false)
    {
        $baseDir = app_path("Domain/$name");
        File::makeDirectory("$baseDir/Actions", 0755, true, true);
        File::makeDirectory("$baseDir/DTOs", 0755, true, true);
        File::makeDirectory("$baseDir/Queries", 0755, true, true);
        File::makeDirectory("$baseDir/Events", 0755, true, true);
        File::makeDirectory("$baseDir/Listeners", 0755, true, true);

        $this->generateDTO($name, $fields);
        $this->generateQuery($name, $fields);
        $this->generateEvents($name);
        $this->generateListeners($name, $withFirebase);
        $this->generateActions($name);
    }

    protected function generateActions($name)
    {
        $dir = app_path("Domain/$name/Actions");
        $eventClass = "App\Domain\\$name\Events\\{$name}Created";

        File::put("$dir/Create{$name}Action.php", "<?php\n\nnamespace App\Domain\\$name\Actions;\n\nuse App\Models\\$name;\nuse App\Domain\\$name\DTOs\\{$name}DTO;\nuse App\Domain\\$name\Events\\{$name}Created;\n\nclass Create{$name}Action\n{\n    public function execute({$name}DTO \$dto): $name \n    {\n        \$model = $name::create(\$dto->toArray());\n        event(new {$name}Created(\$model));\n        return \$model;\n    }\n}");
        File::put("$dir/Update{$name}Action.php", "<?php\n\nnamespace App\Domain\\$name\Actions;\n\nuse App\Models\\$name;\nuse App\Domain\\$name\DTOs\\{$name}DTO;\n\nclass Update{$name}Action\n{\n    public function execute($name \$model, {$name}DTO \$dto): $name\n    {\n        \$model->update(\$dto->toArray());\n        return \$model->fresh();\n    }\n}");
        File::put("$dir/Delete{$name}Action.php", "<?php\n\nnamespace App\Domain\\$name\Actions;\n\nuse App\Models\\$name;\n\nclass Delete{$name}Action\n{\n    public function execute($name \$model): bool { return \$model->delete(); }\n}");
    }

    protected function generateEvents($name)
    {
        $dir = app_path("Domain/$name/Events");
        $stub = "<?php\n\nnamespace App\Domain\\$name\Events;\n\nuse App\Models\\$name;\nuse Illuminate\Foundation\Events\Dispatchable;\nuse Illuminate\Queue\SerializesModels;\n\nclass {$name}Created\n{\n    use Dispatchable, SerializesModels;\n    public function __construct(public $name \$model) {}\n}";
        File::put("$dir/{$name}Created.php", $stub);
    }

    protected function generateListeners($name, $withFirebase)
    {
        $dir = app_path("Domain/$name/Listeners");
        if (!$withFirebase) return;

        $stub = "<?php\n\nnamespace App\Domain\\$name\Listeners;\n\nuse App\Domain\\$name\Events\\{$name}Created;\nuse App\Services\FirebaseService;\nuse App\Models\Setting;\n\nclass SendFirebaseNotification\n{\n    public function handle({$name}Created \$event)\n    {\n        \$shouldNotify = (bool) Setting::where('key', 'notify_firebase_$name')->value('value');\n        \n        if (\$shouldNotify) {\n            (new FirebaseService())->sendNotification(\n                'New $name Created',\n                'A new record has been added to ' . '$name'\n            );\n        }\n    }\n}";
        File::put("$dir/SendFirebaseNotification.php", $stub);

        $this->registerEventListener($name);
    }

    protected function registerEventListener($name)
    {
        $path = app_path('Providers/EventServiceProvider.php');
        if (!File::exists($path)) return;

        $event = "App\Domain\\$name\Events\\{$name}Created";
        $listener = "App\Domain\\$name\Listeners\SendFirebaseNotification";

        $content = File::get($path);
        $search = 'protected $listen = [';
        $entry = "\n        \\$event::class => [\n            \\$listener::class,\n        ],";

        if (!str_contains($content, $event)) {
            File::put($path, str_replace($search, $search . $entry, $content));
        }
    }

    protected function generateDTO($name, $fields)
    {
        $props = ""; $fromArray = ""; $toArray = "";
        foreach ($fields as $f) {
            $type = in_array($f['type'], ['integer', 'bigInteger']) ? 'int' : (in_array($f['type'], ['decimal', 'float']) ? 'float' : ($f['type'] === 'boolean' ? 'bool' : 'string'));
            $props .= "        public readonly ?$type \${$f['name']},\n";
            $fromArray .= "            {$f['name']}: \$data['{$f['name']}'] ?? null,\n";
            $toArray .= "            '{$f['name']}' => \$this->{$f['name']},\n";
        }
        $stub = "<?php\n\nnamespace App\Domain\\$name\DTOs;\n\nclass {$name}DTO\n{\n    public function __construct(\n$props    ) {}\n    public static function fromArray(array \$data): self { return new self(\n$fromArray        ); }\n    public function toArray(): array { return [\n$toArray        ]; }\n}";
        File::put(app_path("Domain/$name/DTOs/{$name}DTO.php"), $stub);
    }

    protected function generateQuery($name, $fields)
    {
        $with = collect($fields)->filter(fn($f) => $f['type'] === 'foreignId')->map(fn($f) => "'" . Str::camel(str_replace('_id', '', $f['name'])) . "'")->implode(', ');
        $filters = "";
        foreach ($fields as $f) {
            if ($f['type'] === 'foreignId' || $f['type'] === 'enum') {
                $filters .= "        if (isset(\$params['{$f['name']}']) && \$params['{$f['name']}']) \$query->where('{$f['name']}', \$params['{$f['name']}']);\n";
            }
        }

        $stub = "<?php\n\nnamespace App\Domain\\$name\Queries;\n\nuse App\Models\\$name;\nuse Illuminate\Database\Eloquent\Builder;\n\nclass {$name}ListQuery\n{\n    public function handle(array \$params = [], string \$sortField = 'id', string \$sortAsc = 'asc'): Builder\n    {\n        \$query = $name::query()" . ($with ? "->with([$with])" : "") . ";\n        if (isset(\$params['search']) && \$params['search']) {\n            \$query->where('id', 'like', '%' . \$params['search'] . '%');\n        }\n$filters\n        return \$query->orderBy(\$sortField, \$sortAsc);\n    }\n}";
        File::put(app_path("Domain/$name/Queries/{$name}ListQuery.php"), $stub);
    }

    protected function generateModel($name, $fields)
    {
        $fillable = collect($fields)->map(fn($f) => "'{$f['name']}'")->implode(', ');
        $relations = ""; $casts = ""; $rules = ""; $sortable = "'id'";
        foreach ($fields as $f) {
            if ($f['type'] === 'foreignId') {
                $rel = Str::camel(str_replace('_id', '', $f['name']));
                $relModel = $f['relatedModel'];
                $relations .= "\n    public function $rel(): \Illuminate\Database\Eloquent\Relations\BelongsTo\n    {\n        return \$this->belongsTo(\\App\Models\\$relModel::class, '{$f['name']}');\n    }\n";
            }
            if ($f['type'] === 'boolean') $casts .= "            '{$f['name']}' => 'boolean',\n";
            if (in_array($f['type'], ['date', 'datetime'])) $casts .= "            '{$f['name']}' => 'datetime',\n";
            $ruleSet = $f['nullable'] ? "'nullable'" : "'required'";
            if ($f['type'] === 'string') $ruleSet .= ", 'string', 'max:255'";
            if (in_array($f['type'], ['integer', 'bigInteger'])) $ruleSet .= ", 'numeric'";
            if ($f['type'] === 'date') $ruleSet .= ", 'date'";
            if ($f['type'] === 'enum') $ruleSet .= ", 'in:" . implode(',', $f['options']) . "'";
            $rules .= "            '{$f['name']}' => [$ruleSet],\n";
            if ($f['type'] === 'foreignId') $rules .= "            'new_" . str_replace('_id', '', $f['name']) . "_name' => ['required_if:{$f['name']},new'],\n";
            if (!in_array($f['type'], ['text'])) $sortable .= ", '{$f['name']}'";
        }

        $stub = "<?php\n\nnamespace App\Models;\n\nuse Illuminate\Database\Eloquent\Factories\HasFactory;\nuse Illuminate\Database\Eloquent\Model;\n\nclass $name extends Model\n{\n    use HasFactory;\n    protected \$fillable = [$fillable];\n    protected function casts(): array { return [\n$casts        ]; }\n    public static function rules(\$id = null): array { return [\n$rules        ]; }\n    public static function sortable(): array { return [$sortable]; }\n$relations\n}";
        File::put(app_path("Models/$name.php"), $stub);
    }

    protected function generateLivewireComponents($name, $pluralSnake, $pluralName, $pluralKebab, $fields)
    {
        $dir = app_path("Livewire/Admin/$pluralName");
        if (!File::isDirectory($dir)) File::makeDirectory($dir, 0755, true);
        $viewPath = "livewire.admin." . Str::kebab($pluralName);

        // INDEX
        $filtersProps = ""; $filtersReset = ""; $availableLists = "";
        foreach($fields as $f) {
            if ($f['type'] === 'foreignId') {
                $rv = Str::plural(Str::camel(str_replace('_id', '', $f['name'])));
                $filtersProps .= "    #[Url(history: true)] public \${$f['name']} = '';\n";
                $filtersReset .= "'{$f['name']}', ";
                $availableLists .= "            '{$rv}' => \\App\Models\\{$f['relatedModel']}::pluck('name', 'id')->toArray(),\n";
            }
        }
        $indexStub = "<?php\n\nnamespace App\Livewire\Admin\\$pluralName;\n\nuse App\Models\\$name;\nuse App\Domain\\$name\Queries\\{$name}ListQuery;\nuse App\Domain\\$name\Actions\\Delete{$name}Action;\nuse Livewire\{Component, WithPagination, Attributes\Title, Attributes\Url};\n\n#[Title('$pluralName')]\nclass $pluralName extends Component\n{\n    use WithPagination;\n    public int \$paginate = 10;\n    #[Url(history: true)] public string \$search = '';\n$filtersProps    public bool \$openFilter = false;\n    public string \$sortField = 'id';\n    public bool \$sortAsc = true;\n\n    public function updatedSearch() { \$this->resetPage(); }\n    public function resetFilters() { \$this->reset(['search', 'openFilter', $filtersReset]); }\n\n    public function render()\n    {\n        abort_if_cannot('view_{$pluralSnake}');\n        \$query = (new {$name}ListQuery())->handle([\n            'search' => \$this->search,\n" . collect($fields)->filter(fn($f) => $f['type'] === 'foreignId')->map(fn($f) => "            '{$f['name']}' => \$this->{$f['name']},")->implode("\n") . "\n        ], \$this->sortField, \$this->sortAsc ? 'asc' : 'desc');\n\n        return view('$viewPath.index', [\n            'items' => \$query->paginate(\$this->paginate),\n            'sortableFields' => $name::sortable(),\n$availableLists        ])->layout('components.layouts.app');\n    }\n\n    public function sortBy(string \$field) { if (!in_array(\$field, $name::sortable())) return; if (\$this->sortField === \$field) { \$this->sortAsc = ! \$this->sortAsc; } \$this->sortField = \$field; }\n\n    public function delete$name(string \$id, Delete{$name}Action \$action)
    {
        abort_if_cannot('delete_{$pluralSnake}');
        try {
            \$item = $name::findOrFail(\$id);
            \$action->execute(\$item);
            \$this->dispatch('toast', message: __('$pluralKebab.deleted'), type: 'success');
            \$this->resetPage();
        } catch (\\Illuminate\\Database\\QueryException \$e) {
            if (\$e->getCode() == \"23000\" || \$e->getCode() == \"19\") {
                \$this->dispatch('toast', message: __('$pluralKebab.delete_error_referenced'), type: 'error');
            } else {
                \$this->dispatch('toast', message: __('$pluralKebab.delete_error'), type: 'error');
            }
        }
    }\n}";
        File::put("$dir/$pluralName.php", $indexStub);

        // CREATE
        $props = ""; $newCreators = ""; $dataMap = "";
        foreach ($fields as $f) {
            $props .= "    public \${$f['name']} = '';\n";
            $dataMap .= "            '{$f['name']}' => \$this->{$f['name']},\n";
            if ($f['type'] === 'foreignId') {
                $rv = Str::plural(Str::camel(str_replace('_id', '', $f['name'])));
                $props .= "    public \$new_" . str_replace('_id', '', $f['name']) . "_name = '';\n";
                $newCreators .= "        if (\$this->{$f['name']} === 'new') { \$rel = \\App\Models\\{$f['relatedModel']}::create(['name' => \$this->new_" . str_replace('_id', '', $f['name']) . "_name, 'slug' => Str::slug(\$this->new_" . str_replace('_id', '', $f['name']) . "_name)]); \$this->{$f['name']} = \$rel->id; }\n";
            }
        }
        $createStub = "<?php\n\nnamespace App\Livewire\Admin\\$pluralName;\n\nuse App\Models\\$name;\nuse App\Domain\\$name\DTOs\\{$name}DTO;\nuse App\Domain\\$name\Actions\\Create{$name}Action;\nuse Illuminate\Support\Str;\nuse Livewire\{Component, Attributes\Title};\n\n#[Title('Add $name')]\nclass Create extends Component\n{\n$props\n    public function render() { abort_if_cannot('add_{$pluralSnake}'); return view('$viewPath.create', [\n$availableLists        ])->layout('components.layouts.app'); }\n\n    public function store(Create{$name}Action \$action)\n    {\n        \$this->validate();\n$newCreators\n        \$dto = {$name}DTO::fromArray([\n$dataMap        ]);\n        \$action->execute(\$dto);\n        session()->flash('success', __('$pluralKebab.created'));\n        return to_route('admin.$pluralKebab.index');\n    }\n    protected function rules(): array { return $name::rules(); }\n}";
        File::put("$dir/Create.php", $createStub);

        // EDIT
        $camelName = Str::camel($name);
        $editStub = "<?php\n\nnamespace App\Livewire\Admin\\$pluralName;\n\nuse App\Models\\$name;\nuse App\Domain\\$name\DTOs\\{$name}DTO;\nuse App\Domain\\$name\Actions\\Update{$name}Action;\nuse Illuminate\Support\Str;\nuse Livewire\{Component, Attributes\Title};\n\n#[Title('Edit $name')]\nclass Edit extends Component\n{\n    public $name \$item;\n$props\n    public function mount($name \$" . $camelName . ") { \$this->item = \$" . $camelName . "; \$this->fill(\$" . $camelName . "->toArray()); " . collect($fields)->filter(fn($f) => $f['type'] === 'date')->map(fn($f) => "\$this->{$f['name']} = \$" . $camelName . "->{$f['name']}?->format('Y-m-d');")->implode(" ") . " }\n    public function render() { abort_if_cannot('edit_{$pluralSnake}'); return view('$viewPath.edit', [\n$availableLists        ])->layout('components.layouts.app'); }\n\n    public function update(Update{$name}Action \$action)\n    {\n        \$this->validate();\n$newCreators\n        \$dto = {$name}DTO::fromArray([\n$dataMap        ]);\n        \$action->execute(\$this->item, \$dto);\n        session()->flash('success', __('$pluralKebab.updated'));\n        return to_route('admin.$pluralKebab.index');\n    }\n    protected function rules(): array { return $name::rules(\$this->item->id); }\n}";
        File::put("$dir/Edit.php", $editStub);
        File::put("$dir/Row.php", "<?php\n\nnamespace App\Livewire\Admin\\$pluralName;\n\nuse App\Models\\$name;\nuse Livewire\Component;\n\nclass Row extends Component { public $name \$item; public function render() { return view('$viewPath.row'); } }");
    }

    protected function generateViews($name, $fields, $pluralSnake, $pluralName)
    {
        $dir = resource_path("views/livewire/admin/" . Str::kebab($pluralName));
        if (!File::isDirectory($dir)) File::makeDirectory($dir, 0755, true);
        File::put("$dir/index.blade.php", $this->getIndexViewStub($name, $fields, $pluralSnake, $pluralName));
        File::put("$dir/create.blade.php", $this->getCreateViewStub($name, $fields, $pluralSnake, $pluralName));
        File::put("$dir/edit.blade.php", $this->getEditViewStub($name, $fields, $pluralSnake, $pluralName));
        File::put("$dir/row.blade.php", $this->getRowViewStub($name, $fields, $pluralSnake, $pluralName));
    }

    protected function getIndexViewStub($name, $fields, $pluralSnake, $pluralName) {
        $pk = Str::kebab($pluralName);
        $headers = "                <x-table.th name=\"id\" :label=\"__('$pk.ID')\" :\$sortField :\$sortAsc :sortable=\"in_array('id', \$sortableFields)\" />\n"; $filters = "";
        foreach ($fields as $f) {
            $label = Str::title(str_replace('_', ' ', $f['name']));
            $headers .= "                <x-table.th name=\"{$f['name']}\" :label=\"__('$pk.$label')\" :\$sortField :\$sortAsc :sortable=\"in_array('{$f['name']}', \$sortableFields)\" />\n";
            if ($f['type'] === 'foreignId') {
                $rv = Str::plural(Str::camel(str_replace('_id', '', $f['name'])));
                $filters .= "            <div><x-form.dropdown-search wire:model.live=\"{$f['name']}\" :label=\"__('$pk.$label')\" :data=\"\${$rv}\" :placeholder=\"__('$pk.Filter $label')\" /></div>\n";
            }
        }
        $listKey = "List of " . strtolower($pluralName);
        return "<div class=\"space-y-8\" x-data=\"{ openFilter: @entangle('openFilter') }\"><div class=\"flex flex-col sm:flex-row sm:items-center justify-between gap-4 px-1\"><div><x-h1>{{ __('$pk.$pluralName') }}</x-h1><x-short-description>{{ __('$pk.$listKey') }}</x-short-description></div><div class=\"flex items-center gap-3\">@if(\$search || \$openFilter)<button wire:click=\"resetFilters\" class=\"inline-flex items-center gap-1.5 px-3 py-2 text-xs font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-2xl transition-none\"><span>{{ __('$pk.Reset') }}</span></button>@endif <button @click=\"openFilter = !openFilter\" class=\"inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-gray-600 dark:text-gray-400 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-sm transition-none\"><span>{{ __('$pk.Filters') }}</span></button> @can('add_{$pluralSnake}')<x-btn :href=\"route('admin." . Str::kebab($pluralName) . ".create')\" icon=\"plus\">{{ __('$pk.Add $name') }}</x-btn>@endcan</div></div><div x-show=\"openFilter\" x-cloak x-transition:enter=\"transition ease-out duration-300\" x-transition:enter-start=\"opacity-0 -translate-y-4\" class=\"p-6 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-[2rem] shadow-sm\"><div class=\"grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6\"><div><label class=\"block mb-1.5 text-[10px] font-bold text-gray-900 dark:text-gray-100 uppercase tracking-widest ml-1\">{{ __('$pk.Search') }}</label><input wire:model.live.debounce.300ms=\"search\" type=\"text\" placeholder=\"{{ __('$pk.Search') }}...\" class=\"w-full p-3 text-sm font-bold bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:ring-2 focus:ring-blue-500/20 transition shadow-sm dark:text-white\"></div>$filters</div></div>@include('errors.messages')<div class=\"overflow-hidden bg-white dark:bg-gray-800 rounded-[2rem] border border-gray-50 dark:border-gray-700 shadow-sm\"><div class=\"overflow-x-auto\"><table class=\"w-full text-sm text-left text-gray-500 dark:text-gray-400\"><thead class=\"bg-gray-50/50 dark:bg-gray-900/50\"><tr>$headers<th class=\"px-4 py-4 text-right text-[10px] font-black uppercase text-gray-400 tracking-widest\">{{ __('$pk.Action') }}</th></tr></thead><tbody class=\"divide-y divide-gray-50 dark:divide-gray-700/50\">@foreach(\$items as \$item)<livewire:admin." . Str::kebab($pluralName) . ".row :\$item :key=\"\$item->id\" />@endforeach</tbody></table></div><div class=\"p-4 border-t border-gray-50 dark:border-gray-700/50\">{{ \$items->links() }}</div></div></div>";
    }

    protected function getCreateViewStub($name, $fields, $pluralSnake, $pluralName) {
        $pk = Str::kebab($pluralName);
        return "<div class=\"space-y-10\"><div class=\"flex items-center justify-between gap-4 px-1\"><div><x-h1>{{ __('$pk.Add $name') }}</x-h1><x-short-description>{{ __('$pk.New $name record') }}</x-short-description></div><x-back-btn route=\"admin.{$pk}.index\" /></div><div class=\"bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700\"><form wire:submit.prevent=\"store\" class=\"space-y-8\">" . $this->getFormInputs($fields, $pk) . "<div class=\"mt-10 flex justify-end\"><x-button type=\"submit\" variant=\"blue\" class=\"w-full sm:w-auto !px-12 !py-4 !rounded-2xl\">{{ __('$pk.Save') }}</x-button></div></form></div></div>";
    }

    protected function getEditViewStub($name, $fields, $pluralSnake, $pluralName) {
        $pk = Str::kebab($pluralName);
        return "<div class=\"space-y-10\"><div class=\"flex items-center justify-between gap-4 px-1\"><div><x-h1>{{ __('$pk.Edit $name') }}</x-h1><x-short-description>{{ __('$pk.Update $name info') }}</x-short-description></div><x-back-btn route=\"admin.{$pk}.index\" /></div><div class=\"bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700\"><form wire:submit.prevent=\"update\" class=\"space-y-8\">" . $this->getFormInputs($fields, $pk) . "<div class=\"mt-10 flex justify-end\"><x-button type=\"submit\" variant=\"blue\" class=\"w-full sm:w-auto !px-12 !py-4 !rounded-2xl\">{{ __('$pk.Update') }}</x-button></div></form></div></div>";
    }

    protected function getRowViewStub($name, $fields, $pluralSnake, $pluralName) {
        $pk = Str::kebab($pluralName);
        $cells = "    <td class=\"px-4 py-5 font-bold text-blue-600 dark:text-blue-400\">{{ \$item->id }}</td>\n";

        $displayNameField = 'id';
        foreach ($fields as $f) {
            if (in_array($f['name'], ['name', 'title', 'label'])) {
                $displayNameField = $f['name'];
            }
            if ($f['type'] === 'foreignId') {
                $rel = Str::camel(str_replace('_id', '', $f['name']));
                $cells .= "    <td class=\"px-4 py-5 font-bold text-gray-900 dark:text-white\">{{ \$item->{$rel}->name ?? \$item->{$f['name']} }}</td>\n";
            } elseif($f['type'] === 'date') {
                 $cells .= "    <td class=\"px-4 py-5 font-medium text-gray-600 dark:text-gray-300\">{{ \$item->{$f['name']}?->format('d/m/Y') }}</td>\n";
            } else {
                $cells .= "    <td class=\"px-4 py-5 font-medium text-gray-600 dark:text-gray-300\">{{ \$item->{$f['name']} }}</td>\n";
            }
        }

        return "
<tr class=\"hover:bg-gray-50/50 dark:hover:bg-gray-900/50 transition-none border-b border-gray-50 dark:border-gray-700/50 last:border-none\">
    $cells
    <td class=\"px-4 py-5 text-right\">
        <div class=\"flex justify-end gap-3\">
            @can('edit_{$pluralSnake}')
                <x-a href=\"{{ route('admin.$pk.edit', ['" . Str::camel($name) . "' => \$item->id]) }}\" class=\"!rounded-xl !bg-blue-50 dark:!bg-blue-900/30 !text-blue-600 dark:!text-blue-400 !px-4 !py-1.5 !text-[10px] !font-black !uppercase !border-none\">
                    {{ __('admin.Edit') }}
                </x-a>
            @endcan

            @can('delete_{$pluralSnake}')
                <div x-data=\"{ confirmation: '' }\" class=\"inline-block\">
                    <x-modal>
                        <x-slot name=\"trigger\">
                            <button @click=\"on = true\" class=\"text-[10px] font-black uppercase text-red-400 hover:text-red-600 dark:hover:text-red-300 transition-none\">
                                {{ __('admin.Delete') }}
                            </button>
                        </x-slot>

                        <x-slot name=\"modalTitle\">
                            <div class=\"py-2 text-lg font-black uppercase tracking-tighter text-gray-900 dark:text-white whitespace-normal text-left\">
                                {{ __('$pk.Are you sure you want to delete') }}: <span class=\"text-red-600\">{{ \$item->{$displayNameField} }}</span>?
                            </div>
                        </x-slot>

                        <x-slot name=\"content\">
                            <div class=\"space-y-4 text-left whitespace-normal\">
                                <p class=\"text-sm text-gray-500 dark:text-gray-400 leading-relaxed\">
                                    {{ __('$pk.Delete Warning') }}
                                </p>
                                <div class=\"flex flex-col gap-2\">
                                    <div class=\"text-xs text-gray-600 dark:text-gray-400\">
                                        {{ __('$pk.Type the name') }} <span class=\"font-bold text-red-600\">\"{{ \$item->{$displayNameField} }}\"</span> {{ __('$pk.to confirm') }}
                                    </div>
                                    <input x-model=\"confirmation\" class=\"px-3 py-2 text-sm border border-slate-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white w-full focus:ring-2 focus:ring-red-500 outline-none transition-all\">
                                </div>
                            </div>
                        </x-slot>

                        <x-slot name=\"footer\">
                            <x-button variant=\"gray\" @click=\"on = false\">{{ __('admin.Cancel') }}</x-button>
                            <x-button
                                variant=\"red\"
                                x-bind:disabled=\"confirmation !== '{{ \$item->{$displayNameField} }}'\"
                                wire:click=\"\$parent.delete$name('{{ \$item->id }}')\"
                                @click=\"on = false\"
                            >
                                {{ __('admin.Delete') }}
                            </x-button>
                        </x-slot>
                    </x-modal>
                </div>
            @endcan
        </div>
    </td>
</tr>";
    }

    protected function getFormInputs($fields, $pk) {
        $inputs = "<div class=\"grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8\">";
        foreach ($fields as $f) {
            $label = Str::title(str_replace('_', ' ', $f['name']));
            if ($f['type'] === 'foreignId') {
                $rv = Str::plural(Str::camel(str_replace('_id', '', $f['name'])));
                $inputs .= "<div><x-form.dropdown-search wire:model.live=\"{$f['name']}\" :label=\"__('$pk.$label')\" :data=\"\${$rv}\" :placeholder=\"__('$pk.Select $label')\" />@if(\${$f['name']} === 'new')<div class=\"mt-3 animate-in slide-in-from-top-1\"><x-form.input name=\"new_" . str_replace('_id', '', $f['name']) . "_name\" wire:model=\"new_" . str_replace('_id', '', $f['name']) . "_name\" label=\"none\" placeholder=\"{{ __('$pk.Enter New Name') }}\" class=\"!rounded-2xl !p-3.5 !bg-blue-50/30 dark:!bg-blue-900/10 !border-blue-100 dark:!border-blue-800\" /></div>@endif</div>";
            } elseif ($f['type'] === 'enum') {
                $inputs .= "<div><label class=\"block mb-2 text-[10px] font-bold text-gray-900 dark:text-gray-100 uppercase tracking-widest ml-1\">{{ __('$pk.$label') }}</label><x-form.select name=\"{$f['name']}\" wire:model=\"{$f['name']}\" label=\"none\" class=\"!rounded-2xl !p-3.5 !bg-gray-50/50 dark:!bg-gray-900/50 !border-gray-200 dark:!border-gray-700 dark:text-gray-200\"><option value=\"\">{{ __('$pk.Select $label') }}</option>";
                foreach($f['options'] as $opt) $inputs .= "<option value=\"$opt\">{{ __('$pk.' . Str::title($opt)) }}</option>";
                $inputs .= "</x-form.select></div>";
            } elseif ($f['type'] === 'boolean') {
                 $inputs .= "<div><label class=\"block mb-2 text-[10px] font-bold text-gray-900 dark:text-gray-100 uppercase tracking-widest ml-1\">{{ __('$pk.$label') }}</label><x-form.checkbox name=\"{$f['name']}\" wire:model=\"{$f['name']}\" label=\"none\" class=\"!rounded-2xl !p-3\" /></div>";
            } elseif ($f['type'] === 'text') {
                 $inputs .= "<div class=\"md:col-span-2\"><label class=\"block mb-2 text-[10px] font-bold text-gray-900 dark:text-gray-100 uppercase tracking-widest ml-1\">{{ __('$pk.$label') }}</label><x-form.textarea name=\"{$f['name']}\" wire:model=\"{$f['name']}\" label=\"none\" class=\"!rounded-2xl !p-3 !bg-gray-50/50 dark:!bg-gray-900/50 !border-gray-100 dark:!border-gray-800 dark:text-gray-200\" /></div>";
            } else {
                $it = in_array($f['type'], ['decimal', 'integer', 'bigInteger']) ? 'number' : ($f['type'] === 'date' ? 'date' : ($f['type'] === 'datetime' ? 'datetime-local' : 'text'));
                $sa = $f['type'] === 'decimal' ? 'step="0.01"' : '';
                $inputs .= "<div><label class=\"block mb-2 text-[10px] font-bold text-gray-900 dark:text-gray-100 uppercase tracking-widest ml-1\">{{ __('$pk.$label') }}</label><x-form.input type=\"$it\" $sa name=\"{$f['name']}\" wire:model=\"{$f['name']}\" label=\"none\" class=\"!rounded-2xl !p-3.5 !bg-gray-50/50 dark:!bg-gray-900/50 !border-gray-200 dark:!border-gray-700 dark:text-gray-200\" /></div>";
            }
        }
        return $inputs . "</div>";
    }

    protected function generateTranslationFiles($pk, $name, $fields)
    {
        $languages = ['en'];
        if (File::exists(lang_path())) {
            foreach (File::directories(lang_path()) as $dir) $languages[] = basename($dir);
        }
        $languages = array_unique($languages);

        $pluralName = Str::plural($name);
        $humanName = Str::title(Str::snake($name, ' '));
        $humanPlural = Str::title(Str::snake($pluralName, ' '));
        $listKey = "List of " . strtolower($pluralName);

        $service = new \App\Services\TranslationService();

        // 1. Build the basic English array
        $data = [
            'ID' => 'ID',
            $name => $humanName,
            $pluralName => $humanPlural,
            "Add $name" => "Add $humanName",
            "Edit $name" => "Edit $humanName",
            'Delete' => 'Delete',
            'Edit' => 'Edit',
            'Save' => 'Save',
            'Update' => 'Update',
            'Filters' => 'Filters',
            'Reset' => 'Reset',
            'Search' => 'Search',
            'Action' => 'Action',
            'Are you sure?' => 'Are you sure?',
            'Are you sure you want to delete' => 'Are you sure you want to delete',
            'Delete Warning' => 'This action cannot be undone. This will permanently delete the record from the database.',
            'Type the name' => 'Type the name',
            'to confirm' => 'to confirm',
            'Cancel' => 'Cancel',
            'created' => "$humanName created successfully.",
            'updated' => "$humanName updated successfully.",
            'deleted' => "$humanName deleted successfully.",
            'delete_error' => "Could not delete $humanName.",
            'delete_error_referenced' => "$humanName is referenced by other records and cannot be deleted.",
            "New $name record" => "New $humanName record",
            "Update $humanName info" => "Update $humanName info",
            $listKey => "List of " . strtolower($humanPlural),
        ];

        foreach ($fields as $f) {
            $label = Str::title(str_replace('_', ' ', $f['name']));
            $data[$label] = $label;
            $data["Filter $label"] = "Filter $label";
            $data["Select $label"] = "Select $label";
            if ($f['type'] === 'foreignId') $data['Enter New Name'] = 'Enter New Name';
            if ($f['type'] === 'enum') {
                foreach($f['options'] as $opt) $data[Str::title($opt)] = Str::title($opt);
            }
        }

        // 2. Write to each language folder
        foreach ($languages as $lang) {
            $langDir = lang_path($lang);
            if (!File::isDirectory($langDir)) File::makeDirectory($langDir, 0755, true);

            $currentData = $data;
            /*
            if ($lang !== 'en') {
                $this->info("  🌍 Auto-translating module labels to [$lang]...");
                $currentData = $service->translate($data, $lang, 'en');
            }
            */

            $phpContent = "<?php\n\nreturn " . var_export($currentData, true) . ";\n";
            $phpContent = str_replace(['array (', ')'], ['[', ']'], $phpContent);
            File::put("$langDir/$pk.php", $phpContent);

            // Ensure admin.php exists
            $adminFile = "$langDir/admin.php";
            if (!File::exists($adminFile)) {
                $adminData = ['Back to List' => ($lang === 'en' ? 'Back to List' : $service->translate('Back to List', $lang, 'en'))];
                $phpAdmin = "<?php\n\nreturn " . var_export($adminData, true) . ";\n";
                $phpAdmin = str_replace(['array (', ')'], ['[', ']'], $phpAdmin);
                File::put($adminFile, $phpAdmin);
            }
        }
    }

    protected function generateMigration($tableName, $fields)
    {
        $schemaFields = "";
        foreach ($fields as $f) {
            $line = $f['type'] === 'enum' ? "\$table->enum('{$f['name']}', ['" . implode("', '", $f['options']) . "'])" : "\$table->{$f['type']}('{$f['name']}')";
            if ($f['type'] === 'foreignId' && $f['constrained']) $line .= "->constrained('{$f['constrained']}')";
            if ($f['nullable']) $line .= "->nullable()";
            $schemaFields .= "            $line;\n";
        }
        File::put("database/migrations/".date('Y_m_d_His')."_create_{$tableName}_table.php", "<?php\n\nuse Illuminate\Database\Migrations\Migration;\nuse Illuminate\Database\Schema\Blueprint;\nuse Illuminate\Support\Facades\Schema;\n\nreturn new class extends Migration\n{\n    public function up(): void { Schema::create('$tableName', function (Blueprint \$table) { \$table->id();\n$schemaFields            \$table->timestamps(); }); }\n    public function down(): void { Schema::dropIfExists('$tableName'); }\n};");
    }

    protected function generateRouteFile($pluralName, $pluralKebab, $name, $pluralSnake) { File::put(base_path("routes/admin/$pluralKebab.php"), "<?php\n\nuse Illuminate\Support\Facades\Route;\nuse App\Livewire\Admin\\$pluralName\\$pluralName;\nuse App\Livewire\Admin\\$pluralName\\Create;\nuse App\Livewire\Admin\\$pluralName\\Edit;\n\nRoute::prefix('$pluralKebab')->group(function () {\n    Route::get('/', $pluralName::class)->name('admin.$pluralKebab.index')->middleware('can:view_{$pluralSnake}');\n    Route::get('create', Create::class)->name('admin.$pluralKebab.create')->middleware('can:add_{$pluralSnake}');\n    Route::get('{" . Str::camel($name) . "}/edit', Edit::class)->name('admin.$pluralKebab.edit')->middleware('can:edit_{$pluralSnake}');\n});\n"); }

    protected function addTranslations($name, $fields) {
        $path = base_path('lang/en.json');
        $translations = File::exists($path) ? json_decode(File::get($path), true) : [];
        $translations[$name] = $name; $translations[Str::plural($name)] = Str::plural($name);
        foreach ($fields as $field) { $label = Str::title(str_replace('_', ' ', $field['name'])); $translations[$label] = $label; }
        File::put($path, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    protected function addPermissions($name, $pluralSnake) {
        $permissions = ["view_{$pluralSnake}" => "View ".Str::plural($name), "add_{$pluralSnake}" => "Add ".Str::plural($name), "edit_{$pluralSnake}" => "Edit ".Str::plural($name), "delete_{$pluralSnake}" => "Delete ".Str::plural($name)];
        foreach ($permissions as $p => $l) Permission::firstOrCreate(['name' => $p, 'label' => $l, 'module' => Str::plural($name)]);
    }

    protected function addNavigation($pluralName, $pluralKebab, $pluralSnake, $icon) {
        $navPath = resource_path('views/components/layouts/app/navigation.blade.php');
        if (File::exists($navPath)) {
            $content = File::get($navPath);
            $newLink = "\n@can('view_{$pluralSnake}')\n    <x-nav.link route=\"admin.{$pluralKebab}.index\" icon=\"$icon\">{{ __('$pluralKebab.$pluralName') }}</x-nav.link>\n@endcan\n";
            $search = "<x-nav.divider>{{ __('admin.Account') }}</x-nav.divider>";
            if (strpos($content, $search) !== false && strpos($content, "admin.{$pluralKebab}.index") === false) {
                File::put($navPath, str_replace($search, $newLink . $search, $content));
            }
        }
    }

    protected function generateApiLayer($name, $pluralName, $pluralKebab, $fields)
    {
        $this->info("📡 Generating API Layer for $name...");

        $controllerDir = app_path("Http/Controllers/Api");
        if (!File::isDirectory($controllerDir)) File::makeDirectory($controllerDir, 0755, true);

        $resourceDir = app_path("Http/Resources");
        if (!File::isDirectory($resourceDir)) File::makeDirectory($resourceDir, 0755, true);

        $requestDir = app_path("Http/Requests/Api/$name");
        if (!File::isDirectory($requestDir)) File::makeDirectory($requestDir, 0755, true);

        // 1. Generate FormRequests
        $this->generateApiRequests($name, $fields);

        // 2. Generate Resource
        $resourceData = collect($fields)->map(fn($f) => "            '{$f['name']}' => \$this->{$f['name']},")->implode("\n");
        $resourceStub = "<?php\n\nnamespace App\Http\Resources;\n\nuse Illuminate\Http\Request;\nuse Illuminate\Http\Resources\Json\JsonResource;\n\nclass {$name}Resource extends JsonResource\n{\n    public function toArray(Request \$request): array\n    {\n        return [\n            'id' => \$this->id,\n$resourceData\n            'created_at' => \$this->created_at,\n            'updated_at' => \$this->updated_at,\n        ];\n    }\n}";
        File::put("$resourceDir/{$name}Resource.php", $resourceStub);

        // 3. Generate Controller (Matching Premium logic)
        $camelName = Str::camel($name);
        $fieldNames = collect($fields)->map(fn ($f) => "'{$f['name']}'")->implode(', ');

        $controllerStub = "<?php\n\nnamespace App\Http\Controllers\Api;\n\nuse App\Http\Controllers\Controller;\nuse App\Models\\$name;\nuse App\Http\Resources\\{$name}Resource;\nuse App\Http\Requests\Api\\$name\Store{$name}Request;\nuse App\Http\Requests\Api\\$name\Update{$name}Request;\nuse App\Domain\\$name\DTOs\\{$name}DTO;\nuse App\Domain\\$name\Actions\Create{$name}Action;\nuse App\Domain\\$name\Actions\Update{$name}Action;\nuse App\Domain\\$name\Actions\Delete{$name}Action;\nuse App\Domain\\$name\Queries\\{$name}ListQuery;\nuse App\Http\Responses\ApiResponse;\nuse Illuminate\Http\Request;\n\nclass {$name}Controller extends Controller\n{\n    public function index(Request \$request, {$name}ListQuery \$query): ApiResponse\n    {\n        \$items = \$query->handle(\$request->all())->paginate(\$request->get('per_page', 15));\n        return to_api({$name}Resource::collection(\$items));\n    }\n\n    public function store(Store{$name}Request \$request, Create{$name}Action \$action): ApiResponse\n    {\n        \$dto = {$name}DTO::fromArray(\$request->validated());\n        \$model = \$action->execute(\$dto);\n        return to_api(new {$name}Resource(\$model), 'Record created.', 201);\n    }\n\n    public function show($name \$" . $camelName . "): ApiResponse\n    {\n        return to_api(new {$name}Resource(\$" . $camelName . "));\n    }\n\n    public function update(Update{$name}Request \$request, $name \$" . $camelName . ", Update{$name}Action \$action): ApiResponse\n    {\n        \$merged = array_merge(\$" . $camelName . "->toArray(), \$request->validated());\n        \$dto = {$name}DTO::fromArray(\$merged);\n        \$model = \$action->execute(\$" . $camelName . ", \$dto);\n        return to_api(new {$name}Resource(\$model), 'Record updated.');\n    }\n\n    public function destroy($name \$" . $camelName . ", Delete{$name}Action \$action): ApiResponse\n    {\n        try {\n            \$action->execute(\$" . $camelName . ");\n            return to_api(null, 'Record deleted.', 204);\n        } catch (\\Exception \$e) {\n            return to_api(null, \$e->getMessage(), 400);\n        }\n    }\n}";
        File::put("$controllerDir/{$name}Controller.php", $controllerStub);

        // 4. Add API Routes
        $apiRoutePath = base_path("routes/api.php");
        $routeStub = "\nRoute::apiResource('$pluralKebab', \App\Http\Controllers\Api\\{$name}Controller::class);";
        File::append($apiRoutePath, $routeStub);
    }

    protected function generateApiRequests($name, $fields)
    {
        $dir = app_path("Http/Requests/Api/$name");
        $rules = "";
        foreach ($fields as $f) {
            $ruleSet = $f['nullable'] ? "'nullable'" : "'required'";
            if ($f['type'] === 'string') $ruleSet .= ", 'string', 'max:255'";
            if (in_array($f['type'], ['integer', 'bigInteger'])) $ruleSet .= ", 'numeric'";
            if ($f['type'] === 'date') $ruleSet .= ", 'date'";
            if ($f['type'] === 'enum') $ruleSet .= ", 'in:" . implode(',', $f['options']) . "'";
            $rules .= "            '{$f['name']}' => [$ruleSet],\n";
        }

        // Store Request
        $storeStub = "<?php\n\nnamespace App\Http\Requests\Api\\$name;\n\nuse Illuminate\Foundation\Http\FormRequest;\n\nclass Store{$name}Request extends FormRequest\n{\n    public function authorize(): bool { return true; }\n    public function rules(): array\n    {\n        return [\n$rules        ];\n    }\n}";
        File::put("$dir/Store{$name}Request.php", $storeStub);

        // Update Request (using 'sometimes' for partial updates)
        $updateRules = str_replace("'required'", "'sometimes'", $rules);
        $updateStub = "<?php\n\nnamespace App\Http\Requests\Api\\$name;\n\nuse Illuminate\Foundation\Http\FormRequest;\n\nclass Update{$name}Request extends FormRequest\n{\n    public function authorize(): bool { return true; }\n    public function rules(): array\n    {\n        return [\n$updateRules        ];\n    }\n}";
        File::put("$dir/Update{$name}Request.php", $updateStub);
    }
}
