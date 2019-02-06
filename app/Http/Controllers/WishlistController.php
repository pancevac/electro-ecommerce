<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToWishList;
use App\Models\Product;
use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{

    /**
     * WishlistController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except([
            'store',
            // 'destroy',
        ]); // TODO kasnije skloni destroy zato sto ces ga promeniti u post
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->restoreWishListSession();

        // Load wish list items saved in wish list
        $wishListItems = Cart::instance('wishlist')->content();

        $this->storeWishListSession();

        // Get all products with corresponding ids from wish list items collection
        $products = Product::with(['translations', 'category', 'discount'])
            ->findOrFail($wishListItems->pluck('id')->toArray());

        // Modify each wish list item appending product property
        $items = $wishListItems->map(function ($item, $rowId) use ($products) {

            // Get product from collection
            $item->model = $products->where('id', $item->id)->first();
            return $item;
        });

        return view('pages.wishlist')->with('products', $items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddToWishList $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AddToWishList $request)
    {
        // Get product which we want to store to cart
        $product = Product::where('code', $request->input('product_code'))->first();

        if (!$product) {
            return response()->json([
                'message' => trans('messages.wish_list.unknown_product'),
            ], 403);
        }

        // Restore wish list session from db
        // After restoring, wish list is deleted from db
        // so we need to store instance again in order to save wish list
        $this->restoreWishListSession();

        // Search wish list if same product is already there
        // If it is, return message to user
        $hasInWishList = \Cart::instance('wishlist')
            ->search(function ($cartItem, $rowId) use ($product) {
                return $cartItem->id === $product->id;
            });

        if ($hasInWishList->count()) {

            $this->storeWishListSession();

            return response()->json([
                'message' => trans('messages.wish_list.duplicate')
            ], 403);
        }

        // Add product to wish list
        \Cart::instance('wishlist')->add($product, 1);

        // Save wish list session instance in db
        $this->storeWishListSession();

        return getCartStatus(trans('messages.wish_list.added'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $rowId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($rowId)
    {
        // Restore instance from db
        $this->restoreWishListSession();

        try {
            \Cart::instance('wishlist')->remove($rowId);
        }
        // Catch exception when RowId is invalid and return message
        catch (InvalidRowIDException $e) {

            $this->storeWishListSession();

            return back()->with('error', trans('messages.wish_list.unknown_product'));
        }

        $this->storeWishListSession();

        return back()->with('success', trans('messages.wish_list.deleted'));
    }

    /**
     * Add all products from wish list to shopping cart.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function moveAllToCart(Request $request)
    {
        $this->restoreWishListSession();

        $wishListItems = \Cart::instance('wishlist')->content();

        $this->storeWishListSession();

        $products = Product::findMany($wishListItems->pluck('id')->toArray());

        if ($products->isEmpty()) {
            return back()->with('error', 'No products in wish list!');
        }

        \Cart::instance('shopping')->add($products->all());

        return back()->with('success', trans('messages.wish_list.added_all_to_cart'));
    }

    /**
     * Restore wish list session from db
     */
    protected function restoreWishListSession()
    {
        \Cart::instance('wishlist')->restore(Auth::id());
    }

    /**
     * Store wish list session in db
     */
    protected function storeWishListSession()
    {
        \Cart::instance('wishlist')->store(Auth::id());
    }
}
