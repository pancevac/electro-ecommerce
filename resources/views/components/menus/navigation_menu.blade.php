<ul class="main-nav nav navbar-nav">
    @foreach($items as $menu_item)
        <li @if($loop->index == 0) id="home-page" @endif><a href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a></li>
    @endforeach
    {{--<li class="active"><a href="{{ route('frontend.index') }}">Home</a></li>
    <li><a href="{{ route('store') }}">Shop</a></li>
    <li><a href="#">Hot Deals</a></li>
    <li><a href="#">Categories</a></li>
    <li><a href="#">Laptops</a></li>
    <li><a href="#">Smartphones</a></li>
    <li><a href="#">Cameras</a></li>
    <li><a href="#">Accessories</a></li>--}}
</ul>