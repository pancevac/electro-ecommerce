<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = array(
        'user_id', 'billing_email', 'billing_first_name', 'billing_last_name', 'billing_address', 'billing_city',
        'billing_country', 'billing_postalcode', 'billing_phone', 'billing_name_on_card', 'billing_discount',
        'billing_discount_code', 'billing_subtotal', 'billing_tax', 'billing_total', 'error',
    );

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('quantity', 'price', 'percent_off');
    }
}
