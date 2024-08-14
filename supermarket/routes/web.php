<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/calculator', function () {
    return view('calculator');
});


// client route
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoriesController::class, 'index'])->name('categories.list');
    Route::get('/edit{id}', [CategoriesController::class, 'getCategory'])->name('categories.edit');
    Route::post('/edit{id}', [CategoriesController::class, 'updateCategory']);
    Route::get('/create', [CategoriesController::class, 'createCategory'])->name('categories.create');
    Route::post('/handler', [CategoriesController::class, 'handleCategory'])->name('categories.add');
    Route::delete('/delete/{id}', [CategoriesController::class, 'deleteCategory'])->name('categories.delete');
});
