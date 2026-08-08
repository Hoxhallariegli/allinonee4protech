<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\WarehouseManagement\Dashboard;
Route::get('/warehouse-management/dashboard', Dashboard::class)->name('admin.warehouse-management.dashboard');