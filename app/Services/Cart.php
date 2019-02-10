<?php
/**
 * Created by PhpStorm.
 * User: Sile
 * Date: 1/31/2019
 * Time: 11:37 PM
 */

namespace App\Services;


use App\Models\Product;

class Cart
{
    /**
     * Cart items
     *
     * @var
     */
    protected $items;

    /**
     * Hide attributes before transforming product class into JSON.
     *
     * @var array
     */
    protected $hiddenProductAttributes = [
        'id',
        'user_id',
        'collection_id',
        'publish_at',
        'publish',
        'created_at',
        'updated_at',
        'translations',
        'category_id',
        'manufacturer_id',
    ];

    public function init()
    {
        // Get cart items
        $content = \Cart::instance('shopping')->content();

        $cartItemsWithModel = []; // Cart items array with associated products(model)

        // Get associated products, append product link and hide useless properties
        // We do this because products are not eager-loaded in shopping cart
        $products = Product::with(['category', 'manufacturer', 'discount', 'comments'])
            ->whereIn('id', $content->pluck('id'))
            ->get()->each
            ->setAppends(['link', 'smallImage'])
            ->makeHidden($this->hiddenProductAttributes);

        $this->items = $content->map(function ($item, $rowId) use ($products) {
            // Convert each item object's properties as array
            // We do this cuz shopping-cart package override laravel's toArray() method which remove associated model.
            // We bypass this with transforming item object properties into array.
            // With this, we can eager load cart products instead of lazy loading and add additional fields.

            // Get product from eager loaded products collection
            $product = $products->where('id', $item->id)->first();

            $cartItem                           = get_object_vars($item);
            $cartItem['priceFormatted']         = currency($product->getBuyablePrice());
            $cartItem['pricePlusQtyFormatted']  = currency($product->getBuyablePrice() * $cartItem['qty']);
            $cartItem['model']                  = $product;

            // after adding additional "fields" on cart item, transform item array into item object
            return (object) $cartItem;
        });

    }

    /**
     * Return shopping cart items as array or as json
     *
     * @param bool $asJson
     * @return array|mixed|string
     */
    public function getCartItems(bool $asJson = false)
    {
        return $asJson ? json_encode($this->items) : $this->items;
    }

    /**
     * Return number of items in cart.
     *
     * @return int
     */
    public function getCartCount(): int
    {
        return \Cart::instance('shopping')->count();
    }

    /**
     * Get the total price of the items in the cart. Discounts included!
     *
     * @param bool $format
     * @return mixed
     */
    public function getTotalPrice(bool $format = false)
    {
        $total = $this->getCartItems()->reduce(function ($cartItemTotal, $cartItem) {
            return $cartItemTotal + $cartItem->price;
        }, 0);

        return $format ? currency($total) : $total;
    }

    /**
     * Return refreshed cart status as JSON
     *
     * @param string $withMessage
     * @param bool $asJson
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCartStatus(string $withMessage, bool $asJson = true)
    {
        // Init(refresh) cart state before returning status
        $this->init();

        return response()->json([
            'message' => $withMessage,
            'cartItems' => $this->getCartItems(),
            'cartItemsCount' => $this->getCartCount(),
            //'subtotalPrice' => $this->getSubtotalPrice(true),
            'totalPrice' => $this->getTotalPrice(true),
            //'discount' => $this->calculateTotalDiscount(true),
            /* 'totalPrice' => self::calculateTotalPrice(),
             'coupon' => self::getCheckedCoupon(),*/
        ]);
    }

}