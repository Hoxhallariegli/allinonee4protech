<?php

use Illuminate\Support\Facades\Route;

Route::get('/berber-app', \App\Livewire\Front\BerberApp\Landing::class)->name('front.berber-app');