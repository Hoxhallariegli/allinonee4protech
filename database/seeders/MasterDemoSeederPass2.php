<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MasterDemoSeederPass2 extends Seeder
{
    public function run()
    {
        echo "🚀 Duke nisur fazën e dytë të popullimit (Rregullimi i fushave)..." . PHP_EOL;

        $create = function($table, $data) {
            $data['created_at'] = now();
            $data['updated_at'] = now();
            try {
                return DB::table($table)->insertGetId($data);
            } catch (\Throwable $e) {
                echo "⚠️ Error seeding table '$table': " . $e->getMessage() . PHP_EOL;
                return null;
            }
        };

        // 1. Clinic (cm_) - Fixed
        for($i=1; $i<=5; $i++) {
            $did = $create('cm_doctors', ['name' => 'Dr. ' . fake()->name, 'specialization' => 'Mjek', 'license_number' => 'LN'.rand(100, 999)]);
            $pid = $create('cm_patients', ['name' => fake()->name, 'phone' => '068'.rand(1000000, 9999999), 'gender' => 'Male']);
            if($pid && $did) {
                $vid = $create('cm_visits', ['patient_id' => $pid, 'doctor_id' => $did, 'visit_date' => now(), 'diagnosis' => 'Checkup', 'status' => 'completed', 'fee' => 1000]);
                $create('cm_clinic_invoices', ['visit_id' => $vid, 'total_amount' => 1000, 'status' => 'paid']);
            }
        }

        // 2. Event (event_) - Fixed
        $orgId = $create('event_organizers', ['name' => 'Elite Events']);
        for($i=1; $i<=5; $i++) {
            $create('event_events', ['organizer_id' => $orgId, 'title' => 'Gala Event '.$i, 'event_date' => now()->addDays(30), 'location' => 'Tirana']);
        }

        // 3. Travel (travel_) - Fixed
        for($i=1; $i<=5; $i++) {
            $create('travel_destinations', ['country' => 'France', 'city' => 'Paris '.$i, 'description' => 'City of lights']);
            $create('travel_tour_packages', ['name' => 'Paketa Premium '.$i, 'price' => 1500]);
        }

        // 4. Human Resources (hr_) - Fixed
        $deptId = $create('hr_departments', ['name' => 'IT Department']);
        for($i=1; $i<=5; $i++) {
            $create('hr_employees', ['name' => fake()->name, 'department_id' => $deptId, 'email' => fake()->email, 'status' => 'active']);
        }

        // 5. Agriculture (agri_) - Fixed
        for($i=1; $i<=5; $i++) {
            $create('agri_fields', ['name' => 'Parcela Bujqësore '.$i, 'area_size' => 2.5]);
        }

        // 6. Fleet (fl_) - Fixed
        for($i=1; $i<=5; $i++) {
            $create('fl_vehicles', ['make' => 'Mercedes', 'model' => 'Sprinter', 'license_plate' => 'AA '.rand(100, 999).' XX', 'status' => 'active']);
        }

        // 7. Hotel (hm_) - Fixed
        for($i=1; $i<=5; $i++) {
            $create('hm_room_types', ['name' => 'Deluxe Suite '.$i, 'price' => 85]);
        }

        // 8. E-Commerce (ecom_) - Fixed
        for($i=1; $i<=5; $i++) {
            $vid = $create('ecom_vendors', ['name' => 'Vendor '.$i, 'store_name' => 'Station Store '.$i]);
            if($vid) {
                $create('ecom_products', ['name' => 'Product '.$i, 'vendor_id' => $vid, 'price' => 5000]);
            }
        }

        // 9. Construction (ce_) - Fixed
        $clientId = $create('ce_clients', ['name' => 'Global Corp']);
        for($i=1; $i<=5; $i++) {
            $create('ce_projects', ['name' => 'Ndërtim Civil '.$i, 'client_id' => $clientId, 'budget' => 1000000]);
        }

        // 10. Facility (facility_) - Fixed
        for($i=1; $i<=5; $i++) {
            $create('facility_buildings', ['name' => 'Objekti '.$i, 'address' => 'Rr. Durresit']);
        }

        echo "✨ Faza e dytë përfundoi!" . PHP_EOL;
    }
}
