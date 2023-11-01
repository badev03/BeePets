@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
@endpush
@section('heading','hihihi')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if(session()->has('success'))
                <div class="alert-success alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <h4 class="card-title">Chi tiết hóa đơn</h4>
                            <div class='d-flex flex-wrap'>
                                @include(BUTTON_HEADER_ADMIN_LINK)
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                                @csrf
                                @method('PUT')
                                <div class="d-flex">
                                    <div class="col-sm-6">

                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Mã hóa đơn</label>
                                                <input class="form-control" disabled value="{{ $model->code }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Tên khách hàng</label>
                                                <input class="form-control" disabled value="{{ $model->customer_name }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Tên khách hàng</label>
                                                <input class="form-control" disabled value="{{ $model->shift_name }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Số điện thoại khách hàng</label>
                                                <input class="form-control" disabled value="{{ $model->customer_phone }}">
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Dịch vụ</label>
                                                <input class="form-control" disabled value="{{ $model->service_name }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Bác sĩ</label>
                                                <input class="form-control" disabled value="{{ $model->doctor_name }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Tổng tiền</label>
                                                <input class="form-control" disabled value="{{ $model->total_amount }}">
                                            </div>
                                        </div>

                                        @foreach($colums as $key=>$item)
                                            @if(DESC_FIELD === $key)
                                                <div class="row">
                                                    <div class="col-md-10 mb-3">
                                                        <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                        <textarea id="editor" name="description" disabled>
                                                        {{ $model->$key }}
                                                    </textarea>
                                                        @if($errors->has($key))
                                                            <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            <a href="{{ URL::previous() }}" class="btn btn-primary">Quay lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/datatables/datatables.min.js')}}"></script>
@endpush
