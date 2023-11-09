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
                            <h4>Checkout</h4>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col" style="max-width: 650px">
                            <h3>
                                Cart
                            </h3>
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                                </thead>
                                @php
                                    $totalPrice = 0;

                                @endphp
                                <tbody>
                                @foreach($carts as $item)
                                    <tr>
                                        <td><img src="{{ asset($item['image']) }}" alt="" width="50px"></td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>{{ $item['price'] }}</td>
                                    </tr>
                                    @php
                                        $totalPrice += $item['price'] * $item['quantity'];
                                    @endphp
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3">Total Price</td>
                                    <td><b>{{ $totalPrice }}</b></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col px-3">
                            <form method="post" id="form-payment" action="{{ route('checkout.cash') }}">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="customer_name" class="form-label">Name *</label>
                                            <input type="text" class="form-control" id="customer_name"
                                                   name="customer_name"
                                                   value="{{ old('customer_name') }}"
                                                    @error('customer_name')
                                                        style="border-color: red"
                                                    @enderror
                                            >
                                            @error('customer_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="customer_email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="customer_email"
                                                   name="customer_email"
                                                   value="{{ old('customer_email') }}"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="customer_phone" class="form-label">Phone *</label>
                                            <input type="text" class="form-control" id="customer_phone"
                                                   name="customer_phone"
                                                   value="{{ old('customer_phone') }}"
                                                   @error('customer_phone')
                                                    style="border-color: red"
                                                    @enderror
                                            >
                                            @error('customer_phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="total_price" class="form-label">Total Price</label>
                                            <input type="text" class="form-control" id="total_price"
                                                   value="{{ $totalPrice }}" disabled>
                                            <input type="hidden" class="form-control" id="total_price"
                                                   name="total_price"
                                                   value="{{ $totalPrice ?? old('total_price') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <span class="mb-3">Payment Method</span>
                                        <div class="col-8">
                                            <div class="col">
                                                <label for="cash" class="form-label">Cash</label>
                                                <input id="cash" name="cash" value="cash" type="radio" checked
                                                       class="form-check-input">
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
                                        <div class="text-danger payment_method"></div>
                                    </div>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary btn-checkout">Checkout</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function () {
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
            $('#cash').change(function () {
                if($(this).is(':checked')) {
                    $('.btn-checkout').attr('name', 'cash');
                    $('#form-payment').attr('action', '{{ route('checkout.cash') }}');
                }
            });
            //nếu cả 3 radio đều không được chọn thì hiển thị lỗi
            $('.btn-checkout').click(function () {
                if (!$('#VnPay').is(':checked') && !$('#momo').is(':checked') && !$('#cash').is(':checked')) {
                    $('.payment_method').html('Vui lòng chọn phương thức thanh toán');
                    return false;
                }
            });
        });
    </script>
@endpush
