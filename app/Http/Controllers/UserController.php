<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Traits\SEO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use SEO;

    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        }]);
    }

    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Prepare SEO for customer profile page.
        $this->seoDefault(trans('pages.profile.title'));

        return view('home', [
            'user' => $this->user,
        ]);
    }

    public function edit()
    {
        // Prepare SEO for customer edit profile page.
        $this->seoDefault(trans('pages.edit_profile.title'));

        return view('pages.user_form', [
            'user' => $this->user,
        ]);
    }

    public function update(UserRequest $request)
    {
        $this->user->name = $request->get('username');
        $this->user->password = Hash::make($request->get('password'));

        try {
            $this->user->save();
            // Success
            return back()->with('success', 'Your Profile Information has been successfully updated!');

        } catch (\Exception $e) {
            Log::error('Error with updating user profile by user: '.$e->getMessage());
        }
        return back()->with('error', 'An error occured, plase try again later!');
    }

    public function orders()
    {
        $this->seoDefault(trans('pages.orders.title'));

        $orders = $this->user->orders->where('error', false);

        return view('pages.orders')->with('orders', $orders);
    }

    public function order($id)
    {
        $this->seoDefault(trans('pages.order.title'));

        // Get order
        $order = $this->user->orders->where('id', $id)->first();

        if ($order) {
            return view('pages.order_detail')->with('order', $order);
        }
        // If user try to see order that not belong to him
        return redirect()->route('dashboard');
    }
}
