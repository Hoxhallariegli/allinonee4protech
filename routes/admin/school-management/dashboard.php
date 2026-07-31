<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\SchoolManagement\Dashboard;
Route::get('/school-management/dashboard', Dashboard::class)->name('admin.school-management.dashboard');