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

// Products
Route::get('/', 'FrontendController@index')->name('frontend.index');
Route::get('/product/{id}', 'FrontendController@product')->name('product');
Route::get('/store', 'FrontendController@store')->name('store');

// Cart
Route::get('cart', 'CartController@index')->name('cart.index');
Route::put('cart/{id}', 'CartController@update')->name('cart.update');
Route::delete('cart/{id}', 'CartController@destroy')->name('cart.destroy');

// Wish list
/*Route::get('wishlist/create', 'WishlistController@create')->name('wishlist.create')->middleware('auth');
Route::get('wishlist', 'WishlistController@index')->name('wishlist.index')->middleware('auth');
Route::post('wishlist', 'WishlistController@store')->name('wishlist.store')->middleware('auth');
Route::put('wishlist/{id}', 'WishlistController@update')->name('wishlist.update')->middleware('auth');
Route::delete('wishlist/{id}', 'WishlistController@destroy')->name('wishlist.destroy')->middleware('auth');*/
Route::resource('wishlist', 'WishlistController')->middleware('auth');


// Checkout
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/charge', 'CheckoutController@store')->name('charge');

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

// User
Route::get('/dashboard', 'UserController@index')->name('dashboard');
Route::get('/user/edit', 'UserController@edit')->name('user.edit');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/orders', 'UserController@orders')->name('user.orders');
Route::get('/user/order/{id}','UserController@order')->name('user.order');
Route::get('/home', 'HomeController@index')->name('home');

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

// About us
Route::view('/about-us', 'pages.about_us')->name('about_us');
// Contact
Route::view('/contact', 'pages.contact')->name('contact');