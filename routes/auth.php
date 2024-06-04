<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\GithubController;

Route::prefix('v1/auth')->group(function () {
    Route::prefix('google')->controller(GoogleController::class)->group(function () {
        Route::get('/', 'redirectToGoogle');
        Route::get('/callback', 'handleGoogleCallback');
    });

    Route::prefix('github')->controller(GithubController::class)->group(function () {
        Route::get('/', 'redirectToGithub');
        Route::get('/callback', 'handleGithubCallback');
    });
});
