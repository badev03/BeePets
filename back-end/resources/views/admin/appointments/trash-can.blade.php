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
                @if(session()->has('failed_delete'))
                <div class="alert-danger alert">
                    {{ session('failed_delete') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <h4 class="card-title">Danh sách thùng rác</h4>
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
                                <td>Thời gian cuộc hẹn</td>
                                <td>Hành động</td>
                            </thead>
                            <tbody id="tbody_table">
                                    @foreach($data as $key=>$value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->doctor_id }}</td>
                                            <td>{{ $value->user_id }}</td>
                                            <td>{{ $value->type_pet_id }}</td>
                                            <td>{{ $value->service_id }}</td>
                                            <td>{!! $value->description !!}</td>
                                            <td>
                                                {{ '5 Nov 2023' }}
                                                <span class="text-primary d-block">{{ $value->date }}
                                                    - {{ $value->date }} AM</span>
                                            </td>
                                            <td class="d-flex" style="grid-gap:1rem">
                                                <div class="actions">
                                                    <a data-bs-toggle="modal" data-delete="{{ $value->id }}" href="#delete_modal_{{ $value->id }}" class="delete_data btn btn-sm bg-danger-light">
                                                        <i class="fe fe-trash"></i> Khôi phục
                                                    </a>
                                                    <div class="modal fade" id="delete_modal_{{ $value->id }}" aria-hidden="true" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="form-content p-2 text-center">
                                                                        <h4 class="modal-title">Khôi phục dữ liệu</h4>
                                                                        <p class="mb-4">Bạn có chắc chắn muốn khôi phục dữ liệu này</p>
                                                                        <div class="d-flex justify-content-center" style="gap: 1rem">
                                                                            <form action="{{ route('appointments.restore-trash', $value->id) }}" method="post">
                                                                                @csrf
                                                                                @method('DELETE')

                                                                                <button class="btn bg-success-light"
                                                                                        type="submit">Khôi phục
                                                                                </button>
                                                                            </form>
                                                                            <button type="button" class="btn bg-danger-light" data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
