<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\LegalManagement\Dashboard;
Route::get('/legal-management/dashboard', Dashboard::class)->name('admin.legal-management.dashboard');