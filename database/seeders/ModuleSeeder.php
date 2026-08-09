<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear cache first to ensure visibility
        \Illuminate\Support\Facades\Cache::forget('active_modules');

        $modules = [
            ['key' => 'berber-app', 'label' => 'Berber App', 'icon' => 'user'],
            ['key' => 'auto-repair-management', 'label' => 'Auto Repair Management', 'icon' => 'wrench'],
            ['key' => 'construction-e-r-p', 'label' => 'Construction ERP', 'icon' => 'building-office-2'],
            ['key' => 'school-management', 'label' => 'School Management', 'icon' => 'academic-cap'],
            ['key' => 'warehouse-management', 'label' => 'Warehouse Management', 'icon' => 'archive-box'],
            ['key' => 'clinic-management', 'label' => 'Clinic Management', 'icon' => 'heart'],
            ['key' => 'restaurant-p-o-s', 'label' => 'Restaurant POS', 'icon' => 'cake'],
            ['key' => 'real-estate-c-r-m', 'label' => 'Real Estate CRM', 'icon' => 'home-modern'],
            ['key' => 'c-r-m', 'label' => 'CRM', 'icon' => 'user-group'],
            ['key' => 'finance', 'label' => 'Finance', 'icon' => 'banknotes'],
            ['key' => 'agriculture-management', 'label' => 'Agriculture Management', 'icon' => 'sun'],
            ['key' => 'fleet-management', 'label' => 'Fleet Management', 'icon' => 'truck'],
            ['key' => 'gym-management', 'label' => 'Gym Management', 'icon' => 'bolt'],
            ['key' => 'hotel-management', 'label' => 'Hotel Management', 'icon' => 'home-modern'],
            ['key' => 'human-resources', 'label' => 'Human Resources', 'icon' => 'users'],
            ['key' => 'e--commerce', 'label' => 'E-Commerce', 'icon' => 'shopping-cart'],
            ['key' => 'facility-management', 'label' => 'Facility Management', 'icon' => 'wrench-screwdriver'],
            ['key' => 'travel-agency', 'label' => 'Travel Agency', 'icon' => 'globe-alt'],
            ['key' => 'event-management', 'label' => 'Event Management', 'icon' => 'sparkles'],
            ['key' => 'pharmacy-management', 'label' => 'Pharmacy Management', 'icon' => 'beaker'],
            ['key' => 'legal-management', 'label' => 'Legal Management', 'icon' => 'scale'],
        ];

        foreach ($modules as $index => $module) {
            Module::updateOrCreate(
                ['key' => $module['key']],
                [
                    'label' => $module['label'],
                    'icon' => $module['icon'],
                    'is_active' => true,
                    'order' => $index + 1
                ]
            );
        }
    }
}
