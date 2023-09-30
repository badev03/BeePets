@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
@endpush
@section('heading','hihihi')
@section('content')
    <div class="content container-fluid">
        @if(session()->has('success'))
            <div class="alert-success alert">
                {{ session('success') }}
            </div>
        @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="d-flex flex-wrap justify-content-between align-items-center">
                                    <h5 class="card-title">Cấp quyền {{ $title_web }}</h5>
                                    <div class='d-flex flex-wrap'>
                                        @include(BUTTON_HEADER_ADMIN_LINK)
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <form action="{{ route($urlbase.'store') }}" class="needs-validation" novalidate="" enctype="multipart/form-data" method="POST">
                                    @csrf
                                        @foreach($colums as $key=>$item)
                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="{{ $key }}" value="{{ old($key) }}">
                                                @if($errors->has($key))
                                                    <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                        @include('admin.components.permissions.create')
                                        <button class="btn btn-primary" type="submit">Thêm {{ $title_web }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
