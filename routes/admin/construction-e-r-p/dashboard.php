<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ConstructionERP\Dashboard;
Route::get('/construction-e-r-p/dashboard', Dashboard::class)->name('admin.construction-e-r-p.dashboard');