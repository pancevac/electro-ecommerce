<?php


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
    $trail->push('Edit', route('user.edit'));
});
// Home > User > Orders
Breadcrumbs::for('user.orders', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Orders', route('user.orders'));
});
// Home > User > Orders > Order#
Breadcrumbs::for('user.order', function ($trail, $order) {
    $trail->parent('user.orders');
    $trail->push('Order #'.$order->id, route('user.order', ['id' => $order->id]));
});

// Home > Login
Breadcrumbs::for('login', function ($trail) {
    $trail->parent('/');
    $trail->push('Login', route('login'));
});
// Home > login > reset password
Breadcrumbs::for('password.request', function ($trail) {
    $trail->parent('login');
    $trail->push('Reset Password', route('password.request'));
});
// Register
Breadcrumbs::for('register', function ($trail) {
    $trail->parent('/');
    $trail->push('Register', route('register'));
});


// Home > Checkout
Breadcrumbs::for('checkout.index', function ($trail) {
    $trail->parent('/');
    $trail->push('Checkout', route('checkout.index'));
});

// Home > Wishlist
Breadcrumbs::for('wishlist.index', function ($trail) {
    $trail->parent('/');
    $trail->push('Wishlist', route('wishlist.index'));
});

// Home > Shopping Cart
Breadcrumbs::for('cart.index', function ($trail) {
    $trail->parent('/');
    $trail->push('Shopping Cart', route('cart.index'));
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
Breadcrumbs::for('product', function ($trail, $product) {

    $trail->parent('/');
    $trail->push('Shop', route('store'));
    $trail->push($product->category->name, route('store', ['category' => $product->category->name]));
    $trail->push($product->manufacturer->name, route('store', ['category' => $product->category->name, 'brand' => $product->manufacturer->name]));
    $trail->push($product->name);
});


// Home > All categories > category
/*Breadcrumbs::for('store', function ($trail, $category) {
    $trail->parent('store');
    $trail->push($category->name, route('store', ['category' => $category->name]));
});*/



