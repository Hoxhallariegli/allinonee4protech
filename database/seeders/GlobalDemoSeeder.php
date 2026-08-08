<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

// Import all necessary models
use App\Models\WarehouseManagement\{Category as WhCategory, Supplier as WhSupplier, Customer as WhCustomer, Warehouse, Product as WhProduct};
use App\Models\ClinicManagement\{Doctor, Patient, Visit};
use App\Models\RestaurantPOS\{Category as ResCategory, Waiter, DiningTable, MenuItem};
use App\Models\PharmacyManagement\{Supplier as PharSupplier, Medicine};
use App\Models\HotelManagement\{RoomType, Guest, HotelRoom, Reservation};
use App\Models\ECommerce\{Vendor, Customer as EcomCustomer, Product as EcomProduct};
use App\Models\HumanResources\{Department, Employee as HrEmployee};
use App\Models\FleetManagement\{Driver, Vehicle as FleetVehicle};
use App\Models\GymManagement\{MembershipPlan, Trainer, Member};
use App\Models\Finance\{Account, Category as FinCategory, Transaction};
use App\Models\LegalManagement\{Client as LegalClient, LegalCase};
use App\Models\EventManagement\{Organizer, Event};
use App\Models\TravelAgency\{Destination, TourPackage, Client as TravelClient};
use App\Models\FacilityManagement\{Building as FacBuilding, Technician};
use App\Models\BerberApp\{Barber, Service as BerService, Customer as BerCustomer};
use App\Models\RealEstateCRM\{Agent, Owner, Client as ReClient, Property};

class GlobalDemoSeeder extends Seeder
{
    public function run()
    {
        echo "🌍 Starting Global Seeding for remaining 16 modules...\n";

        $this->seedWarehouse();
        $this->seedClinic();
        $this->seedRestaurant();
        $this->seedPharmacy();
        $this->seedHotel();
        $this->seedECommerce();
        $this->seedHumanResources();
        $this->seedFleet();
        $this->seedGym();
        $this->seedFinance();
        $this->seedLegal();
        $this->seedEvents();
        $this->seedTravel();
        $this->seedFacility();
        $this->seedBerber();
        $this->seedRealEstate();

        echo "✨ Global Seeding Complete!\n";
    }

    private function seedWarehouse() {
        echo "📦 Seeding Warehouse...\n";
        $cat = WhCategory::create(['name' => 'Electronics', 'description' => 'Gadgets and devices']);
        $sup = WhSupplier::create(['name' => 'Tech Supply Co', 'phone' => '069123456']);
        $cus = WhCustomer::create(['name' => 'Global Retailers', 'email' => 'contact@global.com']);
        $wh = Warehouse::create(['name' => 'Main Hub Tirana', 'address' => 'Autostrada TR-DR']);
        for($i=1; $i<=5; $i++) WhProduct::create(['name' => "Product $i", 'category_id' => $cat->id, 'price' => 100 * $i, 'stock' => 50]);
    }

    private function seedClinic() {
        echo "🏥 Seeding Clinic...\n";
        $doc = Doctor::create(['name' => 'Dr. Arjan Leka', 'specialization' => 'Cardiology', 'phone' => '068222333']);
        for($i=1; $i<=5; $i++) {
            $pat = Patient::create(['name' => "Patient Name $i", 'phone' => "06711100$i", 'birth_date' => now()->subYears(20+$i)]);
            Visit::create(['patient_id' => $pat->id, 'doctor_id' => $doc->id, 'visit_date' => now(), 'diagnosis' => 'Routine checkup']);
        }
    }

    private function seedRestaurant() {
        echo "🍴 Seeding Restaurant...\n";
        $cat = ResCategory::create(['name' => 'Main Course']);
        $waiter = Waiter::create(['name' => 'Bledi', 'phone' => '068111222']);
        for($i=1; $i<=5; $i++) {
            DiningTable::create(['number' => "Table $i", 'capacity' => 4]);
            MenuItem::create(['name' => "Dish $i", 'price' => 10 + $i, 'category' => $cat->name]);
        }
    }

    private function seedPharmacy() {
        echo "💊 Seeding Pharmacy...\n";
        $sup = PharSupplier::create(['name' => 'PharmaDist', 'phone' => '069555444']);
        for($i=1; $i<=5; $i++) Medicine::create(['name' => "Medicine $i", 'price' => 5 + $i, 'stock' => 100]);
    }

    private function seedHotel() {
        echo "🏨 Seeding Hotel...\n";
        $rt = RoomType::create(['name' => 'Deluxe Suite', 'price_per_night' => 120]);
        for($i=1; $i<=5; $i++) {
            $room = HotelRoom::create(['room_number' => "10$i", 'room_type_id' => $rt->id, 'status' => 'available']);
            $guest = Guest::create(['name' => "Guest $i", 'email' => "guest$i@hotel.com"]);
            Reservation::create(['guest_id' => $guest->id, 'room_id' => $room->id, 'check_in' => now(), 'check_out' => now()->addDays(2), 'status' => 'confirmed']);
        }
    }

