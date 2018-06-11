<!DOCTYPE html>
<html lang="en">
    @include('inc.head')
<body>
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

@include('inc.script')

</body>
</html>