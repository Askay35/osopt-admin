<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class TableController extends Controller
{
    public function __construct(){
        Paginator::useBootstrapFive();
    }
    public function create_category(Request $request){
        Category::create(["name" => $request->post('name')]);
        return redirect()->back();
    }
    public function create_brand(Request $request){
        Brand::create(["name" => $request->post('name')]);
        return redirect()->back();
    }
    public function subcategories(){
        return view('subcategories', ["categories" => Category::all(), "rows" => Subcategory::paginate(config('database.per_page')), "table" => Subcategory::tableName(), "columns" => Subcategory::tableColumns()]);
    }
    public function brands(){
        return view('brands', ["rows" => Brand::paginate(config('database.per_page')), "table" => Brand::tableName()]);
    }
    public function create_subcategory(){
        $data = request()->post();
            Subcategory::create([
                "category_id" => $data['category_id'],
                "name" => $data['name'],
            ]);
            return redirect()->back();
    }
    public function categories(){
        return view('categories', ["rows" => Category::paginate(config('database.per_page')), "table" => Category::tableName()]);
    }
    public function orders(){
        return view('orders', ["rows" => Order::paginate(config('database.per_page')), "table" => Order::tableName(), "columns" => Order::tableColumns()]);
    }
    public function products(){
        return view('products', ["categories" => Category::all(), "subcategories" => Subcategory::all(), "brands" => Brand::all(), "rows" => Product::paginate(config('database.per_page')), "table" => Product::tableName(), "columns" => Product::tableColumns()]);
    }
}
