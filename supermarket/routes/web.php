<?php

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\client\ProductController as ClientProductController;
use App\Http\Controllers\client\UserController;
use Illuminate\Support\Facades\Cookie;
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

//users
Route::prefix('/user')->group(function () {
    Route::get('/index', [UserController::class, 'index']);
    Route::get('/url', [UserController::class, 'getUrl'])->name('user.url');
    Route::get('/show', [UserController::class, 'showForm'])->name('user.get');
    Route::post('/store', [UserController::class, 'handlePost'])->name('user.store');
    Route::post('/file', [UserController::class, 'handleFile'])->name('user.file');
});

// response route
Route::get('/response', function () {
    return 'Response From Serve To Users';
});

// Laravel framework automatically array convert to json
Route::get('/json', function () {
    $data = [
        1,
        2,
        3,
        4,
        5,
        6,
        7,
        8,
        9,
        10,
    ];
    return $data;
});

// response object();
Route::get('/response_result', function () {
    //return response('Data render', 201)->header('API-Version', 'API');
    // you can define header or use header default

    return response('Data render', 200)
        ->header('Content-Type', 'Header')
        ->header('X-Header-One', 'Header Value')
        ->header('X-Header-Two', 'Header Value');
});
// convert object to json auto

// use with header
//Route:
Route::get("/response_data", function () {
    return response("Data render", 200)->withHeaders([
        'token' => 'data',
        'idphp' => 'idphp'
    ]);
    // response headers
});

Route::middleware('cache.headers:public;max_age=2628000;etag')->group(function () {
    Route::get('/privacy', function () {
        return 'privacy';
    });

    Route::get('/terms', function () {
        return 'terms';
    });
});

// cookies in header
Route::get('/cookies', function () {
    return response('Data render', 400)->cookie('token', '1234567890')->withHeaders([
        'data' => 'data01',
    ]);
});

Route::get('/cookies_des', function () {
    Cookie::expire('token');
    //return response('data render', 200)->withoutCookie('token');
});

Route::get('/them-san-pham', [ClientProductController::class, 'product']);
Route::post('/them-san-pham', [ClientProductController::class, 'add']);
