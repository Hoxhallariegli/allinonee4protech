<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AutoRepairManagement\{Customer, VehicleBrand, VehicleModel, Vehicle, Employee, Mechanic, Service, Part, JobCard, Supplier};
use Illuminate\Support\Str;
use Carbon\Carbon;

class AutoRepairDemoSeeder extends Seeder
{
    public function run()
    {
        echo "🔧 Seeding Auto Repair Management...\n";

        // 1. Brands & Models
        $brands = [
            'Toyota' => ['Camry', 'Corolla', 'RAV4', 'Highlander', 'Tacoma'],
            'Mercedes-Benz' => ['C-Class', 'E-Class', 'S-Class', 'GLE', 'GLC'],
            'BMW' => ['3 Series', '5 Series', 'X3', 'X5', 'M3'],
            'Audi' => ['A4', 'A6', 'Q5', 'Q7', 'e-tron'],
            'Ford' => ['F-150', 'Mustang', 'Explorer', 'Escape', 'Focus']
        ];

        foreach ($brands as $brandName => $models) {
            $brand = VehicleBrand::create(['name' => $brandName]);
            foreach ($models as $modelName) {
                VehicleModel::create(['name' => $modelName, 'brand_id' => $brand->id]);
            }
        }
        echo "   ✅ Brands & Models created.\n";

        // 2. Customers
        $customers = [
            ['name' => 'Arben Hoxha', 'email' => 'arben.h@example.com', 'phone' => '0681122334'],
            ['name' => 'Elona Meta', 'email' => 'elona.m@example.com', 'phone' => '0692233445'],
            ['name' => 'Besnik Dervishi', 'email' => 'besnik.d@example.com', 'phone' => '0673344556'],
            ['name' => 'Fatmir Gashi', 'email' => 'fatmir.g@example.com', 'phone' => '0684455667'],
            ['name' => 'Lindita Rama', 'email' => 'lindita.r@example.com', 'phone' => '0695566778'],
        ];

        $customerModels = [];
        foreach ($customers as $c) {
            $customerModels[] = Customer::create($c);
        }
        echo "   ✅ 5 Customers created.\n";

        // 3. Employees & Mechanics
        $employees = [
            ['name' => 'Genci Rira', 'email' => 'genci@auto.com', 'phone' => '0681001001', 'specialization' => 'Master Mechanic'],
            ['name' => 'Ilir Bozo', 'email' => 'ilir@auto.com', 'phone' => '0681001002', 'specialization' => 'Electrician'],
            ['name' => 'Saimir Tahiri', 'email' => 'saimir@auto.com', 'phone' => '0681001003', 'specialization' => 'Body Work'],
            ['name' => 'Artur Kola', 'email' => 'artur@auto.com', 'phone' => '0681001004', 'specialization' => 'Diagnostic Tech'],
            ['name' => 'Edi Rama', 'email' => 'edi@auto.com', 'phone' => '0681001005', 'specialization' => 'Service Advisor'],
        ];

        foreach ($employees as $e) {
            $spec = $e['specialization'];
            unset($e['specialization']);
            $emp = Employee::create($e);
            Mechanic::create(['employee_id' => $emp->id, 'specialization' => $spec]);
        }
        echo "   ✅ 5 Mechanics created.\n";

        // 4. Services & Parts
        $services = [
            ['name' => 'Full Oil Change', 'price' => 75.50, 'duration' => 45],
            ['name' => 'Brake Pad Replacement', 'price' => 120.00, 'duration' => 60],
            ['name' => 'AC Gas Refill', 'price' => 45.00, 'duration' => 30],
            ['name' => 'Computer Diagnostics', 'price' => 35.00, 'duration' => 20],
            ['name' => 'Wheel Alignment', 'price' => 55.00, 'duration' => 40],
        ];
        foreach ($services as $s) Service::create($s);

        $parts = [
            ['name' => 'Castrol 5W40 1L', 'price' => 15.00, 'stock' => 50],
            ['name' => 'Brembo Brake Pads', 'price' => 85.00, 'stock' => 20],
            ['name' => 'Bosch Oil Filter', 'price' => 12.00, 'stock' => 30],
            ['name' => 'Air Filter K&N', 'price' => 45.00, 'stock' => 10],
            ['name' => 'Spark Plug NGK', 'price' => 8.00, 'stock' => 100],
        ];
        foreach ($parts as $p) Part::create($p);
        echo "   ✅ Services & Parts created.\n";

        echo "✨ Auto Repair Seeding Complete!\n";
    }
}
