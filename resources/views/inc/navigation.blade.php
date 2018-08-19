<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            @php
                $nav_menu = \Illuminate\Support\Facades\Cache::remember('nav_menu', 2, function () {
                    return menu('navigation', 'components.menus.navigation_menu');
                });
            @endphp
            {{ $nav_menu }}
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->