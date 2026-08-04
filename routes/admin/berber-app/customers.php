<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\BerberApp\Customers\Customers;

Route::prefix('berber-app/customers')->group(function () {
    Route::get('/', Customers::class)->name('admin.berber-app.customers.index');
});
