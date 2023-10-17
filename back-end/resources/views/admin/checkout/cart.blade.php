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
                            <h4>My Carts</h4>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Sub Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        @php
                            $totalPrice = 0;
                        @endphp
                        @if(count($carts) > 0)
                            <tbody>
                            @foreach($carts as $key=> $cart)
                                <tr data-id="{{ $key }}">
                                    <td>{{ $key }}</td>
                                    <td width="170px"><img src="{{ asset($cart['image']) }}"
                                                           alt="{{ asset($cart['image']) }}" width="100"
                                                           style="height: 100px"></td>
                                    <td>{{ $cart['name'] }}</td>
                                    <td>{{ number_format($cart['price'], 0, ',', '.') }}</td>

                                    <td>
                                        <div class="d-flex">
                                            <input type="number" class="quantity update-cart" name="quantity"
                                                   value="{{ $cart['quantity'] }}"
                                                   style="width: 40px; text-align: center;padding-left: 12px; margin-right: 2px">
                                        </div>
                                    </td>
                                    <td>
                                        {{ number_format($cart['price'] * $cart['quantity'], 0, ',', '.') }} <b>VNĐ</b>
                                    </td>
                                    <td><a class="btn btn-danger btn-sm btn-remove" href="javascript:void(0)">Remove</a>
                                    </td>
                                </tr>
                                @php
                                    $totalPrice += $cart['price'] * $cart['quantity'];
                                @endphp
                            @endforeach
                            </tbody>

                            <tfoot>
                            <tr>
                                <th colspan="5">Total Price</th>
                                <th>{{ number_format($totalPrice, 0, ',', '.') }} <b>VNĐ</b></th>
                                <th>
                                    <label for="input-checkout" class="btn btn-primary btn-sm">Checkout</label>
                                    <input id="input-checkout" type="checkbox" hidden>
                                </th>
                            </tr>
                            </tfoot>
                        @else
                            <tbody>
                            <tr>
                                <td colspan="7" style="text-align: center">Cart Empty!!</td>
                            </tr>
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>

            <div id="sidebar-right" class="row position-fixed top-0 "
                 style="width: 600px; height: 100%; right: 0; z-index: 10000; background: #fff; box-shadow: 0 0 10px 0 #888; transform: translateX(100%); padding-right: 10px">
                <div class="col py-5">
                    <div class="head">
                        <h4>Checkout</h4>
                    </div>
                    <form method="post" id="form-payment">
                        @csrf
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Name</label>
                            <input type="text"  class="form-control" id="customer_name" name="customer_name"
                                   value="{{ old('customer_name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="customer_email" class="form-label">Email</label>
                            <input type="email"  class="form-control" id="customer_email" name="customer_email"
                                   value="{{ old('customer_email') }}">
                        </div>
                        <div class="mb-3">
                            <label for="customer_phone" class="form-label">Phone</label>
                            <input type="text"  class="form-control" id="customer_phone" name="customer_phone"
                                   value="{{ old('customer_phone') }}">
                        </div>
                        <div class="mb-3">
                            <label for="total_price" class="form-label">Total Price</label>
                            <input type="text"  class="form-control" id="total_price" name="total_price"
                                   value="{{ $totalPrice ?? old('total_price') }}">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col"><label for="cash" class="form-label">Payment Method</label>
                                    <input id="cash" name="cash" value="cash" type="radio"
                                           class="form-check-input" checked>
                                </div>
                                <div class="col">
                                    <label for="momo" class="form-label">Momo</label>
                                    <input id="momo" name="cash" value="momo" type="radio"
                                           class="form-check-input">
                                </div>
                                <div class="col">
                                    <label for="VnPay" class="form-label">VnPay</label>
                                    <input id="VnPay" name="cash" value="VnPay" type="radio"
                                           class="form-check-input">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-checkout">Checkout</button>
                        </div>
                    </form>


                </div>
            </div>
            <label for="input-checkout " class="over-play"
                   style="position: fixed; width: 100%; background: #333; top: 0; left: 0; right: 0; bottom: 0;display: none; opacity: 0.6"></label>
        </div>
    </div>
@endsection


@push('script')

    <script>
        $(document).ready(function () {
            $('.update-cart').on('change', function (e) {
                e.preventDefault();
                var ele = $(this);
                data = {
                    "_token": '{{ csrf_token() }}',
                    "quantity": ele.parents("tr").find(".quantity").val(),
                    "id": ele.parents("tr").attr("data-id")
                };
                $.ajax({
                    url: 'update-cart',
                    method: "post",
                    data: data,
                    success: function (response) {
                        window.location.reload();
                        toastr.success(response.message, 'Success');
                    }
                });
            });
            $('.btn-remove').on('click', function (e) {
                e.preventDefault();
                var ele = $(this);
                data = {
                    "_token": '{{ csrf_token() }}',
                    "product_id": ele.parents("tr").attr("data-id")
                };
                $.ajax({
                    url: '{{ route('carts.removeCart') }}',
                    method: "post",
                    data: data,
                    success: function (response) {
                        window.location.reload();
                        toastr.success(response.message, 'Success');
                    }
                });
            });
            $('#input-checkout').change(function () {
                if ($(this).is(':checked')) {
                    $('#sidebar-right').css('transform', 'translateX(0)');
                    $('.over-play').css('display', 'block');
                } else {
                    $('#sidebar-right').css('transform', 'translateX(100%)');
                    $('.over-play').css('display', 'none');
                }
            });
            $('.over-play').click(function () {
                $('#input-checkout').prop('checked', false);
                $('#sidebar-right').css('transform', 'translateX(100%)');
                $('.over-play').css('display', 'none');
            });

            $('#VnPay').change(function () {
                if($(this).is(':checked')) {
                    $('.btn-checkout').attr('name', 'redirect');
                    $('#form-payment').attr('action', '{{ route('checkout.vnpay') }}');
                }
            });
            $('#momo').change(function () {
                if($(this).is(':checked')) {
                    $('.btn-checkout').attr('name', 'payUrl');
                    $('#form-payment').attr('action', '{{ route('checkout.momo') }}');
                }
            });
        });
    </script>
@endpush
