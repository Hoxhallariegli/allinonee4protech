<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AgricultureManagement\Field;
use App\Models\AgricultureManagement\Crop;
use App\Models\AgricultureManagement\InventorySupply;
use Carbon\Carbon;

class AgricultureDemoSeeder extends Seeder
{
    public function run()
    {
        echo "🌱 Seeding Agriculture Management...\n";

        // 1. Fields
        $fields = [
            ['name' => 'Golden Valley East', 'area_size' => 45.5, 'soil_type' => 'Loam', 'location_photo' => 'fields/golden_valley.jpg'],
            ['name' => 'Sunset Ridge', 'area_size' => 22.8, 'soil_type' => 'Silty Clay', 'location_photo' => 'fields/sunset_ridge.jpg'],
            ['name' => 'Riverside Acres', 'area_size' => 60.0, 'soil_type' => 'Alluvial', 'location_photo' => 'fields/riverside.jpg'],
            ['name' => 'Pine Hill Plateau', 'area_size' => 15.2, 'soil_type' => 'Sandy Loam', 'location_photo' => 'fields/pine_hill.jpg'],
            ['name' => 'Oakwood Bottoms', 'area_size' => 38.4, 'soil_type' => 'Clay', 'location_photo' => 'fields/oakwood.jpg'],
        ];

        $fieldModels = [];
        foreach ($fields as $fieldData) {
            $fieldModels[] = Field::create($fieldData);
        }
        echo "   ✅ 5 Fields created.\n";

        // 2. Crops
        $crops = [
            ['name' => 'Hybrid Yellow Corn', 'status' => 'growing', 'planting_date' => Carbon::now()->subMonths(3)],
            ['name' => 'Winter Wheat', 'status' => 'growing', 'planting_date' => Carbon::now()->subMonths(5)],
            ['name' => 'Organic Soybeans', 'status' => 'harvested', 'planting_date' => Carbon::now()->subMonths(7)],
            ['name' => 'Roma Tomatoes', 'status' => 'growing', 'planting_date' => Carbon::now()->subMonths(2)],
            ['name' => 'Russet Potatoes', 'status' => 'growing', 'planting_date' => Carbon::now()->subMonths(4)],
            ['name' => 'Barley', 'status' => 'harvested', 'planting_date' => Carbon::now()->subMonths(8)],
        ];

        foreach ($crops as $index => $cropData) {
            $field = $fieldModels[$index % count($fieldModels)];
            Crop::create(array_merge($cropData, [
                'field_id' => $field->id,
                'photo' => 'crops/' . strtolower(str_replace(' ', '_', $cropData['name'])) . '.jpg'
            ]));
        }
        echo "   ✅ 6 Crops created.\n";

        // 3. Inventory Supplies
        $supplies = [
            ['name' => 'Nitrogen-Rich Fertilizer', 'stock_quantity' => 500, 'unit' => 'kg'],
            ['name' => 'Eco-Friendly Pesticide', 'stock_quantity' => 120, 'unit' => 'liters'],
            ['name' => 'Premium Corn Seeds', 'stock_quantity' => 50, 'unit' => 'bags'],
            ['name' => 'Irrigation Drip Tape', 'stock_quantity' => 2000, 'unit' => 'meters'],
            ['name' => 'Agricultural Lime', 'stock_quantity' => 1000, 'unit' => 'kg'],
            ['name' => 'Tractor Diesel Fuel', 'stock_quantity' => 800, 'unit' => 'liters'],
        ];

        foreach ($supplies as $supplyData) {
            InventorySupply::create($supplyData);
        }
        echo "   ✅ 6 Inventory Supplies created.\n";

        echo "✨ Agriculture Seeding Complete!\n";
    }
}
