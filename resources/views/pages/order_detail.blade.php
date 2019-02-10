@extends('layouts.app')

@section('breadcrumbs')
  {{ Breadcrumbs::render('user.order', $order) }}
@endsection

@section('content')
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-5 order-details">
          <div class="section-title text-center">
            <h3 class="title">{{ __('pages.order.label') }} #{{ $order->id }}</h3>
          </div>
          <div class="order-summary">
            <div class="order-col">
              <div><strong>{{ __('pages.order.list.products') }}</strong></div>
              <div><strong>{{ __('pages.order.list.price') }}</strong></div>
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
              <div><strong>{{ __('pages.order.subtotal') }}</strong></div>
              <div>${{ $order->billing_subtotal }}</div>
            </div>
            <div class="order-col">
              <div><strong>{{ __('pages.order.discount') }}</strong></div>
              <div>-${{ $order->billing_discount }}</div>
            </div>
            <div class="order-col">
              <div><strong>{{ __('pages.order.tax') }}</strong></div>
              <div>+${{ $order->billing_tax }}</div>
            </div>
            <div class="order-col">
              <div><strong>{{ __('pages.order.total') }}</strong></div>
              <div><strong class="order-total">${{ $order->billing_total}}</strong></div>
            </div>
            <hr>
            <div class="order-col">
              <div><strong>{{ __('pages.order.user') }}</strong></div>
              <div>{{ $order->user->name }}</div>
            </div>
            <div class="order-col">
              <div><strong>{{ __('pages.order.email') }}</strong></div>
              <div>{{ $order->billing_email }}</div>
            </div>
            <div class="order-col">
              <div><strong>{{ __('pages.order.first_name') }}</strong></div>
              <div>{{ $order->billing_first_name }}</div>
            </div>
            <div class="order-col">
              <div><strong>{{ __('pages.order.last_name') }}</strong></div>
              <div>{{ $order->billing_last_name }}</div>
            </div>
            <div class="order-col">
              <div><strong>{{ __('pages.order.city') }}</strong></div>
              <div>{{ $order->billing_city }}</div>
            </div>
            <div class="order-col">
              <div><strong>{{ __('pages.order.country') }}</strong></div>
              <div>{{ $order->billing_country}}</div>
            </div>
            <div class="order-col">
              <div><strong>{{ __('pages.order.postal_code') }}</strong></div>
              <div>{{ $order->billing_postalcode }}</div>
            </div>
            <div class="order-col">
              <div><strong>{{ __('pages.order.phone') }}</strong></div>
              <div>{{ $order->billing_phone }}</div>
            </div>
            <div class="order-col">
              <div><strong>{{ __('pages.order.name_on_card') }}</strong></div>
              <div>{{ $order->billing_name_on_card }}</div>
            </div>
            <hr>
            <div class="order-col">
              <div><strong>{{ __('pages.orders.list.ordered_on') }}</strong></div>
              <div>{{ $order->created_at }}</div>
            </div>
            <div class="order-col">
              <div><strong>{{ __('pages.order.shipped') }}</strong></div>
              <div>
                @if($order->shipped)
                  <strong class="order-total" style="color: rgba(26,221,34,0.67)">{{ __('pages.order.shipped_yes') }}</strong>
                @else
                  <strong class="order-total">{{ __('pages.order.shipped_no') }}</strong>
                @endif
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
@endsection