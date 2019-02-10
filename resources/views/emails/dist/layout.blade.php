<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

@include('emails.dist.partials.head')

<body style="background-color:white;">
  <div style="background-color:white;">

    @include('emails.dist.partials.top_bar')

    @include('emails.dist.partials.nav_bar')

    @yield('content')

    @include('emails.dist.partials.footer')

    @yield('newsletter')

  </div>
</body>

</html>