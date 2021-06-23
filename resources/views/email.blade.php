<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container">
    <div class="card row">
        <div class="col-md-12">
            <h3 class="text-center text-info">Welcome to {{$email_data['name'] }}</h3>
            <p class="text-center">Please Click the following link to confirm email</p>
        </div>

        <div class="col-md-12">
            <a href="{{route('verify.mail').'?code='.$email_data['verification_code']}}" class="btn btn-primary">Click Here</a>
        </div>
    </div>
</div>
</body>
</html>
