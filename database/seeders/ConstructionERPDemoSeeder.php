<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConstructionERP\{Client, Project, Building, Apartment};
use Carbon\Carbon;

class ConstructionERPDemoSeeder extends Seeder
{
    public function run()
    {
        echo "🏗️ Seeding Construction ERP...\n";

        // 1. Clients
        $clients = [
            ['name' => 'Adriatik Construction', 'email' => 'info@adriatik.al', 'phone' => '068111222'],
            ['name' => 'Riviera Invest', 'email' => 'contact@riviera.al', 'phone' => '068222333'],
            ['name' => 'Mountain View Properties', 'email' => 'sales@mountainview.com', 'phone' => '068333444'],
            ['name' => 'Urban Developers', 'email' => 'urban@dev.al', 'phone' => '068444555'],
            ['name' => 'Bregu SA', 'email' => 'admin@bregu.al', 'phone' => '068555666'],
        ];

        $clientModels = [];
        foreach ($clients as $c) {
            $clientModels[] = Client::create($c);
        }
        echo "   ✅ 5 Clients created.\n";

        // 2. Projects
        $projects = [
            ['name' => 'Skanderbeg Square Residences', 'budget' => 5000000, 'status' => 'active', 'start_date' => Carbon::now()->subMonths(6)],
            ['name' => 'Vlora Waterfront', 'budget' => 12000000, 'status' => 'planning', 'start_date' => Carbon::now()->addMonths(2)],
            ['name' => 'Korça Boutique Hotel', 'budget' => 2500000, 'status' => 'active', 'start_date' => Carbon::now()->subMonths(3)],
            ['name' => 'Durrës Port Expansion', 'budget' => 8500000, 'status' => 'completed', 'start_date' => Carbon::now()->subYears(2)],
            ['name' => 'Saranda Sunrise Villas', 'budget' => 4200000, 'status' => 'active', 'start_date' => Carbon::now()->subMonths(8)],
        ];

        foreach ($projects as $index => $p) {
            Project::create(array_merge($p, [
                'client_id' => $clientModels[$index % count($clientModels)]->id
            ]));
        }
        echo "   ✅ 5 Projects created.\n";

        echo "✨ Construction Seeding Complete!\n";
    }
}
