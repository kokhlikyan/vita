<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::prefix('v1')->group(function () {
    Route::middleware(['auth:sanctum'])
        ->prefix('tasks')
        ->controller(TaskController::class)
        ->group(function () {
            Route::get('/', 'all');
            Route::get('/list', 'list');
            Route::get('/filter', 'filteredTasks');
            Route::get('/history', 'getHistory');
            Route::get('/{id}', 'findById');
            Route::post('/', 'create');
            Route::delete('/{id}', 'delete');
            Route::put('/{id}', 'update');
            Route::patch('/{id}/completed', 'makeCompleted');
        });
});
