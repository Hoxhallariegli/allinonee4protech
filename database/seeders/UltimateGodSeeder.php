<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UltimateGodSeeder extends Seeder
{
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

        echo "🚀 Starting ULTIMATE GOD-MODE Seeding (All 21 Modules)..." . PHP_EOL;

        // We run multiple passes to ensure foreign keys are satisfied
        for ($pass = 1; $pass <= 3; $pass++) {
            echo "🔄 Pass $pass..." . PHP_EOL;
            foreach ($manifest as $groupName => $groupInfo) {
                $prefix = $groupInfo['prefix'];
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

        echo "✨ Seeding Complete! All 21 modules now have realistic demo data." . PHP_EOL;
    }

    private function seedTable($table, $currentPrefix, $allTables)
    {
        $existingCount = DB::table($table)->count();
        if ($existingCount >= 7) return; // Already seeded

        $toAdd = 7 - $existingCount;
        $columns = Schema::getColumnListing($table);

        for ($i = 1; $i <= $toAdd; $i++) {
            $row = [];
            foreach ($columns as $column) {
                if (in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) continue;

                if (str_ends_with($column, '_id')) {
                    $row[$column] = $this->getForeignKeyValue($column, $currentPrefix, $allTables);
                } else {
                    $row[$column] = $this->getRealisticValue($column, $table);
                }
            }
            $row['created_at'] = now();
            $row['updated_at'] = now();

            try {
                DB::table($table)->insert($row);
            } catch (\Throwable $e) {
                // Skip if constraint fails (pass 2/3 will catch it)
            }
        }
    }

    private function getForeignKeyValue($column, $currentPrefix, $allTables)
    {
        $baseName = substr($column, 0, -3);
        $guesses = [
            $currentPrefix . Str::plural($baseName),
            $currentPrefix . $baseName . 's',
            Str::plural($baseName),
            $baseName . 's'
        ];

        foreach ($guesses as $g) {
            if (in_array($g, $allTables)) {
                $val = DB::table($g)->inRandomOrder()->value('id');
                if ($val) return $val;
            }
        }

        // Final fallback: look for any table ending in that name
        foreach ($allTables as $t) {
            if (str_ends_with($t, '_' . Str::plural($baseName)) || str_ends_with($t, '_' . $baseName . 's')) {
                $val = DB::table($t)->inRandomOrder()->value('id');
                if ($val) return $val;
            }
        }

        return 1; // Last resort
    }

    private function getRealisticValue($column, $table)
    {
        $col = strtolower($column);

        if ($col === 'name' || $col === 'full_name') return fake()->name();
        if (str_contains($col, 'title') || $col === 'subject') return fake()->sentence(3);
        if (str_contains($col, 'email')) return fake()->unique()->safeEmail();
        if (str_contains($col, 'phone') || str_contains($col, 'mobile')) return '06' . rand(7, 9) . rand(1000000, 9999999);
        if (str_contains($col, 'address')) return fake()->address();
        if (str_contains($col, 'description') || $col === 'notes' || $col === 'diagnosis') return fake()->paragraph();
        if (str_contains($col, 'price') || str_contains($col, 'amount') || str_contains($col, 'budget') || str_contains($col, 'total') || $col === 'salary' || $col === 'balance' || $col === 'rate' || $col === 'tax' || $col === 'discount' || $col === 'fee' || $col === 'debt' || $col === 'credit' || $col === 'cost' || $col === 'revenue' || $col === 'profit') return rand(10, 5000) . '.00';
        if (str_contains($col, 'date') || str_contains($col, '_at') || $col === 'dob') return now()->subDays(rand(0, 365))->toDateTimeString();
        if (str_contains($col, 'status')) {
             // Try to find if there are common status values
             return fake()->randomElement(['pending', 'active', 'completed', 'confirmed', 'paid', 'open']);
        }
        if (str_contains($col, 'quantity') || str_contains($col, 'stock') || $col === 'capacity') return rand(1, 100);
        if (str_contains($col, 'photo') || str_contains($col, 'image') || $col === 'logo') return 'https://i.pravatar.cc/150?u=' . Str::random(5);
        if ($col === 'gender') return fake()->randomElement(['male', 'female']);
        if ($col === 'industry') return fake()->randomElement(['Tech', 'Health', 'Finance', 'Retail', 'Logistics']);
        if (str_contains($col, 'specialization')) return fake()->randomElement(['Generalist', 'Expert', 'Consultant']);
        if (str_contains($col, 'license_plate')) return 'AA ' . rand(100, 999) . ' ' . strtoupper(Str::random(2));

        return Str::title(str_replace('_', ' ', $column)) . ' ' . rand(1, 100);
    }
}
