@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
@endpush
@section('heading','hihihi')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if(session()->has('success_delete'))
                <div class="alert-success alert">
                    {{ session('success_delete') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <h4 class="card-title">Danh sách {{ $title_web }}</h4>
                            <div class='d-flex flex-wrap'>
                                @include(BUTTON_HEADER_ADMIN_LINK)
                                @if (route('doctors.index')==url()->current())
                               <a href="{{route('schedules.index')}}" class="btn btn-info btn-sm mx-3 text-white">Lịch Làm việc</a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table table-stripped">
                            <thead>
                            <td>#ID</td>
                            @foreach ($colums as $colum=>$name)


                                <td>{{$name}}</td>
                            @endforeach
                            <td>Hành động</td>
                            </thead>
                            <tbody>
                            @foreach ($data as $key=>$item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    @foreach ($colums as $colum=>$name)
                                        <td>
                                            @if(in_array($colum, FIELD_IMAGE))
                                                <img src="{{ asset($item->$colum)?? '123'}}" width="100px" alt="">
                                            @elseif(in_array($colum , FIELD_DESC))
                                                   {!! $item->$colum !!}
                                            @elseif(in_array($colum , $FIELD_SELECT_CUSTOM_CONTROLLER))
                                                @foreach($listIndex as $keyListIndex=>$valueListIndex)
                                                    {!! $item->$valueListIndex->name !!}
                                                @endforeach
                                            @elseif(array_key_exists($colum , FIELD_SELECT_CUSTOM))
                                                @foreach(FIELD_SELECT_CUSTOM[$colum] as $keyCustom=>$valueCustom)
                                                    @if($keyCustom==$item->$colum)
                                                        {{ $valueCustom }}
                                                    @endif
                                                @endforeach
                                            @else
                                                {{ $item->$colum}}
                                            @endif

                                        </td>
                                    @endforeach
                                    <td class="d-flex" style="grid-gap:1rem">
                                        <div class="actions">
                                            @if(1==2)
                                                <button href="#viewer" class="btn btn-sm bg-info-light buttonView"
                                                        data-bs-check="{{ $item->id }}" data-bs-toggle="modal">
                                                    <i class="far fa-eye"></i> Xem
                                                </button>
                                            @endif
                                            <a class="btn btn-sm bg-success-light" href="{{ route($urlbase . 'edit', $item) }}">
                                                <i class="fe fe-pencil"></i> Sửa
                                            </a>
                                            <a data-bs-toggle="modal" href="#delete_modal_{{$item->id}}" class="btn btn-sm bg-danger-light">
                                                <i class="fe fe-trash"></i> Xóa
                                            </a>
                                                @if(count($data)>0)
                                                    <div class="modal fade" id="delete_modal_{{ $item->id }}" aria-hidden="true" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="form-content p-2 text-center">
                                                                        <h4 class="modal-title">Xóa</h4>
                                                                        <p class="mb-4">Bạn có chắc chắn muốn xóa {{ $item->id }}</p>
                                                                        <div class="d-flex justify-content-center" style="gap: 1rem">
                                                                            <form action="{{ route($urlbase . 'update', $item) }}" method="post">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input hidden type="text" name="status" value="2">
                                                                                <button class="btn bg-success-light"
                                                                                        type="submit">Xóa
                                                                                </button>
                                                                            </form>
                                                                            <button type="button" class="btn bg-danger-light" data-bs-dismiss="modal">Đóng</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                        </div>
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

    {{--view--}}
    @include('admin.baseCrud.view')
@endsection
@push('script')

    <script src="{{asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/datatables/datatables.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.buttonView').click(function() {
                var dataBsToggleValue = $(this).data('bs-check');
                var assetUrl = "{{ asset('') }}";
                $.ajax({
                    type: 'GET',
                    url: "{{ route($urlbase.'show', '') }}" + '/' +dataBsToggleValue,
                    dataType: 'json',
                    success: function(data) {
                        $('#name').val(data.name);
                        $('#slug').val(data.slug);
                        $('#description').val(data.description);
                        $('#image').attr('src', assetUrl + data.image);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });


            $('.add-to-cart').on('click',function (){
                var product_id = $(this).data('id');
                $.ajax({
                    url: "{{ route('carts.store') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "product_id": product_id,
                        "quantity": "1",
                    },
                    success:function (response){
                        if(response.status === 'success'){
                            window.location.reload();
                        }else{
                            console.log(response.message)
                        }
                    }
                });
            })
        });



    </script>

@endpush
