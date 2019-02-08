@if($products)
  @foreach($products as $product)
    <div class="product-widget">
      <div class="product-img" style="padding-top: 60px">

        <lazy-image
          src="{{ $product->smallImage }}"
        ></lazy-image>

      </div>
      <div class="product-body">

        <p class="product-category">{{ $product->category->name }}</p>
        <h3 class="product-name">
          <a href="{{ $product->getUrl() }}">{{ $product->get('name') }}</a>
        </h3>
        @if($product->hasDiscount())
          <h4 class="product-price">{{ currency($product->discountedPrice) }}
            <del class="product-old-price">{{ currency($product->price) }}</del>
          </h4>
        @else
          <h4 class="product-price">{{ currency($product->price) }}</h4>
        @endif
      </div>
    </div>
  @endforeach
@else
  <strong>No top sales products</strong>
@endif