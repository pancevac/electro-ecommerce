<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('inc.head')

<body>
<div id="app">

  <!-- HEADER -->
  <header>

    @include('inc.top-header')
    @include('inc.main-header')

  </header>
  <!-- /HEADER -->

  @include('inc.navigation')

  @yield('breadcrumbs')

  @include('inc.messages')

  @yield('content')

  @include('inc.newsletter')

  @include('inc.footer')

</div>

<script>
  window.app_url = "{{ url('/') }}";
</script>

<script src="{{ asset('js/app.js') }}"></script>

@include('inc.script')

</body>
</html>