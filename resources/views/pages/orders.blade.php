@extends('layouts.app')

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
              <h3 class="title">{{ __('pages.orders.no_order') }}</h3>
            </div>
          @else
            <div class="section-title text-left">
              <h3 class="title">{{ __('pages.orders.title') }}</h3>
            </div>
            <table class="table table-responsive table-hover">
              <thead>
              <tr>
                <th scope="col">{{ __('pages.orders.list.id') }}</th>
                <th scope="col">{{ __('pages.orders.list.product_name') }}</th>
                <th scope="col">{{ __('pages.orders.list.discount') }}</th>
                <th scope="col">{{ __('pages.orders.list.tax') }}</th>
                <th scope="col">{{ __('pages.orders.list.total_price') }}</th>
                <th scope="col">{{ __('pages.orders.list.is_shipped') }}</th>
                <th scope="col">{{ __('pages.orders.list.ordered_on') }}</th>
              </tr>
              </thead>
              <tbody>
              @foreach($orders as $order)
                <tr>
                  <th scope="row">{{ $order->id }}</th>
                  <td>
                    @foreach($order->products as $product)
                      <a href="{{ route('user.order', ['id' => $order->id]) }}">{{ $product->name }}@if(!$loop->last)
                          , @endif</a>
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
                    @if($order->shipped) <span class="label label-primary">{{ __('pages.orders.list.shipped_yes') }}</span> @else <span
                        class="label label-warning">{{ __('pages.orders.list.shipped_no') }}</span> @endif
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