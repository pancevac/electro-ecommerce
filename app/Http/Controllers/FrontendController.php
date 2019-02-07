<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Newsletter;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{
    private $productName;
    private $cacheMinutes;
    protected $test;

    public function __construct()
    {
        // Retreiving minutes for caching products
        $this->cacheMinutes = config('app.cacheMinute');
    }

    /**
     * Show home page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Get product model instance
        $model = new Product();
        // Get random products
        $featuredProducts = Cache::remember('featured_products', $this->cacheMinutes, function () use ($model) {
            return $model->with(['translations', 'category', 'discount', 'comments'])
                ->take(10)
                ->where('featured', true)
                ->get();
        });

        // Get new products
        $newProducts = Cache::remember('new_products', $this->cacheMinutes, function () use ($model) {
            return $model->with(['translations', 'category', 'discount', 'comments'])
                ->take(10)
                ->orderBy('created_at', 'DESC')
                ->get();
        });

        // Get top sales
        $topSales = Cache::remember('top_sales', $this->cacheMinutes, function () {
            return OrderProduct::getTopSales(6);
            //return (new Product())->topSales();
        });

        // Might also like
        $mightAlsoLike = Cache::remember('mightAlsoLike', $this->cacheMinutes, function () use ($model) {
            return $model->mightAlsoLike(6);
        });

        //dd($mightAlsoLike);

        // Discount products
        $discounts = Cache::remember('discounts', $this->cacheMinutes, function () use ($model) {
            return $model->with(['translations', 'category', 'discount'])
                ->has('discount')
                ->inRandomOrder()
                ->get();
        });

        return view('pages.index')->with([
            'featuredProducts' => $featuredProducts,
            'newProducts' => $newProducts,
            'topSales' => $topSales,
            'mightAlsoLike' => $mightAlsoLike,
            'discounts' => $discounts,
        ]);
    }

    /**
     * Show page with product
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function product($id)
    {
        // Get product by id with comments and others relationships
        $product = Product::with(['translations', 'category', 'discount', 'manufacturer', 'comments' => function ($comments) {
            $comments->where('approved', true)->orderBy('created_at', 'DESC');
        }])->where('id', $id)->first();

        // Get related products based on loaded product's category
        $relatedProducts = $product->getRelatedProducts();

        return view('pages.product')->with([
            'product' => $product,
            'related_products' => $relatedProducts,
        ]);
    }

    public function store()
    {
        // Get categories
        $categories = Category::all();

        // Get brands based on selected category
        if (request()->category) {
            $brands = Category::where('name', request()->category)->first()->manufacturers;

            foreach ($brands as $brand) {
                $this->productName = $brand->name;
                // Get products quantity for manufacturers of choosen category
                $product_qty = Product::with('category')->whereHas('category', function ($query) {
                $query->where('name', request()->category);
                })
                ->whereHas('manufacturer', function ($query) {
                    $query->where('name', $this->productName);
                });
                $brand->product_qty = $product_qty->get();
            }
        } else {
            $brands = Manufacturer::all();
            foreach ($brands as $brand) {

                $brand->product_qty = $brand->products;
            }
        }



        // Number of products displayed on single page
        if (request()->show == 9 || request()->show == 18) {
            $products_num = request()->show;
        } else {
            $products_num = 9;
        }



        // Query category string
        if (request()->category) {
            $products = Product::with('category')->whereHas('category', function ($query) {
                $query->where('name', request()->category);
            });
        } else {
            // Get 10 new products
            $products = Product::take(9);
        }

        // Query category and brand string
        if (request()->category && request()->brand) {

            $products = Product::with('category')->whereHas('category', function ($query) {
                $query->where('name', request()->category);
            })
                ->whereHas('manufacturer', function ($query) {
                    $query->where('name', request()->brand);
                });

        } elseif (request()->brand) {
            $products = Product::with('manufacturer')->whereHas('manufacturer', function ($query) {
                $query->where('name', request()->brand);
            });
        }

        /*if (request()->brand) {
            $products = Product::with('manufacturer')->whereHas('manufacturer', function ($query) {
                $query->where('name', request()->brand);
            });
        } elseif (request()->category && request()->brand) {
            dd($products);
        }*/


        // Sort price
        if (request()->sort == 'price_up') {
            $products = $products->orderBy('price', 'ASC')->paginate($products_num);
        } elseif (request()->sort == 'price_down') {
            $products = $products->orderBy('price', 'DESC')->paginate($products_num);
        } else {
            $products = $products->paginate(9);
        }


        /*// Get instance of product model
        $product = new Product();

        // Define where clause based on filters
        $product->where_name_category = 'categories.id';
        $product->where_category_value = 4;
        $product->where_name_manufacturer = 'manufacturers.id';
        $product->where_manufacturer_value = 1;

        // Get query result
        $result = $product->store()->get();*/
        //dd($products, $categories, $brands, OrderProduct::get_top_sales(5));

        // Return view
        return view('pages.store')->with([
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'top_sales' => OrderProduct::getTopSales(5),
        ]);
    }

    public function comment(Request $request, $id)
    {
        // Take commented product
        $product = Product::find($id);

        // Take instance of currently logged user
        $user = \App\User::find(Auth::user()->id);

        // Check if user is admin
        $user->isAdmin = $user->role->name === 'admin' ? true : false;

        // Store comment
        try {

            $user->comment($product, $request->review, $request->rating ? $request->rating : 1);
            // Success
            return back()->with('success', 'Your review has been successfully accepted!');

        } catch (\Exception $exception) {
            Log::error('Error with storing comment: '.$exception->getMessage());
        }

        return back()->with('error', 'Something went wrong, please try again later!');
    }

    public function newsletter(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:newsletters|email'
        ]);
        // Get instance of Newsletter model
        $newletter = new Newsletter();

        $newletter->email = $validated['email'];
        try {
            // Success
            $newletter->save();
            return redirect()->route('frontend.newsletter-thankyou')->with('success_message', 'Thank You, your email address is successfully registered on Newsletter.');

        } catch (\Exception $e) {
            Log::error('Error with register email with newsletters '.$e->getMessage());
        }

        return redirect()->back()->with('error', 'An error occured, please try again later!');
    }

    /*public function test()
    {
        return view('test');
    }

    public function obrada(Request $request)
    {
        dd($request->file('picture')->getClientOriginalName());
        $img = $request->file('picture')->store(
            '/products/May2018/'.$request->file('picture')->getClientOriginalName(),
            'public_html'
        );
    }*/

}
