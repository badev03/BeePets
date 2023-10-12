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
                    <div class="row">
                        <div class="col-sm">
                            <form action="{{ route($urlbase.'update' , [$model->id]) }}" class="needs-validation" novalidate="" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label class="mb-2" for="validationCustom01">Bác sĩ</label>
                                        <select class="form-select" name="doctor_id">
                                            @foreach($dataDoctor as $keyDataDoctor=>$valueDataDoctor )
                                                <option value="{{ $valueDataDoctor->id }}" @if($valueDataDoctor->id == $model->doctor_id) selected @endif>{{ $valueDataDoctor->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('doctor_id'))
                                            <div class="error text-danger mt-2">{{ $errors->first('doctor_id') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label class="mb-2" for="validationCustom01">Dịch vụ</label>
                                        <select class="form-select" name="service_id">
                                            @foreach($dataService as $keyDataService=>$valueDataService )
                                                <option value="{{ $valueDataService->id }}" @if($valueDataService->id == $model->doctor_id) selected @endif>{{ $valueDataService->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('doctor_id'))
                                            <div class="error text-danger mt-2">{{ $errors->first('doctor_id') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label class="mb-2" for="validationCustom01">Loại thú cưng</label>
                                        <select class="form-select" name="service_id">
                                            @foreach($dataTypePet as $keyDataTypePet=>$valueDataTypePet )
                                                <option value="{{ $valueDataTypePet->id }}" @if($valueDataTypePet->id == $model->doctor_id) selected @endif>{{ $valueDataTypePet->name }}</option>
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
                                            <div class="col-md-8 mb-3">
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
                                            <div class="col-md-8 mb-3">
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
                                            <div class="col-md-8 mb-3">
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
                                <div class="col-md-8 mb-3">
                                    <label class="col-form-label col-md-2 text-success">Chọn ngày</label>
                                    <input type="date" class="form-control api_day" name="date" value="{{ $model->date }}"/>
                                </div>
{{--                                <div class="mb-3 row checker">--}}
{{--                                    @foreach($time_work_shift as $keyWork=>$valueWork)--}}
{{--                                    <div class="col-md-2 time_shift">--}}
{{--                                        <label class="col-form-label text-success">Ca {{ $keyWork+1 }}</label>--}}
{{--                                        <div class="checkbox" id="">--}}
{{--                                            <label class="d-flex align-items-center" style="gap: 0.5rem">--}}
{{--                                                <input type="radio" @if($model->word_shift == $keyWork+1) checked @endif name="shift_appointment" value="{{ $keyWork+1 }}"> {{ $time_set_up_shift[$keyWork] }}--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
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
            $('.api_day').change(function() {
                var day = $(this).val();
                var id = {{ $model->id }}; // Đảm bảo rằng $model->id có giá trị hợp lệ
                var url = "{{ route($urlbase.'get-day', ['day' => ':day', 'id' => ':id']) }}".replace(':day', day).replace(':id', id);
                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'json',
                    success: function(data) {
                        $('.time_shift').remove();
                        var newTimeShiftContainer = $('<div class="time_shift d-flex"></div>');
                        // var timeSetupData = JSON.parse($('#timeSetupData').text());
                        $.each(data.time_work_shift, function(key, value) {
                            var div = $('<div class="col-md-2"></div>');
                            var label = $('<label class="col-form-label col-md-2 text-success">Ca ' + (key + 1) + '</label>');
                            var checkboxDiv = $('<div class="checkbox"></div>');
                            var checkboxLabel = $('<label class="d-flex align-items-center" style="gap: 0.5rem"></label>');
                            var input = $('<input type="radio" name="shift_appointment" value="' + (key + 1) + '">');
                            if((key + 1) === 1) {
                                var text = '9:00:00 - 11:00:00 AM';
                            }
                            else if ((key + 1) === 2) {
                                var text = '11:00:00 - 13:00:00 AM';
                            }
                            else if ((key + 1) === 3) {
                                var text = '13:00:00 - 15:00:00 AM';
                            }

                            checkboxLabel.append(input);
                            checkboxLabel.append(text);
                            checkboxDiv.append(checkboxLabel);
                            div.append(label);
                            div.append(checkboxDiv);
                            newTimeShiftContainer.append(div);
                        });

                        $('.checker').append(newTimeShiftContainer);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endpush
