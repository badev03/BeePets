@extends('layouts.partials.master')
@section('title','hahaha')
@section('content')
    <div class="row">
            @include('admin.components.errors.errors')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <h4 class="card-title">Cấu hình website</h4>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{ route('setting') }}" class="needs-validation" novalidate="" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="d-flex col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Logo header</label>
                                                <input name="image_header" type="file" class="form-control" id="header_image"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <img
                                            style="width: 300px"
                                            src="{{ $data_first->image_header ?? 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}"
                                            alt="" id="image_prev">
                                    </div>
                                </div>

                                <div class="d-flex col-sm-12 mt-5">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Logo footer</label>
                                                <input type="file" class="form-control" name="image_footer" id="footer_image"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <img
                                            style="width: 300px"
                                            src="{{ $data_first->image_footer ?? 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}"
                                            alt="" id="image_footer_prev">
                                    </div>
                                </div>

                                <div class="d-flex col-sm-12 mt-3">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Địa chỉ</label>
                                                <input name="address" type="text" class="form-control" value="{{ old($data_first->address) ?? $data_first->address }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Số điện thoại</label>
                                                <input name="phone" type="text" class="form-control" value="{{ old($data_first->phone) ?? $data_first->phone }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Email</label>
                                                <input name="email" type="text" class="form-control" value="{{ old($data_first->email) ?? $data_first->email }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Giới thiệu</label>
                                                <textarea style="height: 200px" name="description" class="form-control">{{ old($data_first->description) ?? $data_first->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="col-1 btn bg-success-light" type="submit">Lưu</button>
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
            $("#header_image").change(function() {
                readURL(this, '#image_prev');
            });

            $('#footer_image').change(function () {
                readURL(this, '#image_footer_prev');
            });

        });
    </script>
@endpush


