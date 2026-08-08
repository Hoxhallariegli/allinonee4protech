<?php

use Illuminate\Support\Facades\Route;

Route::get('/berber-app', \App\Livewire\Front\BerberApp\Landing::class)->name('front.berber-app');
Route::get('/auto-repair-management', \App\Livewire\Front\AutoRepairManagement\Landing::class)->name('front.auto-repair-management');
Route::get('/construction-e-r-p', \App\Livewire\Front\ConstructionERP\Landing::class)->name('front.construction-e-r-p');
Route::get('/school-management', \App\Livewire\Front\SchoolManagement\Landing::class)->name('front.school-management');
Route::get('/warehouse-management', \App\Livewire\Front\WarehouseManagement\Landing::class)->name('front.warehouse-management');
Route::get('/clinic-management', \App\Livewire\Front\ClinicManagement\Landing::class)->name('front.clinic-management');
Route::get('/restaurant-p-o-s', \App\Livewire\Front\RestaurantPOS\Landing::class)->name('front.restaurant-p-o-s');
Route::get('/real-estate-c-r-m', \App\Livewire\Front\RealEstateCRM\Landing::class)->name('front.real-estate-c-r-m');
Route::get('/c-r-m', \App\Livewire\Front\CRM\Landing::class)->name('front.c-r-m');
Route::get('/finance', \App\Livewire\Front\Finance\Landing::class)->name('front.finance');
Route::get('/agriculture-management', \App\Livewire\Front\AgricultureManagement\Landing::class)->name('front.agriculture-management');
Route::get('/fleet-management', \App\Livewire\Front\FleetManagement\Landing::class)->name('front.fleet-management');
Route::get('/gym-management', \App\Livewire\Front\GymManagement\Landing::class)->name('front.gym-management');
Route::get('/hotel-management', \App\Livewire\Front\HotelManagement\Landing::class)->name('front.hotel-management');
Route::get('/human-resources', \App\Livewire\Front\HumanResources\Landing::class)->name('front.human-resources');
Route::get('/e--commerce', \App\Livewire\Front\ECommerce\Landing::class)->name('front.e--commerce');
Route::get('/facility-management', \App\Livewire\Front\FacilityManagement\Landing::class)->name('front.facility-management');
Route::get('/travel-agency', \App\Livewire\Front\TravelAgency\Landing::class)->name('front.travel-agency');
Route::get('/event-management', \App\Livewire\Front\EventManagement\Landing::class)->name('front.event-management');
Route::get('/pharmacy-management', \App\Livewire\Front\PharmacyManagement\Landing::class)->name('front.pharmacy-management');
Route::get('/legal-management', \App\Livewire\Front\LegalManagement\Landing::class)->name('front.legal-management');
