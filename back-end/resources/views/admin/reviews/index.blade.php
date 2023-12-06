@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
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
                            <h4 class="card-title">Danh sách {{ $title_web }}</h4>
                            <div class='d-flex flex-wrap'>
                                @include(BUTTON_HEADER_ADMIN_LINK)
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table table-stripped">
                            <thead id="thead_table">
                                <td>#ID</td>
                                @foreach ($colums as $colum=>$name)
                                    <td>{{$name}}</td>
                                @endforeach
                                <td>Ngày bình luận</td>
                                <td>Hành động</td>
                            </thead>
                            <tbody id="tbody_table">
                                    @foreach($data as $key=>$value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td class="sorting_1">
                                                <h2 class="table-avatar">
                                                    <a href="" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="{{ $value->avatar }}" alt="User Image"></a>
                                                    <a href=""> {{ $value->user_id }}</a>
                                                </h2>
                                            </td>
                                            <td>
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $value->score)
                                                        <i class="fe fe-star text-warning"></i>
                                                    @else
                                                        <i class="fe fe-star text-secondary"></i>
                                                    @endif
                                                @endfor
                                            </td>

                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="{{ $value->doctor_image }}" alt="User Image"></a>
                                                    <a href=""> {{ $value->doctor_id }}</a>
                                                </h2>
                                            </td>
                                            <td>@if($value->status == null)
                                                    Chưa chấp nhận
                                                @elseif($value->status == 1)
                                                    Đã chấp nhận
                                                @endif
                                            </td>
                                            <td>{{ isset($value->created_at) ? $value->created_at : 'N/A' }}</td>
                                            <td class="d-flex" style="grid-gap:1rem">
                                                <div class="actions">
                                                    <a href="{{ route($urlbase.'show', [$value->id]) }}" class="btn btn-sm bg-info-light buttonView"
                                                           >
                                                        <i class="far fa-eye"></i> Xem chi tiết
                                                    </a>
                                                </div>
                                                <a data-bs-toggle="modal" href="#delete_modal_{{$value->id}}" class="btn btn-sm bg-danger-light">
                                                    <i class="fe fe-trash"></i> Xóa
                                                </a>
                                                @if(count($data)>0)
                                                    <div class="modal fade" id="delete_modal_{{ $value->id }}" aria-hidden="true" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="form-content p-2 text-center">
                                                                        <h4 class="modal-title">Delete</h4>
                                                                        <p class="mb-4">Bạn có chắc chắn muốn xóa </p>
                                                                        <div class="d-flex justify-content-center" style="gap: 1rem">
                                                                            <form action="{{ route($urlbase . 'destroy', $value->id) }}" method="post">
                                                                                @csrf
                                                                                @method('DELETE')

                                                                                <button class="btn bg-success-light"
                                                                                        type="submit">Xóa
                                                                                </button>
                                                                            </form>
                                                                            <button type="button" class="btn bg-danger-light" data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                 @endif
                                            </td>
                                        @include('admin.components.button.action-index')
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
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
