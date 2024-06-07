<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Middleware\ProviderMiddleware;
Route::prefix('v1')->group(function () {
    Route::middleware(ProviderMiddleware::class)->controller(SocialiteController::class)->group(function () {
        Route::get('/auth/{provider}', 'redirectToProvider');
        Route::get('/auth/{provider}/callback', 'handleProviderCallback');
        Route::post('/auth/{provider}/token', 'handleTokenAuth');
    });
});
