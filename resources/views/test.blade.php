@extends('layouts.app')

@section('title', 'Test')

@section('content')
    <form method="POST" action="{{ route('test_obr') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input name="picture" type="file">
        <button type="submit">Submit</button>
    </form>
@endsection