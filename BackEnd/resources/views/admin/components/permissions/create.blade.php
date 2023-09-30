<label class="col-form-label col-md-2 text-success">Cấp quyền</label>
<div class="mb-3 row">
    @foreach($permission as $permissionKey=>$permissionItem)
        <div class="col-md-4">
            <button type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$permissionKey}}" class="col-form-label mb-3 mt-3 col-md-12 text-danger text-uppercase btn btn-sm bg-danger-light">{{ $permissionKey }}</button>
            @foreach($permissionItem as $permissionItemKey => $valuePermission)
            <div class="checkbox" id="collapse_{{ $permissionKey }}">
                <label>
                    <input type="checkbox" name="permissions[]" value="{{ $valuePermission->name }}"> {{ $valuePermission->name }}
                </label>
            </div>
            @endforeach
        </div>
    @endforeach
</div>
