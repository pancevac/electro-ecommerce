<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Grab saved wishlist instance from db
        Cart::instance('wishlist')->restore(Auth::user()->id);

        // Load it
        $products = Cart::instance('wishlist')->content();

        // Update instance in db becaouse it is lost after retrieving
        Cart::instance('wishlist')->store(Auth::user()->id);

        return view('pages.wishlist')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(Cart::instance('wishlist')->content()->where('id', 7)->isEmpty());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->submit) {

            // Get shopping cart instance
            $shopping = Cart::instance('shopping')->content();

            foreach (Cart::instance('wishlist')->content() as $product) {

                // Check if there isn't already product in shopping cart
                if (!$shopping->has($product->rowId)) {

                    // Adding products to shopping cart instance
                    Cart::instance('shopping')->add([
                        'id' => $product->id,
                        'name' => $product->name,
                        'qty' => 1,
                        'price' => $product->price,
                    ]);
                }
            }
            // Success
            return redirect()->route('wishlist.index')->with('success', 'Items successfully added in shopping cart!');
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Retrieve product
        $product = Product::find($id);

        // Restore previously wishlist instance from db if any. Note: this will delete record from db after getting info
        Cart::instance('wishlist')->restore(Auth::user()->id);

        // Check if product is already added in wish list
        if (!Cart::instance('wishlist')->content()->where('id', $id)->isEmpty()) {

            Cart::instance('wishlist')->store(Auth::user()->id);
            return back()->with('error', 'Item is already added in wish list.');
        }

        // Make wishlist instance
        Cart::instance('wishlist')->add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price,
        ])->associate(\App\Models\Product::class);

        // Update instance in db
        Cart::instance('wishlist')->store(Auth::user()->id);

        return back()->with('success', 'Item added to wish list!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Restore instance from db
        Cart::instance('wishlist')->restore(Auth::user()->id);

        // Remove item from instance
        Cart::instance('wishlist')->remove($id);

        // Update instance in db
        Cart::instance('wishlist')->store(Auth::user()->id);

        return back()->with('success', 'Item successfully removed from wish list!');
    }
}
