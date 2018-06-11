@foreach($items as $parent_menu)
    <div class="col-md-3 col-xs-6">
        <div class="footer">
            <h3 class="footer-title">{{ $parent_menu->title }}</h3>
            <ul class="footer-links">
                @foreach($parent_menu->children as $child_menu)
                    <li><a href="{{ $child_menu->link() }}">{{ $child_menu->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
@if($loop->iteration == 1)
    <div class="clearfix visible-xs"></div>
@endif
@endforeach
