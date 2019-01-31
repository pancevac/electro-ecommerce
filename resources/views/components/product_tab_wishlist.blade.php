<div class="product">
    <div class="product-img">
        <img src="{{ productImage($product->model->image) }}" alt="">
        <div class="product-label">
            @if(isset($product->model->discount->percent_off))
                <span class="sale">-{{ $product->model->discount->percent_off }}%</span>
            @endif
            <span class="new">{{ __('partials.product.new') }}</span>
            <a href="#" onclick="document.getElementById('remove-wishlist').click()"><i class="fa fa-close" type="submit"></i></a>
        </div>
    </div>
    {{ Form::open(['method' => 'delete', 'route' => ['wishlist.destroy', $product->rowId]]) }}
    <button id="remove-wishlist" type="submit" style="display:none"></button>
    {{ Form::close() }}
    <div class="product-body">
        <p class="product-category">{{ $product->model->category->name }}</p>
        <h3 class="product-name"><a href="{{ $product->url() }}">{{ $product->name }}</a></h3>
        @if(isset($product->model->discount->percent_off))
            <h4 class="product-price">${{ calculateDiscountPrice($product->price, $product->model->discount->percent_off) }} <del class="product-old-price">${{ $product->price }}</del></h4>
        @else
            <h4 class="product-price">${{ $product->price }}</h4>
        @endif
        <div class="product-rating">
            @for($i = 0; $i < round($product->model->averageRate()); $i++)

                <i class="fa fa-star"></i>

            @endfor
            @for($i = 0; $i < 5 - round($product->model->averageRate()); $i++)

                <i class="fa fa-star-o"></i>

            @endfor
        </div>
        <div class="product-btns">
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