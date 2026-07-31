<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class BerberPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $entities = [
            'Barber' => 'barbers',
            'Service' => 'services',
            'Booking' => 'bookings',
        ];

        foreach ($entities as $label => $snake) {
            foreach (['view', 'add', 'edit', 'delete'] as $act) {
                Permission::firstOrCreate(
                    ['name' => "{$act}_{$snake}"],
                    ['label' => ucfirst($act) . " $label", 'module' => 'Berber']
                );
            }
        }
    }
}
