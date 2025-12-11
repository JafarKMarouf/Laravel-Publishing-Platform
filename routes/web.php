<?php

use App\Http\Controllers\ClapController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

// public routes
Route::controller(PostController::class)->group(function () {
    Route::get('/', 'index')
        ->name('dashboard');
    Route::get('/@{username}/{post:slug}', 'show')
        ->name('post.show');

    Route::get('category/{category:slug}', 'filterByCategory')
        ->name('post.category');
});

Route::get('/@{user:username}', [PublicProfileController::class, 'show'])
    ->name('profile.show');

// protected routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(PostController::class)->group(function () {
        Route::get('/post/create', 'create')->name('post.create');
        Route::post('/post/create', 'store')->name('post.store');
    });
    Route::post('/follow/{user}', [FollowController::class, 'followUnFollow'])
        ->name('follow');
    Route::post('/clap/{post}', [ClapController::class, 'clap'])
        ->name('clap');
});

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

