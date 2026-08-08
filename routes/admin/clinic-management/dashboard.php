<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ClinicManagement\Dashboard;
Route::get('/clinic-management/dashboard', Dashboard::class)->name('admin.clinic-management.dashboard');