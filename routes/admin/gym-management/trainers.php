<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\GymManagement\Trainers\Trainers;
use App\Livewire\Admin\GymManagement\Trainers\Create;
use App\Livewire\Admin\GymManagement\Trainers\Edit;
Route::prefix('gym-management/trainers')->group(function () {
    Route::get('/', Trainers::class)->name('admin.gym-management.trainers.index');
    Route::get('create', Create::class)->name('admin.gym-management.trainers.create');
    Route::get('/{' . 'trainer' . '}/edit', Edit::class)->name('admin.gym-management.trainers.edit');
});