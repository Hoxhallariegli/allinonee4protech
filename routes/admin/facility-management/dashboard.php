<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\FacilityManagement\Dashboard;
Route::get('/facility-management/dashboard', Dashboard::class)->name('admin.facility-management.dashboard');