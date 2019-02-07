<div class="product">
  <div class="product-img" style="padding-top: 100%">

    <lazy-image
        src="{{ $item->model->thumbImage }}"
    ></lazy-image>

    <div class="product-label">
      @if($item->model->hasDiscount())
        <span class="sale">-{{ $item->model->discount->percent_off }}%</span>
      @endif
      @if($item->qty > 1)
        <span class="new">{{ $item->qty }}x</span>
      @endif
        @if(newProducts($item->model->created_at))
          <span class="new">{{ __('partials.product.new') }}</span>
        @endif

        <a href="#" onclick="document.getElementById('form_cart_del_{{ $item->rowId }}').submit()">
          <i class="fa fa-close" type="submit"></i>
        </a>

    </div>
  </div>

  {{ Form::open(['method' => 'delete', 'id' => "form_cart_del_$item->rowId", 'route' => ['cart.destroy', $item->rowId]]) }}
  {{ Form::close() }}

  <div class="product-body">
    <p class="product-category">{{ $item->model->category->name }}</p>

    <h3 class="product-name">
      <a href="{{ $item->model->getUrl() }}">
        @if($item->qty > 1) {{ $item->qty }}
        x @endif {{ $item->name }}
      </a>
    </h3>

    @if($item->model->hasDiscount())
      <h4 class="product-price">{{ currency($item->model->discountedPrice) }}
        <del class="product-old-price">{{ currency($item->model->price) }}</del>
      </h4>
    @else
      <h4 class="product-price">{{ currency($item->model->price) }}</h4>
    @endif

    <div class="product-rating">
      @for($i = 0; $i < round($item->model->averageRate); $i++)

        <i class="fa fa-star"></i>

      @endfor
      @for($i = 0; $i < 5 - round($item->model->averageRate); $i++)

        <i class="fa fa-star-o"></i>

      @endfor
    </div>
    <div class="product-btns">

      <wish-list-add
        link="{{ route('wishlist.store') }}"
        product-code="{{ $item->model->code }}"
      ></wish-list-add>

      <button class="add-to-compare">
        <i class="fa fa-exchange"></i>
        <span class="tooltipp">{{ __('partials.product.add_to_compare') }}</span>
      </button>

      <button
          class="quick-view"
          onclick="window.location.href='{{ route('product', ['id' => $item->id]) }}'"
      >
        <i class="fa fa-eye"></i>
        <span class="tooltipp">{{ __('partials.product.quick_view') }}</span>
      </button>
    </div>
  </div>

</div>