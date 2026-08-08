<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AgricultureManagement\Field;
use App\Models\AgricultureManagement\Crop;
use App\Models\AgricultureManagement\InventorySupply;
use Illuminate\Support\Str;

class AgricultureSeeder extends Seeder
{
    public function run()
    {
        echo "🌱 Seeding Agriculture Management...\n";

        $soilTypes = ['Clay', 'Sandy', 'Loamy', 'Silty', 'Peaty'];
        $cropNames = ['Wheat', 'Corn', 'Soybeans', 'Potato', 'Tomato', 'Carrot', 'Grapes'];
        $statuses = ['growing', 'harvested', 'failed'];

        // 1. Fields
        for ($i = 1; $i <= 5; $i++) {
            Field::create([
                'name' => "Field #" . Str::padLeft($i, 2, '0'),
                'area_size' => rand(10, 500) / 10,
                'soil_type' => $soilTypes[array_rand($soilTypes)],
                'location_photo' => null, // Placeholder
            ]);
        }
        echo "✅ Fields created.\n";

        // 2. Inventory Supplies
        $supplies = [
            ['name' => 'Nitrogen Fertilizer', 'unit' => 'kg'],
            ['name' => 'Pesticide Alpha', 'unit' => 'L'],
            ['name' => 'Tractor Fuel', 'unit' => 'L'],
            ['name' => 'Seeds Variety X', 'unit' => 'kg'],
            ['name' => 'Irrigation Pipes', 'unit' => 'pcs'],
        ];

        foreach ($supplies as $s) {
            InventorySupply::create([
                'name' => $s['name'],
                'stock_quantity' => rand(50, 1000),
                'unit' => $s['unit'],
            ]);
        }
        echo "✅ Inventory Supplies created.\n";

        // 3. Crops
        $fields = Field::all();
        foreach ($fields as $field) {
            for ($j = 1; $j <= rand(1, 3); $j++) {
                Crop::create([
                    'field_id' => $field->id,
                    'name' => $cropNames[array_rand($cropNames)],
                    'planting_date' => now()->subDays(rand(30, 180)),
                    'harvest_date' => rand(0, 1) ? now()->addDays(rand(30, 90)) : null,
                    'status' => $statuses[array_rand($statuses)],
                    'photo' => null,
                ]);
            }
        }
        echo "✅ Crops created.\n";
    }
}
