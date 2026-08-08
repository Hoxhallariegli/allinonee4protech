<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\CRM\ContactAddresses\ContactAddresses;
use App\Livewire\Admin\CRM\ContactAddresses\Create;
use App\Livewire\Admin\CRM\ContactAddresses\Edit;
Route::prefix('c-r-m/contact-addresses')->group(function () {
    Route::get('/', ContactAddresses::class)->name('admin.c-r-m.contact-addresses.index');
    Route::get('create', Create::class)->name('admin.c-r-m.contact-addresses.create');
    Route::get('/{' . 'contactAddress' . '}/edit', Edit::class)->name('admin.c-r-m.contact-addresses.edit');
});