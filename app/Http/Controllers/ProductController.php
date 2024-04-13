<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function edit(Request $request, $id)
    {
        $data = $request->all();
        $item = Product::find($id);
        if (isset($data['delete'])) {
            $item->delete();
            return redirect()->back();
        }
        $item->price = floatval($data['price']);
        $item->name = $data['name'];
        $item->category_id = intval($data['category_id']);
        $item->subcategory_id = intval($data['subcategory_id']);
        $item->count = $data['count'];
        $item->in_stock = intval($data['in_stock']);

        $image = $request->file('image');
        if ($image) {
            Storage::delete(str_replace("/storage/", "/public/", $item->image));

            $image_name = time() . '_' . uuid_create() . "." . $image->getClientOriginalExtension();
            $image_path = "/storage/products/" . $image_name;
            $image->storePubliclyAs("/public/products/", $image_name);
            $item->image = $image_path;
        }

        $item->save();
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $data = $request->except("_token", 'image');
        $data['price'] = floatval($data['price']);
        $product = Product::create($data);
        $image = $request->file('image');
        if($image){
            $image_name = time() . '_' . uuid_create() . "." . $image->getClientOriginalExtension();
            $image_path = "/storage/products/" . $image_name;
            $image->storePubliclyAs("/public/products/", $image_name);
            $product->image = $image_path;
        }
        $product->save();

        return redirect()->back();
    }
}
