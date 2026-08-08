<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AgricultureManagement\Dashboard;

Route::get('dashboard', Dashboard::class)->name('admin.agriculture-management.dashboard');
