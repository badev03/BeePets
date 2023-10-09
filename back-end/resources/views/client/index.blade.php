@extends('client.app')

@section('content')
   
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as  $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
<div class="row">
    
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3>Đặt lịch</h3>
            </div>
            <div class="card-body">
                <form action="{{route('show.form')}}" method="post">
                    <input type="hidden" name="doctor_id" value="1">
                    <input type="hidden" name="date"  value="{{ now()->toDateString() }}">
                    @csrf
                    <button type="submit">Đặt lịch nhanh</button>
                </form>
              
            </div>
        </div>
    </div>
</div>

@endsection