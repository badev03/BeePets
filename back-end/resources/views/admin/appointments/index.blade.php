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
                            <thead>
                                <td>#ID</td>
                                @foreach ($colums as $colum=>$name)
                                    <td>{{$name}}</td>
                                @endforeach
                                <td>Thời gian cuộc hẹn</td>
                                <td>Hành động</td>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach($data as $key=>$value)
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->doctor_id }}</td>
                                        <td>{{ $value->user_id }}</td>
                                        <td>{{ $value->type_pet_id }}</td>
                                        <td>{{ $value->service_id }}</td>
                                        <td>{{ $value->description }}</td>
                                        <td>
                                            {{ '5 Nov 2023' }}
                                            <span class="text-primary d-block">{{ $value->start_time }}
                                                - {{ $value->end_time }} AM</span>
                                        </td>
                                        @include('admin.components.button.action-index')
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
