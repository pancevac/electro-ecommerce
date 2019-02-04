<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';

    protected $fillable = array('order_id', 'product_id', 'quantity', 'price', 'percent_off');

    public static function getTopSales($limit)
    {
        return \DB::table('order_product')
            ->select('products.*', 'percent_off AS percentOff', 'category.name AS categoryName', 'category.id as CategoryId', \DB::raw('COUNT(order_product.product_id) AS product_count'))
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->join('category', 'products.category_id', '=', 'category.id')
            ->groupBy('order_product.product_id')
            ->orderBy('product_count', 'DESC')
            ->limit($limit)
             // popravi ovo
            ->get();

        /*$orderitems = $order->groupBy('product_id')->sort()->map(function ($product) {
             return $product->count();
         })->reverse()->take(3);*/
    }
}
