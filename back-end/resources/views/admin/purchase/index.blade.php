@extends('layouts.partials.master')
@section('title','Đơn hàng')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
                            <a href="{{ route('purchase.create') }}" class="btn btn-primary btn-sm float-end" id="btn-add-new">Thêm mới</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered" id="myDataTable">
                        <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Ngày tạo
                            </th>
                            <th>Mã đơn hàng</th>
                            <th>Tên người mua</th>
                            <th>Đơn giá</th>
                            <th>Hình thức thanh toán</th>
                            <th>Trạng thái</th>

                            <th>Hành động</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-handle-order" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form method="post" id="form-order-return">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="description" class="form-label"> Lý do hoàn trả *</label>
                            <textarea name="description" id="description" cols="30" rows="8"
                                      class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary save">Hoàn trả</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  modal create new order  --}}
    <div class="modal fade" id="modal-continue-order" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 1200px; margin-left: -300px">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form method="post" id="form-order-continue" action="{{ route('purchase.updateByCash') }}">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="code" class="form-label"> Mã đơn hàng *</label>
                                    <input type="text" name="code" id="code" class="form-control">
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="name" class="form-label"> Tên khách hàng *</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="total_amount" class="form-label"> Đơn giá *</label>
                                    <input type="text" name="total_amount" id="total_amount" class="form-control">
                                </div>
                            </div>
                            <div class="col">
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary btn-checkout">Thanh toán</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="{{asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/datatables/datatables.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function () {

            var table = $('#myDataTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('purchase.getData') }}",
                    "type": "GET",
                },
                "columns": [
                    {"data": "id"},
                    {"data": "created_at"},
                    {"data": "code"},
                    {"data": "customer_name"},
                    {"data": "total_amount"},
                    {"data": "payment_method"},
                    {"data": "status"},
                    {"data": "action"},
                ],
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ bản ghi",
                    "zeroRecords": "Không tìm thấy bản ghi nào",
                    "infoEmpty": "Không có bản ghi nào",
                    "infoFiltered": "(Được tìm kiếm từ _MAX_ bản ghi)",
                    "paginate": {
                        "previous": "Trước",
                        "next": "Sau"
                    },
                    "search": "Tìm kiếm:",
                    "info": "Hiển thị từ _START_ đến _END_ của _TOTAL_ bản ghi",

                },
                //th ID của cột trong database tự động active sort
                "order": [[0, "desc"]]

            })
            $('body').on('click', '.btn-return-order', function () {
                $('#modal-handle-order').modal('show');
                $('.modal-title').html('Hoàn trả đơn hàng');
                $('.text-danger').remove();
                $('#form-order-return')[0].reset();
                $('.form-control').removeClass('border border-danger');
            })
            $('body').on('submit', '#form-order-return', function (e) {
                e.preventDefault();
                let id = $('.btn-return-order').data('id');
                let description = $('#description').val();
                $.ajax({
                    url: "{{ route('purchase.update') }}",
                    type: "PATCH",
                    data: {
                        id: id,
                        description: description,
                        status: 3,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (response.code === 200) {
                            $('#modal-handle-order').modal('hide');
                            table.ajax.reload();
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function (key, value) {
                                $('#' + key).after('<span class="text-danger">' + value + '</span>');
                                $('#' + key).addClass('border border-danger');
                            })
                            toastr.error('Có lỗi xảy ra');
                        }
                    }
                })
            })
            $('body').on('click','.btn-continue__checkout',function (){
                $id = $(this).data('id');
                $('#modal-continue-order').modal('show');
                $('.modal-title').html('Tiếp tục đơn hàng');
                $('.text-danger').remove();
                $('#form-order-return')[0].reset();
                $('.form-control').removeClass('border border-danger');
                $.ajax({
                    url : "get-order/"+$id,
                    type : "GET",
                    success : function (response){
                        console.log(response)
                        $('#code').val(response.data.code);
                        $('#name').val(response.data.customer_name);
                        $('#total_amount').val(response.data.total_amount);
                    }
                })
            })
            $('body').on('change','#cash',function (){
                if($(this).is(':checked')){
                   $('#form-order-continue').attr('action','{{ route('purchase.updateByCash') }}')
                    $('.btn-checkout').attr('name','checkout');
                }
            })
            $('body').on('change','#vnpay',function (){
                if($(this).is(':checked')){
                    $('#form-order-continue').attr('action','{{ route('purchase.updateByVnpay') }}')
                    $('.btn-checkout').attr('name','redirect');
                }
            })







        });
    </script>
@endpush
