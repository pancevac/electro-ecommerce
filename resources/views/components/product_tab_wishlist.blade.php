<div class="product">
  <div class="product-img">
    <img src="{{ productImage($product->model->image) }}" alt="">
    <div class="product-label">
      @if($product->model->hasDiscount())
        <span class="sale">-{{ $product->model->discount->percent_off }}%</span>
      @endif
        @if(newProducts($product->model->created_at))
          <span class="new">{{ __('partials.product.new') }}</span>
        @endif
      <a href="#" onclick="document.getElementById('remove-wishlist').click()"><i class="fa fa-close" type="submit"></i></a>
    </div>
  </div>

  {{ Form::open(['method' => 'delete', 'route' => ['wishlist.destroy', $product->rowId]]) }}
  <button id="remove-wishlist" type="submit" style="display:none"></button>
  {{ Form::close() }}

  <div class="product-body">
    <p class="product-category">{{ $product->model->category->name }}</p>

    <h3 class="product-name"><a href="{{ $product->model->getUrl() }}">{{ $product->model->name }}</a></h3>

    @if($product->model->hasDiscount())
      <h4 class="product-price">{{ currency($product->model->discountedPrice) }}
        <del class="product-old-price">{{ currency($product->model->price) }}</del>
      </h4>
    @else
      <h4 class="product-price">{{ currency($product->model->price) }}</h4>
    @endif
    <div class="product-rating">
      @for($i = 0; $i < round($product->model->averageRate); $i++)

        <i class="fa fa-star"></i>

      @endfor
      @for($i = 0; $i < 5 - round($product->model->averageRate); $i++)

        <i class="fa fa-star-o"></i>

      @endfor
    </div>
    <div class="product-btns">
      <button class="add-to-compare"><i class="fa fa-exchange"></i><span
            class="tooltipp">{{ __('partials.product.add_to_compare') }}</span></button>
      <button class="quick-view" onclick="window.location.href='{{ route('product', ['id' => $product->id]) }}'"><i
            class="fa fa-eye"></i><span class="tooltipp">{{ __('partials.product.quick_view') }}</span></button>
    </div>
  </div>

  <cart-add
      product-code="{{ $product->model->code }}"
      link="{{ route('cart.store') }}"
  ></cart-add>

</div>