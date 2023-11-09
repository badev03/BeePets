@extends('layouts.partials.master')
@section('title','')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
@endpush
@section('heading','hihihi')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if(!isset($appointmentCancel))
                <div class="alert-success alert">
                    Không tồn tại dữ liệu
                </div>
            @endif
            @if(isset($appointmentCancel))
                <div class="card">
                    <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-stripped">
                        <thead>
                            <td>#ID</td>
                            <td>Tên bác sĩ</td>
                            <td>Bệnh nhân</td>
                            <td>Loại thú cưng</td>
                            <td>Tên dịch vụ</td>
                            <td>Mô tả</td>
                            <td>Thời gian cuộc hẹn</td>
                            <td>Hành động</td>
                        </thead>
                        <tbody id="tbody_table_haha">
                            @foreach($appointmentCancel as $key=>$value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->doctor_id }}</td>
                                    <td>{{ $value->user_id }}</td>
                                    <td>{{ $value->type_pet_id }}</td>
                                    <td>{{ $value->service_id }}</td>
                                    <td>{!! $value->description !!}</td>
                                    <td>
                                        <span class="text-primary d-block">{{ $value->date }}
                                                    - {{ $value->date }} AM</span>
                                    </td>
                                    <td>
                                        <a class='btn btn-sm bg-danger-light' href="{{  route('appointments.cancel' , $value->id) }}">
                                            Xem chi tiết
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/datatables/datatables.min.js')}}"></script>
@endpush
