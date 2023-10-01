<a href="{{ route($urlbase.'create') }}" class="btn btn-sm bg-danger-light me-3 d-flex align-items-center">Thêm</a>
<a href="{{ route($urlbase.'index') }}" class="btn btn-sm bg-success-light d-flex align-items-center">Danh sách</a>
@if(request()->routeIs('role.*') && 1==2)
    <a href="{{ route('role.givePermission') }}" class="btn btn-sm bg-info-light d-flex align-items-center ms-3">Cấp quyền</a>
@endif
