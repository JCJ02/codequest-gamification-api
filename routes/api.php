<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllers\{
    AdminController,
    AdminAuditController,
    AdminBadgesController,
    AdminLessonController,
    AdminLevelController,
    AdminLanguageController,
    AdminNotificationController
};
use App\Http\Controllers\UserStudentControllers\{
    UserStudentController,
    UserStudentChatMessageController,
    UserStudentLeaderboardController,
    UserStudentMessageController,
    UserStudentUnlockedLevelController,
    UserStudentAuditController
};


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
    Route::get('/', [AdminLessonController::class, 'index']);
    Route::get('/show/{id}', [AdminLessonController::class, 'show']);
    Route::post('/store', [AdminLessonController::class, 'store']);
    Route::put('/update/{id}', [AdminLessonController::class, 'update']);
    Route::delete('/delete/{id}', [AdminLessonController::class, 'destroy']);
});

// Admin Level Route (Requires Authentication Token)
Route::prefix('admin-levels')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [AdminLevelController::class, 'index']);
    Route::post('/store', [AdminLevelController::class, 'store']);
    Route::get('/show/{id}', [AdminLevelController::class, 'show']);
    Route::put('/update/{id}', [AdminLevelController::class, 'update']);
    Route::delete('/delete/{id}', [AdminLevelController::class, 'destroy']);
});

// Admin Language Route (Requires Authentication Token)
Route::prefix('admin-languages')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [AdminLanguageController::class, 'index']);
    Route::post('/store', [AdminLanguageController::class, 'store']);
    Route::get('/show/{id}', [AdminLanguageController::class, 'show']);
    Route::put('/update/{id}', [AdminLanguageController::class, 'update']);
    Route::delete('/delete/{id}', [AdminLanguageController::class, 'destroy']);
});

// Admin Notification Route (Requires Authentication Token)
Route::prefix('admin-notifications')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [AdminNotificationController::class, 'index']);
    Route::post('/store', [AdminNotificationController::class, 'store']);
    Route::get('/show/{id}', [AdminNotificationController::class, 'show']);
    Route::put('/update/{id}', [AdminNotificationController::class, 'update']);
    Route::delete('/delete/{id}', [AdminNotificationController::class, 'destroy']);
});

// Admin Badges Route (Requires Authentication Token)
Route::prefix('admin-badges')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [AdminBadgesController::class, 'index']);
    Route::post('/store', [AdminBadgesController::class, 'store']);
    Route::get('/show/{id}', [AdminBadgesController::class, 'show']);
    Route::put('/update/{id}', [AdminBadgesController::class, 'update']);
    Route::delete('/delete/{id}', [AdminBadgesController::class, 'destroy']);
});

// Admin Audit Route (Requires Authentication Token)
Route::prefix('admin-audits')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [AdminAuditController::class, 'index']);
    Route::get('/{id}', [AdminAuditController::class, 'show']);
    Route::post('/store', [AdminAuditController::class, 'store']);
    Route::put('/update/{id}', [AdminAuditController::class, 'update']);
    Route::delete('/delete/{id}', [AdminAuditController::class, 'destroy']);
});

// User Student Chat Message Route (Requires Authentication Token)
Route::prefix('user-student-chat-messages')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [UserStudentChatMessageController::class, 'index']);
    Route::post('/store', [UserStudentChatMessageController::class, 'store']);
    Route::get('/show/{id}', [UserStudentChatMessageController::class, 'show']);
    Route::put('/update/{id}', [UserStudentChatMessageController::class, 'update']);
    Route::delete('/delete/{id}', [UserStudentChatMessageController::class, 'destroy']);
});

// User Student Leaderboard Route (Requires Authentication Token)
Route::prefix('user-student-leaderboards')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [UserStudentLeaderboardController::class, 'index']);
    Route::post('/store', [UserStudentLeaderboardController::class, 'store']);
    Route::get('/show/{id}', [UserStudentLeaderboardController::class, 'show']);
    Route::put('/update/{id}', [UserStudentLeaderboardController::class, 'update']);
    Route::delete('/delete/{id}', [UserStudentLeaderboardController::class, 'destroy']);
});

// User Student Message Route (Requires Authentication Token)
Route::prefix('user-student-messages')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [UserStudentMessageController::class, 'index']);
    Route::post('/store', [UserStudentMessageController::class, 'store']);
    Route::get('/store/{id}', [UserStudentMessageController::class, 'show']);
    Route::put('/update/{id}', [UserStudentMessageController::class, 'update']);
    Route::delete('/delete/{id}', [UserStudentMessageController::class, 'destroy']);
});

// User Student Unlocked Level Route (Requires Authentication Token)
Route::prefix('user-student-unlocked-levels')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [UserStudentUnlockedLevelController::class, 'index']);
    Route::post('/store', [UserStudentUnlockedLevelController::class, 'store']);
    Route::get('/show/{id}', [UserStudentUnlockedLevelController::class, 'show']);
    Route::put('/update/{id}', [UserStudentUnlockedLevelController::class, 'update']);
    Route::delete('/delete/{id}', [UserStudentUnlockedLevelController::class, 'destroy']);
});

// User Student Audit (Requires Authentication Token)
Route::prefix('user-student-audits')->group(function () {
    Route::get('/', [UserStudentAuditController::class, 'index']);
    Route::post('/store', [UserStudentAuditController::class, 'store']);
    Route::get('/show/{id}', [UserStudentAuditController::class, 'show']);
    Route::put('/update/{id}', [UserStudentAuditController::class, 'update']);
    Route::delete('/delete/{id}', [UserStudentAuditController::class, 'destroy']);
});
