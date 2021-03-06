<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\SEO;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    use SEO;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Where to redirect users after registration.
     *
     * @return string
     */
    protected function redirectTo()
    {
        return getLocalizedRoute('routes.customer.dashboard');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        session()->put('previousUrl', url()->previous());

        // Prepare SEO for login page.
        $this->seoDefault(trans('pages.login.title'));

        return view('auth.login');
    }

    /*public function redirectPath()
    {
        return str_replace(url('/'), '', session()->get('previousUrl', '/'));
    }*/
}
