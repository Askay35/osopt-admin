<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Order extends BaseModel
{

    public $timestamps = false;
    protected $fillable = [
        "phone",
        "payment_type",
        "status_id"
    ];

    public function status(){
        return DB::table("order_statuses")->find($this->status_id)->first()->name;
    }
    public function products(){
        return DB::table("order_products")->where("order_id", $this->id)->get();
    }

}
