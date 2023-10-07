@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
@endpush
@section('heading','hihihi')
@section('content')
    <div class="content container-fluid">
        @if(session()->has('success'))
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
                                <h5 class="card-title">Thêm {{ $title_web }}</h5>
                                <div class='d-flex flex-wrap'>
                                    @include(BUTTON_HEADER_ADMIN_LINK)
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <form action="{{ route($urlbase.'store') }}" class="needs-validation" novalidate="" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $user->id }}" name="user_id">
                                    <div class="row">
                                        <div class="col-md-10 mb-3">
                                            <label class="mb-2" for="validationCustom01">Bác sĩ</label>
                                            <select class="form-select" name="doctor_id">
                                                @foreach($dataDoctor as $keyDataDoctor=>$valueDataDoctor )
                                                    <option value="{{ $valueDataDoctor->id }}">{{ $valueDataDoctor->name }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('doctor_id'))
                                                <div class="error text-danger mt-2">{{ $errors->first('doctor_id') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-10 mb-3">
                                            <label class="mb-2" for="validationCustom01">Dịch vụ</label>
                                            <select class="form-select" name="service_id">
                                                @foreach($dataService as $keyDataService=>$valueDataService )
                                                    <option value="{{ $valueDataService->id }}">{{ $valueDataService->name }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('doctor_id'))
                                                <div class="error text-danger mt-2">{{ $errors->first('doctor_id') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-10 mb-3">
                                            <label class="mb-2" for="validationCustom01">Loại thú cưng</label>
                                            <select class="form-select" name="type_pet_id">
                                                @foreach($dataTypePet as $keyDataTypePet=>$valueDataTypePet )
                                                    <option value="{{ $valueDataTypePet->id }}">{{ $valueDataTypePet->name }}</option>
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
                                                </textarea>
                                                    @if($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="col-md-10 mb-3">
                                        <label class="col-form-label col-md-2 text-success">Chọn ngày</label>
                                        <input type="date" class="form-control api_day_create" name="day_appointments" value="{{ date('Y-m-d') }}"/>
                                    </div>
                                    <div class="mb-3 row checker">
                                        <label class="col-form-label text-success">Chọn giờ </label>
                                            <div class="col-md-2 time_shift">
                                                @if(1==2)
                                                <label class="col-form-label text-success">Ca </label>
                                                @endif
                                                <div class="checkbox" id="">
                                                    <label class="d-flex align-items-center" style="gap: 0.5rem">
                                                        @if(!empty($data_time_appointments))
                                                            @foreach($data_time_appointments as $key=>$value)
                                                                <input @if(in_array($value , $timeCompare)) disabled @endif name="time" type="radio"  value="{{ $value }}">{{ $value }}
                                                            @endforeach
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Thêm {{ $title_web }}</button>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-danger">Thông tin user</span>
                                <div class="profile-header">
                                    <div class="row align-items-center">
                                        <div class="col-auto profile-image">
                                            <a href="#">
                                                <img class="rounded-circle" alt="{{ $user->name }}" src="{{ asset('storage/peopleAccount/'.$user->avatar) }}">
                                            </a>
                                        </div>
                                        <div class="col ml-md-n2 profile-user-info">
                                            <h4 class="user-name mb-0">{{ $user->name }}</h4>
                                            <h6 class="text-muted">
                                                <a href="https://doccure.dreamguystech.com/cdn-cgi/l/email-protection"
                                                   class="__cf_email__" data-cfemail="fd8f849c93899c8491928fbd9c99909493d39e9290">{{ $user->email }}
                                                </a>
                                            </h6>
                                            <span class="text-danger">Số điện thoại {{ $user->phone }}</span>
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
    <script>
        var currentDate = new Date();
        var currentDateString = currentDate.toISOString().slice(0, 10);

        var dateInput = document.querySelector('input[type="date"]');
        dateInput.min = currentDateString;

        $(document).ready(function() {
            $('.api_day_create').change(function() {
                {{--    var day = $(this).val();--}}
                {{--    var id = {{ $model->id }}; --}}
                {{--    var url = "{{ route($urlbase.'get-day', ['day' => ':day', 'id' => ':id']) }}".replace(':day', day).replace(':id', id);--}}
                {{--    $.ajax({--}}
                {{--        type: 'GET',--}}
                {{--        url: url,--}}
                {{--        dataType: 'json',--}}
                {{--        success: function(data) {--}}
                {{--            $('.time_shift').remove();--}}
                {{--            var newTimeShiftContainer = $('<div class="time_shift d-flex"></div>');--}}
                {{--            // var timeSetupData = JSON.parse($('#timeSetupData').text());--}}
                {{--            $.each(data.time_work_shift, function(key, value) {--}}
                {{--                var div = $('<div class="col-md-2"></div>');--}}
                {{--                var label = $('<label class="col-form-label col-md-2 text-success">Ca ' + (key + 1) + '</label>');--}}
                {{--                var checkboxDiv = $('<div class="checkbox"></div>');--}}
                {{--                var checkboxLabel = $('<label class="d-flex align-items-center" style="gap: 0.5rem"></label>');--}}
                {{--                var input = $('<input type="radio" name="shift_appointment" value="' + (key + 1) + '">');--}}
                {{--                if((key + 1) === 1) {--}}
                {{--                    var text = '9:00:00 - 11:00:00 AM';--}}
                {{--                }--}}
                {{--                else if ((key + 1) === 2) {--}}
                {{--                    var text = '11:00:00 - 13:00:00 AM';--}}
                {{--                }--}}
                {{--                else if ((key + 1) === 3) {--}}
                {{--                    var text = '13:00:00 - 15:00:00 AM';--}}
                {{--                }--}}

                {{--                checkboxLabel.append(input);--}}
                {{--                checkboxLabel.append(text);--}}
                {{--                checkboxDiv.append(checkboxLabel);--}}
                {{--                div.append(label);--}}
                {{--                div.append(checkboxDiv);--}}
                {{--                newTimeShiftContainer.append(div);--}}
                {{--            });--}}

                {{--            $('.checker').append(newTimeShiftContainer);--}}
                {{--        },--}}
                {{--        error: function(xhr, status, error) {--}}
                {{--            console.error(error);--}}
                {{--        }--}}
                {{--    });--}}
                });
            });
    </script>
    <script>
        $(function(){
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $(selector).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function () {
                readURL(this, '#image_prev');
            });

        });
    </script>
    <script src="{{asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/mask.js')}}"></script>>

@endpush
