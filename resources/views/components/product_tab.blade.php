<div class="product">
  <div class="product-img" style="padding-top: 100%">

    <lazy-image
        src="{{ $product->thumbImage }}"
    ></lazy-image>

    <div class="product-label">
      @if($product->hasDiscount())
        <span class="sale">-{{ $product->discount->percent_off }}%</span>
      @endif
      @if(newProducts($product->created_at))
        <span class="new">{{ __('partials.product.new') }}</span>
      @endif
    </div>
  </div>

  <div class="product-body">
    <p class="product-category">{{ $product->category->name }}</p>

    <h3 class="product-name"><a href="{{ $product->getUrl() }}">{{ $product->get('name') }}</a></h3>
    @if($product->hasDiscount())
      <h4 class="product-price">{{ currency($product->discountedPrice) }}
        <del class="product-old-price">{{ currency($product->price) }}</del>
      </h4>
    @else
      <h4 class="product-price">{{ currency($product->price) }}</h4>
    @endif
    <div class="product-rating">
      @for($i = 0; $i < round($product->averageRate); $i++)

        <i class="fa fa-star"></i>

      @endfor
      @for($i = 0; $i < 5 - round($product->averageRate); $i++)

        <i class="fa fa-star-o"></i>

      @endfor
    </div>
    <div class="product-btns">

      <wish-list-add
          link="{{ route('wishlist.store') }}"
          product-code="{{ $product->code }}"
      ></wish-list-add>

      <button class="add-to-compare"><i class="fa fa-exchange"></i><span
            class="tooltipp">{{ __('partials.product.add_to_compare') }}</span></button>
      <button class="quick-view" onclick="window.location.href='{{ route('product', ['id' => $product->id]) }}'"><i
            class="fa fa-eye"></i><span class="tooltipp">{{ __('partials.product.quick_view') }}</span></button>
    </div>
  </div>

  <cart-add
      product-code="{{ $product->code }}"
      link="{{ route('cart.store') }}"
  ></cart-add>

</div>