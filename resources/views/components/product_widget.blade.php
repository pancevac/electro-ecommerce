@if($top_sales)
    @foreach($top_sales as $top_sale)
        <div class="product-widget">
            <div class="product-img">
                <img src="{{ productImage($top_sale->image) }}" alt="">
            </div>
            <div class="product-body">
                <p class="product-category">{{ $top_sale->category->name }}</p>
                <h3 class="product-name"><a href="{{ route('product', ['id' => $top_sale->id]) }}">{{ $top_sale->name }}</a></h3>
                @if(isset($top_sale->discount->percent_off))
                    <h4 class="product-price">${{ calculateDiscountPrice($top_sale->price, $top_sale->discount->percent_off) }} <del class="product-old-price">${{ $top_sale->price }}</del></h4>
                @else
                    <h4 class="product-price">${{ $top_sale->price }}</h4>
                @endif
            </div>
        </div>
    @endforeach
@else
    <strong>No top sales products</strong>
@endif