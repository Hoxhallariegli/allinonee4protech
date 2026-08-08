<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ECommerce\Dashboard;
Route::get('/e--commerce/dashboard', Dashboard::class)->name('admin.e--commerce.dashboard');