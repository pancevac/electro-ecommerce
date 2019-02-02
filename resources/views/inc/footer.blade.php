<!-- FOOTER -->
<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">{{ __('partials.footer.about_us') }}</h3>
                        <p>{!! setting('site.about') !!}</p>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i>{{ setting('site.address') }}</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i>{{ setting('site.phone') }}</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>{!! setting('site.email') !!}</a></li>
                        </ul>
                    </div>
                </div>

                {{--@php
                \Illuminate\Support\Facades\Cache::remember()
                @endphp--}}
                @php
                $footer_menu = \Illuminate\Support\Facades\Cache::remember('footer_menu', 2, function () {
                    return menu('footer', 'components.menus.footer_menu');
                });
                @endphp
                {{ $footer_menu }}

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="footer-payments">
                        <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                        <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                    </ul>
                    <span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;{{ \Carbon\Carbon::now()->year }} All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->