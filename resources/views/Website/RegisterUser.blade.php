<html lang="en">
<head>

    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Vendor Css Files -->
    <link rel="stylesheet" href= "{{ URL::asset('assets/vendor1/bootstrap/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor1/fontawesome/all.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor1/boxicons/css/boxicons.min.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('../../../assets/images1/icon.png') }}">

    <!-- Main Css File -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css1/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css1/login-register.css') }}">

    <title>Evara - Register</title>

</head>
<body>

<div id="particles-js"></div>

<!-- ------------------------------------------------------------------------------ -->
<!-- Start Login -->
<div class="login">
    <div class="image-box">
        <img src="{{ URL::asset('assets/images1/logo.svg') }}" alt="">
    </div>
    <h4 class=" text-center">Register</h4>
    <br>
    @if ($errors->any())
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('save.register.user') }}">
        @csrf
        <div class="form-group">
            <img src="{{ URL::asset('assets/images1/form/user.png') }}" alt="">
            <label for="exampleInputuser">Username</label>
            <input type="text" name="username" class="form-control" id="exampleInputuser" required>

        </div>
        <div class="form-group">
            <img src="{{ URL::asset('assets/images1/form/email.png') }}" alt="">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <img src="{{ URL::asset('assets/images1/form/password.png') }}" alt="">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
        </div>
        <div class="form-group">
            <img src="{{ URL::asset('assets/images/form/confirm.png') }}" alt="">
            <label for="exampleInputPassword2">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" required>
        </div>
        <button type="submit" class="btn submit mt-3">Submit</button>
    </form>
    <div class="sign-up mt-4 text-center">
        <a href="{{url('userLogin')}}">Sign In <i class="fas fa-long-arrow-alt-right ml-2"></i></a>
    </div>
</div>
<!-- End Login -->
<!-- ------------------------------------------------------------------------------ -->

<!-- ------------------------------------------------------------------------------ -->
<!-- Start Loading -->
<div class="box-loading">
    <div class="loader">
        <div class="inner one"></div>
        <div class="inner two"></div>
        <div class="inner three"></div>
    </div>
</div>
<!-- End Loading -->
<!-- ------------------------------------------------------------------------------ -->

<!-- --------------------------------------------------------------------------- -->
<!-- Vendor Js Files -->
<script src="{{ URL::asset('assets/vendor1/particles.js') }}"></script>
<script src="{{ URL::asset('assets/vendor1/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/vendor1/bootstrap/popper.min.js') }}"></script>
<script src="{{ URL::asset('assets/vendor1/bootstrap/bootstrap.js') }}"></script>
<script src="{{ URL::asset('assets/vendor1/fontawesome/all.min.js') }}"></script>

<!-- Main Js Files -->
<script src="{{ URL::asset('assets/js1/main.js') }}"></script>
</body>
</html>
