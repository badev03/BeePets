@extends('layouts.partials.master')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>

    </style>
@endpush
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h3>Lịch làm việc</h3>
                    </div>
                    <div class="col ">
                        <div class="row">
                            <div class="col float-end">
                                <form action="{{ route('import') }}" method="post" enctype="multipart/form-data"  id="form-import">
                                    @csrf
                                       <label class="btn btn-primary btn-sm float-end form-label" for="file">Import Excel</label>
                                       <input type="file" hidden="hidden"  name="file" id="file">
                                </form>
                            </div>
                            <div class="col ">
                                <a href="{{route('schedules.create')}}" class="btn btn-info btn-sm mx-3 text-white float-start">Thêm lịch làm việc</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ngày</th>
                            <th>Giờ bắt đầu</th>
                            <th>Giờ kết thúc</th>
                            <th>Bác sĩ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedules as $key=>$value)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value->date }}</td>
                                <td>{{ $value->start_time }}</td>
                                <td>{{ $value->end_time }}</td>
                                <td>{{ $value->doctor->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
    <script src="{{asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/datatables/datatables.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var select = $('<select class="form-select form-select-sm"><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                },
                "initComplete": function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).appendTo($(column.header()))
                            .val('')
                            .addClass('form-control form-control-sm')
                            .attr('placeholder', 'Search')
                            .on('keyup', function () {
                                column.search($(this).val()).draw();
                            });
                    } );
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#file').change(function () {
                $('#form-import').submit();
            });
        });
    </script>
@endpush
