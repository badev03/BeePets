<label class="col-form-label col-md-2 text-success">Vai trò</label>
<div class="mb-3 row">
    <div class="col-md-3 mb-3">
    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapse_role_1" class="col-form-label mb-3 mt-3 col-md-12 text-danger text-uppercase btn btn-sm bg-danger-light">Vai trò</button>
        @foreach($role as $roleKey=>$roleItem)
    <div class="checkbox" id="collapse_role_1">
        <label>
            @if(request()->routeIs('permission.edit*'))
                    <input @if(in_array($roleItem->name , $permissionWasCheck)) checked @endif type="checkbox" name="role[]" value="{{ $roleItem->name }}"> {{ $roleItem->name }}
            @elseif(request()->routeIs('permission.create'))
                    <input type="checkbox" name="role[]" value="{{ $roleItem->name }}"> {{ $roleItem->name }}
            @endif
        </label>
    </div>
        @endforeach
    </div>
</div>
