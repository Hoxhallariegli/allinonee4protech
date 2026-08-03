<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BerberApp\Barber;
use App\Models\BerberApp\Service;
use App\Models\BerberApp\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BerberAppSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create or Get User for Barbers
        $admin = User::first() ?? User::factory()->create(['name' => 'Admin']);

        // 2. Create Services
        $services = [
            ['name' => 'Prerje Flokësh', 'duration_minutes' => 30, 'price' => 500, 'active' => true],
            ['name' => 'Rruajtje Mjekre', 'duration_minutes' => 15, 'price' => 300, 'active' => true],
            ['name' => 'Full Service (Flokë + Mjekër)', 'duration_minutes' => 50, 'price' => 700, 'active' => true],
            ['name' => 'Stilim / Ngjyrosje', 'duration_minutes' => 60, 'price' => 1200, 'active' => true],
        ];

        foreach ($services as $s) {
            Service::updateOrCreate(['name' => $s['name']], $s);
        }

        // 3. Create Barbers
        $barberData = [
            ['name' => 'Xheksi Lushka', 'specialization' => 'Mjeshtër Stilist / Founder', 'active' => true],
            ['name' => 'Robert Barber', 'specialization' => 'Mjeshtër i Brisqeve / Founder', 'active' => true],
        ];

        foreach ($barberData as $b) {
            Barber::updateOrCreate(['name' => $b['name']], array_merge($b, ['user_id' => $admin->id]));
        }

        // 4. Create some demo bookings
        $barbers = Barber::all();
        $serviceList = Service::all();
        $names = ['Egli', 'Mario', 'Krenar', 'Genti', 'Artan'];

        foreach (range(1, 10) as $i) {
            Booking::create([
                'barber_id' => $barbers->random()->id,
                'service_id' => $serviceList->random()->id,
                'customer_name' => $names[array_rand($names)],
                'customer_phone' => '069' . rand(1000000, 9999999),
                'appointment_datetime' => Carbon::now()->addDays(rand(1, 5))->setHour(rand(9, 18))->setMinute(0),
                'status' => 'pending',
                'reminder_enabled' => true,
                'reminder_minutes' => 30,
            ]);
        }
    }
}
