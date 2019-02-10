<!-- TOP HEADER -->
<div id="top-header">
    <div class="container">
        <ul class="header-links pull-left">
            <li><a href="#"><i class="fa fa-phone"></i> {{ setting('site.phone') }}</a></li>
            <li><a href="#"><i class="fa fa-envelope-o"></i> {{ setting('site.email') }}</a></li>
            <li><a href="#"><i class="fa fa-map-marker"></i> {{ setting('site.address') }}</a></li>
        </ul>
        <ul class="header-links pull-right">


            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                @if($loop->last)
                    <li style="border-right: 1px solid white; padding-right: 20px;">
                @else
                    <li>
                @endif
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
            @endforeach


            <li>
              <a href="{{ url()->current() . '/?currency=eur' }}"><i class="fa fa-money"></i> EUR</a>
            </li>
            <li style="padding-right: 20px; border-right: 1px solid white">
              <a href="{{ url()->current() . '/?currency=rsd' }}"><i class="fa fa-money"></i> RSD</a>
            </li>

            @guest
                <li><a href="{{ route('login') }}"><i class="fa fa-user-o"></i> {{ __('partials.header.login') }}</a></li>
                <li><a href="{{ route('register') }}"><i class="fa fa-user-o"></i> {{ __('partials.header.register') }}</a></li>
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