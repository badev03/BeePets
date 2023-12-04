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
        @if(session()->has('error'))
            <div class="alert-danger alert">
                {{ session('error') }}
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
                                <form action="{{ route($urlbase.'update' , [$model->id]) }}" class="needs-validation" novalidate="" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method('PUT')
                                    @foreach($colums as $key=>$item)
                                        @if(in_array($key , FIELD_IMAGE))
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                    <input type="file" class="form-control" id="image" name="{{ $key }}" required="">
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    @if(!$model->$key)
                                                        <img style="width: 300px" src="https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg" alt="" id="image_prev">
                                                    @else
                                                        <img style="width: 300px" src="{{ asset($model->$key) }}" alt="" id="image_prev">
                                                    @endif
                                                </div>
                                            </div>
                                        @elseif(in_array($key , FIELD_DESC))
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                    <textarea id="editor" name="{{ $key }}">
                                                        {{ $model->$key }}
                                                    </textarea>
                                                    @if($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @elseif(in_array($key , $FIELD_SELECT_CUSTOM_CONTROLLER) && isset($addDataSelect))
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                    <select class="form-select" name="{{ $key }}">
                                                        @foreach($addDataSelect[$key] as $keyDataAction=>$valueAction )
                                                            <option value="{{ $valueAction->id }}" @if($valueAction->id == $model->$key) selected @endif>{{ $valueAction->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @elseif(array_key_exists($key , FIELD_SELECT_CUSTOM))
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                    <select class="form-select" name="{{ $key }}">
                                                        @foreach(FIELD_SELECT_CUSTOM[$key] as $keyCustom=>$itemCustom)
                                                            <option value="{{ $keyCustom }}" @if($keyCustom == $model->$key) selected @endif>{{ $itemCustom }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @elseif(in_array($key , ['password']))
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                    <input type="password" class="form-control" id="validationCustom01" name="{{ $key }}" value="{{ $model->$key }}">
                                                    @if($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                    <input type="text" class="form-control" id="validationCustom01" name="{{ $key }}" value="{{ $model->$key }}">
                                                    @if($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @if(request()->routeIs('people-account*') && 1==2)
                                        @include('admin.components.permissions.create')
                                    @elseif(request()->routeIs('people-account.edit*') && 1==2)
                                        @include('admin.components.permissions.edit')
                                    @elseif(request()->routeIs('permission.create') || request()->routeIs('permission.edit*'))
                                        @include('admin.components.role.create')
                                    @endif
                                    <button class="btn btn-primary" type="submit">Update {{ $title_web }}</button>
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
@endpush
