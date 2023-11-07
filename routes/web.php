<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\PostCondition;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth'])->group(function () {
    Route::get('/', [PostController::class, 'index'])->middleware(['auth']);
    // Posts
    Route::get('/posts/create', [PostController::class, 'create']);
    Route::post('/post', [PostController::class, 'store']);
    Route::get('/posts/{postId}/detail', [PostController::class, 'show']);
    Route::get('/posts/{postId}/edit', [PostController::class, 'edit']);
    Route::put('/posts/{postId}/update', [PostController::class, 'update']);
    Route::delete('/posts/{postId}/delete', [PostController::class, 'destroy']);
    Route::get('/posts/manage', [PostController::class, 'manage']);

    // Admin Permission For Users
    Route::middleware(['admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/create', [UserController::class, 'create']);
        Route::post('/user', [UserController::class, 'store']);
    });

    // Users
    Route::get('/users/{userId}/detail', [UserController::class, 'show']);
    Route::get('/users/{userId}/profile', [UserController::class, 'profile']);
    Route::get('/users/{userId}/edit', [UserController::class, 'edit']);
    Route::put('/users/{userId}/update', [UserController::class, 'update']);
    Route::delete('/users/{userId}/delete', [UserController::class, 'destroy']);

    // User Logout
    Route::post('logout', [UserController::class, 'logout']);

    // Change Password
    Route::post('update-password', [UserController::class, 'updatePassword']);

    // File Uploading
    Route::post('/tmp-upload', [UserController::class, 'tmpUpload']);
    Route::delete('/tmp-delete', [UserController::class, 'tmpDelete']);
    Route::post('/users/{userId}/clear-profile-image', [UserController::class, 'clearProfileImage']);

    // Excel Export Import
    Route::get('posts-export', [PostController::class, 'fileExport'])->name('posts.export.get');
    Route::get('posts-import', [PostController::class, 'showFileImport'])->name('posts.import.get');
    Route::post('posts-import', [PostController::class, 'fileImport'])->name('posts.import.post');
});


Route::middleware(['guest'])->group(function () {
    // User Registration
    Route::get('/register', [UserController::class, 'showRegistrationForm']);
    Route::post('/post-register', [UserController::class, 'submitRegistrationForm']);

    // User Login
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/post-login', [UserController::class, 'authenticate']);

    // Forgot Password
    Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot.password.get');
    Route::post('forgot-password', [ForgotPasswordController::class, 'submitForgotPasswordForm'])->name('forgot.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});
