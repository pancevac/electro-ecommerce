<!-- NEWSLETTER -->
<div id="newsletter" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                    <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                    <form method="POST" action="{{ route('frontend.newsletter') }}">
                        {{ @csrf_field() }}
                        <input class="input" type="email" placeholder="Enter Your Email" name="email">
                        <button type="submit" class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
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