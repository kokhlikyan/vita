<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenAIController;

Route::prefix('v1')->group(function () {
    Route::middleware(['auth:sanctum'])
        ->prefix('ai')
        ->controller(OpenAIController::class)
        ->group(function () {
            Route::post('/start',  'startDialog');
            Route::post('/continue', 'continueDialog');
            Route::post('/finalize', 'finalizeDialog');
        });
});