    private function seedECommerce() {
        echo "🛒 Seeding E-Commerce...\n";
        $vendor = Vendor::create(['name' => 'ShopZilla', 'email' => 'sales@shopzilla.com']);
        for($i=1; $i<=5; $i++) {
            EcomProduct::create(['name' => "Ecom Item $i", 'price' => 20 * $i, 'vendor_id' => $vendor->id]);
            EcomCustomer::create(['name' => "Ecom User $i", 'email' => "user$i@ecom.com"]);
        }
    }

    private function seedHumanResources() {
        echo "👥 Seeding HR...\n";
        $dept = Department::create(['name' => 'Operations']);
        for($i=1; $i<=5; $i++) HrEmployee::create(['name' => "Employee $i", 'department_id' => $dept->id, 'position' => 'Staff', 'phone' => '068111000']);
    }

    private function seedFleet() {
        echo "🚚 Seeding Fleet...\n";
        $driver = Driver::create(['name' => 'Viron', 'license_number' => 'ABC12345']);
        for($i=1; $i<=5; $i++) FleetVehicle::create(['make' => 'Iveco', 'model' => 'Eurocargo', 'license_plate' => "TR $i$i$i AA"]);
    }

    private function seedGym() {
        echo "💪 Seeding Gym...\n";
        $plan = MembershipPlan::create(['name' => 'Gold Monthly', 'price' => 50]);
        $trainer = Trainer::create(['name' => 'Kreshnik', 'specialization' => 'Powerlifting']);
        for($i=1; $i<=5; $i++) Member::create(['name' => "Member $i", 'membership_plan_id' => $plan->id, 'phone' => '068000000']);
    }

    private function seedFinance() {
        echo "💰 Seeding Finance...\n";
        $acc = Account::create(['name' => 'Business Savings', 'balance' => 10000]);
        $cat = FinCategory::create(['name' => 'Operational Expenses']);
        for($i=1; $i<=5; $i++) Transaction::create(['account_id' => $acc->id, 'category_id' => $cat->id, 'amount' => 500, 'type' => 'expense', 'description' => "Trans $i"]);
    }

    private function seedLegal() {
        echo "⚖️ Seeding Legal...\n";
        for($i=1; $i<=5; $i++) {
            $cli = LegalClient::create(['name' => "Client $i", 'email' => "cli$i@legal.com"]);
            LegalCase::create(['title' => "Case #00$i", 'client_id' => $cli->id, 'status' => 'open']);
        }
    }

    private function seedEvents() {
        echo "🎫 Seeding Events...\n";
        $org = Organizer::create(['name' => 'EventPro', 'email' => 'info@eventpro.com']);
        for($i=1; $i<=5; $i++) Event::create(['title' => "Mega Event $i", 'organizer_id' => $org->id, 'event_date' => now()->addMonths($i), 'location' => 'Tirana Congress Center']);
    }

    private function seedTravel() {
        echo "✈️ Seeding Travel...\n";
        $dest = Destination::create(['name' => 'Saranda', 'country' => 'Albania']);
        for($i=1; $i<=5; $i++) {
            TourPackage::create(['name' => "Summer Package $i", 'destination_id' => $dest->id, 'price' => 300 + ($i*50)]);
            TravelClient::create(['name' => "Traveler $i", 'email' => "traveler$i@mail.com"]);
        }
    }

    private function seedFacility() {
        echo "🏢 Seeding Facility...\n";
        $building = FacBuilding::create(['name' => 'Business Tower', 'address' => 'Blvd. Deshmoret e Kombit']);
        for($i=1; $i<=5; $i++) Technician::create(['name' => "Tech $i", 'specialization' => 'Maintenance']);
    }

    private function seedBerber() {
        echo "✂️ Seeding Berber App...\n";
        $barber = Barber::create(['name' => 'Artan', 'phone' => '068777888']);
        $service = BerService::create(['name' => 'Haircut', 'price' => 10]);
        for($i=1; $i<=5; $i++) BerCustomer::create(['name' => "Cus $i", 'phone' => '069000000']);
    }

    private function seedRealEstate() {
        echo "🏠 Seeding Real Estate...\n";
        $agent = Agent::create(['name' => 'Erald', 'phone' => '068444333']);
        $owner = Owner::create(['name' => 'Petrit', 'phone' => '067111111']);
        for($i=1; $i<=5; $i++) {
            Property::create(['title' => "Apartment $i", 'owner_id' => $owner->id, 'agent_id' => $agent->id, 'price' => 80000 + ($i*10000), 'type' => 'apartment']);
            ReClient::create(['name' => "Buyer $i", 'phone' => '068111000']);
        }
    }
}
