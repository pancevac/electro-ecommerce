@extends('layouts.app')

@section('content')
  <!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
    @foreach(Cart::content() as $c)
      {{ $c->options->has('image') }}
    @endforeach
    <!-- row -->
      <div class="row">
        <!-- shop -->
        <div class="col-md-4 col-xs-6">
          <div class="shop">
            <div class="shop-img">
              <img src="./img/shop01.png" alt="">
            </div>
            <div class="shop-body">
              {!! __('pages.home.laptop_collection') !!}
              <a href="{{ route('store', ['category' => 'Laptops']) }}" class="cta-btn">{{ __('pages.home.button2') }}
                <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /shop -->

        <!-- shop -->
        <div class="col-md-4 col-xs-6">
          <div class="shop">
            <div class="shop-img">
              <img src="./img/shop03.png" alt="">
            </div>
            <div class="shop-body">
              {!! __('pages.home.accessories_collection') !!}
              <a href="{{ route('store', ['category' => 'Accessories']) }}"
                 class="cta-btn">{{ __('pages.home.button2') }} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /shop -->

        <!-- shop -->
        <div class="col-md-4 col-xs-6">
          <div class="shop">
            <div class="shop-img">
              <img src="./img/shop02.png" alt="">
            </div>
            <div class="shop-body">
              {!! __('pages.home.cameras_collection') !!}
              <a href="{{ route('store', ['category' => 'Cameras']) }}" class="cta-btn">{{ __('pages.home.button2') }}
                <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /shop -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION -->

  <!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">

        <!-- section title -->
        <div class="col-md-12">
          <div class="section-title">
            <h3 class="title">{{ __('pages.home.featured') }}</h3>
            {{ menu('section-nav', 'components.menus.section-nav') }}
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

                  @foreach($featuredProducts as $product)

                    @component('components.product_tab', [
                      'product' => $product
                    ])
                    @endcomponent

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

  <!-- HOT DEAL SECTION -->
  <div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <div class="hot-deal">
            <ul class="hot-deal-countdown">
              <li>
                <div>
                  <h3>02</h3>
                  <span>Days</span>
                </div>
              </li>
              <li>
                <div>
                  <h3>10</h3>
                  <span>Hours</span>
                </div>
              </li>
              <li>
                <div>
                  <h3>34</h3>
                  <span>Mins</span>
                </div>
              </li>
              <li>
                <div>
                  <h3>60</h3>
                  <span>Secs</span>
                </div>
              </li>
            </ul>
            {!!  __('pages.home.desc1') !!}
            {!! __('pages.home.desc2') !!}
            <a class="primary-btn cta-btn" href="#">{{ __('pages.home.button') }}</a>
          </div>
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /HOT DEAL SECTION -->

  <!-- SECTION TOP SELLING-->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">

        <!-- section title -->
        <div class="col-md-12">
          <div class="section-title">
            <h3 class="title">{{ __('pages.home.new_products') }}</h3>
            {{ menu('section-nav', 'components.menus.section-nav') }}
          </div>
        </div>
        <!-- /section title -->

        <!-- Products tab & slick -->
        <div class="col-md-12">
          <div class="row">
            <div class="products-tabs">
              <!-- tab -->
              <div id="tab2" class="tab-pane fade in active">
                <div class="products-slick" data-nav="#slick-nav-2">

                  @foreach($newProducts as $product)

                    @include('components.product_tab')

                  @endforeach()

                </div>
                <div id="slick-nav-2" class="products-slick-nav"></div>
              </div>
              <!-- /tab -->
            </div>
          </div>
        </div>
        <!-- /Products tab & slick -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION TOP SELLING-->

  <!-- SECTION MINI TOP SELLING-->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <div class="col-md-4 col-xs-6">
          <div class="section-title">
            <h4 class="title">{{ __('pages.home.top_selling') }}</h4>
            <div class="section-nav">
              <div id="slick-nav-3" class="products-slick-nav"></div>
            </div>
          </div>

          @component('components.product_widget_slick', [
            'products' => $topSales,
            'widgetId' => 3,
          ])
          @endcomponent

        </div>

        <div class="col-md-4 col-xs-6">
          <div class="section-title">
            <h4 class="title">{{ __('pages.home.might_also_like') }}</h4>
            <div class="section-nav">
              <div id="slick-nav-4" class="products-slick-nav"></div>
            </div>
          </div>

          @component('components.product_widget_slick', [
            'products' => $mightAlsoLike,
            'widgetId' => 4,
          ])
          @endcomponent

        </div>

        <div class="clearfix visible-sm visible-xs"></div>

        <div class="col-md-4 col-xs-6">
          <div class="section-title">
            <h4 class="title">{{ __('pages.home.discount') }}</h4>
            <div class="section-nav">
              <div id="slick-nav-5" class="products-slick-nav"></div>
            </div>
          </div>

          @component('components.product_widget_slick', [
            'products' => $discounts,
            'widgetId' => 5,
          ])
          @endcomponent

        </div>

      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION MINI TOP SELLING-->
@endsection()