@extends('client.app')

@section('content')
    @if(auth()->check())
       <form action="{{route('logout')}}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
       </form>

    @endif
    <form action="" method="post">
        @csrf
       <div class="mb-3">
        <label for="service">Chọn dịch vụ</label>
        <select name="service_id" id="service">
            @foreach ($service as $service)
            <option value="{{$service->id}}" {{$service->id==$service_id?'selected':''}}>{{$service->name}}</option>
            @endforeach
        </select>
       </div>
       <div class="mb-3">
        <label for="">Chọn Bác sĩ</label>
        <select name="doctor_id" id="doctor">
            @foreach ($doctors as $item)
            <option value="{{$item->id}}" {{$item->id==$doctor->id?'selected':''}}>{{$item->name}}</option>
            @endforeach
        </select>
       </div>
       <div class="mb-3">

        <label for="date">Chọn ngày</label>
        <input type="date" name="date" id="date" value="{{$date}}">
        
       </div>
  

     <div class="mb-3">
        <label for="">Chọn thời gian</label>
        <div>
            @php
                // Chuyển đổi thời gian trong biến $times thành định dạng giờ phút "H:i"
                $formattedTimes = [];
                foreach ($times as $time) {
                    $formattedTimes[] = date('H:i', strtotime($time['time']));
                }
            @endphp
    
            @foreach ($scheduleData as $schedule)
                @php
                    // Kiểm tra xem thời gian này đã được đặt lịch hay chưa
                    $isBooked = false;
    
                    if (in_array($schedule['start_time'], $formattedTimes)) {
                        $isBooked = true;
                    }
                @endphp
    
                @if ($isBooked)
                    <input type="radio" name="start_time" id="{{ $schedule['start_time'] }}" value="{{ $schedule['start_time'] }}" disabled>
                    <label for="{{ $schedule['start_time'] }}">{{ $schedule['start_time'] }}</label>
                @else
                    <input type="radio" name="start_time" id="{{ $schedule['start_time'] }}" value="{{ $schedule['start_time'] }}">
                    <label for="{{ $schedule['start_time'] }}">{{ $schedule['start_time'] }}</label>
                @endif
            @endforeach
        </div>
    </div>
    

       
       <div class="mb-3">
        <label for="">Nhập THông tin khách hàng</label><br>
        <input type="text" placeholder="Họ và tên" name="name" value="{{auth()->user()->name ?? old('name')}}">
       </div>
       <div class="mb-3">
        <input type="text" placeholder="Số điện thoại" name="phone" value="{{auth()->user()->phone ?? old('phone')}}">
       </div>
       <div class="mb-3">
        <label for="">Ghi chú</label><br>
        <textarea name="description" id="" cols="30" rows="10" >

        </textarea>

       </div>
       <div class="mb-3">
        <label for="">Chọn loại thú cưng</label><br>
        <select name="type_pet_id" id="">
            @foreach ($typePets as $typePets)
                <option value="{{$typePets->id}}">{{$typePets->name}}</option>
            @endforeach
           
           </select>
       </div>
       
       <button type="submit">Tiếp tục</button>
        
    </form>





@endsection