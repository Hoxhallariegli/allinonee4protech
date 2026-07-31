<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\SchoolManagement\Payments\Payments;
use App\Livewire\Admin\SchoolManagement\Payments\Create;
use App\Livewire\Admin\SchoolManagement\Payments\Edit;
Route::prefix('school-management/payments')->group(function () {
    Route::get('/', Payments::class)->name('admin.school-management.payments.index');
    Route::get('create', Create::class)->name('admin.school-management.payments.create');
    Route::get('/{' . 'payment' . '}/edit', Edit::class)->name('admin.school-management.payments.edit');
});