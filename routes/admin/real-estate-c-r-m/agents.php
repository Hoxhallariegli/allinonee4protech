<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RealEstateCRM\Agents\Agents;
use App\Livewire\Admin\RealEstateCRM\Agents\Create;
use App\Livewire\Admin\RealEstateCRM\Agents\Edit;
Route::prefix('real-estate-c-r-m/agents')->group(function () {
    Route::get('/', Agents::class)->name('admin.real-estate-c-r-m.agents.index');
    Route::get('create', Create::class)->name('admin.real-estate-c-r-m.agents.create');
    Route::get('/{' . 'agent' . '}/edit', Edit::class)->name('admin.real-estate-c-r-m.agents.edit');
});