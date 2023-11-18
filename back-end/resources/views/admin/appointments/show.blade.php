@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
@endpush
@section('heading','hihihi')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @include('admin.components.errors.errors')
            @php
                $stauts = '';
                $button = '';
                $routes = '';
                $cancel = '<div class="modal fade" id="huy_lich" aria-hidden="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-content p-2 text-center">
                                    <h4 class="modal-title">Xác nhận hủy lịch hẹn</h4>
                                    <p class="mb-4">Bạn có chắc chắn muốn hủy cuộc hẹn này không</p>
                                    <div class="d-flex justify-content-center" style="gap: 1rem">
                                    <form action="'.$routes.'" method="post">
                                        @csrf
                                        @method("DELETE")

                                        <button class="btn bg-success-light"
                                                type="submit">Hủy
                                        </button>
                                    </form>
                                        <button type="button" class="btn bg-danger-light" data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                if($data->status == 1) {
                    $routes_confirm_finish = route('appointments.for-confirmation-finished' , $data->id) ;
                    $routes_edit = route('appointment.edit' , $data->id) ;
                    $routes= route('appointment.destroy' ,  $data->id);
                     $stauts = 'Xác nhận';
                     if(date('Y-m-d') <= $data->date) {
                         $button = '<a data-bs-toggle="modal" href="#hoan_thanh_appointment" class="btn btn-sm bg-danger-light">Hoàn thành</a>
                     <div class="modal fade" id="hoan_thanh_appointment" aria-hidden="true" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-content p-2 text-center">
                                    <h4 class="modal-title">Xác nhận hoàn thành lịch hẹn</h4>
                                    <p class="mb-4">Bạn có chắc chắn muốn xác nhận hoàn thành  không</p>
                                    <div class="d-flex justify-content-center" style="gap: 1rem">
                                            <a href="'.$routes_confirm_finish.'" class="btn bg-success-light"
                                                    type="submit">Xác nhận
                                            </a>
                                        <button type="button" class="btn bg-danger-light" data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                     <a data-bs-toggle="modal" href="#huy_lich" class="btn btn-sm bg-success-light">Hủy lịch</a>

                     <a href="'.$routes_edit.'" class="btn btn-sm bg-info-light">Edit</a>';
                     }

                }
                elseif ($data->status == 0) {
                    $routes = route('appointment.destroy' , $data->id) ;
                    $routes_edit = route('appointment.edit' , $data->id) ;
                    $routes_confirm = route('appointments.for-confirmation' , $data->id) ;
                    $stauts = 'Chờ xác nhận';
                    $button = '<a data-bs-toggle="modal" href="#xac_nhan_appointments" class="btn btn-sm bg-danger-light">Xác nhận</a>
                    <div class="modal fade" id="xac_nhan_appointments" aria-hidden="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-content p-2 text-center">
                                    <h4 class="modal-title">Xác nhận lịch hẹn</h4>
                                    <p class="mb-4">Bạn có chắc chắn muốn xác nhận cuộc hẹn này không</p>
                                    <div class="d-flex justify-content-center" style="gap: 1rem">
                                            <a href="'.$routes_confirm.'" class="btn bg-success-light"
                                                    type="submit">Xác nhận
                                            </a>
                                        <button type="button" class="btn bg-danger-light" data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                     <a href="#huy_lich" class="btn btn-sm bg-success-light" data-bs-toggle="modal">Hủy lịch</a>
                     <a href="'.$routes_edit.'" class="btn btn-sm bg-info-light">Edit</a>';
                }
                elseif ($data->status == 2) {
                    $stauts = 'Đã Xóa';
                }
                elseif ($data->status == 3) {
                    $stauts = 'Đã hủy';
                }
                elseif ($data->status == 4) {
                    $stauts = 'Đã hoàn thành';
                    $routes = route('appointments.detail-bills-appointment' , $data->id) ;
                    $button = '<a href="'.$routes.'" class="btn btn-sm bg-info-light">Xem hóa đơn</a>';
                }
                elseif ($data->status == 6) {
                    $routes = route('appointment.destroy' , $data->id) ;
                    $stauts = 'Yêu cầu hủy';
                    $button = '<a href="#huy_lich" class="btn btn-sm bg-danger-light" data-bs-toggle="modal">Hủy lịch</a>';
                }
                elseif ($data->status == 7) {
                    $stauts = 'Yêu cầu đổi lịch';
                    if(date('Y-m-d') > $data->date) {
                        $button = '';
                    }else {
                        $button = '<a href="" class="btn btn-sm bg-info-light">Đổi lịch</a>';
                    }
                }
            @endphp
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-4 shadow-lg p-3 mb-5 bg-white rounded">
                            <div class="d-flex">
                                <div>
                                    <img style="border-radius: 20px; width: 200px" src="{{ $data->image_user }}" alt="" srcset="">
                                    <h6 class="mt-3">Chủ thú cưng : <span class="text-danger">{{ $data->user_id }}</span></h6>
                                </div>
                                <div class="ms-2">
                                    Trạng thái : <span class="text-danger">{{ $stauts }}</span>
                                </div>
                            </div>
                            <h6>Loại thú cưng  : <span>{{ $data->type_pet_id }}</span></h6>
                            <h6>Ca khám bệnh  : <span>{{ $data->shift_name }}  {{$data->start_time}}h - {{$data->start_time}}h</span></h6>
                            <h6>Ngày khám  : <span>{{ $data->date }}</span></h6>
                            <h6>Dịch vụ  : <span>{{ $data->service_id }}</span></h6>
                            <div class="d-flex">
                                <div>Ghi chú  : </div>
                                <div>{!! $data->description !!} </div>
                            </div>

                        </div>
                        <div class="col-sm-4 ms-2 shadow-lg p-3 mb-5 bg-white rounded">
                            <img style="border-radius: 20px; width: 200px" src="{{ $data->image_doctor }}" alt="" srcset="">
                            <h6 class="mt-3">Bác sĩ khám bệnh  : <span>{{ $data->doctor_id }}</span></h6>
                        </div>
                    </div>
                    {!! $button !!}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="huy_lich" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-content p-2 text-center">
                        <h4 class="modal-title">Xác nhận hủy lịch hẹn</h4>
                        <p class="mb-4">Bạn có chắc chắn muốn hủy cuộc hẹn này không</p>
                        <div class="row d-flex justify-content-center" style="gap: 1rem">
                            <form action="{{ route('appointment.destroy' , $data->id) }}" method="post">
                                @csrf
                                @method("DELETE")
                                <div class="col-sm-12">
                                    <p>Nhập lý do hủy lịch</p>
                                    <input type="text" class="form-control" name="reason_cancel">
                                </div>
                                <div class="mt-2">
                                    <button class="btn bg-success-light"
                                            type="submit">Hủy
                                    </button>
                                    <button type="button" class="btn bg-danger-light" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush
