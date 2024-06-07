<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlockController;
use App\Http\Middleware\ProviderMiddleware;

Route::prefix('v1')->group(function () {
    Route::middleware(['auth:sanctum'])
        ->prefix('blocks')
        ->controller(BlockController::class)
        ->group(function () {
            Route::get('/', 'all');
            Route::get('/{id}', 'findById');
            Route::post('/', 'create');
            Route::delete('/{id}', 'delete');
            Route::put('/{id}', 'update');
        });
});
