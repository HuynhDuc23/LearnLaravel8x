<?php

use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => '/route'
], function () {
    Route::get('/list-student', [
        App\Http\Controllers\Route\RouteController::class,
        'showStudent'
    ]);
    Route::get('/hello', function () {
        return 'Hello World';
    });
});
