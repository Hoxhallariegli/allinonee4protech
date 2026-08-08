<?php
use Illuminate\Support\Facades\Route;

Route::prefix('modular')->middleware(['auth'])->group(function () {
    $modules = [
        'berber-app' => 'BerberApp',
        'auto-repair-management' => 'AutoRepairManagement',
        'construction-e-r-p' => 'ConstructionERP',
        'warehouse-management' => 'WarehouseManagement',
        'clinic-management' => 'ClinicManagement',
        'restaurant-p-o-s' => 'RestaurantPOS',
        'school-management' => 'SchoolManagement',
        'real-estate-c-r-m' => 'RealEstateCRM',
        'c-r-m' => 'CRM',
        'hotel-management' => 'HotelManagement',
        'human-resources' => 'HumanResources',
        'e--commerce' => 'ECommerce',
        'fleet-management' => 'FleetManagement',
        'gym-management' => 'GymManagement',
        'finance' => 'Finance',
        'legal-management' => 'LegalManagement',
        'pharmacy-management' => 'PharmacyManagement',
        'event-management' => 'EventManagement',
        'travel-agency' => 'TravelAgency',
        'facility-management' => 'FacilityManagement',
        'agriculture-management' => 'AgricultureManagement'
    ];

    foreach ($modules as $kebab => $studly) {
        $class = "\\App\\Livewire\\Admin\\{$studly}\\Dashboard";
        if (class_exists($class)) {
            Route::get("{$kebab}/dashboard", $class)->name("admin.{$kebab}.dashboard");
        }
    }
});
