<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\CRM\Contacts\Contacts;
use App\Livewire\Admin\CRM\Contacts\Create;
use App\Livewire\Admin\CRM\Contacts\Edit;
Route::prefix('c-r-m/contacts')->group(function () {
    Route::get('/', Contacts::class)->name('admin.c-r-m.contacts.index');
    Route::get('create', Create::class)->name('admin.c-r-m.contacts.create');
    Route::get('/{' . 'contact' . '}/edit', Edit::class)->name('admin.c-r-m.contacts.edit');
});