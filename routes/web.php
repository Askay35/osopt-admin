<?php

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {

    Route::get('/', [TableController::class,"categories"]);

    Route::prefix("categories")->group(function () {
        Route::post('/', [TableController::class, "create_category"]);
        Route::post('/edit/{id}', [AdminPageController::class, "edit"])->where('id', '[0-9]+');
    });
    Route::prefix("subcategories")->group(function () {

        Route::get('/', [TableController::class, "subcategories"]);
        Route::post('/', [TableController::class, "create_subcategory"]);
        Route::post('/edit/{id}', [AdminPageController::class, "edit"])->where('id', '[0-9]+');
    });
    Route::prefix("orders")->group(function () {

        Route::get('/', [TableController::class, "orders"]);
    });

    Route::prefix("products")->group(function () {
        Route::get('/', [TableController::class, "products"]);
        Route::post('/', [ProductController::class, "store"]);
        Route::post('/edit/{id}', [ProductController::class, "edit"])->where('id', '[0-9]+');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
