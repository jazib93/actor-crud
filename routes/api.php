<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;

Route::get('/actors/prompt-validation', [ActorController::class, 'promptValidation']);
