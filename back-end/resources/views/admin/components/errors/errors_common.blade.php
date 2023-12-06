@if (session()->has('success'))
    <div class="alert-success alert">
        {{ session('success') }}
    </div>
@elseif(session()->has('fails'))
    <div class="alert-danger alert">
        {{ session('fails') }}
    </div>
@elseif(session()->has('success_delete'))
    <div class="alert-success alert">
        {{ session('success_delete') }}
    </div>
@endif
