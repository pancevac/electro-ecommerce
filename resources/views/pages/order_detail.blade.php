@extends('layouts.app')

@section('title', 'Order Detail')

@section('breadcrumbs')
    {{ Breadcrumbs::render('user.order', $order) }}
@endsection

@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Your Order #{{ $order->id }}</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PRODUCT(S)</strong></div>
                            <div><strong>PRICE</strong></div>
                        </div>
                        <div class="order-products">
                            @foreach($order->products as $product)

                                <div class="order-col">
                                    <div>
                                        {{ $product->name }}
                                        @if($product->pivot->quantity > 1)
                                            <strong>({{ $product->pivot->quantity }}x)</strong>
                                        @endif
                                    </div>
                                    @if(isset($product->pivot->percent_off))
                                        <div>({{ $product->pivot->percent_off }}% off)</div>
                                        <div>${{ $product->pivot->price }}</div>
                                    @else
                                        <div>${{ $product->price }}</div>
                                    @endif
                                </div>
                            @endforeach()

                        </div>
                        <hr>
                        <div class="order-col">
                            <div><strong>Subtotal</strong></div>
                            <div>${{ $order->billing_subtotal }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>Discount</strong></div>
                            <div>-${{ $order->billing_discount }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>Order Tax</strong></div>
                            <div>+${{ $order->billing_tax }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>TOTAL PRICE</strong></div>
                            <div><strong class="order-total">${{ $order->billing_total}}</strong></div>
                        </div>
                        <hr>
                        <div class="order-col">
                            <div><strong>User</strong></div>
                            <div>{{ $order->user->name }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>Email</strong></div>
                            <div>{{ $order->billing_email }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>First Name</strong></div>
                            <div>{{ $order->billing_first_name }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>Last Name</strong></div>
                            <div>{{ $order->billing_last_name }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>City</strong></div>
                            <div>{{ $order->billing_city }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>Country</strong></div>
                            <div>{{ $order->billing_country}}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>Postal Code</strong></div>
                            <div>{{ $order->billing_postalcode }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>Phone</strong></div>
                            <div>{{ $order->billing_phone }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>Name on card</strong></div>
                            <div>{{ $order->billing_name_on_card }}</div>
                        </div>
                        <hr>
                        <div class="order-col">
                            <div><strong>Ordered on</strong></div>
                            <div>{{ $order->created_at }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>Shipped</strong></div>
                            <div>
                                @if($order->shipped)
                                    <strong class="order-total" style="color: rgba(26,221,34,0.67)">Yes</strong>
                                    @else
                                    <strong class="order-total">No</strong>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection