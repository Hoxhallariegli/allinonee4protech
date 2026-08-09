<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UltimateDemoSeeder extends Seeder
{
    private $tableEnums = [];

    public function run()
    {
        $manifestPath = storage_path('app/scaffold-groups.json');
        if (!file_exists($manifestPath)) {
            echo "❌ Scaffold manifest not found!" . PHP_EOL;
            return;
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);
        $rawTables = DB::connection()->getSchemaBuilder()->getTableListing();
        $tables = array_map(fn($t) => str_replace('main.', '', $t), $rawTables);

        // Exclude system tables
        $tables = array_filter($tables, fn($t) => !in_array($t, ['migrations', 'personal_access_tokens', 'failed_jobs', 'password_reset_tokens', 'sessions', 'cache', 'cache_locks', 'jobs', 'job_batches', 'telescope_entries', 'telescope_entries_tags', 'telescope_monitoring']));

        echo "🚀 Starting GOD-MODE (Enums Enabled) Demo Data Seeding..." . PHP_EOL;

        foreach ($tables as $table) {
            $this->parseEnums($table);
        }

        for ($pass = 1; $pass <= 5; $pass++) {
            echo "🔄 Pass $pass..." . PHP_EOL;
            foreach ($manifest as $group) {
                $prefix = $group['prefix'];
                $moduleTables = array_filter($tables, fn($t) => str_starts_with($t, $prefix));

                // Sort tables: parent tables (short names, no underscores after prefix) first
                usort($moduleTables, function($a, $b) {
                    return substr_count($a, '_') <=> substr_count($b, '_');
                });

                foreach ($moduleTables as $table) {
                    $this->seedTable($table, $prefix, $tables);
                }
            }
        }

        echo "✨ Seeding Complete!" . PHP_EOL;
    }

    private function parseEnums($table)
    {
        try {
            $sql = DB::table('sqlite_master')->where('name', $table)->value('sql');
            if (!$sql) return;

            // Pattern: check ("column" in ('val1', 'val2'))
            preg_match_all('/check\s*\("([^"]+)"\s*in\s*\(([^)]+)\)\)/i', $sql, $matches);

            if (!empty($matches[1])) {
                foreach ($matches[1] as $idx => $column) {
                    $values = str_replace(["'", " "], "", $matches[2][$idx]);
                    $this->tableEnums[$table][$column] = explode(",", $values);
                }
            }
        } catch (\Throwable $e) {}
    }

    private function seedTable($table, $currentPrefix, $allTables)
    {
        $count = DB::table($table)->count();
        if ($count >= 5) return;

        $toAdd = 5 - $count;
        $columns = Schema::getColumnListing($table);

        for ($i = 1; $i <= $toAdd; $i++) {
            $row = [];
            foreach ($columns as $column) {
                if (in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) continue;

                if (str_ends_with($column, '_id')) {
                    $baseName = substr($column, 0, -3);
                    $refTable = null;

                    $guesses = [
                        $currentPrefix . Str::plural($baseName),
                        $currentPrefix . $baseName . 's',
                        Str::plural($baseName),
                    ];

                    foreach ($guesses as $g) {
                        if (in_array($g, $allTables)) {
                            $refTable = $g;
                            break;
                        }
                    }

                    if (!$refTable) {
                        foreach ($allTables as $t) {
                            if (str_ends_with($t, '_' . Str::plural($baseName)) || str_ends_with($t, '_' . $baseName . 's')) {
                                $refTable = $t;
                                break;
                            }
                        }
                    }

                    if ($refTable) {
                        $val = DB::table($refTable)->inRandomOrder()->value('id');
                        if ($val) {
                            $row[$column] = $val;
                        } else {
                            continue 2;
                        }
                    } else {
                        $row[$column] = 1;
                    }
                } else {
                    $row[$column] = $this->fakeValue($column, $table, $i);
                }
            }
            $row['created_at'] = now();
            $row['updated_at'] = now();

            try {
                DB::table($table)->insert($row);
            } catch (\Throwable $e) {
                // Silently skip if insert fails
            }
        }

        $newCount = DB::table($table)->count();
        if ($newCount > $count) {
            echo "   ✅ '$table': $count -> $newCount" . PHP_EOL;
        }
    }

    private function fakeValue($column, $table, $index)
    {
        // Check if we have detected enums for this column
        if (isset($this->tableEnums[$table][$column])) {
            return $this->tableEnums[$table][$column][array_rand($this->tableEnums[$table][$column])];
        }

        $lowCol = strtolower($column);
        if ($lowCol === 'password') return \Illuminate\Support\Facades\Hash::make('password');

        try {
            $type = Schema::getColumnType($table, $column);
        } catch (\Throwable $e) {
            $type = 'string';
        }

        // Priority 1: Strict Type Detection
        if ($type === 'boolean') return rand(0, 1);
        if (in_array($type, ['integer', 'bigint', 'smallint', 'mediumint', 'tinyint'])) return rand(1, 100);
        if (in_array($type, ['decimal', 'float', 'double'])) return (float) (rand(1000, 50000) / 100);
        if (in_array($type, ['date', 'datetime', 'timestamp'])) return now()->subDays(rand(1, 100))->toDateTimeString();

        // Priority 2: Fallback checks based on column names (if type detection returns 'string' for numeric fields)
        $lowCol = strtolower($column);
        if (str_contains($lowCol, 'price') || str_contains($lowCol, 'amount') || str_contains($lowCol, 'balance') || str_contains($lowCol, 'fee') || str_contains($lowCol, 'budget') || str_contains($lowCol, 'salary') || str_contains($lowCol, 'cost') || str_contains($lowCol, 'total') || str_contains($lowCol, 'rate') || str_contains($lowCol, 'percentage') || str_contains($lowCol, 'commission') || str_contains($lowCol, 'score') || str_contains($lowCol, 'tax')) {
            return (float) (rand(1000, 50000) / 100);
        }

        if (str_contains($lowCol, 'quantity') || str_contains($lowCol, 'stock') || str_contains($lowCol, 'capacity') || str_contains($lowCol, 'count') || str_contains($lowCol, 'duration') || str_contains($lowCol, 'points') || str_contains($lowCol, 'level') || str_contains($lowCol, 'age') || str_contains($lowCol, 'year') || str_contains($lowCol, 'sort') || str_contains($lowCol, 'order') || str_contains($lowCol, 'step') || str_starts_with($lowCol, 'is_') || str_starts_with($lowCol, 'has_') || str_starts_with($lowCol, 'can_')) {
            return rand(0, 100);
        }

        if (str_contains($lowCol, 'date') || str_contains($lowCol, 'at') || $lowCol === 'dob' || str_contains($lowCol, 'time') || str_contains($lowCol, 'birth') || str_contains($lowCol, 'check_in') || str_contains($lowCol, 'check_out')) {
            return now()->subDays(rand(1, 100))->toDateTimeString();
        }

        if (str_contains($lowCol, 'email')) {
            return "user" . rand(100, 9999) . "@example.com";
        }

        if (str_contains($lowCol, 'phone') || str_contains($lowCol, 'mobile')) {
            return "06" . rand(7, 9) . rand(1000000, 9999999);
        }

        if (str_contains($lowCol, 'gender')) {
            return rand(0, 1) ? 'male' : 'female';
        }

        if (str_contains($lowCol, 'license_plate')) {
            return "AA " . rand(100, 999) . " " . strtoupper(Str::random(2));
        }

        // If it's still identified as a numeric type but escaped our name checks, force a number
        if (in_array($type, ['integer', 'bigint', 'smallint', 'mediumint', 'tinyint', 'decimal', 'float', 'double'])) {
            return rand(1, 100);
        }

        $label = Str::title(str_replace(['_', 'ba_', 'arm_', 'ce_', 'wm_', 'cm_', 'rp_', 'sm_', 'rec_', 'c_', 'hm_', 'hr_', 'ecom_', 'fl_', 'gym_', 'fin_', 'legal_', 'pharm_', 'event_', 'travel_', 'facility_', 'agri_'], ' ', $table));
        $colLabel = Str::title(str_replace('_', ' ', $column));

        return trim("$label $colLabel $index");
    }
}
