@extends('layouts.partials.master')
@section('title','')
@push('style')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
@endpush
@section('heading','hihihi')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if(session()->has('success_delete'))
                <div class="alert-success alert">
                    {{ session('success_delete') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <h4 class="card-title">Bác sĩ <span class="text-danger">{{ $appointmentCancel->doctor_id }}</span> đã yêu cầu hủy lịch hẹn này</h4>
                        </div>
                    </div>

                    <div class="shadow-lg p-3 mb-3 bg-body rounded mt-3">
                        <div class="row d-flex">
                            <h6 class="card-title text-danger">Nội dung hủy</h6>
                            <p>
                                {{ $appointmentCancel->message_admin }}
                            </p>
                        </div>
                    </div>

                    <div class="shadow-lg p-3 mb-5 bg-body rounded">
                        <div class="row d-flex">
                            <h6>Người đặt lịch hẹn : {{ $appointmentCancel->user_id }}</h6>
                            <h6>Bác sĩ nhận đơn : {{ $appointmentCancel->doctor_id }}</h6>
                            <p>Thời gian cuộc hẹn ngày : {{ $appointmentCancel->date }} thời gian : 119181</p>
                            <p>Số điện thoại người dùng : {{ $appointmentCancel->phone }}</p>
                            <p>Dịch vụ : {{ $appointmentCancel->service_id }}</p>
                            <p>Nội dung của người đặt cuộc hẹn : {{ $appointmentCancel->description }}</p>
                            <p class="text-danger">Trạng thái : Hủy cuộc hẹn</p>
                            <div class="d-flex align-items-center">
                                <a href="" class="btn btn-sm bg-danger-light me-3 d-flex align-items-center">Hủy cuộc hẹn</a>
                                <a href="{{ route('appointment.edit' ,$appointmentCancel->id ) }}" class="btn btn-sm bg-success-light me-3 d-flex align-items-center">Đổi bác sĩ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
