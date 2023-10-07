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

                <form action="{{route('saveInfo.store')}}" method="post">
                        @csrf
                    <label for="date">Chọn Ngày:</label>
                    <input type="date" id="date" name="date" value="{{ now()->toDateString() }}">
                    {{-- @dd(now()) --}}
                    @error('date')
                    <span class="text-danger">{{$message}}</span>
                         @enderror
                    <label for="service">Chọn dịch vụ:</label>

                    <select name="service_id" id="service">
                        @foreach($sevices as $sevice)
                            <option value="{{ $sevice->id }}">{{ $sevice->name }}</option>
                        @endforeach

                    </select>
                    @error('service_id')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                    <button type="submit">Đặt lịch ngay</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
