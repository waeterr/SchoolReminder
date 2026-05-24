<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ClassroomController;
use App\Http\Controllers\API\AssignmentController;
use App\Http\Controllers\API\SubmissionController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\MaterialController;
use App\Http\Controllers\API\ReminderController;
use App\Http\Controllers\API\DashboardController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/profile', [ProfileController::class, 'profile']);
    Route::post('/profile/update', [ProfileController::class, 'update']);

    Route::post('/create-class', [ClassroomController::class, 'store']);
    Route::post('/join', [ClassroomController::class, 'join']);
    Route::get('/classes', [ClassroomController::class, 'index']);
    Route::get('/class-members/{id}', [ClassroomController::class, 'members']);

    Route::post('/create-assignment', [AssignmentController::class, 'store']);

    // Submissions
    Route::post('/submit-assignment', [SubmissionController::class, 'store']);
    Route::get('/assignment/{id}/submissions', [SubmissionController::class, 'getByAssignment']);
    Route::post('/submission/grade', [SubmissionController::class, 'grade']);

    Route::post('/create-material', [MaterialController::class, 'store']);
    Route::get('/materials/{classroom}', [MaterialController::class, 'index']);

    Route::get('/reminders', [ReminderController::class, 'index']);
    Route::post('/grade-submission', [SubmissionController::class, 'grade'])
    ->middleware('auth:sanctum');
});