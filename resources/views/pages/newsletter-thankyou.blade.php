@extends('layouts.app')

@section('title', 'Thank You')

@section('content')

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->

            <div class="thank-you-section">
                <h1>Thank you for <br> Your subscription!</h1>
                <p>Your email address is successfully registered on Newsletter</p>
                <div class="spacer"></div>
                <div>
                    <a href="{{ url('/') }}" class="button">Home Page</a>
                </div>
            </div>

            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection