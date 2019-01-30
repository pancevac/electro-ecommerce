<div class="product">
    <div class="product-img">
        <img src="{{ productImage($product->image) }}" alt="">
        <div class="product-label">
            @if(isset($product->discount->percent_off))
                <span class="sale">-{{ $product->discount->percent_off }}%</span>
            @endif
                @if(newProducts($product->created_at))
                    <span class="new">{{ __('partials.product.new') }}</span>
                @endif
        </div>
    </div>
    {{ Form::open(['method' => 'PUT', 'route' => ['wishlist.update', $product->id]]) }}
    <button id="submit-wishlist" type="submit" style="display:none"></button>
    {{ Form::close() }}
    <div class="product-body">
        <p class="product-category">{{ $product->category->name }}</p>

        <h3 class="product-name"><a href="{{ $product->getUrl() }}">{{ $product->get('name') }}</a></h3>
        @if(isset($product->discount->percent_off))
            <h4 class="product-price">${{ calculateDiscountPrice($product->price, $product->discount->percent_off) }} <del class="product-old-price">${{ $product->price }}</del></h4>
        @else
            <h4 class="product-price">${{ $product->price }}</h4>
        @endif
        <div class="product-rating">
            @for($i = 0; $i < round($product->averageProductRate); $i++)

                <i class="fa fa-star"></i>

            @endfor
            @for($i = 0; $i < 5 - round($product->averageProductRate); $i++)

                <i class="fa fa-star-o"></i>

            @endfor
        </div>
        <div class="product-btns">
            <button class="add-to-wishlist" onclick="document.getElementById('submit-wishlist').click()"><i class="fa fa-heart-o"></i><span class="tooltipp">{{ __('partials.product.add_to_wish_list') }}</span></button>
            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">{{ __('partials.product.add_to_compare') }}</span></button>
            <button class="quick-view" onclick="window.location.href='{{ route('product', ['id' => $product->id]) }}'"><i class="fa fa-eye"></i><span class="tooltipp">{{ __('partials.product.quick_view') }}</span></button>
        </div>
    </div>
    <div class="add-to-cart">
        {{ Form::open(['method' => 'PUT', 'route' => ['cart.update', $product->id]]) }}
        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> {{ __('partials.product.add_to_cart') }}</button>
        {{ Form::close() }}
    </div>
</div>