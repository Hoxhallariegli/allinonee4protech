<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ECommerce\Customers\Customers;
use App\Livewire\Admin\ECommerce\Customers\Create;
use App\Livewire\Admin\ECommerce\Customers\Edit;
Route::prefix('e--commerce/customers')->group(function () {
    Route::get('/', Customers::class)->name('admin.e--commerce.customers.index');
    Route::get('create', Create::class)->name('admin.e--commerce.customers.create');
    Route::get('/{' . 'customer' . '}/edit', Edit::class)->name('admin.e--commerce.customers.edit');
});