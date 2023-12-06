@extends('layouts.partials.master')
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
                        <h4 class="card-title">Danh sách {{ $title_web }}</h4>
                        <div class='d-flex flex-wrap'>
                           <a href="{{route('doctors.create')}}" class="btn btn-info btn-sm mx-3 text-white">Thêm bác sĩ</a>


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


                            @foreach ($doctors as $key=>$item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                @foreach ($colums as $colum=>$name)
                                    <td>
                                        @if(in_array($colum, FIELD_IMAGE))
                                            <img src="{{ asset($item->$colum)?? '123'}}" width="100px" alt="">
                                        @elseif(in_array($colum , FIELD_DESC))
                                            {!! $item->$colum !!}

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



                                                <a class="btn btn-sm bg-success-light" href="{{route('doctors.show', $item)}}">
                                                    <i class="far fa-eye"></i> Xem
                                                </a>
                                        <a class="btn btn-sm bg-success-light" href="{{route('doctors.edit', $item)}}">
                                            <i class="fe fe-pencil"></i> Edit
                                        </a>
                                       
                                    </div>
                                </td>
                            </tr>
                  


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
