@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('product', $product))

@section('content')

  <!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <!-- Product main img -->
        <div class="col-md-5 col-md-push-2">
          <div id="product-main-img">
            @if($product->images)
              @foreach(json_decode($product->images) as $image)
                <div class="product-preview">
                  <img src="{{ productImage($image) }}" alt="">
                </div>
              @endforeach()
            @else
              <img src="{{ asset('img/not-found.jpg') }}" alt="Not found">
            @endif
          </div>
        </div>
        <!-- /Product main img -->

        <!-- Product thumb imgs -->
        <div class="col-md-2  col-md-pull-5">
          <div id="product-imgs">
            @if($product->images)
              @foreach(json_decode($product->images) as $image)
                <div class="product-preview">
                  <img src="{{ productImage($image) }}" alt="">
                </div>
              @endforeach()
            @endif
          </div>
        </div>
        <!-- /Product thumb imgs -->

        <!-- Product details -->
        <div class="col-md-5">
          <div class="product-details">
            <h2 class="product-name">{{ $product->get('name') }}</h2>
            <div>
              <div class="product-rating">
                @php
                  $averageRate = $product->averageRate;
                @endphp
                @for($i = 0; $i < round($product->averageRate); $i++)

                  <i class="fa fa-star"></i>

                @endfor
                @for($i = 0; $i < 5 - round($product->averageRate); $i++)

                  <i class="fa fa-star-o"></i>

                @endfor
              </div>
              @php
                $totalCommentCount = $product->totalCommentCount
              @endphp
              <a class="review-link" href="#tab3">{{ $totalCommentCount }} {{ __('pages.product.reviews_status') }}</a>
            </div>
            <div>
              @if($product->hasDiscount())
                <h3 class="product-price">{{ currency($product->discountedPrice) }}
                  <del class="product-old-price">{{ currency($product->price) }}</del>
                </h3>
              @else
                <h3 class="product-price">{{ currency($product->price) }}</h3>
              @endif
              <span class="product-available">
                                @if($product->isInStock())
                  {{ __('pages.product.in_stock') }}
                @else
                  {{ __('pages.product.not_in_stock') }}
                @endif
                            </span>
            </div>
            <p>{!! $product->details !!}</p>

            <div class="product-options">
              {{--<label>
                  Size
                  <select class="input-select">
                      <option value="0">X</option>
                  </select>
              </label>
              <label>
                  Color
                  <select class="input-select">
                      <option value="0">Red</option>
                  </select>
              </label>--}}
            </div>

            <cart-add-multiple
              product-code="{{ $product->code }}"
              link="{{ route('cart.store') }}"
            ></cart-add-multiple>

            <wish-list-add
              product-code="{{ $product->code }}"
              link="{{ route('wishlist.store') }}"
              :as-link="true"
            >
            </wish-list-add>

            <ul class="product-links">
              <li>{{ __('pages.product.brand') }}:</li>
              <li><a
                    href="{{ route('store', ['brand' => $product->manufacturer->name]) }}">{{ $product->manufacturer->name }}</a>
              </li>
            </ul>
            <ul class="product-links">
              <li>{{ __('pages.product.category') }}:</li>
              <li><a
                    href="{{ route('store', ['category' => $product->category->name]) }}">{{ $product->category->name }}</a>
              </li>
            </ul>

            <ul class="product-links">
              <li>{{ __('pages.product.share') }}:</li>
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              <li><a href="#"><i class="fa fa-envelope"></i></a></li>
            </ul>

          </div>
        </div>
        <!-- /Product details -->

        <!-- Product tab -->
        <div class="col-md-12">
          <div id="product-tab">
            <!-- product tab nav -->
            <ul class="tab-nav">
              <li class="active"><a data-toggle="tab" href="#tab1">{{ __('pages.product.description') }}</a></li>
              <li><a data-toggle="tab" href="#tab2">{{ __('pages.product.details') }}</a></li>
              <li><a data-toggle="tab" href="#tab3">{{ __('pages.product.reviews') }} ({{ $totalCommentCount }})</a>
              </li>
            </ul>
            <!-- /product tab nav -->

            <!-- product tab content -->
            <div class="tab-content">
              <!-- tab1  -->
              <div id="tab1" class="tab-pane fade in active">
                <div class="row">
                  <div class="col-md-12">
                    <p>{!! $product->description !!}</p>
                  </div>
                </div>
              </div>
              <!-- /tab1  -->

              <!-- tab2  -->
              <div id="tab2" class="tab-pane fade in">
                <div class="row">
                  <div class="col-md-12">
                    <p>{!! $product->details !!}</p>
                  </div>
                </div>
              </div>
              <!-- /tab2  -->

              <!-- tab3  -->
              <div id="tab3" class="tab-pane fade in">
                <div class="row">
                  <!-- Rating -->
                @include('components.reviews.rating')
                <!-- /Rating -->

                  <!-- Reviews -->
                @include('components.reviews.comments')
                <!-- /Reviews -->

                  <!-- Review Form -->
                @include('components.reviews.comment_form')
                <!-- /Review Form -->
                </div>
              </div>
              <!-- /tab3  -->
            </div>
            <!-- /product tab content  -->
          </div>
        </div>
        <!-- /product tab -->
        {{--<hr>
        <!-- section title -->
        <div class="col-md-12">
            <div class="section-title">
                <h3 class="title">Might also like</h3>
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

                        @foreach($might_also_like as $product)
                            <!-- product -->
                            @include('components.product_tab')
                            <!-- /product -->
                            @endforeach()


                        </div>
                        <div id="slick-nav-1" class="products-slick-nav"></div>
                    </div>
                    <!-- /tab -->
                </div>
            </div>
        </div>
        <!-- Products tab & slick -->--}}
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION -->
  <!-- Section -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">

        <div class="col-md-12">
          <div class="section-title text-center">
            <h3 class="title">{{ __('pages.product.related_products') }}</h3>
          </div>
        </div>

      @foreach($related_products as $product)
        <!-- product -->
          <div class="col-md-3 col-xs-6">
            @component('components.product_tab', [
                'product' => $product
            ])@endcomponent
          </div>
          <!-- /product -->
        @endforeach()

      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /Section -->
@endsection()