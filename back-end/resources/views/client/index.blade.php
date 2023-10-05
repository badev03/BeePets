@extends('client.app')

@section('content')
   
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
<div class="row">
    
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3>Đặt lịch</h3>
            </div>
            <div class="card-body">

                <form action="{{route('store')}}" method="post">
                        @csrf
                    <label for="date">Chọn Ngày:</label>
                    <input type="date" id="date" name="date">
                    <label for="service">Chọn dịch vụ:</label>

                    <select name="service_id" id="service">
                        @foreach($sevices as $sevice)
                            <option value="{{ $sevice->id }}">{{ $sevice->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit">Đặt lịch ngay</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection