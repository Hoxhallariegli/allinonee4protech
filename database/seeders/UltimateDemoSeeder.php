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
        $manifest = [
            "BerberApp" => ["prefix" => "ba_"],
            "AutoRepairManagement" => ["prefix" => "arm_"],
            "ConstructionERP" => ["prefix" => "ce_"],
            "WarehouseManagement" => ["prefix" => "wm_"],
            "ClinicManagement" => ["prefix" => "cm_"],
            "RestaurantPOS" => ["prefix" => "rp_"],
            "SchoolManagement" => ["prefix" => "sm_"],
            "RealEstateCRM" => ["prefix" => "rec_"],
            "CRM" => ["prefix" => "c_"],
            "HotelManagement" => ["prefix" => "hm_"],
            "HumanResources" => ["prefix" => "hr_"],
            "ECommerce" => ["prefix" => "ecom_"],
            "FleetManagement" => ["prefix" => "fl_"],
            "GymManagement" => ["prefix" => "gym_"],
            "Finance" => ["prefix" => "fin_"],
            "LegalManagement" => ["prefix" => "legal_"],
            "PharmacyManagement" => ["prefix" => "pharm_"],
            "EventManagement" => ["prefix" => "event_"],
            "TravelAgency" => ["prefix" => "travel_"],
            "FacilityManagement" => ["prefix" => "facility_"],
            "AgricultureManagement" => ["prefix" => "agri_"]
        ];

        $rawTables = DB::connection()->getSchemaBuilder()->getTableListing();
        // Clean table names (remove quotes and generic sqlite prefixes)
        $tables = array_map(function($t) {
            $t = str_replace(['main.', '"', '`'], '', $t);
            if (is_object($t)) return $t->name; // Handle some DB drivers returning objects
            return (string)$t;
        }, $rawTables);

        // Exclude system tables
        $tables = array_filter($tables, fn($t) => !in_array($t, ['migrations', 'personal_access_tokens', 'failed_jobs', 'password_reset_tokens', 'sessions', 'cache', 'cache_locks', 'jobs', 'job_batches', 'telescope_entries', 'telescope_entries_tags', 'telescope_monitoring', 'notification_settings', 'settings', 'permissions', 'roles', 'role_has_permissions', 'model_has_roles', 'model_has_permissions', 'users', 'audit_trails', 'notifications']));

        echo "🚀 Starting GOD-MODE Demo Data Seeding (All 21 Modules)..." . PHP_EOL;
        echo "📊 Total tables found in DB: " . count($tables) . PHP_EOL;

        foreach ($tables as $table) {
            $this->parseEnums($table);
        }

        foreach ($manifest as $groupName => $groupInfo) {
            $prefix = $groupInfo['prefix'];
            $moduleTables = array_filter($tables, fn($t) => str_starts_with($t, $prefix));

            if (empty($moduleTables)) {
                echo "   ⚠️ No tables found for prefix '$prefix'" . PHP_EOL;
                continue;
            }

            // Sort tables: parent tables (short names, no underscores after prefix) first
            usort($moduleTables, function($a, $b) {
                return substr_count($a, '_') <=> substr_count($b, '_');
            });

            for ($pass = 1; $pass <= 3; $pass++) {
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
                // If it's the last pass and still failing, maybe log it
                // echo "      ❌ Failed to insert into '$table': " . Str::limit($e->getMessage(), 50) . PHP_EOL;
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

        if (str_contains($lowCol, 'quantity') || str_contains($lowCol, 'stock') || str_contains($lowCol, 'capacity') || str_contains($lowCol, 'count') || str_contains($lowCol, 'duration') || str_contains($lowCol, 'points') || str_contains($lowCol, 'level') || str_contains($lowCol, 'age') || str_contains($lowCol, 'year') || str_contains($lowCol, 'sort') || str_contains($lowCol, 'order') || str_contains($lowCol, 'step') || str_contains($lowCol, 'priority') || str_contains($lowCol, 'limit') || str_contains($lowCol, 'min') || str_contains($lowCol, 'max') || str_starts_with($lowCol, 'is_') || str_starts_with($lowCol, 'has_') || str_starts_with($lowCol, 'can_')) {
            return rand(0, 10);
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

        if ($lowCol === 'slug') {
            return Str::slug($label . " " . $index . " " . Str::random(5));
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
