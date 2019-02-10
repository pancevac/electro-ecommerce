@extends('layouts.app')

@section('js')
    <script>
        $('#sortBy').on('change', function (e) {
            var selected = $(this).val();
            document.location.href = '{{ route('store', ['category' => request()->category, 'brand' => request()->brand, 'show' => request()->show]) }}&sort='+selected;
        });
        $('#show').on('change', function (e) {
            var selectedShow = $(this).val();
            document.location.href = '{{ route('store', ['category' => request()->category, 'brand' => request()->brand, 'sort' => request()->sort]) }}&show='+selectedShow;
        });
    </script>
@endsection
@section('breadcrumbs', Breadcrumbs::render('store', request()))

@section('content')



    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">{{ __('pages.shop.categories') }}</h3>
                        <div class="checkbox-filter">

                            @foreach($categories as $category)

                                <div class="input-checkbox">
                                    <input type="checkbox" id="category-{{ $category->id }}"
                                           onclick="window.location.href='{{ route('store', ['category' => $category->name]) }}'" {{ request()->category == $category->name  ? 'checked' : ''}}>
                                    <label for="category-{{ $category->id }}">
                                        <span></span>
                                        {{ $category->name }}
                                        <small>({{ count($category->products) }})</small>
                                    </label>
                                </div>

                            @endforeach

                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">{{ __('pages.shop.price') }}</h3>
                        <div class="price-filter">
                            <div id="price-slider"></div>
                            <div class="input-number price-min">
                                <input id="price-min" type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                            <span>-</span>
                            <div class="input-number price-max">
                                <input id="price-max" type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Brand</h3>
                        <div class="checkbox-filter">

                            @foreach($brands as $brand)

                                <div class="input-checkbox">
                                    <input type="checkbox" id="brand-{{ $brand->id }}"
                                           onclick="window.location.href='{{ route('store', ['category' => request()->category, 'brand' => $brand->name]) }}'" {{ request()->brand == $brand->name  ? 'checked' : '' }}>
                                    <label for="brand-{{ $brand->id }}">
                                        <span></span>
                                        {{ strtoupper($brand->name) }}
                                        <small>({{ count($brand->product_qty) }})</small>
                                    </label>
                                </div>

                            @endforeach

                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">{{ __('pages.shop.top_selling') }}</h3>

                        @include('components.product_widget', [
                            'products' => $topSales
                        ])

                    </div>
                    <!-- /aside Widget -->
                </div>
                <!-- /ASIDE -->

                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- store top filter -->
                    <div class="store-filter clearfix">
                        <div class="store-sort">
                            <label>
                                {{ __('pages.shop.sort_by') }}:
                                <select class="input-select" id="sortBy">
                                    <option value="price_up" {{ request()->sort == 'price_up' ? 'selected="selected"' : ''}}>{{ __('pages.shop.price_up') }}</option>
                                    <option value="price_down" {{ request()->sort == 'price_down' ? 'selected="selected"' : ''}}>{{ __('pages.shop.price_down') }}</option>
                                </select>
                            </label>

                            <label>
                                {{ __('pages.shop.show') }}:
                                <select class="input-select" id="show">
                                    <option value="9">9</option>
                                    <option value="18">18</option>
                                </select>
                            </label>
                        </div>
                        <ul class="store-grid">
                            <li class="active"><i class="fa fa-th"></i></li>
                            <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                        </ul>
                    </div>
                    <!-- /store top filter -->

                    <!-- store products -->
                    <div class="row">
                        @foreach($products as $product)
                            <!-- product -->
                            <div class="col-md-4 col-xs-6">
                                @include('components.product_tab')
                            </div>
                            <!-- /product -->

                            @if($loop->iteration == 2)
                                    <div class="clearfix visible-sm visible-xs"></div>
                                @endif
                            @if($loop->iteration == 3)
                                    <div class="clearfix visible-lg visible-md"></div>
                                @endif
                            @if($loop->iteration == 4)
                                    <div class="clearfix visible-sm visible-xs"></div>
                                @endif
                            @if($loop->iteration == 6)
                                    <div class="clearfix visible-lg visible-md visible-sm visible-xs"></div>
                                @endif
                            @if($loop->iteration == 8)
                                    <div class="clearfix visible-sm visible-xs"></div>
                                @endif
                        @endforeach()



                    </div>
                    <!-- store bottom filter -->
                        <div class="store-filter clearfix">
                            <span class="store-qty">Showing {{ $products->count() }}-{{ $products->total() }} products</span>
                            {{ $products->appends(request()->input())->links('vendor.pagination.custom_shop_pagination') }}
                        </div>
                            {{--{{ $products->links() }}--}}
                            {{-- Appends query string in url and add pagination query --}}
                            {{--{{ $products->appends(request()->input())->links('vendor.pagination.custom_pagination') }}--}}
                        <!-- /store bottom filter -->
                </div>
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

@endsection()