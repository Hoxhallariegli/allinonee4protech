<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\HumanResources\Dashboard;
Route::get('/human-resources/dashboard', Dashboard::class)->name('admin.human-resources.dashboard');