<?php

use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/calculator', function () {
//     return view('calculator');
// });


// Route::get('/', function () {
//     return 'UNICODE';
// })->name('home');

// client route
Route::middleware('auth.admin')->prefix('categories')->group(function () {
    // danh sach chuyen muc
    Route::get('/', [CategoriesController::class, 'index'])->name('categories.list');
    // lay chi tiet 1 chuyen muc (ap dung show form sua chuyen muc)
    Route::get('/edit{id}', [CategoriesController::class, 'getCategory'])->name('categories.edit');
    // xu ly update chuyen muc
    Route::post('/edit{id}', [CategoriesController::class, 'updateCategory']);
    // hien thi form add du lieu
    Route::get('/create', [CategoriesController::class, 'createCategory'])->name('categories.create');
    // xu ly them chuyen muc
    Route::post('/handler', [CategoriesController::class, 'handleCategory'])->name('categories.add');
    // xoa 1 chuyen muc (ap dung show form xoa chuyen muc)
    Route::delete('/delete/{id}', [CategoriesController::class, 'deleteCategory'])->name('categories.delete');
});
// admin route
// Route::prefix('admin')->group(function () {
//     Route::middleware('auth.admin.product')->resource('products', [ProductController::class, 'index']);
//     // Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// });

Route::get('/product', [ProductController::class, 'index']);
