<?php


use App\Models\Order;
use App\Models\Product;

// Home
Breadcrumbs::for('/', function ($trail) {
    $trail->push('Home', route('frontend.index'));
});
// Home > User
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->parent('/');
    $trail->push(\Illuminate\Support\Facades\Auth::user()->name, route('dashboard'));
});
// Home > User > Edit
Breadcrumbs::for('user.edit', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('pages.edit_profile.title'), route('user.edit'));
});
// Home > User > Orders
Breadcrumbs::for('user.orders', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('pages.orders.title'), route('user.orders'));
});
// Home > User > Orders > Order#
Breadcrumbs::for('user.order', function ($trail, Order $order) {
    $trail->parent('user.orders');
    $trail->push(trans('pages.order.title') . ' #'.$order->id, $order->getUrl());
});

// Home > Login
Breadcrumbs::for('login', function ($trail) {
    $trail->parent('/');
    $trail->push(trans('pages.login.title'), route('login'));
});
// Home > login > reset password
Breadcrumbs::for('password.request', function ($trail) {
    $trail->parent('login');
    $trail->push('Reset Password', route('password.request'));
});
// Register
Breadcrumbs::for('register', function ($trail) {
    $trail->parent('/');
    $trail->push(trans('pages.register.title'), route('register'));
});


// Home > Checkout
Breadcrumbs::for('checkout.index', function ($trail) {
    $trail->parent('/');
    $trail->push(trans('pages.checkout.title'), route('checkout.index'));
});

// Home > Wishlist
Breadcrumbs::for('wishlist.index', function ($trail) {
    $trail->parent('/');
    $trail->push(trans('pages.wish_list.title'), route('wishlist.index'));
});

// Home > Shopping Cart
Breadcrumbs::for('cart.index', function ($trail) {
    $trail->parent('/');
    $trail->push(trans('pages.cart.title'), route('cart.index'));
});

// Home > All Categories  ? category
Breadcrumbs::for('store', function ($trail, $request) {

    if ($request->category) {

            $trail->parent('/');
            $trail->push('Shop', route('store'));
            $trail->push($request->category, route('store', ['category' => $request->category]));
    }
    else {
        $trail->parent('/');
        $trail->push('Shop', route('store'));
    }
    if ($request->brand) {
        $trail->push($request->brand, route('store', ['brand' => $request->brand]));
    }

});

// Home > Category > Brand > Product
Breadcrumbs::for('product', function ($trail, Product $product) {

    $trail->parent('/');
    $trail->push(trans('pages.shop.title'), route('store'));
    $trail->push($product->category->name, route('store', ['category' => $product->category->name]));
    $trail->push($product->manufacturer->name, route('store', ['category' => $product->category->name, 'brand' => $product->manufacturer->name]));
    $trail->push($product->get('name'), $product->getUrl());
});


// Home > All categories > category
/*Breadcrumbs::for('store', function ($trail, $category) {
    $trail->parent('store');
    $trail->push($category->name, route('store', ['category' => $category->name]));
});*/



