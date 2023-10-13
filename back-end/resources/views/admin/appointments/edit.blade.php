@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
@endpush
@section('heading','hihihi')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if(session()->has('success'))
                <div class="alert-success alert">
                    {{ session('success') }}
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
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{ route($urlbase.'update' , [$model->id]) }}" class="needs-validation" novalidate="" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="d-flex">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Dịch vụ</label>
                                                <select class="form-select" name="service_id" id="service_id">
                                                    @foreach($dataService as $keyDataService=>$valueDataService )
                                                        <option value="{{ $valueDataService->id }}" @if($valueDataService->id == $model->doctor_id) selected @endif>{{ $valueDataService->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('service_id'))
                                                    <div class="error text-danger mt-2">{{ $errors->first('service_id') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Loại thú cưng</label>
                                                <select class="form-select" name="type_pet_id">
                                                    @foreach($dataTypePet as $keyDataTypePet=>$valueDataTypePet )
                                                        <option value="{{ $valueDataTypePet->id }}" @if($valueDataTypePet->id == $model->doctor_id) selected @endif>{{ $valueDataTypePet->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('type_pet_id'))
                                                    <div class="error text-danger mt-2">{{ $errors->first('type_pet_id') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Bác sĩ</label>
                                                <select class="form-select" name="doctor_id" id="doctor_id">
                                                    @foreach($dataDoctor as $keyDataDoctor=>$valueDataDoctor )
                                                        <option value="{{ $valueDataDoctor->id }}" @if($valueDataDoctor->id == $model->doctor_id) selected @endif>{{ $valueDataDoctor->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('doctor_id'))
                                                    <div class="error text-danger mt-2">{{ $errors->first('doctor_id') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        @foreach($colums as $key=>$item)
                                            @if(DESC_FIELD === $key)
                                                <div class="row">
                                                    <div class="col-md-10 mb-3">
                                                        <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                        <textarea id="editor" name="description">
                                                        {{ $model->$key }}
                                                    </textarea>
                                                        @if($errors->has($key))
                                                            <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @elseif(in_array($key , $FIELD_SELECT_CUSTOM_CONTROLLER) && isset($addDataSelect))
                                                <div class="row">
                                                    <div class="col-md-10 mb-3">
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
                                                    <div class="col-md-10 mb-3">
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
                                            @endif
                                        @endforeach
                                        <div class="col-md-10 mb-3">
                                            <label class="col-form-label col-md-2 text-success">Chọn ngày</label>
                                            <input id="day-create" type="date" class="form-control api_day_create" name="date" value="{{ $model->date }}"/>
                                            @if($errors->has('date'))
                                                <div class="error text-danger mt-2">{{ $errors->first('date') }}</div>
                                            @endif
                                        </div>
                                        <div class="mb-3 row checker">
                                            <label class="col-form-label text-success">Chọn Ca </label>
                                            <div class="col-md-6 time_shift">
                                                <div class="checkbox" id="">
                                                    <label id="shift_appointment" class="d-flex align-items-center" style="gap: 0.5rem">
                                                        @if(!empty($getDayDefault))
                                                            @foreach($getDayDefault as $key=>$value)
                                                                <input @if($value->shift_name === $model->shift_name) checked @endif name="shift_name" type="radio"  value="{{ $value->shift_name }}">{{ $value->shift_name }}
                                                            @endforeach
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="text-danger">Thông tin user</span>
                                        <div class="profile-header">
                                            <div class="row align-items-center">
                                                <div class="col-md-12 mb-3">
                                                    <label class="mb-2" for="validationCustom01">Tên khách hàng</label>
                                                    <input disabled id="user_id" type="text" class="form-control " value="{{ $user->name }}"/>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label class="mb-2" for="validationCustom01">Số điện thoại</label>
                                                    <input name="user_id" type="text" class="form-control" value="{{ $user->phone }}"/>
                                                    @if($errors->has('user_id'))
                                                        <div class="error text-danger mt-2">{{ $errors->first('user_id') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Update {{ $title_web }}</button>
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
    <script>
        var currentDate = new Date();
        var currentDateString = currentDate.toISOString().slice(0, 10);

        var dateInput = document.querySelector('input[type="date"]');
        dateInput.min = currentDateString;

        $(document).ready(function() {
            $('.api_day_create').change(function() {
                var day = $(this).val();
                var id = $('#doctor_id').val();
                var url = "{{ route($urlbase.'get-day', ['day' => ':day', 'id' => ':id']) }}".replace(':day', day).replace(':id', id);
                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'json',
                    success: function(data) {
                        let shift_appointment_default = $('#shift_appointment');
                        shift_appointment_default.empty();
                        if(data.time_work_shift.length>0) {
                            $.each(data.time_work_shift, function (index, shift) {
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
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            $('#service_id').change(function () {
                let service_id = $(this).val();
                $.ajax({
                    type : 'GET',
                    url : '{{ route('get.doctor' , ['id' => ':id']) }}'.replace(':id', service_id),
                    success : function (data){
                        let doctorSelect = $('#doctor_id');
                        doctorSelect.empty();
                        if(data.doctor.length>0) {
                            doctorSelect.append($('<option value="" {{ old('service_id') }}>Chọn bác sĩ</option>')

                            );
                            $.each(data.doctor, function (key, value) {
                                doctorSelect.append($('<option></option>')
                                    .attr('value', value.id)
                                    .text(value.name)
                                );
                            });
                        }
                        else {
                            doctorSelect.append($('<option>âjssj</option>')
                                .attr('value', '')
                                .text('Không có dữ liệu')
                            );
                        }
                    },
                    error : function (error) {
                        console.log(error);
                    }
                })
            })

            $('#doctor_id').change(function () {
                let doctor_id = $(this).val();
                let day = $('#day-create').val();
                $.ajax({
                    type: 'GET',
                    url : '{{ route('get.shift.doctor' , ['id' => ':id' , 'day' => ':day']) }}'.replace(':id', doctor_id).replace(':day' , day),
                    success : function (data){
                        let shift_appointment_default = $('#shift_appointment');
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
            })
        });
    </script>
@endpush
