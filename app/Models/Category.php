<?php

namespace App\Models;


class Category extends BaseModel
{

    public $timestamps = false;
    protected $fillable = [
        "id",
        "name",
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

}
