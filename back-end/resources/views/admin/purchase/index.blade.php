@extends('layouts.partials.master')
@section('title','Đơn hàng')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
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
                            <button class="btn btn-primary btn-sm float-end" id="btn-add-new">Thêm mới</button>
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
                                        <a href="{{ route('print.order',$value->id) }}" class="btn btn-sm btn-primary">In
                                            hóa đơn</a>
                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm btn-return-order"
                                           data-id="{{ $value->id }}">Hoàn trả</a>
                                    @endif
                                    <a href="{{ route('purchase.show',$value->id) }}"
                                       class="btn btn-sm btn-info text-white">Xem</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--  modal order return  --}}
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
    <div class="modal fade" id="modal-create-order" style="display: none;" aria-hidden="true">
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
                        <button type="submit" class="btn btn-primary create-order">Thêm mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="{{asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/datatables/datatables.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#myDataTable').DataTable();
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
                        status : 3,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if(response.code === 200){
                            $('#modal-handle-order').modal('hide');
                            window.location.reload();
                        }
                        else{
                            console.log(response)
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function (key, value) {
                                $('#' + key).after('<span class="text-danger">' + value + '</span>');
                                $('#' + key).addClass('border border-danger');
                            })
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
