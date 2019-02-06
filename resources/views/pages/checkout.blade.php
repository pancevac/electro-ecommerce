@extends('layouts.app')

@section('title')
  Checkout
@endsection()


@section('css')
  <link type="text/css" rel="stylesheet" href="{{ asset('css/stripe.css') }}"/>
  <script src="https://js.stripe.com/v3/"></script>
@endsection
@section('js')
  <script src="{{ asset('js/stripe.js') }}"></script>
@endsection()

@section('breadcrumbs')
  {{ Breadcrumbs::render('checkout.index') }}
@endsection()
@section('content')
  <!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">

        <form action="{{ route('charge') }}" method="POST" id="payment-form">
          @csrf()
          <button id="complete-order" class="primary-btn order-submit" style="display:none;">Place order</button>
          <div class="col-md-7">
            <!-- Billing Details -->
            <div class="billing-details">
              <div class="section-title">
                <h3 class="title">{{ __('pages.checkout.form.billing_address') }}</h3>
              </div>

              @component('components.form.text-field', [
                'id' => 'email',
                'name' => 'email',
                'placeholder' => __('pages.checkout.form.email'),
                'value' => auth()->check() ? auth()->user()->email : old('email'),
                'required' => auth()->guest() ? true : '',
                'readonly' => auth()->check() ? true : '',
              ])
              @endcomponent

              @component('components.form.text-field', [
                'id' => 'first-name',
                'name' => 'first_name',
                'placeholder' => __('pages.checkout.form.first_name'),
                'value' => old('first_name'),
                'required' => true,
              ])
              @endcomponent

              @component('components.form.text-field', [
                'id' => 'last-name',
                'name' => 'last_name',
                'placeholder' => __('pages.checkout.form.last_name'),
                'value' => old('last_name'),
                'required' => true,
              ])
              @endcomponent

              @component('components.form.text-field', [
                'id' => 'address',
                'name' => 'address',
                'placeholder' => __('pages.checkout.form.address'),
                'value' => old('address'),
                'required' => true,
              ])
              @endcomponent

              @component('components.form.text-field', [
                'id' => 'city',
                'name' => 'city',
                'placeholder' => __('pages.checkout.form.city'),
                'value' => old('city'),
                'required' => true,
              ])
              @endcomponent

              @component('components.form.text-field', [
                'id' => 'country',
                'name' => 'country',
                'placeholder' => __('pages.checkout.form.country'),
                'value' => old('country'),
                'required' => true,
              ])
              @endcomponent

              @component('components.form.text-field', [
                'id' => 'zip-code',
                'name' => 'zip_code',
                'placeholder' => __('pages.checkout.form.postal_code'),
                'value' => old('zip_code'),
                'required' => true,
              ])
              @endcomponent

              @component('components.form.text-field', [
                'id' => 'tel',
                'name' => 'tel',
                'placeholder' => __('pages.checkout.form.phone'),
                'value' => old('tel'),
                'required' => true,
              ])
              @endcomponent

            </div>
            <!-- /Billing Details -->

          <!-- Order notes -->
            @component('components.form.text-area-field', [
                'id' => 'order-notes',
                'name' => 'order-notes',
                'placeholder' => __('pages.checkout.form.note'),
                'value' => old('order-notes'),
              ])
            @endcomponent
            <!-- /Order notes -->
          </div>
        </form>

        <!-- Order Details -->
        <div class="col-md-5 order-details">
          <div class="section-title text-center">
            <h3 class="title">{{ __('pages.checkout.your_order') }}</h3>
          </div>
          <div class="order-summary">
            <div class="order-col">
              <div><strong>{{ strtoupper(__('pages.checkout.product')) }}</strong></div>
              <div><strong>{{ strtoupper(__('pages.checkout.total')) }}</strong></div>
            </div>
            <div class="order-products">
              @foreach($cartContent as $cartItem)
                <div class="order-col">
                  <div>
                    @if($cartItem->qty > 1)
                      {{ $cartItem->qty }}x
                    @endif
                    {{ $cartItem->name }}
                  </div>
                  <div>{{ currency($cartItem->price) }}</div>
                </div>
              @endforeach()

            </div>
            <hr>
            <div class="order-col">
              <div>{{ __('pages.checkout.subtotal') }}</div>
              <div @if(session()->has('coupon')) style="text-decoration: line-through;"@endif>
                {{ currency(Cart::instance('shopping')->subtotal()) }}</div>
            </div>
            @if(session()->has('coupon'))
              <div class="order-col">
                <form action="{{ route('coupon.destroy') }}" method="POST" id="remove-coupon">
                  {{ @csrf_field() }}
                  {{ @method_field('delete') }}
                  <div>{{ __('pages.checkout.discount') }}({{ session()->get('coupon')['name'] }}) -
                    <a href="javascript:{}"
                       onclick="document.getElementById('remove-coupon').submit();"
                    >
                      {{ __('pages.checkout.remove_coupon') }}
                    </a>
                  </div>
                </form>
                <div>-${{ session()->get('coupon')['discount'] }}</div>
              </div>
            @endif
            @if(session()->has('coupon'))
              <hr>
              <div class="order-col">
                <div>{{ __('pages.checkout.new_subtotal') }}</div>
                <div>{{ currency($newSubtotal) }}</div>
              </div>
            @endif
            <div class="order-col">
              <div>{{ __('pages.checkout.tax') }}({{ $taxPercent }}%)</div>
              {{--<div>+${{ Cart::tax() }}</div>--}}
              <div>+{{ currency($newTax) }}</div>
            </div>
            <hr>
            <div class="order-col">
              <div><strong>{{ strtoupper(__('pages.checkout.total')) }}</strong></div>
              <div><strong class="order-total">{{ currency($newTotal) }}</strong></div>
            </div>
          </div>

          {{-- Coupon field --}}
          @if(!session()->has('coupon'))
            <div class="form-group">
              <form action="{{ route('coupon.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="order-col">
                  <div>
                    <h4><strong>{{ __('pages.checkout.have_a_coupon') }}</strong></h4>
                  </div>
                </div>
                <div class="coupon-code">
                  <input type="text" class="input" name="coupon_code" id="coupon_id" style="width:50%">
                  <button type="submit">{{ __('pages.checkout.submit') }}</button>
                </div>
              </form>
            </div>
          @endif

          <div class="payment-method">
            <div class="input-radio">
              <input type="radio" name="payment" id="payment-1">
              <label for="payment-1">
                <span></span>
                Direct Bank Transfer
              </label>
              <div class="caption">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                  et dolore magna aliqua.</p>
              </div>
            </div>
            <div class="input-radio">
              <input type="radio" name="payment" id="payment-2">
              <label for="payment-2">
                <span></span>
                Cheque Payment
              </label>
              <div class="caption">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                  et dolore magna aliqua.</p>
              </div>
            </div>
            <div class="input-radio">
              <input type="radio" name="payment" id="payment-3">
              <label for="payment-3">
                <span></span>
                Paypal System
              </label>
              <div class="caption">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                  et dolore magna aliqua.</p>
              </div>
            </div>
          </div>


          <div class="form-group">

            <label for="card-element">
              {{ __('pages.checkout.credit_or_debit_card') }}
            </label>
            <div id="card-element">
              <!-- A Stripe Element will be inserted here. -->
            </div>
            <!-- Used to display Element errors. -->
            <div id="card-errors" role="alert"></div>

          </div>

          <div class="input-checkbox">
            <input type="checkbox" id="terms">
            <label for="terms">
              <span></span>
              {{--I've read and accept the <a href="#">terms & conditions</a>--}}
              {{ __('pages.checkout.terms_and_conditions') }}
            </label>
          </div>
          <button id="second-button" class="primary-btn order-submit"
                  onclick="document.getElementById('complete-order').click()">{{ __('pages.checkout.purchase') }}
          </button>
        </div>
        <!-- /Order Details -->

      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION -->
@endsection()