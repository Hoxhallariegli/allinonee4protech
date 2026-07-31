<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Permission;

class NewView extends Command
{
    protected $signature = 'new:view {name} {--api : Generate API layer automatically} {--firebase : Enable Firebase notifications} {--group= : Group permissions and navigation} {--prefix= : Explicit table prefix for this group (only needed if two groups would otherwise collide)}';
    protected $description = 'Universal DDD Scaffolder - God Version (Pro UI, Nested Modals, Hardened)';

    protected array $reserved = [
        'class', 'function', 'array', 'return', 'if', 'else', 'elseif', 'parent', 'self', 'static',
        'string', 'int', 'integer', 'float', 'bool', 'boolean', 'object', 'null', 'true', 'false',
        'interface', 'trait', 'namespace', 'use', 'new', 'clone', 'match', 'enum', 'fn', 'yield',
        'id', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function handle()
    {
        try {
            return $this->scaffold();
        } catch (\Throwable $e) {
            $this->error('Scaffolding failed: ' . $e->getMessage());
            $this->line($e->getFile() . ':' . $e->getLine());
            return 1;
        }
    }

    protected function scaffold()
    {
        $rawName = trim((string) $this->argument('name'));
        $clean = preg_replace('/[^A-Za-z0-9_\- ]/', '', $rawName);
        $name = Str::studly((string) $clean);

        if (!$name || !preg_match('/^[A-Z][A-Za-z0-9]*$/', $name)) {
            $this->error("Invalid model name '$rawName'. Use letters and numbers only.");
            return 1;
        }
        if (in_array(strtolower($name), $this->reserved, true)) {
            $this->error("Error: '$name' is a reserved word.");
            return 1;
        }

        $pluralName = Str::plural($name);
        $pluralKebab = Str::kebab($pluralName);
        $pluralSnake = Str::snake($pluralName);

        $group = $this->option('group');
        $groupStudly = $group ? Str::studly($group) : '';
        $groupKebab = $group ? Str::kebab($group) : '';
        $groupPath = $groupStudly ? "$groupStudly/" : "";
        $groupViewPath = $groupKebab ? "$groupKebab/" : "";

        // Resolve Group Info (Prefix and Label)
        $groupInfo = $group ? $this->resolveGroupInfo($group, $groupStudly) : null;
        $initials = $groupInfo ? $groupInfo['prefix'] : '';
        // We use the raw group name for the label to keep it clean and minimalist.
        $groupLabel = $groupInfo ? $groupInfo['label'] : $pluralName;

        $tableName = $initials . Str::snake(Str::pluralStudly($name));

        // --- Overwrite guard ---
        $modelPath = app_path("Models/{$groupPath}$name.php");
        $domainPath = app_path("Domain/{$groupPath}$name");
        $livewirePath = app_path("Livewire/Admin/{$groupPath}$pluralName");
        $viewsPath = resource_path("views/livewire/admin/{$groupViewPath}" . Str::kebab($pluralName));
        $routePath = base_path("routes/admin/{$groupViewPath}$pluralKebab.php");

        $existing = array_filter([
            $modelPath => File::exists($modelPath),
            $domainPath => File::isDirectory($domainPath),
            $livewirePath => File::isDirectory($livewirePath),
            $viewsPath => File::isDirectory($viewsPath),
            $routePath => File::exists($routePath),
            "Database Table: $tableName" => Schema::hasTable($tableName),
        ]);

        if (!empty($existing)) {
            $this->warn('The following already exist and will be OVERWRITTEN (Auto-Yes):');
            foreach (array_keys($existing) as $p) {
                $this->line(" - $p");
            }

            // Cleanup before generating new ones
            if (Schema::hasTable($tableName)) {
                Schema::dropIfExists($tableName);
                // Also remove old migration files for this specific table
                $migrations = File::files(database_path('migrations'));
                foreach ($migrations as $migration) {
                    if (str_ends_with($migration->getFilename(), "_create_{$tableName}_table.php")) {
                        File::delete($migration->getPathname());
                    }
                }
            }
        }

        $fields = [];
        $usedNames = ['id', 'created_at', 'updated_at', 'deleted_at'];
        $this->info("🏗️ Starting ENTERPRISE Scaffolding for $name");

        while (true) {
            $fieldNameRaw = trim((string) $this->ask('Field name (leave empty to finish)'));
            if ($fieldNameRaw === '') {
                break;
            }

            $fieldName = Str::snake($fieldNameRaw);
            if (!preg_match('/^[a-z][a-z0-9_]*$/', $fieldName)) {
                $this->error("Invalid field name '$fieldNameRaw'. Use lowercase letters, numbers and underscores, starting with a letter.");
                continue;
            }
            if (in_array($fieldName, $usedNames, true)) {
                $this->error("Field '$fieldName' is already used or reserved.");
                continue;
            }

            $type = $this->choice('Field type', [
                'string', 'text', 'integer', 'bigInteger', 'boolean', 'decimal', 'date', 'datetime', 'foreignId', 'enum'
            ], 0);

            $extra = ''; $relatedModel = ''; $labelField = 'name'; $options = [];

            if ($type === 'foreignId') {
                $rawTable = Str::snake(trim((string) $this->ask('Constrained table', Str::snake(Str::pluralStudly(str_replace('_id', '', $fieldName))))));

                // If this scaffold is grouped, check for the prefixed sibling table first.
                // A bare name like 'customers' will automatically resolve to '5arm_customers'
                // if it exists or if we're in that group.
                $extra = $rawTable;
                if ($initials && !str_starts_with($extra, $initials)) {
                    $prefixedGuess = $initials . $rawTable;
                    if (Schema::hasTable($prefixedGuess) || !Schema::hasTable($rawTable)) {
                        if (Schema::hasTable($prefixedGuess)) {
                            $this->line("Note: auto-resolved to '$prefixedGuess' (found in group '$group').");
                        }
                        $extra = $prefixedGuess;
                    }
                }

                if (!Schema::hasTable($extra)) {
                    $this->warn("Warning: table '$extra' doesn't exist yet — migration will fail unless it's created before this one runs.");
                }

                // Model name resolution: Strip ANY known group prefix to get the base model name.
                // We load the manifest to get the exact list of prefixes currently in use.
                $cleanModelName = $extra;
                $manifestPath = storage_path('app/scaffold-groups.json');
                if (File::exists($manifestPath)) {
                    $manifest = json_decode(File::get($manifestPath), true) ?: [];
                    foreach ($manifest as $entry) {
                        $p = $entry['prefix'] ?? '';
                        if ($p && str_starts_with($extra, $p)) {
                            $cleanModelName = substr($extra, strlen($p));
                            break;
                        }
                    }
                }
                $relatedModel = Str::studly(Str::singular($cleanModelName));

                // Find correct FQCN for related model, prioritizing current group
                $relatedFQCN = $this->findModelFQCN($relatedModel, $groupStudly);
                if (!$relatedFQCN) {
                    $this->warn("Warning: Model '$relatedModel' wasn't found in app/Models — relations will error until it's created.");
                    $relatedFQCN = "App\\Models\\$relatedModel"; // Fallback
                }

                $labelField = trim((string) $this->ask("Display field for $relatedModel (supports dot notation like employee.name)?", 'name'));
                if (!preg_match('/^[a-z][a-z0-9_]*(\.[a-z][a-z0-9_]*)?$/', $labelField)) {
                    $this->warn("Invalid display field '$labelField', falling back to 'name'.");
                    $labelField = 'name';
                }
            }

            if ($type === 'enum') {
                $optRaw = (string) $this->ask('Enum options (comma separated)');
                $options = array_values(array_unique(array_filter(array_map(
                    fn ($o) => trim($o),
                    explode(',', $optRaw)
                ))));
                if (count($options) < 2) {
                    $this->error('Enum needs at least 2 non-empty, unique options. Field skipped.');
                    continue;
                }
            }

            $fields[] = [
                'name' => $fieldName, 'type' => $type, 'constrained' => $extra,
                'relatedModel' => $relatedModel, 'relatedFQCN' => $relatedFQCN ?? null,
                'labelField' => $labelField,
                'options' => $options, 'nullable' => $this->confirm('Nullable?', false)
            ];
            $usedNames[] = $fieldName;
        }

        $iconRaw = (string) $this->ask('Menu icon', 'chevron-right');
        $iconClean = preg_replace('/[^a-z0-9\-]/', '', strtolower($iconRaw)) ?: 'chevron-right';
        $iconMap = [
            'box' => 'archive-box', 'file' => 'document', 'clipboard' => 'clipboard-document',
            'office-building' => 'building-office', 'desktop' => 'computer-desktop',
            'pencil' => 'pencil-square', 'chart-bar' => 'chart-bar'
        ];
        $icon = $iconMap[$iconClean] ?? $iconClean;

        $withApi = $this->option('api') || ($this->choice('Generate API?', ['No', 'Yes'], 0) === 'Yes');

        $this->generateDomainStructure($name, $fields, $groupStudly);
        $this->generateMigration($tableName, $fields, $group);
        $this->generateModel($name, $fields, $tableName, $groupStudly);
        $this->generateLivewireComponents($name, $pluralSnake, $pluralName, $pluralKebab, $fields, $groupStudly, $groupKebab);
        $this->generateViews($name, $fields, $pluralSnake, $pluralName, $groupKebab);

        if ($withApi) {
            $this->generateApiLayer($name, $pluralName, $pluralKebab, $fields, $groupStudly, $groupKebab);
        }

        $this->info('💾 Migrating...');
        $exitCode = $this->call('migrate');
        if ($exitCode !== 0) {
            $this->error('Migration failed. Files were generated but the table was not created.');
            $this->warn('Fix database/migrations manually, run "php artisan migrate", then re-add permissions/nav by hand if needed.');
            return 1;
        }

        $this->addPermissions($name, $pluralSnake, $group ?: $pluralName);
        $this->generateTranslationFiles($pluralKebab, $name, $fields, $groupKebab);
        $this->generateRouteFile($pluralName, $pluralKebab, $name, $pluralSnake, $groupStudly, $groupKebab);
        $this->addNavigation($pluralName, $pluralKebab, $pluralSnake, $icon, $group, $groupLabel);

        $this->info("✅ DONE! $name is ready with Modal Support.");
        return 0;
    }

    /**
     * Resolves the table prefix for a group, guaranteeing it is unique and stable.
     * Also returns a stable ID (1, 2, 3...) for menu grouping.
     */
    protected function resolveGroupInfo($group, $groupStudly)
    {
        $manifestPath = storage_path('app/scaffold-groups.json');
        $manifest = File::exists($manifestPath)
            ? (json_decode(File::get($manifestPath), true) ?: [])
            : [];

        if (isset($manifest[$groupStudly])) {
            return $manifest[$groupStudly];
        }

        $id = count($manifest) + 1;

        $prefixOption = $this->option('prefix');
        if ($prefixOption) {
            $prefix = Str::snake($prefixOption) . '_';
        } else {
            $initials = '';
            foreach (explode(' ', $group) as $w) {
                $initials .= strtolower(substr($w, 0, 1));
            }
            // NO MORE ID PREPENDED TO PREFIX - Just stable initials
            $prefix = $initials . '_';
        }

        foreach ($manifest as $existingGroupStudly => $entry) {
            if ($entry['prefix'] === $prefix && $existingGroupStudly !== $groupStudly) {
                $this->error("Prefix '$prefix' is already used by group '{$entry['label']}'. Its tables would collide with '$group'.");
                $this->error("Re-run with --prefix=<something-unique> to give '$group' its own prefix.");
                throw new \RuntimeException("Table prefix collision: '$prefix' claimed by both '{$entry['label']}' and '$group'.");
            }
        }

        $entry = [
            'id' => $id,
            'label' => $group,
            'prefix' => $prefix
        ];

        $manifest[$groupStudly] = $entry;
        File::ensureDirectoryExists(dirname($manifestPath));
        File::put($manifestPath, json_encode($manifest, JSON_PRETTY_PRINT));
        $this->line("Registered group '$group' with stable prefix '$prefix'.");

        return $entry;
    }

    protected function generateDomainStructure($name, $fields, $groupStudly = '')
    {
        $groupPath = $groupStudly ? "$groupStudly/" : "";
        $baseDir = app_path("Domain/{$groupPath}$name");
        foreach (['Actions', 'DTOs', 'Queries', 'Events'] as $d) {
            File::makeDirectory("$baseDir/$d", 0755, true, true);
        }
        $this->generateDTO($name, $fields, $groupStudly);
        $this->generateQuery($name, $fields, $groupStudly);
        $this->generateActions($name, $groupStudly);
    }

    protected function generateActions($name, $groupStudly = '')
    {
        $groupPath = $groupStudly ? "$groupStudly/" : "";
        $groupNamespace = $groupStudly ? "\\$groupStudly" : "";
        $dir = app_path("Domain/{$groupPath}$name/Actions");
        $plural = Str::plural($name);
        $withFirebase = $this->option('firebase');

        $createStub = "<?php\n\nnamespace App\Domain{$groupNamespace}\\$name\Actions;\n\nuse App\Models{$groupNamespace}\\$name;\nuse App\Domain{$groupNamespace}\\$name\DTOs\\{$name}DTO;\nuse App\Models\AuditTrail;\n";

        if ($withFirebase) {
            $createStub .= "use App\Services\FirebaseService;\nuse App\Models\NotificationSetting;\n";
        }

        $createStub .= "\nclass Create{$name}Action\n{\n";

        if ($withFirebase) {
            $createStub .= "    public function __construct(protected FirebaseService \$firebaseService) {}\n\n";
        }

        $createStub .= "    public function execute({$name}DTO \$dto): $name \n    {\n        \$item = $name::create(\$dto->toArray());\n        AuditTrail::log(\$item, 'create', '$plural');\n";

        if ($withFirebase) {
            $groupName = $groupStudly ?: 'General';
            $createStub .= "
        // check user notification preferences
        \$enabled = NotificationSetting::where('user_id', auth()->id())
            ->where('module', '$groupName')
            ->where('event_type', 'created')
            ->where('enabled', true)
            ->exists();

        if (NotificationSetting::where('user_id', auth()->id())->where('module', '$groupName')->where('event_type', 'created')->doesntExist()) {
            \$enabled = true;
        }

        if (\$enabled) {
            \$this->firebaseService->sendNotification('New $name Created', 'A new record has been added to $plural.', 'all');
        }\n";
        }

        $createStub .= "        return \$item;\n    }\n}";

        File::put("$dir/Create{$name}Action.php", $createStub);

        File::put("$dir/Update{$name}Action.php", "<?php\n\nnamespace App\Domain{$groupNamespace}\\$name\Actions;\n\nuse App\Models{$groupNamespace}\\$name;\nuse App\Domain{$groupNamespace}\\$name\DTOs\\{$name}DTO;\nuse App\Models\AuditTrail;\n\nclass Update{$name}Action\n{\n    public function execute($name \$model, {$name}DTO \$dto): $name\n    {\n        \$model->fill(\$dto->toArray());\n        AuditTrail::log(\$model, 'update', '$plural');\n        \$model->save();\n        return \$model->fresh();\n    }\n}");
        File::put("$dir/Delete{$name}Action.php", "<?php\n\nnamespace App\Domain{$groupNamespace}\\$name\Actions;\n\nuse App\Models{$groupNamespace}\\$name;\nuse App\Models\AuditTrail;\n\nclass Delete{$name}Action\n{\n    public function execute($name \$model): bool \n    {\n        AuditTrail::log(\$model, 'delete', '$plural');\n        return \$model->delete(); \n    }\n}");
    }

    protected function generateDTO($name, $fields, $groupStudly = '')
    {
        $groupNamespace = $groupStudly ? "\\$groupStudly" : "";
        $groupPath = $groupStudly ? "$groupStudly/" : "";
        $props = ''; $args = ''; $toArray = '';
        foreach ($fields as $f) {
            $props .= "        public readonly mixed \${$f['name']},\n";
            $args .= "            {$f['name']}: \$data['{$f['name']}'] ?? null,\n";
            $toArray .= "            '{$f['name']}' => \$this->{$f['name']},\n";
        }
        $stub = "<?php\n\nnamespace App\Domain{$groupNamespace}\\$name\DTOs;\n\nclass {$name}DTO\n{\n    public function __construct(\n$props    ) {}\n    public static function fromArray(array \$data): self { return new self(\n$args        ); }\n    public function toArray(): array { return [\n$toArray        ]; }\n}";
        File::put(app_path("Domain/{$groupPath}$name/DTOs/{$name}DTO.php"), $stub);
    }

    protected function generateQuery($name, $fields, $groupStudly = '')
    {
        $groupNamespace = $groupStudly ? "\\$groupStudly" : "";
        $groupPath = $groupStudly ? "$groupStudly/" : "";
        $with = collect($fields)->filter(fn ($f) => $f['type'] === 'foreignId')->map(function($f) {
            $rel = Str::camel(str_replace('_id', '', $f['name']));
            if (Str::contains($f['labelField'], '.')) {
                $subRel = Str::beforeLast($f['labelField'], '.');
                return "'$rel.$subRel'";
            }
            return "'$rel'";
        })->unique()->implode(', ');

        $searchFields = collect($fields)->filter(fn ($f) => in_array($f['type'], ['string', 'text']))->map(fn ($f) => "                \$query->orWhere('{$f['name']}', 'like', '%' . \$params['search'] . '%');")->implode("\n");
        $filters = collect($fields)->filter(fn ($f) => $f['type'] === 'foreignId')->map(fn ($f) => "        if (isset(\$params['{$f['name']}']) && \$params['{$f['name']}']) \$query->where('{$f['name']}', \$params['{$f['name']}']);")->implode("\n");
        File::put(app_path("Domain/{$groupPath}$name/Queries/{$name}ListQuery.php"), "<?php\n\nnamespace App\Domain{$groupNamespace}\\$name\Queries;\n\nuse App\Models{$groupNamespace}\\$name;\nuse Illuminate\Database\Eloquent\Builder;\n\nclass {$name}ListQuery\n{\n    public function handle(array \$params = [], string \$sortField = 'id', string \$sortAsc = 'asc'): Builder\n    {\n        \$query = $name::query()" . ($with ? "->with([$with])" : '') . ";\n        if (isset(\$params['search']) && \$params['search']) {\n            \$query->where(function(\$query) use (\$params) {\n                \$query->where('id', 'like', '%' . \$params['search'] . '%');\n$searchFields\n            });\n        }\n$filters\n        \$sortField = in_array(\$sortField, $name::sortable(), true) ? \$sortField : 'id';\n        \$sortAsc = in_array(strtolower((string) \$sortAsc), ['asc', 'desc'], true) ? \$sortAsc : 'asc';\n        return \$query->orderBy(\$sortField, \$sortAsc);\n    }\n}");
    }

    protected function generateModel($name, $fields, $tableName, $groupStudly = '')
    {
        $groupPath = $groupStudly ? "$groupStudly/" : "";
        $groupNamespace = $groupStudly ? "\\$groupStudly" : "";

        $fillable = collect($fields)->map(fn ($f) => "'{$f['name']}'")->implode(', ');
        $relations = ''; $casts = ''; $rules = ''; $sortable = "'id'";
        foreach ($fields as $f) {
            if ($f['type'] === 'foreignId') {
                $rel = Str::camel(str_replace('_id', '', $f['name']));
                $relations .= "\n    public function $rel(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return \$this->belongsTo(\\{$f['relatedFQCN']}::class, '{$f['name']}'); }\n";
            }
            if ($f['type'] === 'boolean') {
                $casts .= "            '{$f['name']}' => 'boolean',\n";
            }
            if (in_array($f['type'], ['date', 'datetime'])) {
                $casts .= "            '{$f['name']}' => 'datetime',\n";
            }
            if ($f['type'] === 'decimal') {
                $casts .= "            '{$f['name']}' => 'decimal:2',\n";
            }

            $req = $f['nullable'] ? "'nullable'" : "'required'";
            $typeRule = match ($f['type']) {
                'string' => "'string', 'max:255'",
                'text' => "'string'",
                'integer', 'bigInteger' => "'integer'",
                'boolean' => "'boolean'",
                'decimal' => "'numeric'",
                'date', 'datetime' => "'date'",
                'foreignId' => "'integer'",
                'enum' => "\Illuminate\Validation\Rule::in(['" . implode("', '", array_map('addslashes', $f['options'])) . "'])",
                default => null,
            };
            $rules .= "            '{$f['name']}' => [$req" . ($typeRule ? ", $typeRule" : '') . "],\n";
            $sortable .= ", '{$f['name']}'";
        }

        $dir = app_path("Models/$groupPath");
        if (!File::isDirectory($dir)) File::makeDirectory($dir, 0755, true);

        File::put("$dir/$name.php", "<?php\n\nnamespace App\Models$groupNamespace;\n\nuse Illuminate\Database\Eloquent\Factories\HasFactory;\nuse Illuminate\Database\Eloquent\Model;\n\nclass $name extends Model\n{\n    use HasFactory;\n    protected \$table = '$tableName';\n    protected \$fillable = [$fillable];\n    protected function casts(): array { return [\n$casts        ]; }\n    public static function rules(\$id = null): array { return [\n$rules        ]; }\n    public static function sortable(): array { return [$sortable]; }\n$relations\n}");
    }

    protected function generateLivewireComponents($name, $pluralSnake, $pluralName, $pluralKebab, $fields, $groupStudly = '', $groupKebab = '')
    {
        $camel = Str::camel($name);
        $groupPath = $groupStudly ? "$groupStudly/" : "";
        $groupNamespace = $groupStudly ? "\\$groupStudly" : "";
        $groupViewPath = $groupKebab ? "$groupKebab." : "";
        $groupRoutePath = $groupKebab ? "admin.$groupKebab.$pluralKebab" : "admin.$pluralKebab";
        $transPk = $groupKebab ? "$groupKebab/$pluralKebab" : $pluralKebab;

        $dir = app_path("Livewire/Admin/{$groupPath}$pluralName");
        File::makeDirectory($dir, 0755, true, true);
        $viewPath = "livewire.admin.{$groupViewPath}" . Str::kebab($pluralName);

        $hasFile = collect($fields)->contains(fn ($f) => Str::contains(strtolower($f['name']), ['file', 'document', 'image', 'photo']));
        $availableListsIndex = ''; $availableListsForm = ''; $props = ''; $dataMap = ''; $fileHandlers = '';
        $filterReset = ''; $filterProps = ''; $renderFilters = '';

        foreach ($fields as $f) {
            $props .= "    public \${$f['name']} = '';\n";
            $dataMap .= "            '{$f['name']}' => \$this->{$f['name']},\n";
            if ($f['type'] === 'foreignId') {
                $rv = Str::plural(Str::camel(str_replace('_id', '', $f['name'])));

                if (Str::contains($f['labelField'], '.')) {
                    $relPart = explode('.', $f['labelField'])[0];
                    $availableListsIndex .= "            '{$rv}' => \\{$f['relatedFQCN']}::with('$relPart')->get()->pluck('{$f['labelField']}', 'id')->toArray(),\n";
                } else {
                    $availableListsIndex .= "            '{$rv}' => \\{$f['relatedFQCN']}::pluck('{$f['labelField']}', 'id')->toArray(),\n";
                }

                $availableListsForm .= "            '{$rv}' => \$this->get{$rv}List(),\n";
                $filterReset .= "'{$f['name']}', ";
                $filterProps .= "    #[Url(history: true)] public \${$f['name']} = '';\n";
                $renderFilters .= "            '{$f['name']}' => \$this->{$f['name']},\n";
            }
            if (Str::contains(strtolower($f['name']), ['file', 'document'])) {
                $fileHandlers .= "        if (\$this->{$f['name']} && !is_string(\$this->{$f['name']})) { \$this->{$f['name']} = \$this->{$f['name']}->store('uploads/$pluralKebab', 'public'); }\n";
            }
        }

        $imports = "use Livewire\Component;\nuse Livewire\WithPagination;\nuse Livewire\Attributes\Title;\nuse Livewire\Attributes\Url;\nuse Livewire\Attributes\On;\n";
        if ($hasFile) {
            $imports .= "use Livewire\WithFileUploads;\n";
        }
        $traits = '    use WithPagination' . ($hasFile ? ', WithFileUploads' : '') . ";\n";

        $formHelperMethods = ''; $onEvents = ''; $updatedHooks = '';
        foreach ($fields as $f) {
            if ($f['type'] === 'foreignId') {
                $rv = Str::plural(Str::camel(str_replace('_id', '', $f['name'])));
                $onEvents .= "\n    #[On('" . Str::kebab($f['relatedModel']) . "-created')] \n    public function refresh" . Str::studly($rv) . "(\$id) { \$this->{$f['name']} = \$id; \$this->updated" . Str::studly($f['name']) . "(\$id); }\n";

                // Add updated hook for auto-filling related fields
                $updatedHooks .= "\n    public function updated" . Str::studly($f['name']) . "(\$value)\n    {\n        if (!\$value) return;\n        \$related = \\{$f['relatedFQCN']}::find(\$value);\n        if (!\$related) return;\n";
                foreach ($fields as $otherField) {
                    if ($otherField['name'] !== $f['name'] && $otherField['type'] === 'foreignId') {
                        // If the related model has a field with the same name as our other field, auto-fill it
                        $updatedHooks .= "        if (isset(\$related->{$otherField['name']})) { \$this->{$otherField['name']} = \$related->{$otherField['name']}; }\n";
                    }
                }
                $updatedHooks .= "    }\n";

                $formHelperMethods .= "\n    protected function get{$rv}List() {\n";
                if (Str::contains($f['labelField'], '.')) {
                    $relPart = explode('.', $f['labelField'])[0];
                    $formHelperMethods .= "        return \\{$f['relatedFQCN']}::with('$relPart')->get()->pluck('{$f['labelField']}', 'id')->toArray();\n";
                } else {
                    $formHelperMethods .= "        return \\{$f['relatedFQCN']}::pluck('{$f['labelField']}', 'id')->toArray();\n";
                }
                $formHelperMethods .= "    }\n";
            }
        }

        $indexStub = "<?php\n\nnamespace App\Livewire\Admin{$groupNamespace}\\$pluralName;\n\nuse App\Models{$groupNamespace}\\$name;\nuse App\Domain{$groupNamespace}\\$name\Queries\\{$name}ListQuery;\nuse App\Domain{$groupNamespace}\\$name\Actions\\Delete{$name}Action;\n$imports\n#[Title('$pluralName')]\nclass $pluralName extends Component\n{\n    $traits\n    public int \$paginate = 10;\n    #[Url(history: true)] public string \$search = '';\n$filterProps    public bool \$openFilter = false;\n    public string \$sortField = 'id';\n    public bool \$sortAsc = true;\n\n    public function resetFilters() { \$this->reset(['search', 'openFilter', $filterReset]); \$this->resetPage(); }\n\n    public function render()\n    {\n        abort_if_cannot('view_{$pluralSnake}');\n        \$query = (new {$name}ListQuery())->handle(['search' => \$this->search, $renderFilters], \$this->sortField, \$this->sortAsc ? 'asc' : 'desc');\n\n        return view('$viewPath.index', [\n            'items' => \$query->paginate(\$this->paginate),\n            'sortableFields' => $name::sortable(),\n$availableListsIndex        ])->layout('components.layouts.app');\n    }\n\n    public function sortBy(\$field) { if (!in_array(\$field, $name::sortable(), true)) return; if (\$this->sortField === \$field) { \$this->sortAsc = ! \$this->sortAsc; } \$this->sortField = \$field; }\n\n    public function delete$name(\$id, Delete{$name}Action \$action) \n    {\n        abort_if_cannot('delete_{$pluralSnake}');\n        \$item = $name::find(\$id);\n        if (!\$item) { \$this->dispatch('toast', message: __('$transPk.not_found'), type: 'error'); return; }\n        try { \$action->execute(\$item); \$this->dispatch('toast', message: __('$transPk.deleted'), type: 'success'); \$this->resetPage(); } \n        catch (\\Illuminate\\Database\\QueryException \$e) { \$this->dispatch('toast', message: __('$transPk.delete_error_referenced'), type: 'error'); }\n        catch (\\Exception \$e) { \$this->dispatch('toast', message: __('$transPk.delete_error'), type: 'error'); }\n    }\n}";
        File::put("$dir/$pluralName.php", $indexStub);

        File::put("$dir/Create.php", "<?php\n\nnamespace App\Livewire\Admin{$groupNamespace}\\$pluralName;\n\nuse App\Models{$groupNamespace}\\$name;\nuse App\Domain{$groupNamespace}\\$name\DTOs\\{$name}DTO;\nuse App\Domain{$groupNamespace}\\$name\Actions\\Create{$name}Action;\n$imports\n#[Title('Add $name')]\nclass Create extends Component\n{\n    $traits $props $onEvents $updatedHooks $formHelperMethods\n    public function render() { abort_if_cannot('add_{$pluralSnake}'); return view('$viewPath.create', [\n$availableListsForm        ])->layout('components.layouts.app'); }\n    public function store(Create{$name}Action \$action) { \$this->validate(); $fileHandlers \$dto = {$name}DTO::fromArray([\n$dataMap        ]); \$action->execute(\$dto); session()->flash('success', __('$transPk.created')); return to_route('$groupRoutePath.index'); }\n    protected function rules(): array { return $name::rules(); }\n}");

        $dateFills = collect($fields)->filter(fn ($f) => in_array($f['type'], ['date', 'datetime']))->map(function ($f) use ($camel) {
            $fmt = $f['type'] === 'datetime' ? "'Y-m-d\\TH:i'" : "'Y-m-d'";
            return "\$this->{$f['name']} = \$" . $camel . "->{$f['name']}?->format($fmt);";
        })->implode(' ');
        File::put("$dir/Edit.php", "<?php\n\nnamespace App\Livewire\Admin{$groupNamespace}\\$pluralName;\n\nuse App\Models{$groupNamespace}\\$name;\nuse App\Domain{$groupNamespace}\\$name\DTOs\\{$name}DTO;\nuse App\Domain{$groupNamespace}\\$name\Actions\\Update{$name}Action;\n$imports\n#[Title('Edit $name')]\nclass Edit extends Component\n{\n    $traits public $name \$item;\n$props $onEvents $updatedHooks $formHelperMethods\n    public function mount($name \$" . $camel . ") { \$this->item = \$" . $camel . "; \$this->fill(\$" . $camel . "->toArray()); $dateFills }\n    public function render() { abort_if_cannot('edit_{$pluralSnake}'); return view('$viewPath.edit', [\n$availableListsForm        ])->layout('components.layouts.app'); }\n    public function update(Update{$name}Action \$action) { \$this->validate(); $fileHandlers \$dto = {$name}DTO::fromArray([\n$dataMap        ]); \$action->execute(\$this->item, \$dto); session()->flash('success', __('$transPk.updated')); return to_route('$groupRoutePath.index'); }\n    protected function rules(): array { return $name::rules(\$this->item->id); }\n}");
        File::put("$dir/Row.php", "<?php\n\nnamespace App\Livewire\Admin{$groupNamespace}\\$pluralName;\n\nuse App\Models{$groupNamespace}\\$name;\nuse Livewire\Component;\n\nclass Row extends Component { public $name \$item; public function render() { return view('$viewPath.row'); } }");

        $displayField = 'id';
        foreach ($fields as $f) {
            if (in_array($f['name'], ['name', 'title', 'label'], true)) {
                $displayField = $f['name'];
                break;
            }
        }
        $resetList = collect($fields)->map(fn ($f) => "'{$f['name']}'")->implode(', ');

        $kebabName = Str::kebab($name);
        File::put("$dir/QuickCreate.php", "<?php\n\nnamespace App\Livewire\Admin{$groupNamespace}\\$pluralName;\n\nuse App\Models{$groupNamespace}\\$name;\nuse App\Domain{$groupNamespace}\\$name\DTOs\\{$name}DTO;\nuse App\Domain{$groupNamespace}\\$name\Actions\\Create{$name}Action;\n$imports\nclass QuickCreate extends Component\n{\n    $traits $props $onEvents $updatedHooks $formHelperMethods\n    public bool \$created = false;\n    public ?int \$createdId = null;\n    public string \$createdLabel = '';\n\n    public function render() { return view('$viewPath.quick-create', [\n$availableListsForm        ]); }\n\n    public function store(Create{$name}Action \$action)\n    {\n        \$this->validate();\n$fileHandlers        \$dto = {$name}DTO::fromArray([\n$dataMap        ]);\n        \$item = \$action->execute(\$dto);\n        \$this->dispatch('$kebabName-created', id: \$item->id);\n        \$this->js(\"Livewire.dispatch('$kebabName-created', { id: {\$item->id} })\");\n        \$this->dispatch('toast', message: __('$transPk.created'), type: 'success');\n        \$this->created = true;\n        \$this->createdId = \$item->id;\n        \$this->createdLabel = (string) (\$item->{$displayField} ?? \$item->id);\n        \$this->reset([$resetList]);\n    }\n\n    public function addAnother()\n    {\n        \$this->created = false;\n        \$this->createdId = null;\n        \$this->createdLabel = '';\n    }\n\n    protected function rules(): array { return $name::rules(); }\n}");
    }

    protected function generateViews($name, $fields, $pluralSnake, $pluralName, $groupKebab = '')
    {
        $groupPath = $groupKebab ? "$groupKebab/" : "";
        $dir = resource_path("views/livewire/admin/{$groupPath}" . Str::kebab($pluralName));
        File::makeDirectory($dir, 0755, true, true);
        $pk = Str::kebab($pluralName);
        $transPk = $groupKebab ? "$groupKebab/$pk" : $pk;

        File::put("$dir/index.blade.php", $this->getIndexStub($name, $pluralName, $pk, $fields, $groupKebab, $transPk));
        File::put("$dir/create.blade.php", $this->getCreateStub($name, $pk, $fields, $groupKebab, $transPk));
        File::put("$dir/edit.blade.php", $this->getEditStub($name, $pk, $fields, $groupKebab, $transPk));
        File::put("$dir/row.blade.php", $this->getRowStub($name, $pk, $fields, $pluralSnake, $groupKebab, $transPk));
        File::put("$dir/quick-create.blade.php", "<div class=\"p-6\">\n    @if(\$created)\n        <div class=\"flex flex-col items-center text-center py-10\">\n            <div class=\"w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center mb-4\">\n                <x-heroicon-o-check class=\"w-6 h-6 text-green-500\" />\n            </div>\n            <p class=\"font-bold text-gray-900 dark:text-white\">{{ __('$transPk.created') }}</p>\n            @if(\$createdLabel)<p class=\"text-sm text-gray-500 dark:text-gray-400 mt-1\">{{ \$createdLabel }}</p>@endif\n            <button type=\"button\" wire:click=\"addAnother\" class=\"mt-6 text-xs font-black uppercase tracking-widest text-blue-600 dark:text-blue-400\">{{ __('$transPk.Add $name') }}</button>\n        </div>\n    @else\n        " . $this->getInputs($fields, $pk, true, $groupKebab, $transPk) . "\n        <div class=\"mt-8 flex justify-end\"><x-button wire:click=\"store\" variant=\"blue\">{{ __('$transPk.Save') }}</x-button></div>\n    @endif\n</div>");
    }

    protected function getIndexStub($name, $pluralName, $pk, $fields, $groupKebab = '', $transPk = '')
    {
        $searchable = collect($fields)->filter(fn ($f) => in_array($f['type'], ['string', 'text']))->map(fn ($f) => Str::title($f['name']))->prepend('ID')->implode(', ');
        $filters = collect($fields)->filter(fn ($f) => $f['type'] === 'foreignId')->map(function ($f) use ($transPk) {
            $rv = Str::plural(Str::camel(str_replace('_id', '', $f['name'])));
            $label = Str::title(str_replace('_', ' ', $f['name']));
            return "<div><label class=\"block mb-1.5 text-[10px] font-bold uppercase tracking-widest ml-1 text-gray-900 dark:text-gray-100\">$label</label><x-form.dropdown-search name=\"{$f['name']}\" wire:model.live=\"{$f['name']}\" label=\"none\" :data=\"\${$rv}\" placeholder=\"Filter $label\" /></div>";
        })->implode("\n");

        $groupDot = $groupKebab ? "$groupKebab." : "";
        $groupRoutePath = $groupKebab ? "admin.$groupKebab.$pk" : "admin.$pk";

        return "<div x-data=\"{ openFilter: @entangle('openFilter') }\">\n    <div class=\"card !p-0 overflow-hidden shadow-none border-gray-200 dark:border-gray-700 dark:bg-gray-800\">\n        <div class=\"p-6\">\n            <div class=\"flex flex-col sm:flex-row sm:items-center justify-between gap-4\">\n                <div><x-h1>{{ __('$transPk.$pluralName') }}</x-h1><x-short-description class=\"dark:text-gray-400\">{{ __('$transPk.List of') }} ".strtolower($pluralName)."</x-short-description></div>\n                <div class=\"flex items-center gap-3\">\n                    @if(\$search || \$openFilter)\n                        <button wire:click=\"resetFilters\" class=\"inline-flex items-center gap-1.5 px-3 py-2 text-xs font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-2xl transition-none shadow-none\"><span>{{ __('$transPk.Reset') }}</span></button>\n                    @endif\n                    <button @click=\"openFilter = !openFilter\" class=\"inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-gray-600 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-sm transition-none\"><span>{{ __('$transPk.Filters') }}</span></button>\n                    <x-btn :href=\"route('$groupRoutePath.create')\" icon=\"plus\">{{ __('$transPk.Add $name') }}</x-btn>\n                </div>\n            </div>\n\n            <div x-show=\"openFilter\" x-cloak class=\"mt-6 p-6 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-2xl\">\n                <div class=\"grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6\">\n                    <div>\n                        <label class=\"block mb-1.5 text-[10px] font-bold uppercase tracking-widest ml-1 text-gray-900 dark:text-gray-100\">{{ __('$transPk.Search') }}</label>\n                        <input name=\"search\" wire:model.live.debounce.300ms=\"search\" type=\"text\" placeholder=\"Search by $searchable\" class=\"w-full p-3 text-sm font-bold bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl focus:ring-2 focus:ring-blue-500/20 dark:text-white\">\n                    </div>\n                    $filters\n                </div>\n            </div>\n        </div>\n\n        @include('errors.messages')\n\n        <div class=\"overflow-x-auto border-t border-gray-100 dark:border-gray-700\">\n            <table class=\"w-full text-sm text-left text-gray-500 dark:text-gray-400\">\n                <thead class=\"bg-gray-100/50 dark:bg-gray-700/50\"><tr><x-table.th name=\"id\" :label=\"__('$transPk.ID')\" :\$sortField :\$sortAsc :sortable=\"true\" />" . collect($fields)->map(fn ($f) => "<x-table.th name=\"{$f['name']}\" :label=\"__('$transPk.".Str::title(str_replace('_', ' ', $f['name']))."')\" :\$sortField :\$sortAsc :sortable=\"in_array('{$f['name']}', \$sortableFields)\" />")->implode("\n") . "<th class=\"px-6 py-4 text-right text-[10px] font-black uppercase text-gray-400 tracking-widest\">{{ __('$transPk.Action') }}</th></tr></thead>\n                <tbody class=\"divide-y divide-gray-50 dark:divide-gray-700/50\">@forelse(\$items as \$item) <livewire:admin.{$groupDot}$pk.row :\$item :key=\"\$item->id\" /> @empty <tr><td colspan=\"100\" class=\"px-6 py-10 text-center text-sm text-gray-400\">{{ __('$transPk.No records found.') }}</td></tr> @endforelse</tbody>\n            </table>\n        </div>\n        <div class=\"p-4 border-t border-gray-50 dark:border-gray-700/50\">{{ \$items->links() }}</div>\n    </div>\n</div>";
    }

    protected function getCreateStub($name, $pk, $fields, $groupKebab = '', $transPk = '')
    {
        $groupRoutePath = $groupKebab ? "admin.$groupKebab.$pk" : "admin.$pk";
        return "<div class=\"space-y-10\">\n    <div class=\"flex items-center justify-between gap-4 px-1\"><div><x-h1>{{ __('$transPk.Add $name') }}</x-h1><x-short-description class=\"dark:text-gray-400\">{{ __('$transPk.New record') }}</x-short-description></div><x-back-btn route=\"$groupRoutePath.index\" /></div>\n    @include('errors.errors')\n    <div class=\"bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700\"><form wire:submit.prevent=\"store\" class=\"space-y-8\">".$this->getInputs($fields, $pk, true, $groupKebab, $transPk)."<div class=\"mt-10 flex justify-end\"><x-button type=\"submit\" variant=\"blue\" class=\"w-full sm:w-auto !px-12 !py-4 !rounded-2xl\">{{ __('$transPk.Save') }}</x-button></div></form></div>\n</div>";
    }

    protected function getEditStub($name, $pk, $fields, $groupKebab = '', $transPk = '')
    {
        $groupRoutePath = $groupKebab ? "admin.$groupKebab.$pk" : "admin.$pk";
        return "<div class=\"space-y-10\">\n    <div class=\"flex items-center justify-between gap-4 px-1\"><div><x-h1>{{ __('$transPk.Edit $name') }}</x-h1><x-short-description class=\"dark:text-gray-400\">{{ __('$transPk.Update info') }}</x-short-description></div><x-back-btn route=\"$groupRoutePath.index\" /></div>\n    @include('errors.errors')\n    <div class=\"bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700\"><form wire:submit.prevent=\"update\" class=\"space-y-8\">".$this->getInputs($fields, $pk, false, $groupKebab, $transPk)."<div class=\"mt-10 flex justify-end\"><x-button type=\"submit\" variant=\"blue\" class=\"w-full sm:w-auto !px-12 !py-4 !rounded-2xl\">{{ __('$transPk.Update') }}</x-button></div></form></div>\n</div>";
    }

    protected function getRowStub($name, $pk, $fields, $pluralSnake, $groupKebab = '', $transPk = '')
    {
        $cells = collect($fields)->map(function ($f) {
            if ($f['type'] === 'foreignId') {
                $labelPath = str_replace('.', '?->', $f['labelField']);
                return "<td class=\"px-6 py-5 font-bold text-gray-900 dark:text-white\">{{ \$item->".Str::camel(str_replace('_id', '', $f['name']))."?->{$labelPath} ?? '-' }}</td>";
            }
            if (Str::contains(strtolower($f['name']), ['file', 'document'])) {
                return "<td class=\"px-6 py-5\">@if(\$item->{$f['name']}) <a href=\"{{ asset('storage/'.\$item->{$f['name']}) }}\" target=\"_blank\" rel=\"noopener\"><x-heroicon-o-arrow-down-tray class=\"w-5 h-5 text-blue-500\" /></a> @else - @endif</td>";
            }
            if (in_array($f['type'], ['date', 'datetime'])) {
                return "<td class=\"px-6 py-5 text-gray-600 dark:text-gray-300\">{{ \$item->{$f['name']}?->format('d/m/Y H:i') ?? '-' }}</td>";
            }
            return "<td class=\"px-6 py-5 text-gray-600 dark:text-gray-300\">{{ \$item->{$f['name']} }}</td>";
        })->implode("\n");

        $displayNameField = 'id';
        foreach ($fields as $f) {
            if (in_array($f['name'], ['name', 'title', 'label'], true)) {
                $displayNameField = $f['name'];
            }
        }

        $groupDot = $groupKebab ? "$groupKebab." : "";
        $groupRoutePath = $groupKebab ? "admin.$groupKebab.$pk" : "admin.$pk";

        return "<tr class=\"hover:bg-gray-50/50 dark:hover:bg-gray-900/50 transition-none border-b border-gray-50 dark:border-gray-700/50 last:border-none\">\n    <td class=\"px-6 py-5 font-bold text-blue-600 dark:text-blue-400\">{{ \$item->id }}</td>\n    $cells\n    <td class=\"px-6 py-5 text-right !transition-none\">\n        <div class=\"flex justify-end gap-3 !transition-none\">\n            @can('edit_{$pluralSnake}')\n                <x-a href=\"{{ route('$groupRoutePath.edit', \$item) }}\" class=\"!rounded-xl !bg-blue-50 dark:!bg-blue-900/30 !text-blue-600 dark:!text-blue-400 !px-4 !py-1.5 !text-[10px] !font-black !uppercase !border-none\">Edit</x-a>\n            @endcan\n            @can('delete_{$pluralSnake}')\n                <div x-data=\"{ confirmation: '' }\" x-cloak class=\"inline-block\">\n                    <x-modal>\n                        <x-slot name=\"trigger\"><button @click=\"on = true\" class=\"text-[10px] font-black uppercase text-red-400 hover:text-red-600 dark:hover:text-red-300\">Delete</button></x-slot>\n                        <x-slot name=\"modalTitle\"><div class=\"text-left dark:text-white\">Delete {{ \$item->{$displayNameField} }}?</div></x-slot>\n                        <x-slot name=\"content\"><div class=\"text-left space-y-2\"><p class=\"text-sm text-gray-500 dark:text-gray-400\">This action cannot be undone.</p><input x-model=\"confirmation\" placeholder=\"Type {{ \$item->{$displayNameField} }} to confirm\" class=\"w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-red-500 outline-none\"></div></x-slot>\n                        <x-slot name=\"footer\"><x-button variant=\"gray\" @click=\"on = false\">Cancel</x-button><x-button variant=\"red\" x-bind:disabled=\"confirmation !== '{{ \$item->{$displayNameField} }}'\" wire:click=\"\$parent.delete$name('{{ \$item->id }}')\" @click=\"on = false\">Delete</x-button></x-slot>\n                    </x-modal>\n                </div>\n            @endcan\n        </div>\n    </td>\n</tr>";
    }

    protected function getInputs($fields, $pk, $isCreating = true, $groupKebab = '', $transPk = '')
    {
        $groupDot = $groupKebab ? "$groupKebab." : "";
        $inputs = '<div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">';
        $inputs .= collect($fields)->map(function ($f) use ($pk, $isCreating, $groupDot, $transPk) {
            $label = Str::title(str_replace('_', ' ', $f['name']));
            if ($f['type'] === 'foreignId') {
                $rv = Str::plural(Str::camel(str_replace('_id', '', $f['name'])));
                $relatedPluralKebab = Str::kebab(Str::plural($f['relatedModel']));

                // FALLBACK: We assume related models are either in the SAME group or flat.
                $comp = "admin.{$groupDot}{$relatedPluralKebab}.quick-create";

                return "<div>\n    <div class=\"flex items-end gap-2\">\n        <div class=\"flex-1\"><x-form.dropdown-search name=\"{$f['name']}\" wire:model.live=\"{$f['name']}\" :label=\"__('$transPk.$label')\" :data=\"\${$rv}\" /></div>\n        <x-modal>\n            <x-slot name=\"trigger\"><button type=\"button\" @click=\"on = true\" class=\"mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform\"><x-heroicon-o-plus class=\"w-5 h-5\" /></button></x-slot>\n            <x-slot name=\"modalTitle\"><div class=\"dark:text-white px-6 pt-6\">Add New " . $f['relatedModel'] . "</div></x-slot>\n            <x-slot name=\"content\"><livewire:$comp /></x-slot>\n        </x-modal>\n    </div>\n</div>";
            }
            if (Str::contains(strtolower($f['name']), ['file', 'document'])) {
                return "<div><x-form.file-upload name=\"{$f['name']}\" wire:model=\"{$f['name']}\" :label=\"__('$transPk.$label')\" id=\"{$f['name']}\" :isEditing=\"!\" . ($isCreating ? 'true' : 'false') . \" /></div>";
            }
            if ($f['type'] === 'text') {
                return "<div class=\"md:col-span-2\"><x-form.textarea name=\"{$f['name']}\" wire:model=\"{$f['name']}\" :label=\"__('$transPk.$label')\" class=\"dark:bg-gray-900\" /></div>";
            }
            if ($f['type'] === 'boolean') {
                return "<div><x-form.checkbox name=\"{$f['name']}\" wire:model=\"{$f['name']}\" :label=\"__('$transPk.$label')\" /></div>";
            }
            if ($f['type'] === 'enum') {
                $opts = collect($f['options'])->map(fn ($o) => '<option value=\"' . e($o) . '\">' . e($o) . '</option>')->implode('');
                return "<div><label class=\"block mb-1.5 text-[10px] font-bold uppercase tracking-widest\">{{ __('$transPk.$label') }}</label><select name=\"{$f['name']}\" wire:model=\"{$f['name']}\" class=\"w-full p-3 text-sm font-bold bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl\"><option value=\"\">--</option>$opts</select></div>";
            }
            $type = ($f['type'] === 'datetime') ? 'datetime-local' : (($f['type'] === 'date') ? 'date' : 'text');
            return "<div><x-form.input name=\"{$f['name']}\" type=\"$type\" wire:model=\"{$f['name']}\" :label=\"__('$transPk.$label')\" class=\"dark:bg-gray-900\" /></div>";
        })->implode("\n");
        return $inputs . '</div>';
    }

    protected function generateTranslationFiles($pk, $name, $fields, $groupKebab = '')
    {
        $pluralName = Str::plural($name);
        foreach (['en', 'sq'] as $lang) {
            $langDir = lang_path($lang);
            if ($groupKebab) {
                $langDir .= '/' . $groupKebab;
            }
            File::makeDirectory($langDir, 0755, true, true);
            $path = "$langDir/$pk.php";

            $existing = [];
            if (File::exists($path)) {
                try {
                    $loaded = include $path;
                    $existing = is_array($loaded) ? $loaded : [];
                } catch (\Throwable $e) {
                    $this->warn("Could not read existing $path ({$e->getMessage()}) — treating as empty, nothing will be lost since we still merge below.");
                }
            }

            $defaults = [
                'ID' => 'ID', $name => $name, $pluralName => $pluralName, 'Action' => 'Action',
                'Reset' => 'Reset', 'Filters' => 'Filters', 'Search' => 'Search', 'List of' => 'List of',
                'Save' => 'Save', 'Update' => 'Update', 'Add ' . $name => 'Add ' . $name, 'Edit ' . $name => 'Edit ' . $name,
                'New record' => 'New record', 'Update info' => 'Update info', 'No records found.' => 'No records found.',
                'created' => $name . ' created.', 'updated' => $name . ' updated.', 'deleted' => $name . ' deleted.',
                'not_found' => 'Record not found.',
                'delete_error_referenced' => 'Record is referenced by other items and cannot be deleted.',
                'delete_error' => 'Could not delete record.',
            ];
            foreach ($fields as $f) {
                $l = Str::title(str_replace('_', ' ', $f['name']));
                $defaults[$l] = $l;
            }

            // Existing values win for any key already translated. Only genuinely
            // new keys (new fields, new UI strings) get the generated default.
            $merged = array_merge($defaults, $existing);

            if ($existing !== [] && $merged === $existing) {
                $this->line("$path already has every key — left untouched.");
                continue;
            }
            if ($existing !== []) {
                $this->line("$path merged — existing translations preserved, new keys added.");
            }

            $content = "<?php\n\nreturn " . var_export($merged, true) . ";\n";
            $content = str_replace(['array (', ')'], ['[', ']'], $content);
            File::put($path, $content);
        }
    }

    protected function generateMigration($tableName, $fields, $group = '')
    {
        $schema = collect($fields)->map(function ($f) {
            if ($f['type'] === 'enum') {
                $opts = "['" . implode("', '", array_map('addslashes', $f['options'])) . "']";
                $line = "\$table->enum('{$f['name']}', $opts)";
            } elseif ($f['type'] === 'foreignId') {
                $line = "\$table->foreignId('{$f['name']}')->constrained('{$f['constrained']}')";
            } else {
                $line = "\$table->{$f['type']}('{$f['name']}')";
            }
            if ($f['nullable']) {
                $line .= '->nullable()';
            }
            return "            $line;";
        })->implode("\n");
        File::put(
            'database/migrations/' . date('Y_m_d_His') . "_create_{$tableName}_table.php",
            "<?php\nuse Illuminate\Database\Migrations\Migration;\nuse Illuminate\Database\Schema\Blueprint;\nuse Illuminate\Support\Facades\Schema;\nreturn new class extends Migration { public function up() { Schema::create('$tableName', function (Blueprint \$table) { \$table->id();\n$schema\n            \$table->timestamps(); }); } public function down() { Schema::dropIfExists('$tableName'); } };"
        );
    }

    protected function generateRouteFile($pluralName, $pluralKebab, $name, $pluralSnake, $groupStudly = '', $groupKebab = '')
    {
        $camel = Str::camel($name);
        $groupNamespace = $groupStudly ? "\\$groupStudly" : "";
        $groupPath = $groupKebab ? "$groupKebab/" : "";

        $path = base_path("routes/admin/{$groupPath}$pluralKebab.php");
        if ($groupKebab && !File::isDirectory(dirname($path))) {
            File::makeDirectory(dirname($path), 0755, true, true);
        }

        $groupRoutePath = $groupKebab ? "admin.$groupKebab.$pluralKebab" : "admin.$pluralKebab";
        $routePrefix = $groupKebab ? "$groupKebab/$pluralKebab" : $pluralKebab;

        File::put($path, "<?php\nuse Illuminate\Support\Facades\Route;\nuse App\Livewire\Admin{$groupNamespace}\\$pluralName\\$pluralName;\nuse App\Livewire\Admin{$groupNamespace}\\$pluralName\\Create;\nuse App\Livewire\Admin{$groupNamespace}\\$pluralName\\Edit;\nRoute::prefix('$routePrefix')->group(function () {\n    Route::get('/', $pluralName::class)->name('$groupRoutePath.index');\n    Route::get('create', Create::class)->name('$groupRoutePath.create');\n    Route::get('/{' . '$camel' . '}/edit', Edit::class)->name('$groupRoutePath.edit');\n});");
    }

    protected function addPermissions($name, $pluralSnake, $groupName)
    {
        foreach (['view', 'add', 'edit', 'delete'] as $act) {
            Permission::firstOrCreate(['name' => "{$act}_{$pluralSnake}"], ['label' => ucfirst($act) . ' ' . $name, 'module' => $groupName]);
        }
    }

    protected function addNavigation($pluralName, $pluralKebab, $pluralSnake, $icon, $group = null, $groupLabel = null)
    {
        $navPath = resource_path('views/components/layouts/app/navigation.blade.php');
        if (!File::exists($navPath)) {
            $this->warn("Navigation file not found at $navPath — skipped.");
            return;
        }
        $content = File::get($navPath);

        $groupKebab = $group ? Str::kebab($group) : '';
        $routeName = $groupKebab ? "admin.$groupKebab.$pluralKebab.index" : "admin.$pluralKebab.index";
        $transPk = $groupKebab ? "$groupKebab/$pluralKebab" : $pluralKebab;

        // Ensure group name is in admin.php translations
        if ($group) {
            $this->updateAdminTranslations($group);
        }

        // Remove ANY existing link for this module by routeName to avoid duplicates
        $escapedRoute = preg_quote($routeName, '/');
        $pattern = "/\s*@can\('view_{$pluralSnake}'\)\s*<x-nav\.link route=\"{$escapedRoute}\".*?<\/x-nav\.link>\s*@endcan/s";
        $content = preg_replace($pattern, '', $content);

        $newLink = "\n    @can('view_{$pluralSnake}')\n        <x-nav.link route=\"$routeName\" icon=\"$icon\">{{ __('$transPk.$pluralName') }}</x-nav.link>\n    @endcan\n";

        if ($group) {
            $escapedGroup = preg_quote("{{ __('admin.$group') }}", '/');
            // Pattern to match the group with its potential @if wrapper
            $groupPattern = "/(@if\(.*?\)\s*)?<x-nav\.group label=['\"]([0-9]+\. )?{$escapedGroup}['\"].*?<\/x-nav\.group>(\s*@endif)?/s";

            if (preg_match($groupPattern, $content, $matches)) {
                $matchedFullGroup = $matches[0];
                $ifWrapper = $matches[1] ?? '';
                $endifWrapper = $matches[3] ?? '';

                if (str_contains($matchedFullGroup, $newLink)) {
                    return; // Link already exists
                }

                // Update @if condition if it exists
                if ($ifWrapper) {
                    if (!str_contains($ifWrapper, "'view_{$pluralSnake}'")) {
                        $newIf = preg_replace("/\)\s*$/", " || can('view_{$pluralSnake}'))", trim($ifWrapper));
                        $content = str_replace($ifWrapper, $newIf . "\n", $content);
                    }
                } else {
                    // Wrap existing group in @if
                    // First we need to find all permissions already inside the group
                    preg_match_all("/@can\('(view_[a-z_]+)'\)/", $matchedFullGroup, $perms);
                    $allPerms = array_unique(array_merge($perms[1] ?? [], ["view_{$pluralSnake}"]));
                    $ifCond = "@if(" . collect($allPerms)->map(fn($p) => "can('$p')")->implode(' || ') . ")";
                    $updatedGroup = "$ifCond\n" . $matchedFullGroup . "\n@endif";
                    $content = str_replace($matchedFullGroup, $updatedGroup, $content);
                }

                // Insert the new link inside the group (re-read content because we might have changed it above)
                if (preg_match($groupPattern, $content, $newMatches)) {
                    $matchedGroupPart = $newMatches[0];
                    $updatedGroup = str_replace('</x-nav.group>', $newLink . '</x-nav.group>', $matchedGroupPart);
                    $content = str_replace($matchedGroupPart, $updatedGroup, $content);
                }

                File::put($navPath, $content);
            } else {
                // Create new group wrapped in @if
                $groupLabelTrans = "{{ __('admin.$group') }}";
                if ($groupLabel && preg_match('/^[0-9]+\. /', $groupLabel, $idMatch)) {
                    $groupLabelTrans = $idMatch[0] . $groupLabelTrans;
                }

                $ifCond = "@if(can('view_{$pluralSnake}'))";
                $newGroup = "\n$ifCond\n<x-nav.group label=\"$groupLabelTrans\" icon=\"rectangle-group\" route=\"admin." . Str::kebab($group) . "\">" . $newLink . "</x-nav.group>\n@endif\n";

                $search = "<x-nav.divider>{{ __('admin.Account') }}</x-nav.divider>";
                if (str_contains($content, $search)) {
                    File::put($navPath, str_replace($search, $newGroup . $search, $content));
                } else {
                    File::append($navPath, $newGroup);
                }
            }
        } else {
            $search = "<x-nav.divider>{{ __('admin.Account') }}</x-nav.divider>";
            if (str_contains($content, $search)) {
                File::put($navPath, str_replace($search, $newLink . $search, $content));
            } else {
                File::append($navPath, $newLink);
            }
        }
    }

    protected function updateAdminTranslations($group)
    {
        foreach (['en', 'sq'] as $lang) {
            $path = lang_path("$lang/admin.php");
            if (!File::exists($path)) continue;

            $existing = include $path;
            if (!isset($existing[$group])) {
                $existing[$group] = $group;
                $content = "<?php\n\nreturn " . var_export($existing, true) . ";\n";
                $content = str_replace(['array (', ')'], ['[', ']'], $content);
                File::put($path, $content);
                $this->line("✓ Added '$group' to $lang/admin.php");
            }
        }
    }

    protected function generateApiLayer($name, $pluralName, $pluralKebab, $fields, $groupStudly = '', $groupKebab = '')
    {
        $groupNamespace = $groupStudly ? "\\$groupStudly" : "";
        $dir = app_path('Http/Controllers/Api');
        File::makeDirectory($dir, 0755, true, true);
        File::put("$dir/{$name}Controller.php", "<?php\nnamespace App\Http\Controllers\Api;\nuse App\Http\Controllers\Controller;\nuse App\Models{$groupNamespace}\\$name;\nclass {$name}Controller extends Controller { public function index() { return $name::paginate(); } }");
        $apiRoutePath = base_path('routes/api.php');
        $existing = File::exists($apiRoutePath) ? File::get($apiRoutePath) : '';
        if (!str_contains($existing, "apiResource('$pluralKebab'")) {
            File::append($apiRoutePath, "\nRoute::apiResource('$pluralKebab', \App\Http\Controllers\Api\\{$name}Controller::class);");
        } else {
            $this->line("API route for $pluralKebab already registered — skipped.");
        }
    }

    protected function findModelFQCN($modelName, $currentGroupPath = '')
    {
        // 1. Try in current group first (High Priority)
        if ($currentGroupPath) {
            $groupDir = app_path("Models/$currentGroupPath");
            if (File::exists("$groupDir/$modelName.php")) {
                $namespace = str_replace('/', '\\', $currentGroupPath);
                return "App\\Models\\$namespace\\$modelName";
            }
        }

        // 2. Fallback to global search
        $modelsDir = app_path('Models');
        if (!File::isDirectory($modelsDir)) return null;

        $it = new \RecursiveDirectoryIterator($modelsDir);
        foreach (new \RecursiveIteratorIterator($it) as $file) {
            if ($file->getFilename() === "$modelName.php") {
                $relativePath = str_replace([$modelsDir, DIRECTORY_SEPARATOR], ['', '\\'], $file->getPath());
                return "App\\Models" . $relativePath . "\\" . $modelName;
            }
        }
        return null;
    }
}
