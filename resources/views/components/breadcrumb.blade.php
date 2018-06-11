{{--
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">All Categories</a></li>
                    <li><a href="#">Accessories</a></li>
                    <li><a href="#">Headphones</a></li>
                    <li class="active">Product name goes here</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->--}}



@if (count($breadcrumbs))

    <div id="breadcrumb" class="section">

        <div class="container">

            <div class="row">

                <div class="col-md-12">
                    <ul class="breadcrumb-tree">

                        @foreach ($breadcrumbs as $breadcrumb)

                            @if ($breadcrumb->url && !$loop->last)
                                <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                            @else
                                <li class="active">{{ $breadcrumb->title }}</li>
                            @endif

                        @endforeach

                    </ul>

                </div>


            </div>


        </div>
    </div>

@endif
