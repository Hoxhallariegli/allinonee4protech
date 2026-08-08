<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\GymManagement\Dashboard;
Route::get('/gym-management/dashboard', Dashboard::class)->name('admin.gym-management.dashboard');