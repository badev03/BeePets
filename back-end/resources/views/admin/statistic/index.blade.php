@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
    <style>
        .col-hover:hover {
            transition: 0.5s;
            margin-top: -10px;
        }
    </style>

@endpush
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                {{--                <h3 class="page-title">Bảng điều khiển</h3>--}}
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-3 col-md-6 col-sm-6  mb-3 col-hover">
                <div class="d-block" style="background: #00a65a">
                    <div class="rounded-2 shadow text-dark p-2 ">
                        <div class="d-flex justify-content-between p-2">
                            <div>
                                <h4>Doanh thu</h4>
                                <p class="mb-0">
                                    Tổng doanh thu cửa hàng
                                </p>
                            </div>
                            <h5>{{ number_format($totalAmount) ?? 0}} VNĐ</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6  mb-3 col-hover">
                <div class="d-block" style="background: #00c0ef">
                    <div class="rounded-2 shadow text-dark p-2 ">
                        <div class="d-flex justify-content-between p-2">
                            <div>
                                <h4>Doanh thu</h4>
                                <p class="mb-0">
                                    Tổng doanh thu năm nay
                                </p>
                            </div>
                            <h5>{{ number_format($totalAmountYear) ?? 0}} VNĐ</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6  mb-3 col-hover">
                <div class="d-block" style="background: #f39c12">
                    <div class="rounded-2 shadow text-dark p-2 ">
                        <div class="d-flex justify-content-between p-2">
                            <div>
                                <h4>Doanh thu</h4>
                                <p class="mb-0">
                                    Tổng doanh thu trong tháng
                                </p>
                            </div>
                            <h5>{{ number_format($totalAmountMonth) ?? 0}} VNĐ</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6  mb-3 col-hover">
                <div class="d-block" style="background: #dd4b39">
                    <div class="rounded-2 shadow text-dark p-2 ">
                        <div class="d-flex justify-content-between p-2">
                            <div>
                                <h4>Doanh thu</h4>
                                <p class="mb-0">
                                    Tổng doanh thu tháng trước
                                </p>
                            </div>
                            <h5>{{ number_format($totalAmountLastMonth) ?? 0}} VNĐ</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <div class="">
                    <h4>
                        Biểu đồ doanh thu năm nay và năm trước
                    </h4>
                </div>
                <div class="">
                    <canvas id="chartRevenue" height="100px"></canvas>
                </div>
            </div>
            <div class="col">
                <div class="">
                    <h4>
                        Biểu đồ doanh thu tháng này và tháng trước
                    </h4>
                </div>
                <div class="">
                    <canvas id="chartRevenueMonthly" height="100px"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-2">
                    <form id="form-chart">
                        <label for="date_chart"><h3>Chọn ngày</h3></label>
                        <input type="date" id="date_chart" name="date_chart" class="form-control">
                    </form>
                </div>
            </div>
            <div class="col">
                <canvas id="chartByDate" height="100px"></canvas>
            </div>
            <div class="col">

            </div>
        </div>

    </div>

@endsection


