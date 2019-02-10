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

    /**
     * Products
     */
    Route::get(LaravelLocalization::transRoute('routes.product'), 'FrontendController@product')->name('product');
    Route::get(LaravelLocalization::transRoute('routes.shop'), 'FrontendController@store')->name('store');

    /**
     * User
     */
    Route::group(['middleware' => ['auth', 'isEmailVerified']], function () {
        Route::get(LaravelLocalization::transRoute('routes.customer.dashboard'), 'UserController@index')->name('dashboard');
        Route::get(LaravelLocalization::transRoute('routes.customer.edit'), 'UserController@edit')->name('user.edit');
        Route::post(LaravelLocalization::transRoute('routes.customer.update'), 'UserController@update')->name('user.update');
        Route::get(LaravelLocalization::transRoute('routes.customer.orders'), 'UserController@orders')->name('user.orders');
        Route::get(LaravelLocalization::transRoute('routes.customer.order'),'UserController@order')->name('user.order');
    });
    //Route::get('/home', 'HomeController@index')->name('home');

    /**
     * Checkout
     */
    Route::group(['middleware' => 'isEmailVerified'], function () {
        Route::get(LaravelLocalization::transRoute('routes.checkout'), 'CheckoutController@index')->name('checkout.index');
        Route::post(LaravelLocalization::transRoute('routes.purchase'), 'CheckoutController@store')->name('charge');
    });

    /**
     * About us
     */
    Route::view(LaravelLocalization::transRoute('routes.about'), 'pages.about-us')->name('about_us');

    /**
     * Contact
     */
    Route::view(LaravelLocalization::transRoute('routes.contact'), 'pages.contact')->name('contact');

    /**
     * Login
     */
    Route::get(LaravelLocalization::transRoute('routes.login'), 'Auth\LoginController@showLoginForm')->name('login');
    Route::post(LaravelLocalization::transRoute('routes.login'), 'Auth\LoginController@login');
    Route::post(LaravelLocalization::transRoute('routes.logout'), 'Auth\LoginController@logout')->name('logout');

    /**
     * Register
     */
    Route::get(LaravelLocalization::transRoute('routes.register'), 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post(LaravelLocalization::transRoute('routes.register'), 'Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    /**
     * Email verification
     */
    Route::get(LaravelLocalization::transRoute('routes.register-verify'), 'Auth\RegisterController@verify')->name('verifyEmail');
    Route::get(LaravelLocalization::transRoute('routes.register-verify-resend'), 'Auth\RegisterController@showResendVerificationEmailForm')->name('showResendVerificationForm');
    Route::post(LaravelLocalization::transRoute('routes.register-verify-resend'), 'Auth\RegisterController@resendVerificationEmail')->name('resendVerification')->middleware('throttle:2,1');

    /**
     * Shopping cart
     */
    Route::get('cart', 'CartController@index')->name('cart.index');
    Route::post('cart', 'CartController@store')->name('cart.store');
    Route::put('cart/{rowId}', 'CartController@update')->name('cart.update');
    Route::delete('cartAjax/{rowId}', 'CartController@AjaxDestroy')->name('cart.cartAjax');
    Route::delete('cart/{rowId}', 'CartController@destroy')->name('cart.destroy');

    /**
     * Wish list
     */
    Route::post('wishlist/all', 'WishlistController@moveAllToCart')->name('wishlist.addToCart');
    Route::resource('wishlist', 'WishlistController')->except(['create', 'show', 'update', 'edit']);

});

// Cart
/*Route::get('cart', 'CartController@index')->name('cart.index');
Route::post('cart', 'CartController@store')->name('cart.store');
Route::put('cart/{rowId}', 'CartController@update')->name('cart.update');
Route::delete('cartAjax/{rowId}', 'CartController@AjaxDestroy')->name('cart.cartAjax');
Route::delete('cart/{rowId}', 'CartController@destroy')->name('cart.destroy');*/

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

//Auth::routes();

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