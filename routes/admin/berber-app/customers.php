<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\BerberApp\Customers\Customers;
use App\Livewire\Admin\BerberApp\Customers\Create;
use App\Livewire\Admin\BerberApp\Customers\Edit;
Route::prefix('berber-app/customers')->group(function () {
    Route::get('/', Customers::class)->name('admin.berber-app.customers.index');
    Route::get('create', Create::class)->name('admin.berber-app.customers.create');
    Route::get('/{' . 'customer' . '}/edit', Edit::class)->name('admin.berber-app.customers.edit');
});