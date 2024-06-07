<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;

Route::prefix('v1')->group(function () {
    Route::middleware(['auth:sanctum'])
        ->prefix('goals')
        ->controller(GoalController::class)
        ->group(function () {
            Route::get('/', 'all');
            Route::get('/{id}', 'findById');
            Route::post('/', 'create');
            Route::delete('/{id}', 'delete');
            Route::put('/{id}', 'update');
        });
});
