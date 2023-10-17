@extends('layouts.partials.master')
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3>
                                Chỉnh sửa lịch làm việc
                            </h3>
                        </div>
                        <div class="col">
                            <a class="btn btn-sm btn-primary float-end" href="{{ route('schedules.index') }}">Quay
                                lại</a>
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    <form action="{{ route('schedules.update',$schedule->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="values">Bác sĩ</label>
                                    <select class="form-control" id="" 
                                            name="doctor_id">
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" {{ $doctor->id == $schedule->doctor_id ? 'selected' : '' }}> {{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('doctor_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col"></div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="time">Thời gian mỗi ca</label>
                                    <input type="time" name="slot_time" id="time" class="form-control select_size"
                                           value="{{ $schedule->slot_time }}"
                                    >
                                    @error('slot_time')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="card-day">
                            <div class="row mb-3">
                                <div class="col">
<label class="form-label" for="date_old">Chọn ngày</label>
                                    <input type="date" name="date" id="date_old" class="form-control select_size" value="{{ $schedule->date }}" >
                                    @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="form-label" for="start_time_old">Thời gian bắt đầu</label>
                                    <input type="time" name="start_time" id="start_time_old" class="form-control select_size"
                                             value="{{ $schedule->start_time }}"
                                    >
                                    @error('start_time')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="form-label" for="end_time_old">Thời gian kết thúc</label>
                                    <input type="time" name="end_time" id="end_time_old" class="form-control select_size"
                                             value="{{ $schedule->end_time }}"
                                    >
                                    @error('end_time')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>

                        <div class="col">

                        </div>
                        <button type="submit" class="btn btn-success">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('script')
    



@endpush