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
              <h3 class="title">{{ __('pages.edit_profile.label') }}</h3>
            </div>
            <form action="{{ route('user.update') }}" method="POST">

              {{ csrf_field() }}

              @component('components.form.text-field', [
                'label' => __('pages.edit_profile.username'),
                'id' => 'username',
                'name' => 'username',
                'placeholder' => __('pages.edit_profile.username'),
                'value' => $user->name,
                'customWrapperClass' => 'col-md-5',
              ])@endcomponent

              @component('components.form.text-field', [
                'label' => __('pages.edit_profile.email'),
                'id' => 'email',
                'name' => 'email',
                'placeholder' => __('pages.edit_profile.email'),
                'value' => $user->email,
                'customWrapperClass' => 'col-md-5',
                'type' => 'email'
              ])@endcomponent

              @component('components.form.text-field', [
                'label' => __('pages.edit_profile.password'),
                'id' => 'password',
                'name' => 'password',
                'placeholder' => __('pages.edit_profile.password'),
                'customWrapperClass' => 'col-md-5',
                'type' => 'password'
              ])@endcomponent

              @component('components.form.text-field', [
                'label' => __('pages.edit_profile.password_confirm'),
                'id' => 'passconf',
                'name' => 'passconf',
                'placeholder' => __('pages.edit_profile.password_confirm'),
                'customWrapperClass' => 'col-md-5',
                'type' => 'password'
              ])@endcomponent

              <div class="input-checkbox col-md-5">
                <button type="submit" class="primary-btn order-submit">{{ __('pages.edit_profile.button.update') }}</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection