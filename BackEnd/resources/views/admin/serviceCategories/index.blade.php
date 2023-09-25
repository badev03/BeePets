@extends('layouts.partials.master')
@section('title',$title)
@push('style')
    <link href="{{asset('backend/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('heading',$title)
@section('content')
{{--    cái này là datatable có đầy đủ các link cần thiết . coppy là dùng thôi--}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <h4 class="mt-0 header-title">Multi item selection</h4>
                    <p class="text-muted font-14 mb-3">
                        This example shows the multi option. Note how a click on a row will toggle its selected state without effecting other rows, unlike the os and single options shown in other examples.
                    </p>
                    <button><a href="{{ route($urlbase . 'create') }}">Thêm mới</a></button>
                    <table id="selection-datatable" class="table table-bordered dt-responsive nowrap">
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
                                        fcvzdxzcv
                                        {{ $item->$colum}}
                                        <img src="{{Storage::url($item->$colum)}}" alt="">
                                      
                                       {{-- @endif --}}
                                    </td>
                                    
                                @endforeach
                                <td>
                                    <a href="{{ route($urlbase . 'show', $item) }}">Xem</a>
                                    <a href="{{ route($urlbase . 'edit', $item) }}">Sửa</a>
                    
                                    <form action="{{ route($urlbase . 'destroy', $item) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <button class="btn btn-danger" onclick=" return confirm('Bạn có chắc muốn xóa không?  Hành động này của bạn có thể dẫn đến mất dữ liệu')" type="submit">Xóa</button>
                                    </form>
                                </td>
                                </tr>
                                
                               
                           @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div> <!-- end row -->
@endsection
@push('script')





    <!-- third party js -->
    <script src="{{asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>


    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="{{asset('backend/assets/js/pages/datatables.init.js')}}"></script>




@endpush
