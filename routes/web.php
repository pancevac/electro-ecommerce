<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize'],
], function () {

    Route::get('/', 'FrontendController@index')->name('frontend.index');

    // Products
    Route::get(LaravelLocalization::transRoute('routes.product'), 'FrontendController@product')->name('product');
    Route::get(LaravelLocalization::transRoute('routes.shop'), 'FrontendController@store')->name('store');

    // User
    Route::get(LaravelLocalization::transRoute('routes.customer.dashboard'), 'UserController@index')->name('dashboard');
    Route::get(LaravelLocalization::transRoute('routes.customer.edit'), 'UserController@edit')->name('user.edit');
    Route::post(LaravelLocalization::transRoute('routes.customer.update'), 'UserController@update')->name('user.update');
    Route::get(LaravelLocalization::transRoute('routes.customer.orders'), 'UserController@orders')->name('user.orders');
    Route::get(LaravelLocalization::transRoute('routes.customer.order'),'UserController@order')->name('user.order');
    //Route::get('/home', 'HomeController@index')->name('home');

    // Checkout
    Route::get(LaravelLocalization::transRoute('routes.checkout'), 'CheckoutController@index')->name('checkout.index');
    Route::post(LaravelLocalization::transRoute('routes.purchase'), 'CheckoutController@store')->name('charge');

    // About us
    Route::view(LaravelLocalization::transRoute('routes.about'), 'pages.about-us')->name('about_us');
    // Contact
    Route::view(LaravelLocalization::transRoute('routes.contact'), 'pages.contact')->name('contact');

});

// Cart
Route::get('cart', 'CartController@index')->name('cart.index');
Route::post('cart', 'CartController@store')->name('cart.store');
Route::put('cart/{rowId}', 'CartController@update')->name('cart.update');
Route::delete('cart/{rowId}', 'CartController@destroy')->name('cart.destroy');

// Wish list
/*Route::get('wishlist/create', 'WishlistController@create')->name('wishlist.create')->middleware('auth');
Route::get('wishlist', 'WishlistController@index')->name('wishlist.index')->middleware('auth');
Route::post('wishlist', 'WishlistController@store')->name('wishlist.store')->middleware('auth');
Route::put('wishlist/{id}', 'WishlistController@update')->name('wishlist.update')->middleware('auth');
Route::delete('wishlist/{id}', 'WishlistController@destroy')->name('wishlist.destroy')->middleware('auth');*/
Route::apiResource('wishlist', 'WishlistController')->middleware('auth');

// Comment handler
Route::put('product/{coupon}', [
    'middleware' => 'auth',
    'uses' => 'FrontendController@comment'
])->name('product.comment');

// Coupon controller
Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy');

// Thank you page after purchase
Route::get('/thankyou', function () {

    if (session()->has('success_message')) {
        return view('pages.thankyou');
    }
    return redirect('/');
})->name('thankyou');

Auth::routes();

// Admin Panel
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Newsletter
Route::post('/newsletter', 'FrontendController@newsletter')->name('frontend.newsletter');
Route::get('/newsletter-Thankyou', function () {

    if (session()->has('success_message')) {
        return view('pages.newsletter-thankyou');
    }
    return redirect('/');
})->name('frontend.newsletter-thankyou');