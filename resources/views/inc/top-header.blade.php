<!-- TOP HEADER -->
<div id="top-header">
    <div class="container">
        <ul class="header-links pull-left">
            <li><a href="#"><i class="fa fa-phone"></i> {{ setting('site.phone') }}</a></li>
            <li><a href="#"><i class="fa fa-envelope-o"></i> {{ setting('site.email') }}</a></li>
            <li><a href="#"><i class="fa fa-map-marker"></i> {{ setting('site.address') }}</a></li>
        </ul>
        <ul class="header-links pull-right">
            <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>

            @guest
                <li><a href="{{ route('login') }}"><i class="fa fa-user-o"></i> Login</a></li>
                <li><a href="{{ route('register') }}"><i class="fa fa-user-o"></i> Register</a></li>
                {{--<li><a href="{{ route('login') }}"><i class="fa fa-user-o"></i> My Account</a></li>--}}
            @else
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-user-o"></i> {{ ucfirst(Auth::user()->name) }}</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();
                "><i class="fa fa-close"></i> Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </ul>
    </div>
</div>
<!-- /TOP HEADER -->