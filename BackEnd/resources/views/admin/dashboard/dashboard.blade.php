@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')


@endpush
@section('heading','hihihi')
@section('content')
hello

@endsection
@push('script')
    <!--Morris Chart-->
    <script src="{{asset('backend/assets/libs/morris.js06/morris.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/raphael/raphael.min.js')}}"></script>

    <!-- Dashboar init js-->
    <script src="{{asset('backend/assets/js/pages/dashboard.init.js')}}"></script>








@endpush
