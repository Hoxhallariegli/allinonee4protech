<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\TravelAgency\Dashboard;
Route::get('/travel-agency/dashboard', Dashboard::class)->name('admin.travel-agency.dashboard');