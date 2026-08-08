<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\GymManagement\ClassSchedules\ClassSchedules;
use App\Livewire\Admin\GymManagement\ClassSchedules\Create;
use App\Livewire\Admin\GymManagement\ClassSchedules\Edit;
Route::prefix('gym-management/class-schedules')->group(function () {
    Route::get('/', ClassSchedules::class)->name('admin.gym-management.class-schedules.index');
    Route::get('create', Create::class)->name('admin.gym-management.class-schedules.create');
    Route::get('/{' . 'classSchedule' . '}/edit', Edit::class)->name('admin.gym-management.class-schedules.edit');
});