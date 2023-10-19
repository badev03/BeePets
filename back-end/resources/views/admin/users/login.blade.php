<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from doccure.dreamguystech.com/html/template/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 14:20:21 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The responsive professional Doccure template offers many features, like scheduling appointments with  top doctors, clinics, and hospitals via voice, video call & chat.">
    <meta name="keywords" content="practo clone, doccure, doctor appointment, Practo clone html template, doctor booking template">
    <meta name="author" content="Practo Clone HTML Template - Doctor Booking Template">
    <meta property="og:url" content="https://doccure.dreamguystech.com/html/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Doctors Appointment HTML Website Templates | Doccure">
    <meta property="og:description" content="The responsive professional Doccure template offers many features, like scheduling appointments with  top doctors, clinics, and hospitals via voice, video call & chat.">
    <meta property="og:image" content="assets/img/preview-banner.html">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="https://doccure.dreamguystech.com/html/">
    <meta property="twitter:url" content="https://doccure.dreamguystech.com/html/">
    <meta name="twitter:title" content="Doctors Appointment HTML Website Templates | Doccure">
    <meta name="twitter:description" content="The responsive professional Doccure template offers many features, like scheduling appointments with  top doctors, clinics, and hospitals via voice, video call & chat.">
    <meta name="twitter:image" content="assets/img/preview-banner.html">
    <title>Doccure - Login</title>

    <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/css/feathericon.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/morris/morris.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/css/custom.css')}}">
</head>
<body>

<div class="main-wrapper login-body">
    <div class="login-wrapper">
        <div class="container">
            <div class="loginbox">
                <div class="login-left">
                    <img class="img-fluid" src="{{asset('backend/assets/img/ok_login.jpg')}}" alt="Logo">
                </div>
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Login</h1>
                        @if(session()->has('msg'))
                            <p class="account-subtitle text-danger">{{ session('msg') }}</p>
                        @else
                        <p class="account-subtitle">Access to our dashboard</p>
                        @endif
                        <form action="{{ route('admin.login.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control" type="text" placeholder="Email" name="email">
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="password" placeholder="Password" name="password">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary w-100" type="submit">Đăng nhập</button>
                            </div>
                        </form>

                        <div class="text-center forgotpass"><a href="forgot-password.html">Quên mật khẩu?</a></div>
                        <div class="login-or">
                            <span class="or-line"></span>
                            <span class="span-or">or</span>
                        </div>

                        <div class="text-center dont-have">Bạn đã có tài khoản chưa? <a href="register.html">Register</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('layouts.partials.script')
</body>

</html>
