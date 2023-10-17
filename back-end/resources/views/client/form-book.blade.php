@extends('client.app')
@push('css')
    
<style>
  
/* 
    .container {
        width: 100%;
        height: 100vh;
        background-color: #f1f1f1;
        display: flex;
        justify-content: center;
        align-items: center;
    } */

    .label-form {
        background-color: #ffffff;
        padding: 10px 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    }


    .label-form.checked {
        background-color: #3498db;
        color: #ffffff;
    }
    #shift_name {
        display: none;
    }
</style>
@endpush
@section('content')

    @if(auth()->check())
       <form action="{{route('logout')}}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
       </form>

    @endif
  

  
  
    
    <form action="{{route('booking.store')}}" method="post" id="form-booking">
        @csrf
       <div class="mb-3">
        <label for="service">Chọn dịch vụ</label>
        <select name="service_id" id="service">
            @foreach ($service as $service)
            <option value="{{$service->id}}" >{{$service->name}}</option>
            @endforeach
        </select>
       </div>


       <div class="mb-3">
        <label for="">Chọn Bác sĩ</label>
        <select name="doctor_id" id="doctor">
            @foreach ($doctors as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
       </div>
       <div class="mb-3">

        <label for="date">Chọn ngày</label>
        <input type="date" name="date" id="date" >
        
       </div>
  

     <div class="mb-3">
        <label for="">Chọn thời gian</label>
        <div>
          {{-- lưu thời gian hiện tại --}}
            <input type="hidden" name="time" value="{{date('H:i:s')}}">
                {{-- Hiển thị thời gian trong biến scheduleData --}}
               @foreach ($workSchedule as $item)
              

               <div class="mb-3">
                <label for="shift_name" class="label-form" id="shiftLabel">{{$item->shift_name}}</label>
                <input type="checkbox" class="form-control" id="shift_name" name="shift_name" value="{{$item->shift_name}}"> 
                {{'('.$item->start_time .'-'. $item->end_time.')'}}
            </div>
                
          
            
                @endforeach 



            
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#shift_name').change(function () {
                if ($(this).is(':checked')) {
                    $('#shiftLabel').addClass('checked');
                } else {
                    $('#shiftLabel').removeClass('checked');
                }
            });
        });
    </script>
 <script>
        // document.getElementById('doctor').addEventListener('change', function() {
        //     document.getElementById('form-booking').submit();
        // });
        // document.getElementById('service').addEventListener('change', function() {
        //     document.getElementById('form-booking').submit();
        // });
        // document.getElementById('date').addEventListener('change', function() {
        //     document.getElementById('form-booking').submit();
        // });


</script>



@endsection