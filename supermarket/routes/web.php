<?php

use App\Http\Controllers\CalculatorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Route\RouteController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/calculator', function () {
    return view('calculator');
});
// Route::any(
//     '/calculator_2',
//     [
//         'as' => 'calculator_name',
//         'uses' => 'CalculatorController@showCalculator',
//     ]
// );
// neu dung voi 2 muc dich thi dung any , chu y  khi dung post can co them 1 token de laravel check ???

// Route::any(
//     '/calculator2',
//     [CalculatorController::class, 'showCalculator',]
// );
