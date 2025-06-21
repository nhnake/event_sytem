<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\User\EventController as UserEventController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\JoinController;
use App\Http\Controllers\Admin\CategoryController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
    Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);


    Route::middleware('is_admin')->prefix('admin')->group(function () {
        Route::apiResource('events', AdminEventController::class);
        Route::get('users', [AdminUserController::class, 'index']);
        Route::apiResource('categories', CategoryController::class);
    });

    Route::middleware('is_user')->prefix('user')->group(function () {
        Route::apiResource('events', UserEventController::class);
        Route::put('account', [AccountController::class, 'update']);
        Route::delete('account', [AccountController::class, 'destroy']);
        Route::post('events/{event}/join', [JoinController::class, 'join']);
        Route::get('joined-events', [JoinController::class, 'history']);
        Route::get('events/{event}/participants', [JoinController::class, 'participants']);
        Route::post('events/{event}/feedback', [JoinController::class, 'giveFeedback']);

    });
});
