@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
@endpush
@section('heading','đ')
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
                    @include('admin.appointments.filter-data-module-appointments')
                    <a data-bs-toggle="modal" href="#appointments-clear-appointment-data"  class="btn btn-sm bg-info-light">Hủy các cuộc hẹn không đến</a>

                    <div class="modal fade" id="appointments-clear-appointment-data" aria-hidden="true" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="form-content p-2 text-center">
                                        <h4 class="modal-title">Xóa các cuộc hẹn đã quá thời gian đến</h4>
                                        <p class="mb-4">Bạn có chắc chắn xóa không</p>
                                        <div class="d-flex justify-content-center" style="gap: 1rem">
                                            <a href="{{ route('appointments.clear-appointment-data') }}" class="btn bg-success-light"
                                                    type="submit">Xóa
                                            </a>
                                            <button type="button" class="btn bg-danger-light" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
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
                                <td>Trạng thái</td>
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
                                            <td>
                                                @if($value->status == 6)
                                                    <button class="btn btn-sm bg-info-light">
                                                        {{ 'Yêu cầu hủy' }}
                                                    </button>
                                                @elseif($value->status == 1)
                                                    <button class="btn btn-sm bg-success-light">
                                                        {{ 'Xác nhận' }}
                                                    </button>
                                                @elseif($value->status == 3)
                                                    <button class="btn btn-sm bg-danger-light">
                                                        {{ 'Hoàn thành' }}
                                                    </button>
                                                @endif
                                            </td>
                                            <td>{!! $value->date !!}</td>
                                            <td>
                                                <span class="text-primary d-block">{{ $value->start_time }}
                                                    - {{ $value->end_time }} AM</span>
                                            </td>
                                        @include('admin.components.button.action-index-status')
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
            var status_cho_xac_nhan = 1;
            $('.date_filter').change(function () {
                var data = $(this).val();
                var route = '{{ route($urlbase.'filter-date', '') }}/' + data + '/' + status_cho_xac_nhan;
                console.log(route)
                $.ajax({
                    type : 'GET',
                    url :route,
                    success: function (data) {
                        clearData()
                        var html = '';
                        var time = '';
                        if(data.day_appointments.length == 0) {
                            html += '<tr><td colspan="7">KHÔNG CÓ DỮ LIỆU</td></tr>';
                        }
                        else {
                            $.each(data.day_appointments, function (key, value) {
                                if (value.shift_appointment === 2) {
                                    time += '<td>' + value.day_appointments + '' +
                                        '<span class="text-primary d-block">11:00:00 - 13:00:00 AM</span>' +
                                        '</td>'
                                } else if (value.shift_appointment === 1) {
                                    time += '<td>' + value.day_appointments + '' +
                                        '<span class="text-primary d-block">09:00:00 - 11:00:00 AM</span>' +
                                        '</td>'
                                } else if (value.shift_appointment === 3) {
                                    time += '<td>' + value.day_appointments + '' +
                                        '<span class="text-primary d-block">13:00:00 - 15:00:00 AM</span>' +
                                        '</td>'
                                }
                                html += '<tr>' +
                                    '<td>' + (key + 1) + '</td>' +
                                    '<td>' + value.doctor_id + '</td>' +
                                    '<td>' + value.user_id + '</td>' +
                                    '<td>' + value.type_pet_id + '</td>' +
                                    '<td>' + value.service_id + '</td>' +
                                    '<td>' + value.description + '</td>' +
                                    status(value.status) +
                                    '<td>' + value.date + '</td>' +
                                    '<td>' + value.start_time + ' - ' + value.end_time + ' AM</td>' +
                                    action_status(value.status, value.id) +
                                    '</tr>';
                                button_action()
                                $('#tbody_table').html(html);

                            })
                        }},
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            })

            $('.service_id_index').change(function () {
                var data = $(this).val();
                var route = '{{ route($urlbase.'filter-service', '') }}/' + data + '/' + status_cho_xac_nhan;
                $.ajax({
                    type : 'GET',
                    url : route,
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
                                    '<td>' + value.description + '</td>' +
                                    status(value.status)+
                                    '<td>' + value.date + '</td>' +
                                    '<td>' + value.start_time + ' - ' + value.end_time + ' AM</td>' +
                                    action_status(value.status , value.id) +
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
                var route = '{{ route($urlbase.'filter-doctor', '') }}/' + data + '/' + status_cho_xac_nhan;
                $.ajax({
                    type : 'GET',
                    url : route,
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
                                    '<td>' + value.description + '</td>' +
                                    status(value.status)+
                                    '<td>' + value.date + '</td>' +
                                    '<td>' + value.start_time + ' - ' + value.end_time + ' AM</td>' +
                                    action_status(value.status , value.id) +
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

            $('.filter_searchName').click(function () {
                var searchTerm = $('.search_input').val();
                var postData = {
                    searchTerm: searchTerm ,
                    status : status_cho_xac_nhan
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
                                html += '<tr>' +
                                    '<td>' + (key + 1) + '</td>' +
                                    '<td>' + value.doctor_id + '</td>' +
                                    '<td>' + value.user_id + '</td>' +
                                    '<td>' + value.type_pet_id + '</td>' +
                                    '<td>' + value.service_id + '</td>' +
                                    '<td>' + value.description + '</td>' +
                                    status(value.status) +
                                    '<td>' + value.date + '</td>' +
                                    '<td>' + value.start_time + ' - ' + value.end_time + ' AM</td>' +
                                    action_status(value.status, value.id) +
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

        $('.time_appointments').change(function () {
            var time_appointments = $('.time_appointments').find(":selected").val();
            var status_cho_xac_nhan = 1;
            var route = '{{ route($urlbase.'time', '') }}/' + time_appointments + '/' + status_cho_xac_nhan;
            $.ajax({
                type: 'GET',
                url : route,
                success: function (data) {
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
                            html += '<tr>' +
                                '<td>' + (key + 1) + '</td>' +
                                '<td>' + value.doctor_id + '</td>' +
                                '<td>' + value.user_id + '</td>' +
                                '<td>' + value.type_pet_id + '</td>' +
                                '<td>' + value.service_id + '</td>' +
                                '<td>' + value.description + '</td>' +
                                status(value.status) +
                                '<td>' + value.date + '</td>' +
                                '<td>' + value.start_time + ' - ' + value.end_time + ' AM</td>' +
                                action_status(value.status, value.id) +
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

        function status(status) {
            let html = '';
            if (status == 0) {
                html += '<td>' +
                    '<button class="btn btn-sm bg-info-light">Chờ xác nhận</button>' +
                    '</td>';
            }
            else if(status == 1) {
                html += '<td>' +
                    '<button class="btn btn-sm bg-info-light">Xác nhận</button>' +
                    '</td>';
            }
            return html;
        }

        function action_status(status , id) {
            let html = '';
            var Route = '{{ route('appointments.detail-bills-appointment', ":id") }}'
            Route = Route.replace(':id', id);
            if (status == 0) {
                html += '<td class="d-flex" style="grid-gap:1rem">' +
                    '<div class="d-flex" style="grid-gap:0.5rem">' +
                    '<a href="'+Route+'" class="delete_data btn btn-sm bg-info-light">' +
                    'Xem chi tiết cuộc hẹn / bill' +
                    '</a>' +
                    '<a class="btn btn-sm bg-success-light" href="#xac_nhan_'+id+'" data-bs-toggle="modal">' +
                    '<svg fill="#e63c3c" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" xml:space="preserve" width="19px" height="19px">' +
                    '<g id="SVGRepo_bgCarrier" stroke-width="0"></g>' +
                    '<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>' +
                    '<g id="SVGRepo_iconCarrier"> ' +
                    '<style type="text/css"> .st0{fill:none;} </style>' +
                    '<path d="M19.3,5.3L9,15.6l-4.3-4.3l-1.4,1.4l5,5L9,18.4l0.7-0.7l11-11L19.3,5.3z"></path> ' +
                    '<rect class="st0" width="24" height="24"></rect>' +
                    '</g>' +
                    '</svg>' +
                    'Xác nhận' +
                    '</a>' +
                    '<a data-bs-toggle="modal" data-delete="' + id + '" href="#delete_modal_' + id + '" class="delete_data btn btn-sm bg-danger-light">' +
                    '<i class="fe fe-trash"></i> Hủy lịch' +
                    '</a>' +
                    '</div>' +
                    '</td>';
            }
            else if (status == 1) {
                html += '<td class="d-flex" style="grid-gap:1rem">' +
                    '<div class="d-flex" style="grid-gap:0.5rem">' +
                    '<a href="' + Route + '" class="delete_data btn btn-sm bg-info-light">' +
                    'Xem chi tiết cuộc hẹn / bill' +
                    '</a>' +
                    '<a class="btn btn-sm bg-danger-light" href="#finished_' + id + '" data-bs-toggle="modal">' +
                    '<svg fill="#e63c3c" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" xml:space="preserve" width="19px" height="19px"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:none;} </style> <path d="M19.3,5.3L9,15.6l-4.3-4.3l-1.4,1.4l5,5L9,18.4l0.7-0.7l11-11L19.3,5.3z"></path> <rect class="st0" width="24" height="24"></rect> </g></svg> Hoàn thành</a>' +
                    '<a data-bs-toggle="modal" data-delete="' + id + '" href="#delete_modal_' + id + '" class="delete_data btn btn-sm bg-danger-light">' +
                    '<i class="fe fe-trash"></i> Hủy lịch' +
                    '</a>' +
                    '</div>' +
                    '</td>';
            }
            return html;
        }


    </script>
@endpush

