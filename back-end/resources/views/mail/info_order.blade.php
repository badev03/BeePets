<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center">Thông tin đơn hàng tại BeePets</h3>
        </div>
        <hr>
        <div class="col-12">
            <p>{{$data['name']}} thân mến,</p>
            <p>{{$data['content']}}</p>
        </div>
        <div class="col-12">
            <p>Thông tin đơn hàng:</p>
            <p>Mã đơn hàng: <strong>{{$data['code']}}</strong></p>
            <p>Phương thức thanh toán: <strong>{{$data['payment_method']}}</strong></p>
            <p>Trạng thái đơn hàng: <strong>{{$data['status']}}</strong></p>
        </div>
        <div class="col-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data['order_detail'] as $orderDetail)
                    <tr>
                        <td>{{$orderDetail->product_name}}</td>
                        <td>{{number_format($orderDetail->price,0,',','.')}}</td>
                        <td>{{$orderDetail->quantity}}</td>
                        <td>{{number_format($orderDetail->price*$orderDetail->quantity,0,',','.')}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3">Tổng tiền</td>
                    <td>{{number_format($data['total_amount'],0,',','.')}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
