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
            @if(session()->has('success_delete'))
                <div class="alert-success alert">
                    {{ session('success_delete') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <h4 class="card-title">Thống kê cuộc hẹn</h4>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <h6 class="card-title text-danger">Bộ lọc thống kê</h6>
                        <div class="col-3 mt-3">
                            <label class="form-label">Ngày bắt đầu</label>
                            <input style="height: 38px" type="date" class="form-control" id="start_time_date_filter">
                        </div>

                        <div class="col-3 mt-3">
                            <label class="form-label">Ngày kết thúc</label>
                            <input style="height: 38px" type="date" class="form-control" id="time_date_filter">
                        </div>

                        <div class="col-3 mt-3">
                            <label class="form-label">Chọn Bác sĩ</label>
                            <select class="form-select" name="since_time" id="doctor_id_choose">
                                <option value="all">Chọn bác sĩ</option>
                                @foreach($doctor as $key=>$value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-1 mt-3">
                        <button style="height: 38px" type="submit
                            " class="form-control btn btn-sm bg-success-light" id="filter_data_static">
                            Lọc
                        </button>
                    </div>
                </div>
                <div id="chart" style="height: 250px;"></div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        @if (count($statistics) > 0)
        var chartData = [
                @foreach ($statistics as $stat)
                @php
                    $statusName = '';
                    if ($stat->status == 0) {
                        $statusName = 'Hóa đơn đã chờ xác nhận';
                    } elseif ($stat->status == 1) {
                        $statusName = 'Hóa đơn đã xác nhận';
                    } elseif($stat->status == 4) {
                        $statusName = 'Hóa đơn đã hoàn thành';
                    }
                    elseif($stat->status == 3) {
                        $statusName = 'Đã hủy';
                    }
                    elseif($stat->status == 7) {
                        $statusName = 'Hóa đơn yêu cầu đổi lịch';
                    }
                    elseif($stat->status == 6) {
                        $statusName = 'Hóa đơn yêu cầu hủy lịch';
                    }
                @endphp
            { date: "{{ $statusName }}", value: {{ $stat->count }} },
            @endforeach
        ];

        Morris.Bar({
            element: 'chart',
            data: chartData,
            xkey: 'date',
            ykeys: ['value'],
            labels: ['Cuộc hẹn']
        });
        @else
        // Hiển thị đoạn văn bản khi không có dữ liệu
        document.getElementById('chart').textContent = "Không có dữ liệu thống kê.";
        @endif
    </script>
    <script>
        $('#filter_data_static').click(function () {
            let start_time_web = $('#start_time_date_filter').val();
            let end_time_web = $('#time_date_filter').val();
            let doctor_id_choose = $('#doctor_id_choose').val();
            let day = $(this).val();
            $.ajax({
                type: 'GET',
                url : '{{ route('statistics.filter-data') }}',
                data : {start_time_web:start_time_web , end_time_web:end_time_web , doctor_id_choose:doctor_id_choose },
                success: function (data) {
                    var chartDatas = [];
                    console.log(data)
                    if (data.filter.length > 0) {
                        $.each(data.filter, function (index, stat) {
                            var statusName = '';

                            if (stat.status == 0) {
                                statusName = 'Cuộc hẹn chờ xác nhận';
                            } else if (stat.status == 1) {
                                statusName = 'Cuộc hẹn đã xác nhận';
                            } else if(stat.status == 3) {
                                statusName = 'Cuộc hẹn đã hủy';
                            }
                            else if(stat.status == 4) {
                                statusName = 'Cuộc hẹn đã hoàn thành';
                            }
                            else if(stat.status == 7) {
                                statusName = 'Cuộc hẹn yêu cầu đổi lịch';
                            }
                            else if(stat.status == 6) {
                                statusName = 'Cuộc hẹn yêu cầu hủy lịch';
                            }
                            chartDatas.push({date: statusName, value: stat.count});
                        });
                        console.log(chartDatas);
                        // Xóa biểu đồ cũ nếu có
                        $('#chart').empty();

                        // Vẽ biểu đồ mới
                        Morris.Bar({
                            element: 'chart',
                            data: chartDatas,
                            xkey: 'date',
                            ykeys: ['value'],
                            labels: ['Cuộc hẹn'],

                        });
                    } else {
                        // Hiển thị thông báo nếu không có dữ liệu
                        $('#chart').text('Không có dữ liệu thống kê.');
                    }
                },
                error: function (error) {

                }
            });
        });
    </script>
{{--    <script>--}}
{{--        $('#time_date_filter').change(function () {--}}
{{--            let date = $(this).val();--}}
{{--            $.ajax({--}}
{{--                type: 'GET',--}}
{{--                url : '{{ route('appointments.statistics.date_time' , '') }}' + '/' + date,--}}
{{--                success: function (data) {--}}
{{--                    var chartData = [];--}}
{{--                    if (data.filter.length > 0) {--}}
{{--                        $.each(data.filter, function (index, stat) {--}}
{{--                            var statusName = '';--}}

{{--                            if (stat.status == 0) {--}}
{{--                                statusName = 'Cuộc hẹn chờ xác nhận';--}}
{{--                            } else if (stat.status == 1) {--}}
{{--                                statusName = 'Cuộc hẹn đã xác nhận';--}}
{{--                            } else if(stat.status == 3) {--}}
{{--                                statusName = 'Cuộc hẹn đã hủy';--}}
{{--                            }--}}
{{--                            else if(stat.status == 4) {--}}
{{--                                statusName = 'Cuộc hẹn đã hoàn thành';--}}
{{--                            }--}}
{{--                            else if(stat.status == 7) {--}}
{{--                                statusName = 'Cuộc hẹn yêu cầu đổi lịch';--}}
{{--                            }--}}
{{--                            else if(stat.status == 6) {--}}
{{--                                statusName = 'Cuộc hẹn yêu cầu hủy lịch';--}}
{{--                            }--}}
{{--                            chartData.push({date: statusName, value: stat.count});--}}
{{--                        });--}}

{{--                        // Xóa biểu đồ cũ nếu có--}}
{{--                        $('#chart').empty();--}}

{{--                        // Vẽ biểu đồ mới--}}
{{--                        Morris.Bar({--}}
{{--                            element: 'chart',--}}
{{--                            data: chartData,--}}
{{--                            xkey: 'date',--}}
{{--                            ykeys: ['value'],--}}
{{--                            labels: ['Cuộc hẹn']--}}
{{--                        });--}}
{{--                    } else {--}}
{{--                        // Hiển thị thông báo nếu không có dữ liệu--}}
{{--                        $('#chart').text('Không có dữ liệu thống kê.');--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function (error) {--}}

{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endpush
