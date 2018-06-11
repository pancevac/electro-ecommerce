<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}
