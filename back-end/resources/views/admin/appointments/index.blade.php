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
                    <div class="row mt-3">
                        <h6 class="card-title text-danger">Bộ lọc</h6>
                        <div class="col-4 mt-3">
                            <label class="form-label">Loại thú cưng</label>
                            <select class="form-select" name="type_pet_id">
                                @foreach($dataTypePet as $key=>$value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 mt-3">
                            <label class="form-label">Chọn bác sĩ</label>
                            <select class="form-select doctor_id_index" name="doctor_id">
                                @foreach($dataDoctor as $key=>$value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 mt-3">
                            <label class="form-label">Dịch vụ</label>
                            <select class="form-select service_id_index" name="service_id">
                                @foreach($dataService as $key=>$value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 mt-3">
                            <label class="form-label">Chọn ngày</label>
                            <input style="height: 38px" type="date" class="form-control" id="date_filter">
                        </div>
                        <div class="col-4 mt-3">
                            <label class="form-label">Ca làm việc</label>
                            <select class="form-select" id="time_appointments" name="time_appointments">
                                    <option value="Ca 1">Ca 1</option>
                                    <option value="Ca 2">Ca 2</option>
                                    <option value="Ca 3">Ca 3</option>
                            </select>
                        </div>
                        <div class="col-4 mt-3">
                            <label class="form-label">Tên người dùng</label>
                            <input style="height: 38px" id="search_input" name="name" type="text" class="form-control">
                        </div>
                    </div>
                    <button id="filter_searchName" class="btn me-2 btn-sm bg-success-light mt-3">Filter</button>
                    <a href="{{ route($urlbase.'index') }}" class="btn btn-sm bg-danger-light mt-3">Clear Filter</a>
                    <hr class="hr"/>

                    <h6 class="card-title text-danger">Bộ lọc ngày</h6>
                    <div class="row">
                        <div class="col-4 mt-3">
                            <label class="form-label">Ca sắp tới</label>
                            <select class="form-select" name="type_pet_id">
                                @foreach($dataTypePet as $key=>$value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-4 mt-3">
                            <label class="form-label">Ca sắp tới</label>
                            <select class="form-select" name="type_pet_id">
                                @foreach($dataTypePet as $key=>$value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr class="hr"/>

                    <div class="row mt-3">
                        <h6 class="card-title text-danger">Tìm kiếm tài khoản </h6>
                        <div class="col-4 mt-3">
                            <label class="form-label">Số điện thoại người dùng</label>
                            <input style="height: 38px" id="search_phone" name="phoneSearch" type="text" class="form-control">
                        </div>
                    </div>
                    <button id="filter_searchPhone" class="btn me-2 btn-sm bg-success-light mt-3">Tìm kiếm</button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table table-stripped">
                            <thead id="thead_table">
                                <td>#ID</td>
                                @foreach ($colums as $colum=>$name)
                                    <td>{{$name}}</td>
                                @endforeach
                                <td>Ngày hẹn</td>
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
                                            <td>{!! $value->date !!}</td>
                                            <td>
                                                <span class="text-primary d-block">{{ $value->start_time }}
                                                    - {{ $value->end_time }} AM</span>
                                            </td>
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
    <script>
        var currentDate = new Date();
        var currentDateString = currentDate.toISOString().slice(0, 10);

        var dateInput = document.getElementById('date_filter');
        dateInput.min = currentDateString;

    //    bộ lọc
        $(document).ready(function () {
            $('#date_filter').change(function () {
                var data = $(this).val();
                $.ajax({
                    type : 'GET',
                    url : '{{ route($urlbase.'filter-date' , '') }}' + '/' + data,
                    success: function (data) {
                        clearData()
                        var html = '';
                        var time = '';
                        if(data.day_appointments.length == 0) {
                            html += '<tr><td colspan="7">KHÔNG CÓ DỮ LIỆU</td></tr>';
                        }
                        else {
                            $.each(data.day_appointments , function (key , value) {
                                if(value.shift_appointment === 2) {
                                    time+= '<td>' + value.day_appointments +'' +
                                        '<span class="text-primary d-block">11:00:00 - 13:00:00 AM</span>' +
                                        '</td>'
                                }
                                else if(value.shift_appointment === 1) {
                                    time+= '<td>' + value.day_appointments +'' +
                                        '<span class="text-primary d-block">09:00:00 - 11:00:00 AM</span>' +
                                        '</td>'
                                }
                                else if(value.shift_appointment === 3) {
                                    time+= '<td>' + value.day_appointments +'' +
                                        '<span class="text-primary d-block">13:00:00 - 15:00:00 AM</span>' +
                                        '</td>'
                                }
                                html+= '<tr>' +
                                    '<td>' + (key+1) +'</td>' +
                                    '<td>' + value.doctor_id + '</td>' +
                                    '<td>' + value.user_id + '</td>' +
                                    '<td>' + value.type_pet_id + '</td>' +
                                    '<td>' + value.service_id + '</td>' +
                                    '<td>' + value.service_id + '</td>' +
                                    '<td>'+ value.description +'</td>' +
                                    button_action(value.id) +
                                    '</tr>';
                            })
                            button_action()
                        }
                        $('#tbody_table').html(html);

                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            })

            $('.service_id_index').change(function () {
                var data = $(this).val();
                $.ajax({
                    type : 'GET',
                    url : '{{ route($urlbase.'filter-service' , '') }}' + '/' + data,
                    success: function (data) {
                        clearData()
                        var html = '';
                        var time = '';
                        if(data.service.length == 0) {
                            html += '<tr><td colspan="7">KHÔNG CÓ DỮ LIỆU</td></tr>';
                        }
                        else {
                            $.each(data.service , function (key , value) {
                                html+= '<tr>' +
                                    '<td>' + (key+1) +'</td>' +
                                    '<td>' + value.doctor_id + '</td>' +
                                    '<td>' + value.user_id + '</td>' +
                                    '<td>' + value.type_pet_id + '</td>' +
                                    '<td>' + value.service_id + '</td>' +
                                    '<td>' + value.service_id + '</td>' +
                                    '<td>'+ value.description +'</td>' +
                                    button_action(value.id) +
                                    '</tr>';
                            })
                            button_action()
                        }
                        $('#tbody_table').html(html);

                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            })

            $('.doctor_id_index').change(function () {
                var data = $(this).val();
                $.ajax({
                    type : 'GET',
                    url : '{{ route($urlbase.'filter-doctor' , '') }}' + '/' + data,
                    success: function (data) {
                        clearData()
                        var html = '';
                        var time = '';
                        if(data.doctor.length == 0) {
                            html += '<tr><td colspan="7">KHÔNG CÓ DỮ LIỆU</td></tr>';
                        }
                        else {
                            $.each(data.doctor , function (key , value) {
                                html+= '<tr>' +
                                    '<td>' + (key+1) +'</td>' +
                                    '<td>' + value.doctor_id + '</td>' +
                                    '<td>' + value.user_id + '</td>' +
                                    '<td>' + value.type_pet_id + '</td>' +
                                    '<td>' + value.service_id + '</td>' +
                                    '<td>' + value.service_id + '</td>' +
                                    '<td>'+ value.description +'</td>' +
                                    button_action(value.id) +
                                    '</tr>';
                            })
                            button_action()
                        }
                        $('#tbody_table').html(html);

                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            })

            $('#filter_searchName').click(function () {
                var searchTerm = $('#search_input').val();
                var postData = {
                    searchTerm: searchTerm
                };

                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route($urlbase.'filter-search') }}',
                    data: postData,
                    success: function (data) {
                        clearData()
                        var html = '';
                        var time = '';
                        if(data.searchUser.length == 0) {
                            html += '<tr><td colspan="7">KHÔNG CÓ DỮ LIỆU</td></tr>';
                        }
                        else {
                            $.each(data.searchUser , function (key , value) {
                                if(value.shift_appointment === 2) {
                                    time+= '<td>' + value.day_appointments +'' +
                                        '<span class="text-primary d-block">11:00:00 - 13:00:00 AM</span>' +
                                        '</td>'
                                }
                                else if(value.shift_appointment === 1) {
                                    time+= '<td>' + value.day_appointments +'' +
                                        '<span class="text-primary d-block">09:00:00 - 11:00:00 AM</span>' +
                                        '</td>'
                                }
                                else if(value.shift_appointment === 3) {
                                    time+= '<td>' + value.day_appointments +'' +
                                        '<span class="text-primary d-block">13:00:00 - 15:00:00 AM</span>' +
                                        '</td>'
                                }
                                html+= '<tr>' +
                                    '<td>' + (key+1) +'</td>' +
                                    '<td>' + value.doctor_id + '</td>' +
                                    '<td>' + value.user_id + '</td>' +
                                    '<td>' + value.type_pet_id + '</td>' +
                                    '<td>' + value.service_id + '</td>' +
                                    '<td>' + value.service_id + '</td>' +
                                    '<td>'+ value.description +'</td>' +
                                    button_action(value.id) +
                                    '</tr>';
                            })
                            button_action()
                        }
                        $('#tbody_table').html(html);
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            $('#filter_searchPhone').click(function () {
                var searchPhone = $('#search_phone').val();
                var postData = {
                    searchPhones: searchPhone
                };
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route($urlbase.'filter-search-phone') }}',
                    data: postData,
                    success: function (data) {
                        console.log(data)
                        clearData()
                        $('#thead_table').empty();
                        var header =
                            '<td style="width:50px">ID</td>' +
                            '<td style="width:100px">Name</td>' +
                            '<td style="width:100px">Email</td>' +
                            '<td style="width:100px">Phone</td>' +
                            '<td style="width:100px">Hành Động</td>';
                        $('#thead_table').html(header);
                        var html = '';
                        var time = '';
                        if(data.searchUser.length == 0) {
                            html += '<tr><td>KHÔNG CÓ DỮ LIỆU</td></tr>';
                        }
                        else {
                            $.each(data.searchUser , function (key , value) {
                                if(value.shift_appointment === 2) {
                                    time+= '<td>' + value.day_appointments +'' +
                                        '<span class="text-primary d-block">11:00:00 - 13:00:00 AM</span>' +
                                        '</td>'
                                }
                                else if(value.shift_appointment === 1) {
                                    time+= '<td>' + value.day_appointments +'' +
                                        '<span class="text-primary d-block">09:00:00 - 11:00:00 AM</span>' +
                                        '</td>'
                                }
                                else if(value.shift_appointment === 3) {
                                    time+= '<td>' + value.day_appointments +'' +
                                        '<span class="text-primary d-block">13:00:00 - 15:00:00 AM</span>' +
                                        '</td>'
                                }
                                html+= '<tr>' +
                                    '<td>' + (key+1) +'</td>' +
                                    '<td>' + value.name + '</td>' +
                                    '<td>' + value.email + '</td>' +
                                    '<td>' + value.phone + '</td>' +
                                    button_action_add(value.id) +
                                    '</tr>';
                            })
                            button_action()
                        }
                        $('#tbody_table').html(html);
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            })
        })

        $('#time_appointments').change(function () {
            var time_appointments = $('#time_appointments').find(":selected").val();
            $.ajax({
                type: 'GET',
                url : '{{ route($urlbase.'time' , '') }}' + '/' + time_appointments,
                success: function (data) {
                    console.log(data)
                    clearData()
                    var html = '';
                    var time = '';
                    if(data.time_appointments.length == 0) {
                        html += '<tr><td colspan="7">KHÔNG CÓ DỮ LIỆU</td></tr>';
                    }
                    else {
                        $.each(data.time_appointments , function (key , value) {
                            if(value.shift_appointment === 2) {
                                time+= '<td>' + value.day_appointments +'' +
                                    '<span class="text-primary d-block">11:00:00 - 13:00:00 AM</span>' +
                                    '</td>'
                            }
                            else if(value.shift_appointment === 1) {
                                time+= '<td>' + value.day_appointments +'' +
                                    '<span class="text-primary d-block">09:00:00 - 11:00:00 AM</span>' +
                                    '</td>'
                            }
                            else if(value.shift_appointment === 3) {
                                time+= '<td>' + value.day_appointments +'' +
                                    '<span class="text-primary d-block">13:00:00 - 15:00:00 AM</span>' +
                                    '</td>'
                            }
                            html+= '<tr>' +
                                '<td>' + (key+1) +'</td>' +
                                '<td>' + value.doctor_id + '</td>' +
                                '<td>' + value.user_id + '</td>' +
                                '<td>' + value.type_pet_id + '</td>' +
                                '<td>' + value.service_id + '</td>' +
                                '<td>' + value.service_id + '</td>' +
                                '<td>'+ value.description +'</td>' +
                                button_action(value.id) +
                                '</tr>';
                        })
                        button_action()
                    }
                    $('#tbody_table').html(html);
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        })

        function clearData() {
            $('#tbody_table').empty();
        }

        function button_action(id) {
            var editRoute = '{{ route($urlbase.'edit', ":id") }}'
            editRoute = editRoute.replace(':id', id);

            return '<td class="d-flex" style="grid-gap:1rem">' +
                '<div class="actions">' +
                '<a class="btn btn-sm bg-success-light" href="'+editRoute+'"' +
                '<i class="fe fe-pencil"></i> Edit ' +
                '</a>' +
                '</div>' +
                '</td>';
        }

        function button_action_add(id) {
            var addRoute = '{{ route($urlbase.'create-data', ":id") }}'
            addRoute = addRoute.replace(':id', id);

            return '<td class="d-flex" style="grid-gap:1rem">' +
                '<div class="actions">' +
                '<a class="btn btn-sm bg-danger-light" href="'+addRoute+'"' +
                '<i class="fe fe-pencil"></i> Thêm cuộc hẹn ' +
                '</a>' +
                '</div>' +
                '</td>';
        }
    </script>
@endpush
