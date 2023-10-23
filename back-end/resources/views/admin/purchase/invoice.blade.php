<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    /*@import url('https://fonts.googleapis.com/css?family=Muli&display=swap');*/
    /*@import url('https://fonts.googleapis.com/css?family=Quicksand&display=swap');*/
    body{
        font-family: 'Muli', sans-serif;
    }
</style>
<body>
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
                            <p>
                                Email : <b>{{ $bill->customer_email ?? "Không có" }}</b>
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
                                        <span class="badge badge-info">Đã hoàn trả</span>
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
</body>
</html>
