<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\ExpenseTrackings\ExpenseTrackings;
use App\Livewire\Admin\AutoRepairManagement\ExpenseTrackings\Create;
use App\Livewire\Admin\AutoRepairManagement\ExpenseTrackings\Edit;
Route::prefix('auto-repair-management/expense-trackings')->group(function () {
    Route::get('/', ExpenseTrackings::class)->name('admin.auto-repair-management.expense-trackings.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.expense-trackings.create');
    Route::get('/{' . 'expenseTracking' . '}/edit', Edit::class)->name('admin.auto-repair-management.expense-trackings.edit');
});