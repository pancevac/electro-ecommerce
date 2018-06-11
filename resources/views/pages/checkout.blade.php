@extends('layouts.app')

@section('title')
    Checkout
@endsection()


@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/stripe.css') }}"/>
    <script src="https://js.stripe.com/v3/"></script>
@endsection
@section('js')
    <script src="{{ asset('js/stripe.js') }}"></script>
@endsection()

@section('breadcrumbs')
    {{ Breadcrumbs::render('checkout.index') }}
@endsection()
@section('content')
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

                <form action="{{ route('charge') }}" method="POST" id="payment-form">
                    @csrf()
                    <button id="complete-order" class="primary-btn order-submit" style="display:none;">Place order</button>
                    <div class="col-md-7">
                        <!-- Billing Details -->
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Billing address</h3>
                            </div>


                            <div class="form-group">
                                @auth()
                                    <input class="input" type="email" id="email" name="email" placeholder="Email" value="{{ auth()->user()->email }}" readonly>
                                @endauth
                                    @guest()
                                        <input class="input" type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                    @endguest
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" id="first-name" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" id="last-name" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" id="address" name="address" placeholder="Address" value="{{ old('address') }}" required>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" id="city" name="city" placeholder="City" value="{{ old('city') }}" required>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" id="country" name="country" placeholder="Country" value="{{ old('country') }}" required>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" id="zip-code" name="zip_code" placeholder="ZIP Code" value="{{ old('zip_code') }}" required>
                            </div>
                            <div class="form-group">
                                <input class="input" type="tel" id="tel" name="tel" placeholder="Telephone" value="{{ old('tel') }}" required>
                            </div>
                            {{--<div class="form-group">
                                <div class="input-checkbox">
                                    <input type="checkbox" id="create-account">
                                    <label for="create-account">
                                        <span></span>
                                        Create Account?
                                    </label>
                                    <div class="caption">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                                        <input class="input" type="password" name="password" placeholder="Enter Your Password">
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                        <!-- /Billing Details -->

                        {{--<!-- Shiping Details -->
                        <div class="shiping-details">
                            <div class="section-title">
                                <h3 class="title">Shiping address</h3>
                            </div>
                            <div class="input-checkbox">
                                <input type="checkbox" id="shiping-address">
                                <label for="shiping-address">
                                    <span></span>
                                    Ship to a diffrent address?
                                </label>
                                <div class="caption">
                                    <div class="form-group">
                                        <input class="input" type="text" name="first-name" placeholder="First Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="last-name" placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="address" placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="city" placeholder="City">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="country" placeholder="Country">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="zip-code" placeholder="ZIP Code">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="tel" name="tel" placeholder="Telephone">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Shiping Details -->--}}

                        <!-- Order notes -->
                        <div class="order-notes">
                            <textarea class="input" id="order-notes" name="order-notes" placeholder="Order Notes"></textarea>
                        </div>
                        <!-- /Order notes -->
                    </div>
                </form>

                <!-- Order Details -->
                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Your Order</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>
                        <div class="order-products">
                            @foreach($cartContent as $cartItem)
                            <div class="order-col">
                                <div>
                                    @if($cartItem->qty > 1)
                                        {{ $cartItem->qty }}x
                                    @endif
                                    {{ $cartItem->name }}
                                </div>
                                <div>${{ $cartItem->price }}</div>
                            </div>
                            @endforeach()

                        </div>
                        <hr>
                        <div class="order-col">
                            <div>Subtotal</div>
                            <div @if(session()->has('coupon')) style="text-decoration: line-through;"@endif>${{ Cart::instance('shopping')->subtotal() }}</div>
                        </div>
                        @if(session()->has('coupon'))
                            <div class="order-col">
                                <form action="{{ route('coupon.destroy') }}" method="POST" id="remove-coupon">
                                    {{ @csrf_field() }}
                                    {{ @method_field('delete') }}
                                    <div>Discount({{ session()->get('coupon')['name'] }}) - <a href="javascript:{}" onclick="document.getElementById('remove-coupon').submit();">Remove</a></div>
                                </form>
                                <div>-${{ session()->get('coupon')['discount'] }}</div>
                            </div>
                        @endif
                        @if(session()->has('coupon'))
                            <hr>
                            <div class="order-col">
                                <div>New subtotal</div>
                                <div>${{ $newSubtotal }}</div>
                            </div>
                        @endif
                        <div class="order-col">
                            <div>Tax({{ $taxPercent }}%)</div>
                            {{--<div>+${{ Cart::tax() }}</div>--}}
                            <div>+${{ $newTax }}</div>
                        </div>
                        <hr>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div><strong class="order-total">${{ number_format($newTotal, 2) }}</strong></div>
                        </div>
                    </div>

                    {{-- Coupon field --}}
                    @if(!session()->has('coupon'))
                        <div class="form-group">
                            <form action="{{ route('coupon.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="order-col">
                                    <div>
                                        <h4><strong>Have a coupon code?</strong></h4>
                                    </div>
                                </div>
                                <div class="coupon-code">
                                    <input type="text" class="input" name="coupon_code" id="coupon_id" style="width:50%">
                                    <button type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    @endif

                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-1">
                            <label for="payment-1">
                                <span></span>
                                Direct Bank Transfer
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-2">
                            <label for="payment-2">
                                <span></span>
                                Cheque Payment
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-3">
                            <label for="payment-3">
                                <span></span>
                                Paypal System
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">

                        <label for="card-element">
                            Credit or debit card
                        </label>
                        <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <!-- Used to display Element errors. -->
                        <div id="card-errors" role="alert"></div>

                    </div>

                    <div class="input-checkbox">
                        <input type="checkbox" id="terms">
                        <label for="terms">
                            <span></span>
                            I've read and accept the <a href="#">terms & conditions</a>
                        </label>
                    </div>
                    <button id="second-button" class="primary-btn order-submit" onclick="document.getElementById('complete-order').click()">Place order</button>
                </div>
                <!-- /Order Details -->

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
@endsection()