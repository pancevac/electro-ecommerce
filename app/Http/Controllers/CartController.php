<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\UpdateInCartRequest;
use App\Models\Product;
use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartItems = getCartItems();

        return view('pages.cart')->with('cartItems', $cartItems);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddToCartRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AddToCartRequest $request)
    {
        // Set locale
        app()->setLocale($request->get('locale', 'en'));

        // Get product which we want to store to cart
        $product = Product::with('discount')
            ->where('code', $request->input('product_code'))
            ->first();

        if (!$product) {
            return response()->json([
                'message' => trans('messages.cart.unknown_product'),
            ], 403);
        }

        // Add product to shopping cart
        \Cart::instance('shopping')->add($product, $request->input('quantity', 1));

        return getCartStatus(trans('messages.cart.added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInCartRequest $request
     * @param $rowId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateInCartRequest $request, $rowId)
    {
        // Set locale
        app()->setLocale($request->get('locale', 'en'));

        try {
            // Update product quantity
            \Cart::instance('shopping_cart')->update($rowId, $request->input('quantity'));
        }
        // Catch exception when RowId is invalid and return message
        catch (InvalidRowIDException $e) {

            return response()->json([
                'message' => trans('messages.cart.unknown_product'),
            ], 403);
        }

        return getCartStatus(trans('messages.cart.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $rowId
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        try {
            Cart::instance('shopping')->remove($rowId);
        }
        // Catch exception when RowId is invalid and return message
        catch (InvalidRowIDException $e) {

            return response()->json([
                'message' => trans('messages.cart.unknown_product'),
            ], 403);
        }

        return getCartStatus(trans('messages.cart.deleted'));
    }
}
