@if ($errors->any())
    <div class="section">
        <div class="container">
            <div class="alert alert-danger mt-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

@if(session('success'))
    <div class="section">
        <div class="container">
            <div class="alert alert-success mt-2">
                {!! session('success') !!}
            </div>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="section">
        <div class="container">
            <div class="alert alert-danger mt-2">
                {!! session('error') !!}
            </div>
        </div>
    </div>
@endif