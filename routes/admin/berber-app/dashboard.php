<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\BerberApp\Dashboard;
use App\Livewire\Admin\BerberApp\Integrations\DeviceTokens;

Route::get('/admin/berber-app/dashboard', Dashboard::class)->name('admin.berber-app.dashboard');
Route::get('/admin/berber-app/integrations/device-tokens', DeviceTokens::class)->name('admin.berber-app.integrations.device-tokens');
