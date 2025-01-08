<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllers\AdminController;
use App\Http\Controllers\AdminControllers\AdminAuditController;
use App\Http\Controllers\AdminControllers\AdminBadgesController;
use App\Http\Controllers\AdminControllers\AdminLessonController;
use App\Http\Controllers\AdminControllers\AdminLevelController;
use App\Http\Controllers\AdminControllers\AdminLanguageController;
use App\Http\Controllers\AdminControllers\AdminNotificationController;
use App\Http\Controllers\UserStudentControllers\UserStudentController;
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
    Route::get('/admin', [AdminLessonController::class, 'index']);
    Route::get('/show/{id}', [AdminLessonController::class, 'show']);
    Route::post('/store', [AdminLessonController::class, 'store']);
    Route::put('/update/{id}', [AdminLessonController::class, 'update']);
    Route::delete('/delete/{id}', [AdminLessonController::class, 'destroy']);
});

// Admin Level Route (Requires Authentication Token)
Route::prefix('admin-levels')->middleware('auth:sanctum')->group(function () {
    Route::get('/admin', [AdminLevelController::class, 'index']);
    Route::post('/store', [AdminLevelController::class, 'store']);
    Route::get('/show/{id}', [AdminLevelController::class, 'show']);
    Route::put('/update/{id}', [AdminLevelController::class, 'update']);
    Route::delete('/delete/{id}', [AdminLevelController::class, 'destroy']);
});

// Admin Language Route (Requires Authentication Token)
Route::prefix('admin-languages')->middleware('auth:sanctum')->group(function () {
    Route::get('/admin', [AdminLanguageController::class, 'index']);
    Route::post('/store', [AdminLanguageController::class, 'store']);
    Route::get('/show/{id}', [AdminLanguageController::class, 'show']);
    Route::put('/update/{id}', [AdminLanguageController::class, 'update']);
    Route::delete('/delete/{id}', [AdminLanguageController::class, 'destroy']);
});

// Admin Notification Route (Requires Authentication Token)
Route::prefix('admin-notifications')->middleware('auth:sanctum')->group(function () {
    Route::get('/admin', [AdminNotificationController::class, 'index']);
    Route::post('/store', [AdminNotificationController::class, 'store']);
    Route::get('/show/{id}', [AdminNotificationController::class, 'show']);
    Route::put('/update/{id}', [AdminNotificationController::class, 'update']);
    Route::delete('/delete/{id}', [AdminNotificationController::class, 'destroy']);
});

// Admin Badges Route (Requires Authentication Token)
Route::prefix('admin-badges')->middleware('auth:sanctum')->group(function () {
    Route::get('/admin', [AdminBadgesController::class, 'index']);
    Route::post('/store', [AdminBadgesController::class, 'store']);
    Route::get('/show/{id}', [AdminBadgesController::class, 'show']);
    Route::put('/update/{id}', [AdminBadgesController::class, 'update']);
    Route::delete('/delete/{id}', [AdminBadgesController::class, 'destroy']);
});

// Admin Audit Route (Requires Authentication Token)
Route::prefix('admin-audit')->middleware('auth:sanctum')->group(function () {
    Route::get('/admin', [AdminAuditController::class, 'index']);
    Route::get('/{id}', [AdminAuditController::class, 'show']);
    Route::post('/store', [AdminAuditController::class, 'store']);
    Route::put('/update/{id}', [AdminAuditController::class, 'update']);
    Route::delete('/delete/{id}', [AdminAuditController::class, 'destroy']);
});
