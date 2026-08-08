<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\HotelManagement\Dashboard;
Route::get('/hotel-management/dashboard', Dashboard::class)->name('admin.hotel-management.dashboard');