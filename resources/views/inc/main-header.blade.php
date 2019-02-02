@section('css')
  <link type="text/css" rel="stylesheet" href="{{ asset('css/algolia.css') }}"/>
@endsection
@section('js')
  <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
  <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
  <script src="{{ asset('js/algolia.js') }}"></script>
@endsection
<!-- MAIN HEADER -->
<div id="header">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      <!-- LOGO -->
      <div class="col-md-3">
        <div class="header-logo">
          <a href="{{ asset('/') }}" class="logo">
            <img src="{{ asset('storage/'.setting('site.logo')) }}" alt="">
          </a>
        </div>
      </div>
      <!-- /LOGO -->

      <!-- SEARCH BAR -->
      <div class="col-md-6">
        <!-- HTML Markup -->
        <div class="aa-input-container" id="aa-input-container">
          <input type="search" id="aa-search-input" class="aa-input-search" placeholder="Search products..."
                 name="search" autocomplete="off"/>
          <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
            <path
                d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z"/>
          </svg>
        </div>
        {{--<div id="aa-input-container" class="header-search aa-input-container">
            <form>
                <select class="input-select">
                    <option value="0">All Categories</option>
                    @foreach(\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach()
                </select>
                <input id="aa-search-input" class="input aa-input-search" placeholder="Search here" type="search">
                --}}{{--<svg class="aa-input-icon" viewBox="654 -372 1664 1664">
                    <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
                </svg>--}}{{--
                <button class="search-btn">Search</button>
            </form>
        </div>--}}
      </div>
      <!-- /SEARCH BAR -->

      <!-- ACCOUNT -->
      <div class="col-md-3 clearfix">
        <div class="header-ctn">
          <!-- Wishlist -->
          <div>
            <a href="{{ route('wishlist.index') }}">
              <i class="fa fa-heart-o"></i>
              <span>{{ __('partials.header.wish_list') }}</span>
              <div class="qty">{{ Cart::instance('wishlist')->count() }}</div>
            </a>
          </div>
          <!-- /Wishlist -->

          <cart-drop-menu
            cart-link="{{ route('cart.index') }}"
            checkout-link="{{ route('checkout.index') }}"
          ></cart-drop-menu>

          <cart-loader
            :cart-items="{{ getCartItems(true) }}"
            cart-total-price="{{ getTotalPrice() }}"
            cart-count="{{ getCartCount() }}"
          ></cart-loader>

          <!-- Menu Toogle -->
          <div class="menu-toggle">
            <a href="#">
              <i class="fa fa-bars"></i>
              <span>Menu</span>
            </a>
          </div>
          <!-- /Menu Toogle -->
        </div>
      </div>
      <!-- /ACCOUNT -->
    </div>
    <!-- row -->
  </div>
  <!-- container -->
</div>
<!-- /MAIN HEADER -->