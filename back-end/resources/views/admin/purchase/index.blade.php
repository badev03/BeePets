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
{{--    <div class="modal fade" id="modal-create-order" style="display: none;" aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content" style="width: 1200px; margin-left: -300px">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title"></h5>--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal">--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <form method="post" id="form-order-return">--}}
{{--                    <div class="modal-body">--}}
{{--                        @csrf--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label for="code" class="form-label"> Mã đơn hàng *</label>--}}
{{--                                    <input type="text" name="code" id="code" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label for="phone" class="form-label"> Số điện thoại *</label>--}}
{{--                                    <select name="phone" id="phone" class="phone-select form-select" style="z-index: 10000">--}}
{{--                                        <option value="">Chọn số điện thoại</option>--}}
{{--                                        @foreach($customers as $customer)--}}
{{--                                            <option value="{{ $customer->phone }}">{{ $customer->phone }}--}}
{{--                                                / {{ $customer->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label for="name" class="form-label"> Tên khách hàng *</label>--}}
{{--                                    <input type="text" name="name" id="name" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Hủy</button>--}}
{{--                        <button type="submit" class="btn btn-primary create-order">Thêm mới</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
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
            $('#btn-add-new').click(function () {
                $('#modal-create-order').modal('show');
                $('.modal-title').html('Thêm mới đơn hàng');
                $('.text-danger').remove();
                $('#form-order-return')[0].reset();
                $('.form-control').removeClass('border border-danger');
            })



        });
    </script>
@endpush
