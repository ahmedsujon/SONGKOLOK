@extends("layouts.app_main")

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mb-5 mt-5" style="margin: 0 auto">
            <div class="card">
                <div class="card-body text-center text-primary">
                    <h3>{{ Session::get('success') }}</h3>
                </div>
                <div class="card-footer">
                    <div style="margin: 0 auto; width: 17%">
                        <a href="{{ route('home') }}" class="btn btn-outline-success">Shop More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
