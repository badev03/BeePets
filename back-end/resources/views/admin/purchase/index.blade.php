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
                            <h4>Purchase</h4>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Customer</th>
                                <th>Price</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bills as $key=>$value)
                                <tr>
                                    <td>{{ $value->code }}</td>
                                    <td>{{ $value->customer_name }}</td>
                                    <td>{{ number_format($value->total_amount,0,',','.') }}</td>
                                    <td>
                                        @if($value->transaction_type == 1)
                                            <span class="badge badge-success">Thanh toán VNPAY</span>
                                        @elseif($value->transaction_type == 2)
                                            <span class="badge badge-success">Thanh toán tại cửa hàng</span>
                                        @elseif($value->transaction_type == 3)
                                            <span class="badge badge-success">Thanh toán qua thẻ</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($value->status == 0)
                                            <span class="badge badge-danger">Chưa thanh toán</span>

                                        @elseif($value->status == 1)
                                            <span class="badge badge-success">Đã thanh toán</span>
                                        @elseif($value->status == 2)
                                            <span class="badge badge-warning">Đã hủy</span>
                                        @elseif($value->status == 3)
                                            <span class="badge badge-info">Hoàn trả</span>
                                        @endif
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
