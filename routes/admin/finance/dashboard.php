<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Finance\Dashboard;
Route::get('/finance/dashboard', Dashboard::class)->name('admin.finance.dashboard');