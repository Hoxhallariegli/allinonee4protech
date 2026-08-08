<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\GymManagement\MembershipPlans\MembershipPlans;
use App\Livewire\Admin\GymManagement\MembershipPlans\Create;
use App\Livewire\Admin\GymManagement\MembershipPlans\Edit;
Route::prefix('gym-management/membership-plans')->group(function () {
    Route::get('/', MembershipPlans::class)->name('admin.gym-management.membership-plans.index');
    Route::get('create', Create::class)->name('admin.gym-management.membership-plans.create');
    Route::get('/{' . 'membershipPlan' . '}/edit', Edit::class)->name('admin.gym-management.membership-plans.edit');
});