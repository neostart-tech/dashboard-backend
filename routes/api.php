<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LienController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{id}', [ServiceController::class, 'show']);

Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{id}', [BlogController::class, 'show']);

Route::get('/liens', [LienController::class, 'index']);
Route::get('/contacts', [ContactController::class, 'index']);

// Send message
Route::post('/messages', [MessageController::class, 'store']); // Create message

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Profile
    Route::put('/profile/info', [AuthController::class, 'updateProfile']);
    Route::put('/profile/password', [AuthController::class, 'updatePassword']);

    // Admin
    Route::get('/admins', [AdminController::class, 'index']);
    Route::post('/admins', [AdminController::class, 'store']);
    Route::get('/admins/{id}', [AdminController::class, 'show']);
    Route::put('/admins/{id}', [AdminController::class, 'update']);
    Route::delete('/admins/{id}', [AdminController::class, 'destroy']);

    // CRUD Services
    Route::post('/services', [ServiceController::class, 'store']);
    Route::post('/services/{id}', [ServiceController::class, 'update']); // using POST to handle multipart data easily
    Route::delete('/services/{id}', [ServiceController::class, 'destroy']);

    // CRUD Blogs
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::put('/blogs/{id}', [BlogController::class, 'update']);
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);

    // CRUD Images
    Route::get('/images', [ImageController::class, 'index']);
    Route::post('/images', [ImageController::class, 'store']);
    Route::delete('/images/{id}', [ImageController::class, 'destroy']);

    // Modifiable Liens & Contacts
    Route::put('/liens', [LienController::class, 'update']);
    Route::put('/contacts', [ContactController::class, 'update']);

    // Messages
    Route::get('/messages', [MessageController::class, 'index']);
    Route::get('/messages/{id}', [MessageController::class, 'show']);
    Route::delete('/messages/{id}', [MessageController::class, 'destroy']);
    Route::post('/messages/reply', [MessageController::class, 'reply']);
});
