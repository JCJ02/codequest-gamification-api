<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::post('/register', [AdminController::class, 'register']);
Route::get('/admin', [AdminController::class, 'index']);
