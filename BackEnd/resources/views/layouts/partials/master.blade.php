<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8"/>
    <title> @yield('title','Dashboard | Heal Pets') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">

    <!-- App css -->

    <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>

    <!-- icons -->
    <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>

    @stack('style')

</head>


<!-- Topbar Start -->
@include('layouts.partials.topbar')

<!-- end Topbar -->
<!-- ========== Left Sidebar Start ========== -->
@include('layouts.partials.Lsidebar')

<!-- Left Sidebar End -->
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div class="content-page">

    <div class="content">

        @yield('content')

    </div> <!-- container-fluid -->
</div> <!-- content -->
<!-- Footer Start -->
@include('layouts.partials.footer')
<!-- end Footer -->

</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
</div>
<!-- END wrapper -->
<!-- Right Sidebar -->
@include('layouts.partials.Rsidebar')

<!-- /Right-bar -->
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor -->
<script src="{{asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/feather-icons/feather.min.js')}}"></script>

<!-- knob plugin -->
{{--chua biet cai nay de lam gi nen chua chia--}}
<script src="{{asset('backend/assets/libs/jquery-knob/jquery.knob.min.js')}}"></script>

<!-- App js-->
<script src="{{asset('backend/assets/js/app.min.js')}}"></script>

@stack('script')




</body>
</html>
