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
                                        @if($value->payment_method == 1)
                                            <span class="badge badge-success">Thanh toán tại cửa hàng</span>
                                        @elseif($value->payment_method == 2)
                                            <span class="badge badge-success">Thanh toán VNPAY</span>
                                        @elseif($value->payment_method == 3)
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
                                            <span class="badge badge-info">Đã hoàn trả</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($value->status == 1)
                                            <a href="" class="btn btn-sm btn-primary">In hóa đơn</a>
                                            <form action="{{ route('purchase.update',$value->id) }}" method="POST" style="display: inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="3">
                                                <button type="submit" class="btn btn-sm btn-danger">Hoàn trả</button>
                                            </form>
                                        @endif
                                            <a href="{{ route('purchase.show',$value->id) }}" class="btn btn-sm btn-info text-white">Xem</a>
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
