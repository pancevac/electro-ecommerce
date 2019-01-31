@extends('layouts.app')

@section('title', 'Profile')

@section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard', $user) }}
@endsection()

@section('content')

    <div class="section">
        <div class="container">
            <div class="row">

                <div class="col-md-5 order-details">


                    <div class="section-title text-left">
                        <h3 class="title">{{ __('pages.profile.title') }}</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>{{ __('pages.profile.username') }}:</strong></div>
                            <div>{{ $user->name }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>{{ __('pages.profile.email') }}:</strong></div>
                            <div>{{ $user->email }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>{{ __('pages.profile.role') }}:</strong></div>
                            <div>{{ $user->role->display_name }}</div>
                        </div>
                        <div class="order-col">
                            <div><strong>{{ __('pages.profile.created') }}:</strong></div>
                            <div>{{ $user->created_at }}</div>
                        </div>
                    </div>
                    <div class="input-checkbox col-md-6">
                        <a href="{{ route('user.edit') }}" class="primary-btn order-submit" >
                            {{ __('pages.profile.button.edit_profile') }}
                        </a>
                    </div>
                    <div class="input-checkbox col-md-6">
                        <a href="{{ route('user.orders') }}" class="primary-btn order-submit" >
                            {{ __('pages.profile.button.check_orders') }}
                        </a>
                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection
