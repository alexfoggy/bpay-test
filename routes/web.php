<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/{index?}/{date?}', [HomeController::class, 'index'])->name('main');