@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Đoạn mã JavaScript của bạn ở đây
        var labels = [];
        var totals = [];
        var dataFromLaravel = @json($bestSeller);

        dataFromLaravel.forEach(function (item) {
            labels.push(item.name);
            totals.push(parseInt(item.total));
        });

        var labelsForChart = [];
        dataFromLaravel.forEach(function (item) {
            labelsForChart.push(item.name);
        });

        const dataForChart = {
            labels: labelsForChart,
            datasets: [{
                label: 'Sản phẩm bán chạy nhất',
                data: totals,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: dataForChart,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        // Tạo biểu đồ
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, config);
    </script>

    <script>
        // biểu đồ line tổng doanh thu
        var ctx = document.getElementById('chartRevenue').getContext('2d');
        var myChart1 = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                datasets: [{
                    label: 'Doanh thu năm nay',
                    data: [{{ $totalAmountMonth1 ?? 0 }}, {{ $totalAmountMonth2 ?? 0 }}, {{ $totalAmountMonth3 ?? 0 }}, {{ $totalAmountMonth4 ?? 0 }}, {{ $totalAmountMonth5 ?? 0 }}, {{ $totalAmountMonth6 ?? 0 }}, {{ $totalAmountMonth7 ?? 0 }}, {{ $totalAmountMonth8 ?? 0 }}, {{ $totalAmountMonth9 ?? 0 }}, {{ $totalAmountMonth10 ?? 0 }}, {{ $totalAmountMonth11 ?? 0 }}, {{ $totalAmountMonth12 ?? 0 }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                    ],
                    borderWidth: 1
                },
                    {
                        label: 'Doanh thu năm trước',
                        data: [{{ $totalAmountMonth1LastYear ?? 0 }}, {{ $totalAmountMonth2LastYear ?? 0 }}, {{ $totalAmountMonth3LastYear ?? 0 }}, {{ $totalAmountMonth4LastYear ?? 0 }}, {{ $totalAmountMonth5LastYear ?? 0 }}, {{ $totalAmountMonth6LastYear ?? 0 }}, {{ $totalAmountMonth7LastYear ?? 0 }}, {{ $totalAmountMonth8LastYear ?? 0 }}, {{ $totalAmountMonth9LastYear ?? 0 }}, {{ $totalAmountMonth10LastYear ?? 0 }}, {{ $totalAmountMonth11LastYear ?? 0 }}, {{ $totalAmountMonth12LastYear ?? 0 }}],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                        ],
                        borderColor: [
                            'rgb(54, 162, 235)',
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });

    </script>
    {{--    chartRevenueMonthly--}}

    <script>
        // biểu đồ line tổng doanh thu
        var ctx = document.getElementById('chartRevenueMonthly').getContext('2d');
        var myChart2 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Tuần 1', 'Tuần 2', 'Tuần 3', 'Tuần 4'],
                datasets: [{
                    label: 'Doanh thu tháng này',
                    data: [{{ $totalAmountWeek1 ?? 0 }}, {{ $totalAmountWeek2 ?? 0 }}, {{ $totalAmountWeek3 ?? 0 }}, {{ $totalAmountWeek4 ?? 0 }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                    ],
                    borderWidth: 1
                },
                    {
                        label: 'Doanh thu tháng trước',
                        data: [{{ $totalAmountWeek1LastMonth ?? 0 }}, {{ $totalAmountWeek2LastMonth ?? 0 }}, {{ $totalAmountWeek3LastMonth ?? 0 }}, {{ $totalAmountWeek4LastMonth ?? 0 }}],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                        ],
                        borderColor: [
                            'rgb(54, 162, 235)',
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });
    </script>

    <script>
        $(document).ready(function () {
            function updateChart() {
                var date = $('#date_chart').val();

                if (date == '') {
                    var today = new Date();
                    var dd = today.getDate();
                    var mm = today.getMonth() + 1;
                    var yyyy = today.getFullYear();

                    if (dd < 10) {
                        dd = '0' + dd;
                    }
                    if (mm < 10) {
                        mm = '0' + mm;
                    }

                    var today = yyyy + '-' + mm + '-' + dd;
                    var date = today;
                } else {
                    var date = $('#date_chart').val();
                }

                // Hủy bỏ biểu đồ cũ
                if (typeof myChart !== 'undefined') {
                    myChart.destroy();
                }

                // Gửi yêu cầu Ajax để lấy dữ liệu mới
                $.ajax({
                    url: "{{ route('statistic.getByDate') }}",
                    method: "GET",
                    data: {
                        date: date
                    },
                    success: function (data) {
                        var labels = [];
                        var totals = [];
                        var dataFromLaravel = data;

                        dataFromLaravel.forEach(function (item) {
                            labels.push(item.date);
                            totals.push(parseInt(item.total_amount));
                        });

                        var labelsForChart = [];
                        dataFromLaravel.forEach(function (item) {
                            labelsForChart.push(item.date);
                        });

                        var ctx = document.getElementById('chartByDate').getContext('2d');
                        myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labelsForChart,
                                datasets: [{
                                    label: 'Doanh thu',
                                    data: totals,
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgb(255, 99, 132)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                });
            }
            $('#date_chart').on('change', updateChart);
            updateChart();
        });
    </script>
@endpush

