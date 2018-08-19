<!-- jQuery Plugins -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/nouislider.min.js') }}"></script>
<script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

<script>
    $(document).ready(function () {
        const page = @if(\Request::route()->getName() == "frontend.index") true; @endif
        if (page) {
            $('#home-page').addClass('active');
        }
    });
</script>

@yield('js')