<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class ModulePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            'berber-app', 'clinic-management', 'auto-repair-management', 'construction-e-r-p',
            'warehouse-management', 'restaurant-p-o-s', 'school-management', 'real-estate-c-r-m',
            'c-r-m', 'hotel-management', 'human-resources', 'e--commerce', 'fleet-management',
            'gym-management', 'finance', 'legal-management', 'pharmacy-management',
            'event-management', 'travel-agency', 'facility-management', 'agriculture-management'
        ];

        foreach ($modules as $module) {
            $name = str_replace('-', '_', $module);
            Permission::firstOrCreate([
                'name' => "view_{$name}_dashboard",
                'label' => "View " . ucwords(str_replace(['-', '_'], ' ', $module)) . " Dashboard",
                'module' => ucwords(str_replace(['-', '_'], ' ', $module))
            ]);
        }
    }
}
