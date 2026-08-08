<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\CRM\Dashboard;
Route::get('/c-r-m/dashboard', Dashboard::class)->name('admin.c-r-m.dashboard');