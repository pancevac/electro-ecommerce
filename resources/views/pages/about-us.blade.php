@extends('layouts.app')

@section('content')

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3>About site</h3>
                    <p>This site is only for demonstration purposes. I made it with implementing several tehnologies such are stripe paymant, algolia search, shopping cart package and so on.</p>
                    <p>Users can add products into shopping cart. If users are not registered, they can still purchase products. In checkout form, you should add Your real email address
                        sou you can receive order report.</p>
                    <p>If user is registered, he can preview every order details. Also, for registered users. there is wish list so they can easily transfer products from wish list to shopping cart.</p>
                    <p>Only registered users can comment and review products.</p>
                    <p>Every product contains specifications, details information, pictures and also comments and reviews of users. </p>
                    <p>I also implemented admin panel with "voyager" package, so site can be easily maintained.</p>
                </div>
            </div>
        </div>
    </div>

@endsection