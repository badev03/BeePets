@extends('layouts.partials.master')
@section('title', 'hahaha')
@push('style')
    {{-- <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .image-item {
            position: relative;
            margin: 10px;
        }

        .delete-btn {
            position: absolute;
            top: 0;
            right: 0;
            background-color: transparent;
            border: none;
            color: red;
            font-size: 20px;
        }
    </style>
@endpush
@section('heading', 'hihihi')
@section('content')
    <div class="content container-fluid">
        @if (session()->has('success'))
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
                                <h5 class="card-title">Thêm mới bác sĩ</h5>
                                <div class='d-flex flex-wrap'>
                                    <a href="{{ route('doctors.index') }}" class="btn btn-info btn-sm mx-3 text-white">Danh
                                        sách bác sĩ</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                <form action="{{ route('doctors.store') }}" class="needs-validation" novalidate=""
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @foreach ($colums as $key => $item)
                                        @if (in_array($key, FIELD_IMAGE))
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2"
                                                        for="validationCustom01">{{ $item }}</label>
                                                    <input type="file" class="form-control" id="image" name="image"
                                                        required="">
                                                    @if ($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                    @endif
                                                </div>
                                                <div class="col-4">
                                                    <img style="width: 300px"
                                                        src="https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg"
                                                        alt="" id="image_prev">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="values">Ảnh phụ</label>
                                                        <input type="file" class="form-control" id="image_path"
                                                            name="image_path[]" required="" multiple="multiple"
                                                            value="{{ old('image_path[]') }}">

                                                        @error('image_path')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="col-12" id="image_preview"
                                                        style="display: flex; flex-direction: row; flex-wrap: wrap;"></div>
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                        @elseif(in_array($key, FIELD_DESC))
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2"
                                                        for="validationCustom01">{{ $item }}</label>
                                                    <textarea id="editor" name="{{ $key }}">
                                                    </textarea>
                                                    @if ($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @elseif(array_key_exists($key, FIELD_SELECT_CUSTOM))
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2"
                                                        for="validationCustom01">{{ $item }}</label>
                                                    <select class="form-select" name="{{ $key }}">
                                                        @foreach (FIELD_SELECT_CUSTOM[$key] as $keyCustom => $itemCustom)
                                                            <option value="{{ $keyCustom }}">{{ $itemCustom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @elseif(in_array($key, FIELD_DATE))
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2"
                                                        for="validationCustom01">{{ $item }}</label>
                                                    <input type="text" id="date" class="form-control"
                                                        name="{{ $key }}">
                                                    <span class="form-text text-muted">dd/mm/yyyy</span>
                                                    @if ($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2"
                                                        for="validationCustom01">{{ $item }}</label>
                                                    <input type="text" class="form-control" id="validationCustom01"
                                                        name="{{ $key }}" value="{{ old($key) }}">
                                                    @if ($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="values">Dịch vụ </label>
                                                <select class="form-control values select_size" id="values"
                                                    multiple="multiple" name="service_id[]">
                                                    @foreach ($services as $service)
                                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('service_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col"></div>
                                        <div class="col-md-3">
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Thêm </button>
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
        $(function() {
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        $(selector).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function() {
                readURL(this, '#image_prev');
            });


        });
        $("#image_path").change(function() {
            if (this.files && this.files[0]) {
                for (let i = 0; i < this.files.length; i++) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var imageItem = '<div class="image-item" style="position: relative; margin: 10px;">';
                        imageItem += '<img style="width: 100px" src="' + e.target.result + '"/>';
                        imageItem +=
                            '<button class="delete-btn" onclick="deleteImage(this)"><i class="fas fa-times"></i></button>';
                        imageItem += '</div>';
                        $('#image_preview').append(imageItem);
                    }

                    reader.readAsDataURL(this.files[i]);
                }
            }
        });

        function deleteImage(btn) {
            if (confirm("Bạn có chắc chắn muốn xóa ảnh này không?")) {
                $(btn).parent().remove();
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("select.select_size").select2({
                tags: true,
                tokenSeparators: [',', ' '],
            }).on('select2:selecting', function(e) {});
        });
    </script>

    <script src="{{ asset('backend/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/mask.js') }}"></script>>
@endpush
