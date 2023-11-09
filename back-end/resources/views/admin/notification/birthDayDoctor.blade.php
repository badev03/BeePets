@extends('layouts.partials.master')
@section('title','hahaha')

@section('content')
    <div class="page-header">
        <div class="row">
            @if(session()->has('success_delete'))
                <div class="alert-success alert">
                    {{ session('success_delete') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <h4 class="card-title">Danh sách thông báo chúc mừng sinh nhật ngày hôm nay</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-stripped">
                        <thead>
                            <td>#ID</td>
                            <td>Thông báo</td>
                            <td>Bác sĩ</td>
                            <td>Giờ thông báo</td>
                            <td>Hành động</td>
                        </thead>
                        <tbody>
                        @foreach($doctors as $key=>$item)
                            <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->message_doctor }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td class="d-flex" style="grid-gap:1rem">
                                        <a data-bs-toggle="modal" href="#delete_modal_{{$item->id}}" class="btn btn-sm bg-danger-light">
                                            <i class="fe fe-trash"></i> Delete
                                        </a>
                                        @if(count($doctors)>0)
                                            <div class="modal fade" id="delete_modal_{{ $item->id }}" aria-hidden="true" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="form-content p-2 text-center">
                                                                <h4 class="modal-title">Delete</h4>
                                                                <p class="mb-4">Bạn có chắc chắn muốn xóa {{ $item->id }}</p>
                                                                <div class="d-flex justify-content-center" style="gap: 1rem">
                                                                    <form action="{{ route('birthDayDoctor.destroy' , $item->id) }}" method="post">
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/datatables/datatables.min.js')}}"></script>
@endpush
