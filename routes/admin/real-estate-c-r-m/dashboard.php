<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RealEstateCRM\Dashboard;
Route::get('/real-estate-c-r-m/dashboard', Dashboard::class)->name('admin.real-estate-c-r-m.dashboard');