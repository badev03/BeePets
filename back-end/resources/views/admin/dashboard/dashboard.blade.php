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
                    {!! $charts->container() !!}
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
                    <div class="card">
                        <div class="card-header">
                            <h3>Top 5 sản phẩm bán chạy</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng đã bán</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bestSeller as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img src="{{ asset($value->image) }}" alt="" width="50px">
                                        </td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ number_format($value->price) }} VNĐ</td>
                                        <td>{{ $value->total }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

