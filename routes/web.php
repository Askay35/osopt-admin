<?php

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('categories', ["rows" => Category::all()->toArray(), "table" => Category::tableName(), "columns" => Category::tableColumns()]);
});

Route::prefix("categories")->group(function () {
    Route::post('/', function (Request $request) {
        Category::create(["name" => $request->post('name')]);
        return redirect()->back();
    });
    Route::post('/edit/{id}', [AdminPageController::class, "edit"])->where('id', '[0-9]+');

});
Route::prefix("subcategories")->group(function () {

    Route::get('/', function () {
        return view('subcategories', ["categories"=>Category::all(),"rows" => Subcategory::all()->toArray(), "table" => Subcategory::tableName(), "columns" => Subcategory::tableColumns()]);
    });
    Route::post('/', function () {
        $data = request()->post();
        Subcategory::create([
            "category_id" => $data['category_id'],
            "name" => $data['name'],
        ]);
        return redirect()->back();
    });
    Route::post('/edit/{id}', [AdminPageController::class, "edit"])->where('id', '[0-9]+');
});
Route::prefix("orders")->group(function () {

    Route::get('/', function () {
        return view('orders', ["rows" => Order::all()->toArray(), "table" => Order::tableName(), "columns" => Order::tableColumns()]);
    });
});

Route::prefix("products")->group(function () {
    Route::get('/', function () {
        return view('products', ["categories"=>Category::all(),"subcategories"=>Subcategory::all(),"rows" => Product::all()->toArray(), "table" => Product::tableName(), "columns" => Product::tableColumns()]);
    });
    Route::post('/', [ProductController::class, "store"]);
    Route::post('/edit/{id}', [AdminPageController::class, "edit"])->where('id', '[0-9]+');
});
