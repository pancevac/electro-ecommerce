@extends('layouts.app')

@section('title')
    Product
@endsection()

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
                        <h2 class="product-name">{{ $product->name }}</h2>
                        <div>
                            <div class="product-rating">
                                @php
                                    $averageRate = $product->averageProductRate;
                                @endphp
                                @for($i = 0; $i < round($product->averageProductRate); $i++)

                                    <i class="fa fa-star"></i>

                                @endfor
                                @for($i = 0; $i < 5 - round($product->averageProductRate); $i++)

                                    <i class="fa fa-star-o"></i>

                                @endfor
                            </div>
                            @php
                                $totalCommentCount = $product->totalCommentsCount
                            @endphp
                            <a class="review-link" href="#tab3">{{ $totalCommentCount }} Review(s) | Add your review</a>
                        </div>
                        <div>
                            @if(isset($product->discount->percent_off))
                                <h3 class="product-price">${{ calculateDiscountPrice($product->price, $product->discount->percent_off) }} <del class="product-old-price">${{ $product->price }}</del></h3>
                            @else
                                <h3 class="product-price">${{ $product->price }}</h3>
                            @endif
                            <span class="product-available">@if($product->stock) In Stock @else Not In Stock @endif</span>
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
                        {{ Form::open(['method' => 'PUT', 'route' => ['cart.update', $product->id]]) }}
                        <div class="add-to-cart">
                            <div class="qty-label">
                                Qty
                                <div class="input-number">
                                    <input type="number" name="qty" value="1">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>
                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart" type="submit"></i> add to cart</button>
                        </div>
                        {{ Form::close() }}

                        <ul class="product-btns">
                            {{ Form::open(['id' => 'wishlist-form','method' => 'PUT', 'route' => ['wishlist.update', $product->id]]) }}
                            <li><a onclick="document.getElementById('wishlist-form').submit();"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                            {{ Form::close() }}
                        </ul>
                        <ul class="product-links">
                            <li>Brand:</li>
                            <li><a href="{{ route('store', ['brand' => $product->manufacturer->name]) }}">{{ $product->manufacturer->name }}</a></li>
                        </ul>
                        <ul class="product-links">
                            <li>Category:</li>
                            <li><a href="{{ route('store', ['category' => $product->category->name]) }}">{{ $product->category->name }}</a></li>
                        </ul>

                        <ul class="product-links">
                            <li>Share:</li>
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
                            <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                            <li><a data-toggle="tab" href="#tab2">Details</a></li>
                            <li><a data-toggle="tab" href="#tab3">Reviews ({{ $totalCommentCount }})</a></li>
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
                        <h3 class="title">Related Products</h3>
                    </div>
                </div>
            @foreach($related_products as $product)

                <!-- product -->
                    <div class="col-md-3 col-xs-6">
                        @include('components.product_tab')
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