<!DOCTYPE html>
<html lang="en">
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
    <title>Dashboard</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/assets/img/favicon.png')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/css/feathericon.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/morris/morris.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/css/custom.css')}}">

    @stack('style')
</head>
<body>

<div class="main-wrapper">
@include('layouts.partials.header')

    @include('layouts.partials.sidebar')
    <div class="page-wrapper">
        <div class="content container-fluid">
@yield('content')
            </div>
    </div>

</div>


<script src="{{asset('backend/assets/js/jquery-3.7.0.min.js')}}"></script>

<script src="{{asset('backend/assets/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('backend/assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/morris/morris.min.js')}}"></script>
<script src="{{asset('backend/assets/js/chart.morris.js')}}"></script>

@include('layouts.partials.script')
@stack('script')
<script src="{{asset('backend/assets/js/script.js')}}"></script>
</body>

<!-- Mirrored from doccure.dreamguystech.com/html/template/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 14:19:12 GMT -->
</html>
