@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        .select2-container--default .select2-selection--single {
            height: 3118px !important;
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

@section('heading','hihihi')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if(session()->has('success'))
                <div class="alert-success alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <h4 class="card-title">Chi tiết hóa đơn</h4>
                            <div class='d-flex flex-wrap'>
                                @include(BUTTON_HEADER_ADMIN_LINK)
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{ route('appointments.add-appointments-bills' , $model->id) }}" method="post" id="form-payment">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ $model->user_id }}">
                                <input type="hidden" name="doctor_id" value="{{ $model->doctor_id }}">
                                <input type="hidden" name="code" value="{{ $model->code }}">
                                <input type="hidden" name="payment_method" value="0">
                                <div class="d-flex">
                                    <div class="col-sm-6">

                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Mã hóa đơn</label>
                                                <input class="form-control" name="code" disabled value="{{ $model->code }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Tên khách hàng</label>
                                                <input class="form-control" name="customer_name" disabled value="{{ $model->customer_name }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Ca làm việc</label>
                                                <input class="form-control" name="shift_name" disabled value="{{ $model->shift_name }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Số điện thoại khách hàng</label>
                                                <input class="form-control" name="customer_phone" disabled value="{{ $model->customer_phone }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Dịch vụ chính</label>
                                                <input disabled class="form-control" value="{{ $model->service_name }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Dịch vụ</label>
                                                <select style="height: auto" class="form-control service select values select_size" id="values" multiple="multiple" name="service_id[]">
                                                    @foreach($services as $key => $value)
                                                        <option @if(in_array($value->id, $services_bills)) selected @endif value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 mb-3">
                                                <label class="mb-2" for="validationCustom01">Bác sĩ</label>
                                                <input class="form-control" disabled value="{{ $model->doctor_name }}">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="products" class="form-label">Sản phẩm</label>
                                                    <select class="form-control products  select" id="products" multiple="multiple"
                                                            name="product_id[]">
                                                        @foreach($products as $key=>$value)
                                                            <option @if(in_array($value->id, $products_prescription)) selected @endif value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <table class="table table-bordered d-none" id="table-order">
                                            <thead>
                                            <tr>
                                                <th>Hình ảnh</th>
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
                                                <th colspan="4" class="text-start">Tổng tiền</th>
                                                <th colspan="2" class="text-start" >
                                                    <b class="total" id="total"></b>
                                                    <input type="hidden" id="total_amount" name="total_amount">
                                                </th>
                                            </tr>
                                        </table>
                                        {{--                                            <div class="row d-none" id="payment_method_handle">--}}
                                        {{--                                                <label for="payment_method" class="form-label">Phương thức thanh toán</label>--}}
                                        {{--                                                <div class="mb-3">--}}
                                        {{--                                                    <label for="cash" class="form-label">--}}
                                        {{--                                                        <input type="radio" name="payment_method" id="cash" value="1" checked>--}}
                                        {{--                                                        Tiền mặt--}}
                                        {{--                                                    </label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="mb-3 ">--}}
                                        {{--                                                    <label for="vnpay" class="form-label">--}}
                                        {{--                                                        <input type="radio" name="payment_method" id="vnpay" value="2">--}}
                                        {{--                                                        Thanh toán qua VNPAY--}}
                                        {{--                                                    </label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                    </div>
                                </div>
                                <a href="{{ URL::previous() }}" class="btn btn-primary">Quay lại</a>
                                @if($model->status != 4)
                                    <button href="" class="btn bg-danger-light">Lưu</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/datatables/datatables.min.js')}}"></script>
@endpush

@push('script')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            var products_prescription = @json($products_prescription);
            function addProductToTable(product) {
                var html = '<tr id="product-' + product.id + '">';
                html += '<td><img src="' + product.image + '" alt="" width="60"></td>';
                html += '<td>' + product.name + '</td>';
                html += '<td>' + product.price + '</td>';
                html += '<td><input type="number" class="form-control quantity" name="quantity[]" value="1"></td>';
                html += '<td>' + product.price + '</td>';
                html += '<td><button type="button" class="btn btn-danger btn-sm remove-product" data-id="' + product.id + '"><i class="fas fa-trash-alt"></i></button></td>';
                html += '</tr>';
                $('.list-product').append(html);
            }

            // Kiểm tra và tự động thêm sản phẩm nếu đã chọn từ trước
            if (products_prescription.length > 0) {
                $('#table-order').removeClass('d-none');
                $('#payment_method_handle').removeClass('d-none');
                $('#btn-save').removeClass('d-none');

                for (var i = 0; i < products_prescription.length; i++) {
                    if ($('#product-' + products_prescription[i]).length) {
                        continue;
                    } else {
                        $.ajax({
                            url: '/admin/get-product/' + products_prescription[i],
                            type: 'GET',
                            dataType: 'json',
                            success: function (result) {
                                addProductToTable(result.data);
                            }
                        });
                    }
                }
            }
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
                                html += '<td><img src="' + result.data.image + '" alt="" width="60"></td>';
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
                var price = $(this).closest('tr').find('td:nth-child(3)').text();
                var total = quantity * price;
                $(this).closest('tr').find('td:nth-child(5)').text(total);
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
            // $(document).on('click', '.plus', function() {
            //     var quantity = $(this).closest('tr').find('td:nth-child(4) input').val();
            //     quantity++;
            //     $(this).closest('tr').find('td:nth-child(4) input').val(quantity);
            //     var price = $(this).closest('tr').find('td:nth-child(3)').text();
            //     var total = quantity * price;
            //     $(this).closest('tr').find('td:nth-child(5)').text(total);
            // });
            // $(document).on('click', '.minus', function() {
            //     var quantity = $(this).closest('tr').find('td:nth-child(4) input').val();
            //     if (quantity > 1) {
            //         quantity--;
            //         $(this).closest('tr').find('td:nth-child(4) input').val(quantity);
            //         var price = $(this).closest('tr').find('td:nth-child(3)').text();
            //         var total = quantity * price;
            //         $(this).closest('tr').find('td:nth-child(5)').text(total);
            //     }
            // });
            function updateTotal() {
                var total = 0;
                $('.quantity').each(function() {
                    var quantity = $(this).val();
                    var price = $(this).closest('tr').find('td:nth-child(3)').text();
                    total += quantity * price;
                });
                //format lại số tiền

                $('#total_amount').val(total);
                $('#total').text(total);
            }
            $(document).on('DOMNodeInserted', 'tbody tr', function() {
                updateTotal();
            });



            $("select.user_id").select2({
                tags: true,
            }).on('select2:selecting', function(e) {
                var value = e.params.args.data.id.trim().toLowerCase();

                if (!/^\d{10}$/.test(value)) {
                    e.preventDefault();
                    toastr.error('Số điện thoại không hợp lệ', 'Error');
                    return;
                }
            });
            $('#user_id').on('select2:select', function (e) {
                var data = e.params.data;
                if(data.id !== '') {
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
                } else {
                    $('#name').val('');
                    $('#phone').val('');
                }
            });
            $('#vnpay').change(function () {
                if($(this).is(':checked')) {
                    $('.btn-checkout').attr('name', 'redirect');
                    $('#form-payment').attr('action', '{{ route('checkout.vnpay') }}');
                }
            });
            $('#cash').change(function () {
                if($(this).is(':checked')) {
                    $('.btn-checkout').attr('name', 'cash');
                    $('#form-payment').attr('action', '{{ route('checkout.cash') }}');
                }
            });



        });
    </script>

    <script>
        $(document).ready(function() {
            $("select.select_size").select2({
                tags: true,
                tokenSeparators: [',', ' '],
            }).on('select2:selecting', function(e) {});
        });
    </script>
@endpush
