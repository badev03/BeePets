@extends('layouts.partials.master')
@section('title','Đơn hàng')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        .select2-container--default .select2-selection--single {
            height: 38px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px !important;
        }
        .select2-selection {
            border: 1px solid #ced4da !important;
            height: 38px !important;
        }
    </style>
@endpush
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
                            <a href="{{ route('purchase.index') }}" class="btn btn-primary btn-sm float-end" id="btn-add-new">Quay lại</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('checkout.cash') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Mã đơn hàng</label>
                                    <input type="text" class="form-control" id="code" name="code" value="{{ $code ?? old('code') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">Số điện thoại</label>
                                    <select name="customer_phone" id="user_id" class="form-control user_id" multiple="multiple" >
                                        <option value="">Chọn số điện thoại</option>
                                        @foreach($users as $customer)
                                            <option value="{{ $customer->phone }}">{{ $customer->phone }} / {{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        Tên khách hàng <span class="text-danger ">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="name" name="customer_name" value="{{ old('customer_name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="products" class="form-label">Sản phẩm</label>
                                    <select class="form-control products  select" id="products" multiple="multiple"
                                            name="product_id[]">
                                        @foreach($products as $key=>$value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered d-none" id="table-order">
                            <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Giá bán</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody class="list-product">
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="3" class="text-start">Tổng tiền</th>
                                <th colspan="2" class="text-start" >
                                    <b class="total" id="total"></b>
                                    <input type="hidden" id="total_amount" name="total_amount">
                                </th>
                            </tr>
                        </table>
                        <div class="row d-none" id="payment_method_handle">
                            <label for="payment_method" class="form-label">Phương thức thanh toán</label>
                            <div class="mb-3">
                                <label for="cash" class="form-label">
                                    <input type="radio" name="payment_method" id="cash" value="1" checked>
                                    Tiền mặt
                                </label>
                            </div>
                            <div class="mb-3 ">
                                <label for="vnpay" class="form-label">
                                    <input type="radio" name="payment_method" id="vnpay" value="2">
                                    Thanh toán qua VNPAY
                                </label>
                            </div>
                        </div>
                        <div class="row d-none" id="btn-save">
                            <div class="col">
                                <button type="submit" class="btn btn-primary float-start">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('script')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $("select.user_id").select2({

                tags: true,
                tokenSeparators: [',', ' '],
            }).on('select2:selecting', function(e) {
                var value = e.params.args.data.id.trim().toLowerCase();
                var selectedValues = $(this).val() || [];
                selectedValues = selectedValues.map(v => v.trim().toLowerCase());
                if (selectedValues.indexOf(value) > -1) {
                    e.preventDefault();
                    $(this).val(selectedValues).trigger('change.select2');
                }
            });
            $('#user_id').on('select2:select', function (e) {
                var data = e.params.data;
                if(data.id != ''){
                    $.ajax({
                        url: "{{ route('purchase.getCustomerName') }}",
                        type: "GET",
                        data: {
                            phone: data.id
                        },
                        success: function (response) {
                            $('#name').val(response.data.name);
                        }
                    });
                }else {
                    $('#name').val('');
                    $('#phone').val('');
                }
            });
            $('.products').on('change', function () {
                var product_id = $(this).val();
                for (var i = 0; i < product_id.length; i++) {
                    if ($('#product-' + product_id[i]).length) {
                        continue;
                    } else {
                        $('#table-order').removeClass('d-none');
                        $('#payment_method_handle').removeClass('d-none');
                        $('#btn-save').removeClass('d-none');
                        $.ajax({
                            url : '/admin/get-product/' + product_id[i],
                            type : 'GET',
                            dataType : 'json',
                            success : function (result){
                                var html = '';
                                html += '<tr id="product-' + result.data.id + '">';
                                html += '<td>' + result.data.name + '</td>';
                                html += '<td>' + result.data.price + '</td>';
                                html += '<td><input type="number" class="form-control quantity" name="quantity[]" value="1"></td>';

                                html += '<td>' + result.data.price + '</td>';
                                html += '<td><button type="button" class="btn btn-danger btn-sm remove-product" data-id="' + result.data.id + '"><i class="fas fa-trash-alt"></i></button></td>';
                                html += '</tr>';
                                $('.list-product').append(html);
                                $('#products option[value="' + result.data.id + '"]').prop('selected', true);
                                $('#products').trigger('change.select2');
                            }
                        });
                    }
                }

            });

            $(document).on('change', '.quantity', function() {
                var quantity = $(this).val();
                var price = $(this).closest('tr').find('td:nth-child(2)').text();
                var total = quantity * price;
                $(this).closest('tr').find('td:nth-child(4)').text(total);
            });
            $('.products').on('select2:unselecting', function(e) {
                var product_id = e.params.args.data.id;
                $('#product-' + product_id).remove();
            });
            $(document).on('click', '.remove-product', function() {
                var product_id = $(this).data('id');
                $('#product-' + product_id).remove();
                $('#products option[value="' + product_id + '"]').prop('selected', false);
                $('#products').trigger('change.select2');
                updateTotal();
            });
            $(document).on('click', '.plus', function() {
                var quantity = $(this).closest('tr').find('td:nth-child(3) input').val();
                quantity++;
                $(this).closest('tr').find('td:nth-child(3) input').val(quantity);
                var price = $(this).closest('tr').find('td:nth-child(2)').text();
                var total = quantity * price;
                $(this).closest('tr').find('td:nth-child(4)').text(total);
            });
            $(document).on('click', '.minus', function() {
                var quantity = $(this).closest('tr').find('td:nth-child(3) input').val();
                if (quantity > 1) {
                    quantity--;
                    $(this).closest('tr').find('td:nth-child(3) input').val(quantity);
                    var price = $(this).closest('tr').find('td:nth-child(2)').text();
                    var total = quantity * price;
                    $(this).closest('tr').find('td:nth-child(4)').text(total);
                }
            });
            function updateTotal() {
                var total = 0;
                $('.quantity').each(function() {
                    var quantity = $(this).val();
                    var price = $(this).closest('tr').find('td:nth-child(2)').text();
                    total += quantity * price;
                });
                $('#total').text(total);
                $('#total_amount').val(total);
            }
            $(document).on('DOMNodeInserted', 'tbody tr', function() {
                updateTotal();
            });
        });
    </script>
@endpush
