<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserStudentController;
use App\Http\Controllers\LessonAdminController;
use App\Http\Controllers\LevelAdminController;
use App\Http\Controllers\LanguageAdminController;
use Illuminate\Support\Facades\Auth;


// Admin Route (No Authentication Token Required)
Route::post('/admin/register', [AdminController::class, 'register']);
Route::post('/admin/login', [AdminController::class, 'login']);

// User Student Route (No Authentication Token Required)
Route::post('/user-student/register', [UserStudentController::class, 'register']);
Route::post('/user-student/login', [UserStudentController::class, 'login']);

// Admin Route (Requires Authentication Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/admin/logout', [AdminController::class,'logout']);
    Route::get('/user-student', [UserStudentController::class, 'index']);
    Route::post('/user-student/logout', [UserStudentController::class,'logout']);
});

// Admin Lesson Route (Requires Authentication Token)
Route::prefix('admin-lessons')->middleware('auth:sanctum')->group(function () {
    Route::get('/admin', [LessonAdminController::class, 'index']);
    Route::get('/show/{id}', [LessonAdminController::class, 'show']);
    Route::post('/store', [LessonAdminController::class, 'store']);
    Route::put('/update/{id}', [LessonAdminController::class, 'update']);
    Route::delete('/delete/{id}', [LessonAdminController::class, 'destroy']);
});

// Admin Level Route (Requires Authentication Token)
Route::prefix('admin-levels')->middleware('auth:sanctum')->group(function () {
    Route::get('/admin', [LevelAdminController::class, 'index']);
    Route::post('/store', [LevelAdminController::class, 'store']);
    Route::get('/show/{id}', [LevelAdminController::class, 'show']);
    Route::put('/update/{id}', [LevelAdminController::class, 'update']);
    Route::delete('/delete/{id}', [LevelAdminController::class, 'destroy']);
});

// Admin Language Route (Requires Authentication Token)
Route::prefix('admin-languages')->middleware('auth:sanctum')->group(function () {
    Route::get('/admin', [LanguageAdminController::class, 'index']);
    Route::post('/store', [LanguageAdminController::class, 'store']);
    Route::get('/show/{id}', [LanguageAdminController::class, 'show']);
    Route::put('/update/{id}', [LanguageAdminController::class, 'update']);
    Route::delete('/delete/{id}', [LanguageAdminController::class, 'destroy']);
});
