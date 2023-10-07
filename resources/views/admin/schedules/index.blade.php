@extends('layouts.partials.master')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h3>Lịch làm việc</h3>
                    </div>
                    <div class="col">
                        <a href="{{route('schedules.create')}}" class="btn btn-info btn-sm mx-3 text-white float-end">Thêm lịch làm việc</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ngày</th>
                            <th>Giờ bắt đầu</th>
                            <th>Giờ kết thúc</th>
                            <th>Bác sĩ</th>
                            <th>Thao tác</th>
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
                                <td>
                                    <a href="" class="btn btn-success btn-sm">Sửa</a>
                                    <form action="{{ route('schedules.destroy',$value->id) }}" class="d-inline" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                        Xóa</button>
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


@endsection