@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('breadcrumbs')
  {{ Breadcrumbs::render('cart.index') }}
@endsection()

@section('content')

  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-title">
            <h3 class="title">{{ __('pages.cart.your_shopping_cart') }}({{ getCartCount() }})</h3>
          </div>
        </div>

        <div class="col-md-12">
          <div class="row">
            <div class="products-tabs">

              <div id="tab1" class="tab-pane active">
                <div class="products-slick" data-nav="#slick-nav-1">

                  @foreach($cartItems as $item)

                    @component('components.product_tab_cart', [
                      'item' => $item,
                    ])
                    @endcomponent

                  @endforeach()

                </div>
                <div id="slick-nav-1" class="products-slick-nav"></div>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

@endsection