<div class="products-widget-slick" data-nav="#slick-nav-{{ $widgetId }}">

  @if($products)

    @foreach($products->chunk(4) as $chunk)

      <div>

        @foreach($chunk->take(3) as $item)

          <div class="product-widget">
            <div class="product-img" style="padding-top: 60px">

              <lazy-image
                  src="{{ $item->smallImage }}"
              ></lazy-image>

            </div>
            <div class="product-body">
              <p class="product-category">{{ $item->category->name }}</p>
              <h3 class="product-name">
                <a href="{{ $item->getUrl() }}">{{ $item->get('name') }}</a>
              </h3>

              @if($item->hasDiscount())
                <h4 class="product-price">{{ currency($item->discountedPrice) }}
                  <del class="product-old-price">{{ currency($item->price) }}</del>
                </h4>
              @else
                <h4 class="product-price">{{ currency($item->price) }}</h4>
              @endif

            </div>
          </div>

        @endforeach

      </div>

    @endforeach

  @else
    <strong>No products</strong>
  @endif
</div>