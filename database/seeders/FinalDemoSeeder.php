<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FinalDemoSeeder extends Seeder
{
    public function run()
    {
        echo "🚀 Final Seeding Pass..." . PHP_EOL;

        $create = function($table, $data) {
            $data['created_at'] = now();
            $data['updated_at'] = now();
            return DB::table($table)->insertGetId($data);
        };

        // 1. Human Resources
        $did = $create('hr_departments', ['name' => 'Operation Dept']);
        for($i=1; $i<=5; $i++) {
            $create('hr_employees', [
                'department_id' => $did,
                'name' => fake()->name,
                'email' => fake()->email,
                'hire_date' => now()->subMonths(10),
                'salary' => 80000,
                'status' => 'active'
            ]);
        }

        // 2. Fleet
        for($i=1; $i<=5; $i++) {
            $create('fl_vehicles', [
                'make' => 'Mercedes',
                'model' => 'Sprinter',
                'license_plate' => 'AA '.rand(100, 999).' XX',
                'status' => 'active'
            ]);
        }

        // 3. Agriculture
        $fid = $create('agri_fields', ['name' => 'Fusha Veriore', 'area_size' => 10.5]);
        for($i=1; $i<=5; $i++) {
            $create('agri_crops', [
                'field_id' => $fid,
                'name' => 'Crop '.$i,
                'planting_date' => now()->subDays(30),
                'status' => 'growing'
            ]);
        }

        // 4. Finance
        $fincatId = $create('fin_categories', ['name' => 'General Revenue', 'type' => 'income']);
        for($i=1; $i<=5; $i++) {
            $accId = $create('fin_accounts', ['name' => 'Business Acc '.$i, 'balance' => 150000, 'type' => 'bank']);
            $create('fin_transactions', [
                'account_id' => $accId,
                'category_id' => $fincatId,
                'amount' => 5000,
                'description' => 'Service Payment',
                'transaction_date' => now(),
                'status' => 'completed'
            ]);
        }

        // 5. CRM
        $compId = $create('c_companies', ['name' => 'Alpha Corp', 'industry' => 'Tech']);
        for($i=1; $i<=5; $i++) {
            $create('c_leads', [
                'company_id' => $compId,
                'name' => 'High Value Lead '.$i,
                'status' => 'new'
            ]);
        }

        echo "✨ Final Pass Completed!" . PHP_EOL;
    }
}
