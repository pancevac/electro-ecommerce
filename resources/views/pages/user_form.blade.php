@extends('layouts.app')

@section('title', 'Edit Profile')

@section('breadcrumbs')
    {{ Breadcrumbs::render('user.edit') }}
@endsection()

@section('content')

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Edit Profile</h3>
                        </div>
                        <form action="{{ route('user.update') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group col-md-5">
                                <label for="username">Username</label>
                                <input type="text" class="input" id="username" name="username" placeholder="Username..." value="{{ $user->name }}">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="email">Email</label>
                                <input type="email" class="input" id="email" name="email" placeholder="Email..." value="{{ $user->email }}" readonly>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="password">Password</label>
                                <input type="password" class="input" id="password" name="password" placeholder="Password...">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="passconf">Password Confirm</label>
                                <input type="password" class="input" id="passconf" name="passconf" placeholder="Password confirm...">
                            </div>
                            <div class="input-checkbox col-md-5">
                                <button type="submit" class="primary-btn order-submit">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection