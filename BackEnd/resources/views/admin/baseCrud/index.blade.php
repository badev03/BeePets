@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
@endpush
@section('heading','hihihi')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <h4 class="card-title">Danh sách {{ $title_web }}</h4>
                            <div class='d-flex flex-wrap'>
                                @include(BUTTON_HEADER_ADMIN_LINK)
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table table-stripped">

                            <thead>
                            @foreach ($colums as $colum=>$name)
                                <td>{{$name}}</td>
                            @endforeach
                            <td>Hành động</td>
                            </thead>
                            <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    @foreach ($colums as $colum=>$name)

                                        <td>
                                            @if(in_array($colum, FIELD_IMAGE))
                                                <img src="{{ asset($item->$colum)?? '123'}}" width="50px" alt="">
                                            @else
                                                {{ $item->$colum}}
                                            @endif


                                        </td>

                                    @endforeach
                                    <td>
                                        <button class="btn btn-warning">

                                            <a style="color: white" href="{{ route($urlbase . 'show', $item) }}">Xem</a>
                                        </button>

                                        <button class="btn btn-success">
                                            <a style="color: white" href="{{ route($urlbase . 'edit', $item) }}">Sửa</a>
                                        </button>

                                        <form action="{{ route($urlbase . 'destroy', $item) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger"
                                                    onclick=" return confirm('Bạn có chắc muốn xóa không?  Hành động này của bạn có thể dẫn đến mất dữ liệu')"
                                                    type="submit">Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
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
