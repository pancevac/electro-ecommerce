@extends('layouts.app')

@section('title', 'Wish list')

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
                        <h3 class="title">Your wish list ({{ $products->count() }})</h3>
                        <div class="section-nav">
                            @if($products->count())
                            {{ Form::open(['method' => 'POST', 'route' => 'wishlist.store']) }}
                                <button class="primary-btn order-submit" type="submit" name="submit" value="submit">Add all to shopping cart</button>
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
                                    @include('components.product_tab_wishlist')
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