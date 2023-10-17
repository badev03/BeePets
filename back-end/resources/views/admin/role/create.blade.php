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
                            <h5 class="card-title">Thêm {{ $title_web }}</h5>
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
                                    @if(in_array($key , FIELD_IMAGE))
                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                <input type="file" class="form-control" id="image" name="{{ $key }}" required="">
                                                @if($errors->has($key))
                                                    <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                @endif
                                            </div>
                                            <div class="col-4">
                                                <img style="width: 300px" src="https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg" alt="" id="image_prev">
                                            </div>
                                        </div>
                                    @elseif(in_array($key , FIELD_CHECK_FOR))
                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                <select class="form-select" name="{{ $key }}">
                                                    @foreach($categories as $keyCat=>$itemCat)
                                                        <option value="{{ $itemCat->id }}">{{ $itemCat->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has($key))
                                                    <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                @endif
                                            </div>
                                            <div class="col-4">
                                                <img style="width: 300px" src="https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg" alt="" id="image_prev">
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="{{ $key }}" value="{{ old($key) }}">
                                                @if($errors->has($key))
                                                    <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
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
@push('script')
    <script>
        $(function(){
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $(selector).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function () {
                readURL(this, '#image_prev');
            });

        });
    </script>
    <script src="{{asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/mask.js')}}"></script>>
@endpush
