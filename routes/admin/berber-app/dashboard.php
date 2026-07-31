<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\BerberApp\Dashboard;
Route::get('/berber-app/dashboard', Dashboard::class)->name('admin.berber-app.dashboard');