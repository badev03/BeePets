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
                            <thead id="thead_table">
                                <td>#ID</td>
                                @foreach ($colums as $colum=>$name)
                                    <td>{{$name}}</td>
                                @endforeach
                                <td>Hành động</td>
                            </thead>
                            <tbody id="tbody_table">
                                    @foreach($data as $key=>$value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td class="sorting_1">
                                                <h2 class="table-avatar">
                                                    <a href="" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="{{ asset('backend/assets/img/patients/patient4.jpg') }}" alt="User Image"></a>
                                                    <a href=""> {{ $value->user_id }}</a>
                                                </h2>
                                            </td>
                                            <td>{{ $value->content }}</td>
                                            <td>
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $value->score)
                                                        <i class="fe fe-star text-warning"></i>
                                                    @else
                                                        <i class="fe fe-star text-secondary"></i>
                                                    @endif
                                                @endfor
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="{{ asset('backend/assets/img/doctors/doctor-thumb-04.jpg')  }}" alt="User Image"></a>
                                                    <a href=""> {{ $value->doctor_id }}</a>
                                                </h2>
                                            </td>
                                            <td>27 Sep 2023 <br><small>03.40 PM</small></td>
                                        @include('admin.components.button.action-index')
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/datatables/datatables.min.js')}}"></script>
@endpush
