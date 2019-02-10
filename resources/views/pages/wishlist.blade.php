@extends('layouts.app')

@section('breadcrumbs')
  {{ Breadcrumbs::render('wishlist.index') }}
@endsection()

@section('content')

  <!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <!-- section title -->
        <div class="col-md-12">
          <div class="section-title">
            <h3 class="title">{{ __('pages.wish_list.title') }} ({{ $products->count() }})</h3>
            <div class="section-nav">
              @if($products->count())
                {{ Form::open(['method' => 'POST', 'route' => 'wishlist.addToCart']) }}
                <button class="primary-btn order-submit" type="submit" name="submit" value="submit">
                  {{ __('pages.wish_list.add_all_to_cart') }}
                </button>
                {{ Form::close() }}
              @endif
            </div>
          </div>
        </div>
        <!-- /section title -->
        <!-- Products tab & slick -->
        <div class="col-md-12">
          <div class="row">
            <div class="products-tabs">
              <!-- tab -->
              <div id="tab1" class="tab-pane active">
                <div class="products-slick" data-nav="#slick-nav-1">

                  @foreach($products as $product)
                    <!-- product -->
                    @component('components.product_tab_wishlist', [
                        'product' => $product
                    ])
                    @endcomponent
                  <!-- /product -->
                  @endforeach()


                </div>
                <div id="slick-nav-1" class="products-slick-nav"></div>
              </div>
              <!-- /tab -->
            </div>
          </div>
        </div>
        <!-- Products tab & slick -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION -->

@endsection