<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\Dashboard;
Route::get('/auto-repair-management/dashboard', Dashboard::class)->name('admin.auto-repair-management.dashboard');