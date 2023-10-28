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
                            <h4 class="card-title">Lịch hẹn đã hủy</h4>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <h6 class="card-title text-danger">Bộ lọc thống kê</h6>
                        <div class="col-4 mt-3">
                            <label class="form-label">Chọn mốc thời gian</label>
                            <select class="form-select" name="since_time" id="since_time">
                                <option value="all">Chọn khoảng thời gian</option>
                                <option value="-7">7 ngày trước</option>
                                <option value="-14">14 ngày trước</option>
                                <option value="-21">21 ngày trước</option>
                                <option value="7">7 ngày trước</option>
                                <option value="14">14 ngày trước</option>
                                <option value="21">21 ngày trước</option>
                            </select>
                        </div>

                        <div class="col-4 mt-3">
                            <label class="form-label">Chọn ngày</label>
                            <input style="height: 38px" type="date" class="form-control" id="time_date_filter">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
