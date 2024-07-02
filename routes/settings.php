<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;

Route::prefix('v1')->group(function () {
    Route::middleware(['auth:sanctum'])
        ->prefix('settings')
        ->controller(SettingsController::class)
        ->group(function () {
            Route::post('/', 'createOrUpdate');
        });
});
