@extends('layouts.app_main')

@section('content')
<section style="padding-top: 100px;" class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 form-column">
                <div class="contact-form-area">
                    <h2>Contact Us</h2>
                    <form method="POST" action="{{ route('contact-support.store') }}" id="contact-form" class="default-form">
                        @csrf
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="input-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="phone" class="form-control" placeholder="Phone" >
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="subject" class="form-control" placeholder="Subject" >
                        </div>
                        <div class="input-group">
                            <textarea class="form-control" name="description" rows="10" aria-label="With textarea" placeholder="Write mesage..."></textarea>
                        </div>
                        <br>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-success">Submit Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
