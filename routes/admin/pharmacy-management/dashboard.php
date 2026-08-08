<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\PharmacyManagement\Dashboard;
Route::get('/pharmacy-management/dashboard', Dashboard::class)->name('admin.pharmacy-management.dashboard');