<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $table = 'category';


    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function manufacturers()
    {
        return $this->hasMany('App\Models\Manufacturer', 'category_id', 'id');
    }
}
