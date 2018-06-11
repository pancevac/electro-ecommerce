@extends('layouts.app')

@section('title', 'Your orders')

@section('breadcrumbs')
    {{ Breadcrumbs::render('user.orders') }}
@endsection

@section('content')

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if($orders->isEmpty())
                        <div class="section-title text-left">
                            <h3 class="title">You Have no Orders</h3>
                        </div>
                    @else
                        <div class="section-title text-left">
                            <h3 class="title">Your Orders</h3>
                        </div>
                        <table class="table table-responsive table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Product Ordered</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Tax</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Shipped</th>
                                <th scope="col">Ordered on</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <th scope="row">{{ $order->id }}</th>
                                        <td>
                                            @foreach($order->products as $product)
                                                <a href="{{ route('user.order', ['id' => $order->id]) }}">{{ $product->name }}@if(!$loop->last), @endif</a>
                                            @endforeach
                                        </td>
                                        <td>
                                            -${{ $order->billing_discount }}
                                        </td>
                                        <td>
                                            +${{ $order->billing_tax }}
                                        </td>
                                        <td>
                                            ${{ $order->billing_total }}
                                        </td>
                                        <td>
                                            @if($order->shipped) <span class="label label-primary">Yes</span> @else <span class="label label-warning">No</span> @endif
                                        </td>
                                        <td>
                                            {{ $order->created_at }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection