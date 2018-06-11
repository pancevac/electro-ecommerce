@extends('layouts.app')

@section('title', 'Profile')

@section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard', $user) }}
@endsection()

@section('content')
{{--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>--}}

    <div class="section">
        <div class="container">
            <div class="row">

                <div class="col-md-5 order-details">


                    <div class="section-title text-left">
                        <h3 class="title">Profile Information</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>Username:</strong></div>
                            <div>{{ $user->name }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>Email:</strong></div>
                            <div>{{ $user->email }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>Role:</strong></div>
                            <div>{{ $user->role->display_name }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>Created:</strong></div>
                            <div>{{ $user->created_at }}</div>
                        </div>
                    </div>
                    <div class="input-checkbox col-md-6">
                        <a href="{{ route('user.edit') }}" class="primary-btn order-submit" >Edit Profile</a>
                    </div>
                    <div class="input-checkbox col-md-6">
                        <a href="{{ route('user.orders') }}" class="primary-btn order-submit" >Check Orders</a>
                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection
