@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
@endpush
@section('heading','hihihi')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @include('admin.components.errors.errors_common')
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <h4 class="card-title">Danh sách {{ $title_web }}</h4>
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
                                <div class="row">
                                    <div class="col-md-8 d-flex">
                                        <label class="mb-2 text-danger" for="validationCustom01">Tên người gửi :</label>
                                        <div>
                                            {{$model->user_id}}
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <label class="mb-2 text-danger" for="validationCustom01">Nôi dung đánh giá :</label>
                                        <div class="alert alert-primary" role="alert">
                                            {{$model->content}}
                                        </div>
                                    </div>

                                    <div class="col-md-8 d-flex">
                                        <label class="mb-2 text-danger" for="validationCustom01">Sao đánh giá :</label>
                                        <div class="ms-2">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $model->score)
                                                    <i class="fe fe-star text-warning"></i>
                                                @else
                                                    <i class="fe fe-star text-secondary"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <label class="mb-2" for="validationCustom01">Trạng thái đánh giá</label>
                                        <select class="form-select" name="status">
                                                <option value="" @if(null == $model->status) selected @endif>Không chấp nhận đánh giá</option>
                                                <option value="1" @if(1 == $model->status) selected @endif>Chấp nhận đánh giá</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-sm bg-info-light buttonView mt-3">
                                    Lưu
                                </button>
                            </form>
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
