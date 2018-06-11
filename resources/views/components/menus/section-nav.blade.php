<div class="section-nav">
    <ul class="section-tab-nav tab-nav">
        <li class="active"><a data-toggle="tab" href="#tab1">All</a></li>

        @foreach($items as $menu_item)
            <li><a href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a></li>
            @endforeach
    </ul>
</div>