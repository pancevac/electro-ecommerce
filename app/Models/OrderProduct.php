<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class OrderProduct extends Model
{
    protected $table = 'order_product';

    protected $fillable = array('order_id', 'product_id', 'quantity', 'price', 'percent_off');

    public function get_top_sales($limit)
    {
        $top_sales = \DB::table(\DB::raw('(SELECT product_id, COUNT(*) as product_count FROM order_product GROUP BY product_id) AS subquery'))
            ->select('product_id')
            ->orderBy('product_count', 'DESC')
            ->limit($limit)
            ->get();

        $collection = new Collection();

        foreach ($top_sales as $top_sale) {
            $collection->push(Product::find($top_sale->product_id));
        }

        return $collection;

        /*$orderitems = $order->groupBy('product_id')->sort()->map(function ($product) {
             return $product->count();
         })->reverse()->take(3);*/
    }
}
