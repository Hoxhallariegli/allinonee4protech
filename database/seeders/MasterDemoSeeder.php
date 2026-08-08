<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MasterDemoSeeder extends Seeder
{
    public function run()
    {
        echo "🚀 Duke nisur popullimin e plotë të sistemit me Demo Data (5 për secilën)..." . PHP_EOL;

        // --- Helper for creating data via DB to avoid model issues ---
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

        // 1. Berber App (ba_)
        for($i=1; $i<=5; $i++) {
            $bid = $create('ba_barbers', ['name' => fake()->name, 'specialization' => 'Top Stylist', 'active' => 1]);
            $sid = $create('ba_services', ['name' => 'Haircut '.$i, 'duration_minutes' => 30, 'price' => 1000, 'active' => 1]);
            $cid = $create('ba_customers', ['name' => fake()->name, 'phone' => '069'.rand(1000000, 9999999)]);
            $create('ba_bookings', ['barber_id' => $bid, 'service_id' => $sid, 'customer_id' => $cid, 'appointment_datetime' => now()->addDays($i)]);
        }

        // 2. Clinic Management (cm_)
        for($i=1; $i<=5; $i++) {
            $did = $create('cm_doctors', ['name' => 'Dr. ' . fake()->name, 'specialization' => 'Specialist', 'active' => 1]);
            $pid = $create('cm_patients', ['name' => fake()->name, 'phone' => '068'.rand(1000000, 9999999)]);
            $vid = $create('cm_visits', ['patient_id' => $pid, 'doctor_id' => $did, 'visit_date' => now()->subDays($i), 'diagnosis' => 'Kontroll', 'status' => 'completed']);
            $create('cm_clinic_invoices', ['visit_id' => $vid, 'total_amount' => 2000, 'status' => 'paid']);
        }

        // 3. Restaurant POS (rp_)
        for($i=1; $i<=5; $i++) {
            $wid = $create('rp_waiters', ['name' => fake()->name, 'active' => 1]);
            $tid = $create('rp_dining_tables', ['number' => $i, 'capacity' => 4, 'status' => 'free']);
            $mid = $create('rp_menu_items', ['name' => 'Pizza '.$i, 'price' => 800, 'active' => 1]);
            $oid = $create('rp_orders', ['table_id' => $tid, 'waiter_id' => $wid, 'status' => 'paid', 'order_date' => now()]);
            $create('rp_order_items', ['order_id' => $oid, 'menu_item_id' => $mid, 'quantity' => 1]);
        }

        // 4. Real Estate CRM (rec_)
        for($i=1; $i<=5; $i++) {
            $aid = $create('rec_agents', ['name' => fake()->name, 'active' => 1]);
            $oid = $create('rec_owners', ['name' => fake()->name, 'phone' => '069'.rand(1000000, 9999999)]);
            $create('rec_properties', ['title' => 'Apartament '.$i, 'owner_id' => $oid, 'agent_id' => $aid, 'price' => 80000, 'type' => 'apartment', 'active' => 1]);
        }

        // 5. Finance (fin_)
        for($i=1; $i<=5; $i++) {
            $accId = $create('fin_accounts', ['name' => 'Banka '.$i, 'account_number' => 'AL'.rand(1000, 9999), 'balance' => 50000]);
            $create('fin_transactions', ['account_id' => $accId, 'amount' => 1000, 'type' => 'income', 'description' => 'Transfertë']);
        }

        // 6. CRM (c_)
        for($i=1; $i<=5; $i++) {
            $cid = $create('c_companies', ['name' => fake()->company, 'industry' => 'Business']);
            $create('c_leads', ['name' => 'Lead '.$i, 'company_id' => $cid, 'status' => 'new']);
        }

        // 7. Human Resources (hr_)
        for($i=1; $i<=5; $i++) {
            $did = $create('hr_departments', ['name' => 'Departamenti '.$i]);
            $create('hr_employees', ['name' => fake()->name, 'department_id' => $did, 'position' => 'Staff', 'active' => 1]);
        }

        // 8. Agriculture Management (agri_)
        for($i=1; $i<=5; $i++) {
            $fid = $create('agri_fields', ['name' => 'Parcela '.$i]);
            $create('agri_crops', ['name' => 'Mollë '.$i, 'field_id' => $fid, 'active' => 1]);
        }

        // 9. Pharmacy Management (pharm_)
        for($i=1; $i<=5; $i++) {
            $create('pharm_medicines', ['name' => 'Ibuprofen '.$i, 'price' => 500, 'active' => 1]);
        }

        // 10. Fleet Management (fl_)
        for($i=1; $i<=5; $i++) {
            $vid = $create('fl_vehicles', ['license_plate' => 'AA '.rand(100, 999).' XX', 'type' => 'Van', 'active' => 1]);
            $create('fl_shipments', ['vehicle_id' => $vid, 'origin' => 'Tiranë', 'destination' => 'Vlorë', 'status' => 'pending']);
        }

        // 11. Gym Management (gym_)
        for($i=1; $i<=5; $i++) {
            $create('gym_trainers', ['name' => fake()->name, 'specialization' => 'Personal Trainer', 'active' => 1]);
            $create('gym_membership_plans', ['name' => 'Plan '.$i, 'price' => 4000, 'active' => 1]);
        }

        // 12. Hotel Management (hm_)
        for($i=1; $i<=5; $i++) {
            $rtid = $create('hm_room_types', ['name' => 'Double '.$i, 'base_price' => 60]);
            $create('hm_hotel_rooms', ['room_number' => 'A'.$i, 'room_type_id' => $rtid, 'status' => 'available']);
        }

        // 13. Warehouse Management (wm_)
        for($i=1; $i<=5; $i++) {
            $whid = $create('wm_warehouses', ['name' => 'Magazina '.$i]);
            $catid = $create('wm_categories', ['name' => 'Hardware']);
            $create('wm_products', ['name' => 'Keyboard '.$i, 'warehouse_id' => $whid, 'category_id' => $catid, 'price' => 2000, 'stock' => 50, 'active' => 1]);
        }

        // 14. E-Commerce (ecom_)
        for($i=1; $i<=5; $i++) {
            $vid = $create('ecom_vendors', ['name' => fake()->company]);
            $create('ecom_products', ['name' => 'Smartphone '.$i, 'vendor_id' => $vid, 'price' => 30000, 'active' => 1]);
        }

        // 15. Construction ERP (ce_)
        for($i=1; $i<=5; $i++) {
            $pid = $create('ce_projects', ['name' => 'Projekti '.$i, 'active' => 1]);
            $create('ce_buildings', ['project_id' => $pid, 'name' => 'Kulla '.$i]);
        }

        // 16. Event Management (event_)
        for($i=1; $i<=5; $i++) {
            $create('event_events', ['name' => 'Koncert '.$i, 'event_date' => now()->addMonths($i), 'active' => 1]);
        }

        // 17. Travel Agency (travel_)
        for($i=1; $i<=5; $i++) {
            $create('travel_destinations', ['name' => 'Paris '.$i, 'active' => 1]);
            $create('travel_tour_packages', ['name' => 'Paketa '.$i, 'price' => 1200, 'active' => 1]);
        }

        // 18. Facility Management (facility_)
        for($i=1; $i<=5; $i++) {
            $create('facility_buildings', ['name' => 'Qendra '.$i]);
        }

        echo "✨ Popullimi përfundoi me sukses për të gjithë modulet!" . PHP_EOL;
    }
}
