@if(session()->has('fails_msg'))
    <div class="alert-danger alert">
        {{ session('fails_msg') }}
    </div>
@elseif(session()->has('success_msg'))
    <div class="alert-success alert">
        {{ session('success_msg') }}
    </div>
@endif
