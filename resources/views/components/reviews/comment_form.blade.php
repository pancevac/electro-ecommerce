<div class="col-md-3">

    @auth
    <div id="review-form">
        {{ Form::open(['route' => ['product.comment', $product->id], 'method' => 'put', 'class' => 'review-form']) }}
        {{--<form class="review-form" type="POST" action="{{ route('product.comment', ['id' => $product->id]) }}">--}}
            {{--<input class="input" type="text" placeholder="Your Name">
            <input class="input" type="email" placeholder="Your Email">--}}
            <textarea class="input" placeholder="{{ __('pages.product.comment_form.placeholder') }}" name="review"></textarea>
            <div class="input-rating">
                <span>{{ __('pages.product.rating.average_rating') }}: </span>
                <div class="stars">
                    <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                    <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                    <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                    <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                    <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                </div>
            </div>
            <button class="primary-btn">{{ __('pages.product.comment_form.button') }}</button>
        {{--</form>--}}
        {{ Form::close() }}
    </div>
        @endauth
    @guest()
            <h4>{{ __('pages.product.comment_form.please') }}
              <a href="{{ route('login') }}">{{ __('pages.product.comment_form.login_link') }}</a>
              {{ __('pages.product.comment_form.rest') }}</h4>
    @endguest
</div>