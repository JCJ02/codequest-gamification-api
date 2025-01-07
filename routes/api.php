<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserStudentController;
use App\Http\Controllers\LessonAdminController;
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
Route::prefix('lessons')->middleware('auth:sanctum')->group(function () {
    Route::get('/admin/lesson', [LessonAdminController::class, 'index']);
    Route::get('/admin/lesson/{id}', [LessonAdminController::class, 'show']);
    Route::post('/admin/lesson-store', [LessonAdminController::class, 'store']);
    Route::put('/admin/lesson-update/{id}', [LessonAdminController::class, 'update']);
    Route::delete('/admin/lesson-delete/{id}', [LessonAdminController::class, 'destroy']);
});