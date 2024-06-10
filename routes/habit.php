<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;

Route::prefix('v1')->group(function () {
    Route::middleware(['auth:sanctum'])
        ->prefix('habits')
        ->controller(HabitController::class)
        ->group(function () {
            Route::get('/', 'all');
            Route::get('/{id}', 'findById');
            Route::post('/', 'create');
            Route::delete('/{id}', 'delete');
            Route::put('/{id}', 'update');
        });
});
