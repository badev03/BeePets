@extends('layouts.partials.master')
@section('title','')
@push('style')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
@endpush
@section('heading','hihihi')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @include('admin.components.errors.errors')
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <h4 class="card-title">Bác sĩ <span class="text-danger">{{ $appointmentCancel->doctor_id }}</span> đã yêu cầu hủy lịch hẹn này</h4>
                        </div>
                    </div>

                    <div class="shadow-lg p-3 mb-3 bg-body rounded mt-3">
                        <div class="row d-flex">
                            <h6 class="card-title text-danger">Nội dung hủy</h6>
                            <p>
                                {{ $appointmentCancel->message_admin }}
                            </p>
                        </div>
                    </div>
                    <div class="shadow-lg p-3 mb-5 bg-body rounded">
                        <div class="row d-flex">
                            <h6>Người đặt lịch hẹn : {{ $appointmentCancel->user_id }}</h6>
                            <h6>Bác sĩ nhận đơn : {{ $appointmentCancel->doctor_id }}</h6>
                            <p>Thời gian cuộc hẹn ngày : {{ $appointmentCancel->date }} thời gian : 119181</p>
                            <p>Số điện thoại người dùng : {{ $appointmentCancel->phone }}</p>
                            <p>Dịch vụ : {{ $appointmentCancel->service_id }}</p>
                            <p>Nội dung của người đặt cuộc hẹn : {{ $appointmentCancel->description }}</p>
                            <p class="text-danger">Trạng thái : Hủy cuộc hẹn</p>
                            <div class="d-flex align-items-center">
                                <a data-bs-toggle="modal" href="#huy_appointments_{{ $appointmentCancel->id }}" class="btn btn-sm bg-danger-light me-3 d-flex align-items-center">Hủy cuộc hẹn</a>
                                <div class="modal fade" id="huy_appointments_{{ $appointmentCancel->id }}" aria-hidden="true" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="form-content p-2">
                                                    <h4 class="modal-title text-center">Bạn có chắc chắn muốn hủy cuộc hẹn này</h4>
                                                    <form action="{{ route('appointments.cancel-doctor-admin' , [$appointmentCancel->id] ) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="d-flex justify-content-center align-items-center" style="gap: 0.5rem">
                                                            <button type="button" class="btn bg-danger-light" data-bs-dismiss="modal">Close</button>
                                                            <button class="btn bg-success-light" type="submit">Hủy cuộc hẹn</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                {{--                                <a href="{{ route('appointment.edit' ,$appointmentCancel->id ) }}" class="btn btn-sm bg-success-light me-3 d-flex align-items-center">Đổi bác sĩ</a>--}}
                                <a data-bs-toggle="modal" href="#change_schedule_modal_{{ $appointmentCancel->id }}" class="btn btn-sm bg-success-light me-3 d-flex align-items-center">Đổi bác sĩ</a>
                                <div class="modal fade" id="change_schedule_modal_{{ $appointmentCancel->id }}" aria-hidden="true" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="form-content p-2">
                                                    <h4 class="modal-title text-center">Mời chọn bác sĩ</h4>
                                                    <form action="{{ route('appointments.change-doctor-admin' , [$appointmentCancel->id] ) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <p class="mb-1 p-0">Chọn bác sĩ</p>
                                                            <select class="form-select" name="doctor_id" id="doctor_id_change">
                                                                <option value="">Chọn bác sĩ</option>
                                                                @foreach($dataDoctor as $key=>$value)
                                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12 mt-2">
                                                            <p class="mb-1 p-0">Chọn ca</p>
                                                            <div class="d-flex" style="gap: 0.5rem" id="shift_appointment_change">
                                                                <label id="" class="d-flex align-items-center" style="gap: 0.5rem">
                                                                    <input name="shift_name" type="radio"  value="Ca 1">Ca 1
                                                                </label>
                                                                <label id="" class="d-flex align-items-center" style="gap: 0.5rem">
                                                                    <input name="shift_name" type="radio"  value="Ca 2">Ca 2
                                                                </label>
                                                                <label id="" class="d-flex align-items-center" style="gap: 0.5rem">
                                                                    <input name="shift_name" type="radio"  value="Ca 3">Ca 3
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <button type="button" class="btn bg-danger-light" data-bs-dismiss="modal">Close</button>
                                                        <button class="btn bg-success-light" type="submit">Đổi cuộc hẹn</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <script>
        $('#doctor_id_change').change(function () {
            let doctor_id = $(this).val();
            let day = '{{ $appointmentCancel->date }}'
            $.ajax({
                type: 'GET',
                url : '{{ route('get.shift.doctor' , ['id' => ':id' , 'day' => ':day']) }}'.replace(':id', doctor_id).replace(':day' , day),
                success : function (data){
                    console.log(data)
                    let shift_appointment_default = $('#shift_appointment_change');
                    shift_appointment_default.empty();
                    if(data.shift_appointment.length>0) {
                        $.each(data.shift_appointment, function (index, shift) {
                            let radioButton = $('<input>')
                                .attr('type', 'radio')
                                .attr('name', 'shift_name')
                                .attr('value', shift.shift_name);

                            let label = $('<label>').text(shift.shift_name);

                            shift_appointment_default.append(radioButton);
                            shift_appointment_default.append(label);
                        });
                    } else {
                        shift_appointment_default.append('<p>Không có lịch hẹn nào khả dụng.</p>');
                    }
                },
                error : function (error) {
                    console.log(error);
                }
            })
        });
    </script>
@endpush
