<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\FleetManagement\Dashboard;
Route::get('/fleet-management/dashboard', Dashboard::class)->name('admin.fleet-management.dashboard');