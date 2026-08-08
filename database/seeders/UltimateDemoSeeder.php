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

        echo "🚀 Starting GOD-MODE (Enums Enabled) Demo Data Seeding..." . PHP_EOL;

        foreach ($tables as $table) {
            $this->parseEnums($table);
        }

        for ($pass = 1; $pass <= 5; $pass++) {
            echo "🔄 Pass $pass..." . PHP_EOL;
            foreach ($manifest as $group) {
                $prefix = $group['prefix'];
                $moduleTables = array_filter($tables, fn($t) => str_starts_with($t, $prefix));

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

        try {
            $type = Schema::getColumnType($table, $column);
        } catch (\Throwable $e) {
            $type = 'string';
        }

        if ($type === 'boolean') return rand(0, 1);
        if (in_array($type, ['integer', 'bigint', 'smallint'])) return rand(1, 100);
        if (in_array($type, ['decimal', 'float', 'double'])) return rand(1000, 50000) / 100;
        if (in_array($type, ['date', 'datetime', 'timestamp'])) return now()->subDays(rand(1, 100))->toDateTimeString();

        // Fallback checks based on column names if type detection is generic
        if (str_contains($column, 'price') || str_contains($column, 'amount') || str_contains($column, 'balance') || str_contains($column, 'fee') || str_contains($column, 'budget') || str_contains($column, 'salary') || str_contains($column, 'cost') || str_contains($column, 'total') || str_contains($column, 'area') || str_contains($column, 'quantity') || str_contains($column, 'stock') || str_contains($column, 'capacity') || str_contains($column, 'rate') || str_contains($column, 'distance') || str_contains($column, 'percentage') || str_contains($column, 'commission') || str_contains($column, 'score')) {
            return rand(1000, 50000) / 100;
        }

        if (str_contains($column, 'date') || str_contains($column, 'at') || $column === 'dob' || str_contains($column, 'time') || str_contains($column, 'birth') || str_contains($column, 'check_in') || str_contains($column, 'check_out')) {
            return now()->subDays(rand(1, 100))->toDateTimeString();
        }

        if (str_contains($column, 'email')) {
            return "user" . rand(100, 9999) . "@example.com";
        }

        if (str_contains($column, 'phone') || str_contains($column, 'mobile')) {
            return "06" . rand(7, 9) . rand(1000000, 9999999);
        }

        if (str_contains($column, 'gender')) {
            return rand(0, 1) ? 'male' : 'female';
        }

        if (str_contains($column, 'license_plate')) {
            return "AA " . rand(100, 999) . " " . strtoupper(Str::random(2));
        }

        $label = Str::title(str_replace(['_', 'ba_', 'arm_', 'ce_', 'wm_', 'cm_', 'rp_', 'sm_', 'rec_', 'c_', 'hm_', 'hr_', 'ecom_', 'fl_', 'gym_', 'fin_', 'legal_', 'pharm_', 'event_', 'travel_', 'facility_', 'agri_'], ' ', $table));
        $colLabel = Str::title(str_replace('_', ' ', $column));

        return trim("$label $colLabel $index");
    }
}
