<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\GymManagement\Subscriptions\Subscriptions;
use App\Livewire\Admin\GymManagement\Subscriptions\Create;
use App\Livewire\Admin\GymManagement\Subscriptions\Edit;
Route::prefix('gym-management/subscriptions')->group(function () {
    Route::get('/', Subscriptions::class)->name('admin.gym-management.subscriptions.index');
    Route::get('create', Create::class)->name('admin.gym-management.subscriptions.create');
    Route::get('/{' . 'subscription' . '}/edit', Edit::class)->name('admin.gym-management.subscriptions.edit');
});