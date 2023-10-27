@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
    {{-- <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush
@section('heading','hihihi')
@section('content')
    <div class="content container-fluid">
        @if(session()->has('success'))
            <div class="alert-success alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <h5 class="card-title">Cập nhật Bác sĩ</h5>
                                <div class='d-flex flex-wrap'>
                                    <a href="{{route('doctors.index')}}" class="btn btn-info btn-sm mx-3 text-white">Danh sách bác sĩ</a> 
                                    <a href="{{route('doctors.create')}}" class="btn btn-info btn-sm mx-3 text-white">Thêm mới bác sĩ</a> 

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                <form action="{{route('doctors.update',$doctor->id)}}" class="needs-validation" novalidate="" enctype="multipart/form-data" method="POST">
                                    @method('PUT')
                                    @csrf
                                  
                                 
                                    @foreach($colums as $key=>$item)
                                        @if(in_array($key , FIELD_IMAGE))
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                    <input type="file" class="form-control" id="image" name="{{ $key }}" required="">
                                                    <img src="{{$doctor->image}}" width="300px" alt="">
                                                    @if($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                    @endif
                                                </div>
                                                <div class="col-4">
                                                    <img style="width: 300px" src="https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg" alt="" id="image_prev">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="values">Ảnh phụ</label>
                                                        <input type="file" class="form-control" id="image_path" name="image_path[]" required="" multiple="multiple" value="{{old('image_path[]')}}">
                                                        
                                                        @error('image_path')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="col-12" id="image_preview" style="display: flex; flex-direction: row; flex-wrap: wrap;">
                                                        @if(isset($images) && count($images) > 0)
                                                        @foreach($images as $image)
                                                            <img style="width: 100px; margin: 10px" src="{{ $image }}" alt="Ảnh phụ">
                                                        @endforeach
                                                    @endif
                                                    
                                                    </div>
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                            
                                            
                                        @elseif(in_array($key , FIELD_DESC))
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                    <textarea id="editor" name="{{ $key }}">
                                                        {{ $doctor->$key }}
                                                    </textarea>
                                                    @if($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                    
                                        @elseif(array_key_exists($key , FIELD_SELECT_CUSTOM))
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                    <select class="form-select" name="{{ $key }}">
                                                        @foreach(FIELD_SELECT_CUSTOM[$key] as $keyCustom=>$itemCustom)
                                                            {{-- hiển thị dữ liệu đã có --}}
                                                            @if($itemCustom == $doctor->$key)
                                                                <option value="{{ $keyCustom }}" selected>{{ $itemCustom }}</option>
                                                            @else
                                                                <option value="{{ $keyCustom }}">{{ $itemCustom }}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                    @if($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @elseif(in_array($key , FIELD_DATE))
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                    <input type="text" id="date" class="form-control" name="{{ $key }}" value="{{$doctor->$key ? $doctor->$key : old($key)}}">
                                                   
                                                    @if($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="mb-2" for="validationCustom01">{{ $item }}</label>
                                                    <input type="text" class="form-control" id="validationCustom01" name="{{ $key }}" value="{{$doctor->$key ? $doctor->$key : old($key)}}">
                                                    @if($errors->has($key))
                                                        <div class="error text-danger mt-2">{{ $errors->first($key) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                  
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="values">Dịch vụ </label>
                                                <select class="form-control values select_size" id="values" multiple="multiple"
                                                    name="service_id[]">
                                                    @foreach ($services as $service)
                                                    {{-- hiển thị dịch vụ đã có trong bác sĩ --}}
                                                    @if(in_array($service->id,$doctor->services->pluck('id')->toArray()))
                                                    <option value="{{$service->id}}" selected>{{$service->name}}</option>
                                                    @else
                                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                                    @endif

                                                    @endforeach
                                                </select>
                                                @error('service_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col"></div>
                                        <div class="col-md-3">
                                           
            
                                        </div>
                                    </div>
                                  

                                

                                  
                                    <button class="btn btn-primary" type="submit">Thêm </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('script')
    <script>
        $(function(){
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $(selector).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function () {
                readURL(this, '#image_prev');
            });

        });
        $("#image_path").change(function() {
    $('#image_preview').html("");
    if (this.files && this.files[0]) {
        for (let i = 0; i < this.files.length; i++) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#image_preview').append('<img style="width: 100px; margin: 10px" src="' + e.target.result + '"/>');
            }

            reader.readAsDataURL(this.files[i]);
        }
    }
});

    </script>
       <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
       <script>
           $(document).ready(function() {
               $("select.select_size").select2({
                   tags: true,
                   tokenSeparators: [',', ' '],
               }).on('select2:selecting', function(e) {});
           });
       </script>
   
    <script src="{{asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/mask.js')}}"></script>>
@endpush
