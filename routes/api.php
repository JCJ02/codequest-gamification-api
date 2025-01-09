<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::post('/admin', [AdminController::class, 'register']);
Route::get('/admin', [AdminController::class, 'index']);
