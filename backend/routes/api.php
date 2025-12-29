<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MessageController;

/* ---------- Public Routes ---------- */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/* ---------- Protected Routes ---------- */
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/profile', [UserController::class, 'profile']);

    // Items
    Route::apiResource('items', ItemController::class);

    // Listings
    Route::apiResource('listings', ListingController::class);

    // Loans
    Route::get('/my-loans', [LoanController::class, 'myLoans']);
    Route::post('/loans/{loan}/approve', [LoanController::class, 'approve']);
    Route::post('/loans/{loan}/reject', [LoanController::class, 'reject']);
    Route::apiResource('loans', LoanController::class);

    // Conversations & Messages
    Route::get('/conversations', [MessageController::class,'conversations']);
    Route::get('/messages/{conversation}', [MessageController::class,'messages']);
    Route::post('/messages', [MessageController::class,'send']);
});
