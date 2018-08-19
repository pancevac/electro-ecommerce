<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderShipped;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get cart items
        $CartContent = Cart::instance('shopping')->content();

        // Check if user have empty cart
        if (!count($CartContent)) {
            return redirect('/')->with('error', 'Your cart is empty, you can not process to checkout!');
        }

        return view('pages.checkout')->with([
            'cartContent' => $CartContent,
            'newTax' => $this->calculateCoupon()->get('newTax'),
            'newSubtotal' => $this->calculateCoupon()->get('newSubtotal'),
            'taxPercent' => $this->calculateCoupon()->get('taxPercent'),
            'newTotal' => $this->calculateCoupon()->get('newTotal'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CheckoutRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CheckoutRequest $request)
    {
        // Get all cart items
        $orders = Cart::instance('shopping')->content();
        $contents = '';
        // List items
        foreach ($orders as $content) {
            $contents .= $content->name.': '.$content->qty.', ';
        }

        /*dd($request->country);*/

        // Charge with stripe
        try {
            $stripe = new Stripe();
            $stripe->charges()->create([
                'amount' => $this->calculateCoupon()->get('newTotal'),
                'currency' => 'usd',
                'description' => 'Order',
                'source' => $request->stripeToken,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('shopping')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);

            // Store order in orders tables
            $order = $this->addToOrdersTables($request, null);

            // Send order Email to customer
            /*Mail::send(new OrderShipped($order));*/
            // Modified, cuz of 000webhosting only support mail()
            /*dd(new OrderShipped($order));*/
            $orderShipped = new OrderShipped($order);
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            mail($order->billing_email, env('APP_NAME').' Order', $orderShipped->render(), $headers);

            // Success
            Cart::instance('shopping')->destroy();
            session()->forget('coupon');
            return redirect()->route('thankyou')->with('success_message', 'Thank you! Your payment has been successfully accepted!');

            // Catch error with invalid card
        } catch (CardErrorException $e) {

            $this->addToOrdersTables($request, $e->getMessage());
            return back()->with('error', $e->getMessage());
            // Catch any other error
        } catch (\Exception $e) {

            $this->addToOrdersTables($request, $e->getMessage());
            Log::error('Error with charging card: '.$e->getMessage());
        }

        return back()->with('error', 'An error occured, plase try again later!');
    }

    protected function addToOrdersTables($request, $error)
    {
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $request->email,
            'billing_first_name' => $request->first_name,
            'billing_last_name' => $request->last_name,
            'billing_address' => $request->address,
            'billing_country' => $request->country,
            'billing_city' => $request->city,
            'billing_postalcode' => $request->zip_code,
            'billing_phone' => $request->tel,
            'billing_name_on_card' => 'Test',
            'billing_discount' => $this->calculateCoupon()->get('discount'),
            'billing_discount_code' => $this->calculateCoupon()->get('code'),
            'billing_subtotal' => $this->calculateCoupon()->get('newSubtotal'),
            'billing_tax' => $this->calculateCoupon()->get('newTax'),
            'billing_total' => $this->calculateCoupon()->get('newTotal'),
            'error' => $error,
        ]);

        // Insert into pivot order_product table
        foreach (Cart::instance('shopping')->content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->qty,
                'price' => $item->price,
                'percent_off' => isset(Product::find($item->id)->discount->percent_off) ? Product::find($item->id)->discount->percent_off : null,
            ]);
        }

        return $order;
    }


    /**
     * Returns calculated cart prices based on coupons
     *
     * @return \Illuminate\Support\Collection
     */
    private function calculateCoupon()
    {
        // Calculate
        $taxPercent = config('cart.tax');
        $tax = $taxPercent / 100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $code = session()->get('coupon')['name'] ?? null;

        $newSubtotal = (Cart::instance('shopping')->subtotal() - $discount);
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal + $newTax;
        if ($newTotal < 0) {
            $newTotal = 0;
        }
        if ($newSubtotal < 0) {
            $newSubtotal = 0;
        }
        if ($newTax < 0) {
            $newTax = 0;
        }

        return collect([
            'taxPercent' => $taxPercent,
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
            'code' => $code,
        ]);
    }

}
