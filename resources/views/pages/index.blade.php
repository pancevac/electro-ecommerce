@extends('layouts.app')

@section('title')
    Home
@endsection()

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
                        <h3>Laptop<br>Collection</h3>
                        <a href="{{ route('store', ['category' => 'Laptops']) }}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
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
                        <h3>Accessories<br>Collection</h3>
                        <a href="{{ route('store', ['category' => 'Accessories']) }}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
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
                        <h3>Cameras<br>Collection</h3>
                        <a href="{{ route('store', ['category' => 'Cameras']) }}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
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
                    <h3 class="title">Featured</h3>
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

                                @foreach($featured_products as $product)
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
                    <h2 class="text-uppercase">hot deal this week</h2>
                    <p>New Collection Up to 50% OFF</p>
                    <a class="primary-btn cta-btn" href="#">Shop now</a>
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
                    <h3 class="title">New Products</h3>
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

                                @foreach($new_products as $product)

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
                    <h4 class="title">Top selling</h4>
                    <div class="section-nav">
                        <div id="slick-nav-3" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-3">
                    <div>
                        @if($top_sales)
                            @foreach($top_sales->take(3) as $top_sale)
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{ productImage($top_sale->image) }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $top_sale->categoryName }}</p>
                                        <h3 class="product-name"><a href="{{ route('product', ['id' => $top_sale->id]) }}">{{ $top_sale->name }}</a></h3>
                                        @if(isset($top_sale->percentOff))
                                            <h4 class="product-price">${{ calculateDiscountPrice($top_sale->price, $top_sale->percentOff) }} <del class="product-old-price">${{ $top_sale->price }}</del></h4>
                                        @else
                                            <h4 class="product-price">${{ $top_sale->price }}</h4>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <strong>No top sales products</strong>
                        @endif
                    </div>

                    <div>
                        @if($top_sales)
                            @foreach($top_sales->slice(2) as $top_sale)
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{ productImage($top_sale->image) }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $top_sale->categoryName }}</p>
                                        <h3 class="product-name"><a href="{{ route('product', ['id' => $top_sale->id]) }}">{{ $top_sale->name }}</a></h3>
                                        @if(isset($top_sale->percentOff))
                                            <h4 class="product-price">${{ calculateDiscountPrice($top_sale->price, $top_sale->percentOff) }} <del class="product-old-price">${{ $top_sale->price }}</del></h4>
                                        @else
                                            <h4 class="product-price">${{ $top_sale->price }}</h4>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <strong>No top sales products</strong>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Might Also Like</h4>
                    <div class="section-nav">
                        <div id="slick-nav-4" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-4">
                    <div>
                        @if($might_also_like)
                            @foreach($might_also_like->take(3) as $product)
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{ productImage($product->image) }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $product->category->name }}</p>
                                        <h3 class="product-name"><a href="{{ route('product', ['id' => $product->id]) }}">{{ $product->name }}</a></h3>
                                        @if(isset($product->discount->percent_off))
                                            <h4 class="product-price">${{ calculateDiscountPrice($product->price, $product->discount->percent_off) }} <del class="product-old-price">${{ $product->price }}</del></h4>
                                        @else
                                            <h4 class="product-price">${{ $product->price }}</h4>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <strong>No top sales products</strong>
                        @endif
                    </div>

                    <div>
                        @if($top_sales)
                            @foreach($top_sales->slice(2) as $top_sale)
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{ productImage($top_sale->image) }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $top_sale->categoryName }}</p>
                                        <h3 class="product-name"><a href="{{ route('product', ['id' => $top_sale->id]) }}">{{ $top_sale->name }}</a></h3>
                                        @if(isset($product->percentOff))
                                            <h4 class="product-price">${{ calculateDiscountPrice($product->price, $product->percentOff) }} <del class="product-old-price">${{ $product->price }}</del></h4>
                                        @else
                                            <h4 class="product-price">${{ $product->price }}</h4>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <strong>No top sales products</strong>
                        @endif
                    </div>
                </div>
            </div>

            <div class="clearfix visible-sm visible-xs"></div>

            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Discount</h4>
                    <div class="section-nav">
                        <div id="slick-nav-5" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-5">
                    @if($discounts)
                    <div>
                            @foreach($discounts->take(3) as $discount)
                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{ productImage($discount->image) }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $discount->category->name }}</p>
                                        <h3 class="product-name"><a href="{{ route('product', ['id' => $discount->id]) }}">{{ $discount->name }}</a></h3>
                                        @if(isset($discount->discount->percent_off))
                                            <h4 class="product-price">${{ calculateDiscountPrice($discount->price, $discount->discount->percent_off) }} <del class="product-old-price">${{ $discount->price }}</del></h4>
                                        @else
                                            <h4 class="product-price">${{ $discount->price }}</h4>
                                        @endif
                                    </div>
                                </div>
                                <!-- /product widget -->
                            @endforeach
                            @endif
                    </div>

                    @if($discounts->slice(2)->isEmpty())
                    <div>
                        @foreach($discounts->slice(2) as $discount)
                            <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{ productImage($discount->image) }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $discount->category->name }}</p>
                                        <h3 class="product-name"><a href="{{ route('product', ['id' => $discount->id]) }}">{{ $discount->name }}</a></h3>
                                        @if(isset($discount->discount->percent_off))
                                            <h4 class="product-price">${{ calculateDiscountPrice($discount->price, $discount->discount->percent_off) }} <del class="product-old-price">${{ $discount->price }}</del></h4>
                                        @else
                                            <h4 class="product-price">${{ $discount->price }}</h4>
                                        @endif
                                    </div>
                                </div>
                                <!-- /product widget -->
                        @endforeach
                    </div>
                        @endif
                </div>
            </div>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION MINI TOP SELLING-->
@endsection()