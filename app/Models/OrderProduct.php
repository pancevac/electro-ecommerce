<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';

    protected $fillable = array('order_id', 'product_id', 'quantity', 'price', 'percent_off');

    /**
     * Get products that are top saled
     *
     * @param $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getTopSales($limit)
    {
        $productsIds = \DB::table('order_product')
            ->select('order_product.product_id', \DB::raw('COUNT(order_product.product_id) AS product_count'))
            ->groupBy('order_product.product_id')
            ->orderBy('product_count', 'DESC')
            ->limit($limit)
            // popravi ovo
            ->get()
            ->pluck('product_id')
            ->toArray();

        $products = Product::with(['translations', 'category', 'discount'])
            ->findMany($productsIds);

        return $products->sortBy(function ($model) use ($productsIds) {
            return array_search($model->getKey(), $productsIds);
        });



        /*$orderitems = $order->groupBy('product_id')->sort()->map(function ($product) {
             return $product->count();
         })->reverse()->take(3);*/
    }
}
