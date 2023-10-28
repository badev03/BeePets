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
                            <h4 class="card-title">Thông kê cuộc hẹn</h4>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <h6 class="card-title text-danger">Bộ lọc thống kê</h6>
                        <div class="col-4 mt-3">
                            <label class="form-label">Chọn mốc thời gian</label>
                            <select class="form-select" name="since_time" id="since_time">
                                <option value="all">Chọn khoảng thời gian</option>
                                <option value="-7">7 ngày trước</option>
                                <option value="-14">14 ngày trước</option>
                                <option value="-21">21 ngày trước</option>
                                <option value="7">7 ngày trước</option>
                                <option value="14">14 ngày trước</option>
                                <option value="21">21 ngày trước</option>
                            </select>
                        </div>

                        <div class="col-4 mt-3">
                            <label class="form-label">Chọn ngày</label>
                            <input style="height: 38px" type="date" class="form-control" id="time_date_filter">
                        </div>
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
                    } else {
                        $statusName = 'Hóa đơn đã hủy';
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
        $('#since_time').change(function () {
            let day = $(this).val();
            $.ajax({
                type: 'GET',
                url : '{{ route('appointments.statistics.day' , '') }}' + '/' + day,
                success: function (data) {
                    var chartData = [];

                    if (data.filter.length > 0) {
                        $.each(data.filter, function (index, stat) {
                            var statusName = '';

                            if (stat.status == 0) {
                                statusName = 'Hóa đơn đã chờ xác nhận';
                            } else if (stat.status == 1) {
                                statusName = 'Hóa đơn đã xác nhận';
                            } else {
                                statusName = 'Hóa đơn đã hủy';
                            }
                            chartData.push({date: statusName, value: stat.count});
                        });

                        // Xóa biểu đồ cũ nếu có
                        $('#chart').empty();

                        // Vẽ biểu đồ mới
                        Morris.Bar({
                            element: 'chart',
                            data: chartData,
                            xkey: 'date',
                            ykeys: ['value'],
                            labels: ['Cuộc hẹn']
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
    <script>
        $('#time_date_filter').change(function () {
            let date = $(this).val();
            $.ajax({
                type: 'GET',
                url : '{{ route('appointments.statistics.date_time' , '') }}' + '/' + date,
                success: function (data) {
                    var chartData = [];
                    console.log(data)
                    if (data.filter.length > 0) {
                        $.each(data.filter, function (index, stat) {
                            var statusName = '';

                            if (stat.status == 0) {
                                statusName = 'Hóa đơn đã chờ xác nhận';
                            } else if (stat.status == 1) {
                                statusName = 'Hóa đơn đã xác nhận';
                            } else {
                                statusName = 'Hóa đơn đã hủy';
                            }
                            chartData.push({date: statusName, value: stat.count});
                        });

                        // Xóa biểu đồ cũ nếu có
                        $('#chart').empty();

                        // Vẽ biểu đồ mới
                        Morris.Bar({
                            element: 'chart',
                            data: chartData,
                            xkey: 'date',
                            ykeys: ['value'],
                            labels: ['Cuộc hẹn']
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
@endpush
