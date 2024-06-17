<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('migrate', function () {
    Artisan::call('migrate');
    return 'migrated';
});
Route::get('rollback', function () {
    Artisan::call('migrate:rollback');
    return 'migrate rollback';
});


Route::get('storage-link', function () {
    Artisan::call('storage:link');
    return 'storage linked';
});

Route::get('generate-docs', function () {
    Artisan::call('l5-swagger:generate');
    return 'docs generated';
});

Route::get('clear-cache', function () {
    Artisan::call('cache:clear');
    return 'cache cleared';
});
