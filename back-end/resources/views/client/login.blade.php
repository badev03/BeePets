@extends('client.app')

@section('content')
<h3>Đăng nhập</h3>
<form action="{{route('login.post')}}" method="post">
    @csrf
    <div class="form-group mb-3">
        <label for="phone">phone</label>
        <input type="text" name="phone" placeholder="phone" class="form-control" id="phone">
        @error('phone')
                <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" class="form-control" id="password">
        @error('password')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        <button class="btn btn-primary" type="submit">Đăng nhập</button>
</form>
    
@endsection