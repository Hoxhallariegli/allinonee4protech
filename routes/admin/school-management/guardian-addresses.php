<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\SchoolManagement\GuardianAddresses\GuardianAddresses;
use App\Livewire\Admin\SchoolManagement\GuardianAddresses\Create;
use App\Livewire\Admin\SchoolManagement\GuardianAddresses\Edit;
Route::prefix('school-management/guardian-addresses')->group(function () {
    Route::get('/', GuardianAddresses::class)->name('admin.school-management.guardian-addresses.index');
    Route::get('create', Create::class)->name('admin.school-management.guardian-addresses.create');
    Route::get('/{' . 'guardianAddress' . '}/edit', Edit::class)->name('admin.school-management.guardian-addresses.edit');
});