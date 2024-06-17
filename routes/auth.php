<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Middleware\ProviderMiddleware;
Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::middleware(['auth:sanctum'])->controller(AuthController::class)->group(function () {
            Route::post('/email/send', 'sendCode')
                ->withoutMiddleware('auth:sanctum')
                ->middleware('throttle:5,1');
            Route::post('/email/verify', 'verifyCode')
            ->withoutMiddleware('auth:sanctum');
            Route::put('/update', 'updateInfo');
        });
        Route::middleware(ProviderMiddleware::class)->controller(SocialiteController::class)->group(function () {
            Route::get('/{provider}', 'redirectToProvider');
            Route::get('/{provider}/callback', 'handleProviderCallback');
            Route::post('/{provider}/token', 'handleTokenAuth');
        });

    });



});
