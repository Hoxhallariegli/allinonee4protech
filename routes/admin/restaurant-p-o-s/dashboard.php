<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RestaurantPOS\Dashboard;
Route::get('/restaurant-p-o-s/dashboard', Dashboard::class)->name('admin.restaurant-p-o-s.dashboard');