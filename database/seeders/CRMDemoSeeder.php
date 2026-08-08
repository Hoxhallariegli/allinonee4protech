<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CRM\{Company, Contact, Lead, Deal, Task};
use Carbon\Carbon;

class CRMDemoSeeder extends Seeder
{
    public function run()
    {
        echo "💼 Seeding CRM Management...\n";

        // 1. Companies
        $companies = [
            ['name' => 'Tech Solutions Ltd', 'industry' => 'Software', 'phone' => '068100100'],
            ['name' => 'Green Energy Corp', 'industry' => 'Renewables', 'phone' => '068200200'],
            ['name' => 'Fast Logistics SA', 'industry' => 'Transport', 'phone' => '068300300'],
            ['name' => 'Elite Real Estate', 'industry' => 'Real Estate', 'phone' => '068400400'],
            ['name' => 'Global Finance Inc', 'industry' => 'Banking', 'phone' => '068500500'],
        ];

        $companyModels = [];
        foreach ($companies as $c) {
            $companyModels[] = Company::create($c);
        }
        echo "   ✅ 5 Companies created.\n";

        // 2. Contacts
        $contacts = [
            ['name' => 'John Doe', 'email' => 'john.doe@techsol.com'],
            ['name' => 'Sarah Smith', 'email' => 'sarah.s@greenenergy.com'],
            ['name' => 'Mike Ross', 'email' => 'mike.r@fastlog.com'],
            ['name' => 'Harvey Specter', 'email' => 'harvey@elite.com'],
            ['name' => 'Donna Paulsen', 'email' => 'donna@globalfin.com'],
        ];

        $contactModels = [];
        foreach ($contacts as $index => $con) {
            $contactModels[] = Contact::create(array_merge($con, [
                'company_id' => $companyModels[$index % count($companyModels)]->id
            ]));
        }
        echo "   ✅ 5 Contacts created.\n";

        echo "✨ CRM Seeding Complete!\n";
    }
}
