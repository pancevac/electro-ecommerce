<ul class="newsletter-follow">
    @foreach($items as $item_menu)
    <li>
        <a href="{{ $item_menu->link() }}"><i class="fa {{ $item_menu->title }}"></i></a>
    </li>
    @endforeach
    {{--<li>
        <a href="#"><i class="fa fa-twitter"></i></a>
    </li>
    <li>
        <a href="#"><i class="fa fa-instagram"></i></a>
    </li>
    <li>
        <a href="#"><i class="fa fa-pinterest"></i></a>
    </li>--}}
</ul>