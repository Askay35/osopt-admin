<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPageController extends Controller
{

    public function edit(Request $request, $id)
    {
        $data = $request->all();
        $item = DB::table($data['table'])->where('id',$id);
        if (isset($data['delete'])) {
            $item->delete();
            return redirect()->back();
        }
        $table_columns = array_flip(DB::getSchemaBuilder()->getColumnListing($data['table']));
        $item->update(array_intersect_key($data, $table_columns));
        return redirect()->back();
    }
}
