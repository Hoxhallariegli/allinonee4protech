<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\EventManagement\Dashboard;
Route::get('/event-management/dashboard', Dashboard::class)->name('admin.event-management.dashboard');