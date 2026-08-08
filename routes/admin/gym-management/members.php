<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\GymManagement\Members\Members;
use App\Livewire\Admin\GymManagement\Members\Create;
use App\Livewire\Admin\GymManagement\Members\Edit;
Route::prefix('gym-management/members')->group(function () {
    Route::get('/', Members::class)->name('admin.gym-management.members.index');
    Route::get('create', Create::class)->name('admin.gym-management.members.create');
    Route::get('/{' . 'member' . '}/edit', Edit::class)->name('admin.gym-management.members.edit');
});