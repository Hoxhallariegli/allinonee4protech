<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WarehouseManagement\{Category as WhCategory, Supplier as WhSupplier, Customer as WhCustomer, Warehouse, Product as WhProduct, Employee as WhEmployee, CustomerAddress, StockAdjustment};
use App\Models\ClinicManagement\{Doctor, Patient, Visit};
use App\Models\RestaurantPOS\{Category as ResCategory, Waiter, DiningTable, MenuItem};
use App\Models\PharmacyManagement\{Supplier as PharSupplier, Medicine};
use App\Models\HotelManagement\{RoomType, Guest, HotelRoom, Reservation};
use App\Models\ECommerce\{Vendor, Customer as EcomCustomer, Product as EcomProduct, Order as EcomOrder, OrderItem as EcomOrderItem, Category as EcomCategory};
use App\Models\LegalManagement\{Client as LegalClient, LegalCase, Hearing};
use Carbon\Carbon;

class ModuleBatchOneSeeder extends Seeder
{
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        $this->seedWarehouse();
        $this->seedClinic();
        $this->seedRestaurant();
        $this->seedPharmacy();
        $this->seedHotel();
        $this->seedECommerce();
        $this->seedLegal();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
    }

    private function seedWarehouse()
    {
        echo "📦 Seeding Warehouse Management...\n";
        WhCategory::truncate(); WhSupplier::truncate(); Warehouse::truncate(); WhProduct::truncate();
        WhCustomer::truncate(); CustomerAddress::truncate(); WhEmployee::truncate();

        $catModels = [];
        foreach (['Electronics', 'Furniture', 'Tools', 'Appliances', 'Textiles'] as $c)
            $catModels[] = WhCategory::create(['name' => $c, 'description' => "High quality $c products"]);

        foreach ([['name' => 'TechBulk Albania', 'phone' => '068111111'], ['name' => 'EuroTools Sh.p.k', 'phone' => '069222222']] as $s)
            WhSupplier::create($s);

        $warehouses = [];
        foreach ([['name' => 'Tirana East Hub', 'address' => 'Autostrada TR-EL, Km 5'], ['name' => 'Durres Port Depot', 'address' => 'Lagjja 4, Durres']] as $w)
            $warehouses[] = Warehouse::create($w);

        $products = [];
        for ($i = 1; $i <= 10; $i++) {
            $products[] = WhProduct::create([
                'name' => "Product Model " . fake()->word() . " $i",
                'category_id' => $catModels[array_rand($catModels)]->id,
                'price' => rand(50, 2000),
                'stock' => rand(10, 500)
            ]);
        }

        for ($i = 1; $i <= 5; $i++) {
            $customer = WhCustomer::create([
                'name' => fake()->name(),
                'phone' => '06' . rand(7, 9) . rand(1000000, 9999999),
                'email' => fake()->unique()->safeEmail()
            ]);

            CustomerAddress::create([
                'customer_id' => $customer->id,
                'address' => fake()->address()
            ]);
        }

        foreach (['Manager', 'Supervisor', 'Warehouse Worker', 'Inventory Specialist'] as $pos) {
            WhEmployee::create([
                'name' => fake()->name(),
                'position' => $pos,
                'salary' => rand(500, 1500),
                'hire_date' => now()->subMonths(rand(1, 24))
            ]);
        }
    }

    private function seedClinic()
    {
        echo "🏥 Seeding Clinic Management...\n";
        Doctor::truncate(); Patient::truncate(); Visit::truncate();

        $docModels = [];
        foreach ([['name' => 'Dr. Ilir Meta', 'specialization' => 'General Medicine', 'phone' => '068400500'], ['name' => 'Dr. Anila Hoxha', 'specialization' => 'Pediatrics', 'phone' => '069400600']] as $d)
            $docModels[] = Doctor::create($d);

        for ($i = 1; $i <= 7; $i++) {
            $patient = Patient::create([
                'name' => fake()->name(),
                'phone' => '06' . rand(7, 9) . rand(1000000, 9999999),
                'birth_date' => now()->subYears(rand(1, 80))
            ]);

            Visit::create([
                'patient_id' => $patient->id,
                'doctor_id' => $docModels[array_rand($docModels)]->id,
                'visit_date' => now()->subDays(rand(0, 30)),
                'diagnosis' => fake()->randomElement(['Seasonal Flu', 'Mild Allergy', 'High Blood Pressure', 'Regular Checkup'])
            ]);
        }
    }

    private function seedRestaurant()
    {
        echo "🍴 Seeding Restaurant POS...\n";
        ResCategory::truncate(); Waiter::truncate(); DiningTable::truncate(); MenuItem::truncate();

        $categories = [];
        foreach (['Starters', 'Main Course', 'Desserts', 'Drinks'] as $c) {
            $categories[] = ResCategory::create(['name' => $c]);
        }
        foreach (['Bledi', 'Kela', 'Eri'] as $w) Waiter::create(['name' => $w, 'phone' => '068' . rand(1000000, 9999999)]);

        for ($i = 1; $i <= 7; $i++) {
            DiningTable::create(['number' => "T-$i", 'capacity' => rand(2, 6), 'status' => 'free']);
            MenuItem::create([
                'name' => fake()->word() . " Dish",
                'price' => rand(5, 45),
                'category_id' => $categories[array_rand($categories)]->id
            ]);
        }
    }

    private function seedPharmacy()
    {
        echo "💊 Seeding Pharmacy Management...\n";
        PharSupplier::truncate(); Medicine::truncate();
        foreach (['MedLine', 'PharmaDist'] as $s) PharSupplier::create(['name' => $s, 'phone' => '069' . rand(1000000, 9999999)]);
        foreach (['Paracetamol', 'Amoxicillin', 'Ibuprofen', 'Vitamin C', 'Aspirin'] as $m) {
            Medicine::create(['name' => $m, 'price' => rand(2, 20), 'stock' => rand(50, 500)]);
        }
    }

    private function seedHotel()
    {
        echo "🏨 Seeding Hotel Management...\n";
        RoomType::truncate(); Guest::truncate(); HotelRoom::truncate(); Reservation::truncate();
        $rt = RoomType::create(['name' => 'Deluxe Suite', 'base_price' => 150]);
        for ($i = 1; $i <= 7; $i++) {
            $room = HotelRoom::create(['room_number' => "10$i", 'room_type_id' => $rt->id, 'status' => 'available']);
            $guest = Guest::create(['name' => fake()->name(), 'email' => fake()->email()]);
            Reservation::create([
                'guest_id' => $guest->id, 'room_id' => $room->id, 'check_in' => now()->addDays($i),
                'check_out' => now()->addDays($i+2), 'total_price' => 300
            ]);
        }
    }

    private function seedECommerce()
    {
        echo "🛒 Seeding E-Commerce...\n";
        Vendor::truncate(); EcomCustomer::truncate(); EcomProduct::truncate(); EcomOrder::truncate(); EcomOrderItem::truncate(); EcomCategory::truncate();

        $categories = [];
        foreach (['Electronics', 'Fashion', 'Home & Living', 'Beauty'] as $name) {
            $categories[] = EcomCategory::create(['name' => $name]);
        }

        $vendor = Vendor::create(['name' => 'FashionNova AL', 'email' => 'sales@fashionnova.al', 'phone' => '068111222']);
        for ($i = 1; $i <= 7; $i++) {
            $p = EcomProduct::create([
                'name' => "Ecom Item $i",
                'price' => rand(20, 100),
                'stock' => 50,
                'vendor_id' => $vendor->id,
                'category_id' => $categories[array_rand($categories)]->id
            ]);
            $c = EcomCustomer::create(['name' => fake()->name(), 'email' => fake()->email(), 'phone' => '069' . rand(1000000, 9999999)]);
            $order = EcomOrder::create(['customer_id' => $c->id, 'total' => $p->price, 'status' => 'pending']);
            EcomOrderItem::create([
                'order_id' => $order->id,
                'product_id' => $p->id,
                'quantity' => 1,
                'price' => $p->price
            ]);
        }
    }

    private function seedLegal()
    {
        echo "⚖️ Seeding Legal Management...\n";
        LegalClient::truncate(); LegalCase::truncate(); Hearing::truncate();

        for ($i = 1; $i <= 5; $i++) {
            $client = LegalClient::create([
                'name' => fake()->company(),
                'email' => fake()->unique()->safeEmail(),
                'phone' => '06' . rand(7, 9) . rand(1000000, 9999999)
            ]);

            $case = LegalCase::create([
                'title' => fake()->sentence(3),
                'client_id' => $client->id,
                'case_number' => 'L-' . rand(1000, 9999),
                'status' => fake()->randomElement(['open', 'closed', 'appealed'])
            ]);

            Hearing::create([
                'legal_case_id' => $case->id,
                'date' => now()->addDays(rand(1, 30)),
                'location' => 'High Court of Tirana',
                'description' => 'Procedural hearing'
            ]);
        }
    }
}
