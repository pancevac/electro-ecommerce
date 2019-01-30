<!-- NEWSLETTER -->
<div id="newsletter" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                    <p>{!! __('partials.newsletter.sing-up') !!}</p>
                    <form method="POST" action="{{ route('frontend.newsletter') }}">
                        {{ @csrf_field() }}
                        <input class="input" type="email" placeholder="{{ __('partials.newsletter.placeholder') }}" name="email">
                        <button type="submit" class="newsletter-btn"><i class="fa fa-envelope"></i> {{ __('partials.newsletter.button') }}</button>
                    </form>
                    {{ menu('social.networks', 'components.menus.social_networks') }}
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /NEWSLETTER -->