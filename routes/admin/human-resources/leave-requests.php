<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\HumanResources\LeaveRequests\LeaveRequests;
use App\Livewire\Admin\HumanResources\LeaveRequests\Create;
use App\Livewire\Admin\HumanResources\LeaveRequests\Edit;
Route::prefix('human-resources/leave-requests')->group(function () {
    Route::get('/', LeaveRequests::class)->name('admin.human-resources.leave-requests.index');
    Route::get('create', Create::class)->name('admin.human-resources.leave-requests.create');
    Route::get('/{' . 'leaveRequest' . '}/edit', Edit::class)->name('admin.human-resources.leave-requests.edit');
});