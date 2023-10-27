@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
@endpush
@section('heading','hihihi')
@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card table-card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col">
                            <h4>Đơn hàng</h4>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h4>
                                Thông tin đơn hàng : <b>{{ $bill->code }}</b> được thanh toán tại cửa hàng
                            </h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <p>
                                Tên khách hàng : <b>{{ $bill->customer_name }}</b>
                            </p>
                        </div>
                        <div class="col">
                            <p>
                                Số điện thoại : <b>{{ $bill->customer_phone }}</b>
                            </p>
                        </div>
                        <div class="col">
                            @if($bill->payment_method == 1)
                                <p>
                                    Phương thức thanh toán : <b>Thanh toán tại cửa hàng</b>
                                </p>
                            @elseif($bill->payment_method == 2)
                                <p>
                                    Phương thức thanh toán : <b>Thanh toán VNPAY</b>
                                </p>
                            @elseif($bill->payment_method == 3)
                                <p>
                                    Phương thức thanh toán : <b>Thanh toán qua thẻ</b>
                                </p>
                            @endif
                        </div>
                        <div class="col">
                            <p>
                                Lý do hoàn trả: <b>{{ $bill->description }}</b>
                            </p>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <p>
                                Ngày đặt hàng : <b>{{ date('d-m-Y',strtotime($bill->created_at))  }}</b>
                            </p>
                        </div>
                        <div class="col">
                            <p>
                                Ngày cập nhật : <b>{{ date('d-m-Y',strtotime($bill->updated_at))  }}</b>
                            </p>
                        </div>
                        <div class="col">
                            <p>
                                Ghi chú : <b>{{ $bill->note ?? "Không có" }}</b>
                            </p>
                        </div>
                        <div class="col">
                            <p>
                                Trạng thái : <b>
                                    @if($bill->status == 0)
                                        <span class="badge badge-danger">Chưa thanh toán</span>

                                    @elseif($bill->status == 1)
                                        <span class="badge badge-success">Đã thanh toán</span>
                                    @elseif($bill->status == 2)
                                        <span class="badge badge-warning">Đã hủy</span>
                                    @elseif($bill->status == 3)
                                        <span class="badge badge-danger">Đã hoàn trả</span>
                                @endif
                            </p>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h3>
                                Thông tin sản phẩm
                            </h3>
                        </div>
                        <div class="col">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order_details as $key=>$value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                <img src="{{ asset($value->product->image) }}" width="75px">
                                            </td>
                                            <td>{{ $value->product->name }}</td>
                                            <td>{{ number_format($value->product->price,0,',','.') }}</td>
                                            <td>{{ $value->quantity }}</td>
                                            <td>{{ number_format($value->product->price*$value->quantity,0,',','.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right">Tổng tiền</td>
                                        <td>{{ number_format($bill->total_amount,0,',','.') }} <b>VNĐ</b> </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
