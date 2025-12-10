<?php

use App\Http\Controllers\ClapController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;

// public routes
Route::controller(PostController::class)->group(function () {
    Route::get('/', 'index')
        ->name('dashboard');
    Route::get('/@{username}/{post:slug}', 'show')
        ->name('post.show');
});

Route::get('/@{user:username}', [PublicProfileController::class, 'show'])
    ->name('profile.show');

// protected routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(PostController::class)->group(function () {
        Route::get('/post/create', 'create')->name('post.create');
        Route::post('/post/create', 'store')->name('post.store');
    });
    Route::post('/follow/{user}', [FollowController::class, 'followUnFollow'])->name('follow');
    Route::post('/clap/{post}', [ClapController::class, 'clap'])
        ->name('clap');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
