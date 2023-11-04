@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
    <style>
        .col-hover:hover{
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
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>
                        <i class="fa fa-bar-chart"></i>
                        Biểu đồ doanh thu
                    </h3>
                </div>
                <div class="col-md-8">
{{--                    {!! $charts->container() !!}--}}
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-3 col-md-6 col-sm-6  mb-3 col-hover" >
                <div class="d-block">
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
            <div class="col-lg-3 col-md-6 col-sm-6  mb-3 col-hover" >
                <div class="d-block">
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

            <div class="col-lg-3 col-md-6 col-sm-6  mb-3 col-hover" >
                <div class="d-block">
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
            <div class="col-lg-3 col-md-6 col-sm-6  mb-3 col-hover" >
                <div class="d-block">
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
            <div class="col-lg-3 col-md-6 col-sm-6  mb-3 col-hover" >
                <div class="d-block">
                    <div class="rounded-2 shadow text-dark p-2">
                        <div class="d-flex justify-content-between p-2">
                            <div>
                                <h4>Đơn hàng</h4>
                                <p class="mb-0">
                                    Tổng đơn hàng  đã thanh toán
                                </p>
                            </div>
                            <h5>{{ $totalOrder ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6  mb-3 col-hover" >
                <div class="d-block">
                    <div class="rounded-2 shadow text-dark p-2">
                        <div class="d-flex justify-content-between p-2">
                            <div>
                                <h4>Đơn hàng</h4>
                                <p class="mb-0">
                                    Tổng đơn hàng  chưa thanh toán
                                </p>
                            </div>
                            <h5>{{ $totalOrderNeedPay ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6  mb-3 col-hover" >
                <div class="d-block">
                    <div class="rounded-2 shadow text-dark p-2">
                        <div class="d-flex justify-content-between p-2">
                            <div>
                                <h4>Đơn hàng</h4>
                                <p class="mb-0">
                                    Tổng đơn hàng  đã hoàn trả
                                </p>
                            </div>
                            <h5>{{ $totalOrderReturn ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6  mb-3 col-hover" >
                <div class="d-block">
                    <div class="rounded-2 shadow text-dark p-2">
                        <div class="d-flex justify-content-between p-2">
                            <div>
                                <h4>Đơn hàng</h4>
                                <p class="mb-0">
                                    Tổng đơn hàng  đã hủy
                                </p>
                            </div>
                            <h5>{{ $totalOrderCancel ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6  mb-3 col-hover" >
                <div class="d-block">
                    <div class="rounded-2 shadow text-dark p-2">
                        <div class="d-flex justify-content-between p-2">
                            <div>
                                <h4>Sản phẩm</h4>
                                <p class="mb-0">
                                    Tổng tât cả sản phẩm
                                </p>
                            </div>
                            <h5>{{ $totalProducts ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6  mb-3 col-hover" >
                <div class="d-block">
                    <div class="rounded-2 shadow text-dark p-2">
                        <div class="d-flex justify-content-between p-2">
                            <div>
                                <h4>Sản phẩm</h4>
                                <p class="mb-0">
                                    Tổng tât cả danh mục sản phẩm
                                </p>
                            </div>
                            <h5>{{ $totalProductCategory ?? 0 }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <div style="width: 50%;">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
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



@endpush

