<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;

Route::get('/', [ActorController::class, 'index'])->name('actors.index');
Route::post('/actors', [ActorController::class, 'store'])->name('actors.store');
Route::get('/actors', [ActorController::class, 'show'])->name('actors.show');
