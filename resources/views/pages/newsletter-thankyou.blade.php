@extends('layouts.app')

@section('title', 'Thank You')

@section('content')

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->

            <div class="thank-you-section">
                {{ __('pages.newsletter_thank_you.message') }}
                <div class="spacer"></div>
                <div>
                    <a href="{{ url('/') }}" class="button">{{ __('pages.newsletter_thank_you.button') }}</a>
                </div>
            </div>

            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection