<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ECommerce\Vendors\Vendors;
use App\Livewire\Admin\ECommerce\Vendors\Create;
use App\Livewire\Admin\ECommerce\Vendors\Edit;
Route::prefix('e--commerce/vendors')->group(function () {
    Route::get('/', Vendors::class)->name('admin.e--commerce.vendors.index');
    Route::get('create', Create::class)->name('admin.e--commerce.vendors.create');
    Route::get('/{' . 'vendor' . '}/edit', Edit::class)->name('admin.e--commerce.vendors.edit');
});