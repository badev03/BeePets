<label class="col-form-label col-md-2 text-success">Cấp quyền</label>
<div class="mb-3 row">
    @if(request()->routeIs('role.edit*'))

        @foreach($permission as $permissionKey=>$permissionItem)
            <div class="col-md-4">
                <button type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$permissionKey}}" class="col-form-label mb-3 mt-3 col-md-12 text-danger text-uppercase btn btn-sm bg-danger-light">{{ $permissionKey }}</button>
                @foreach($permissionItem as $permissionItemKey => $valuePermission)
                    <div class="checkbox" id="collapse_{{ $permissionKey }}">
                        <label>
                            <input @if(in_array($valuePermission->name , $permissionsArray)) checked @endif type="checkbox" name="permissions[]" value="{{ $valuePermission->name }}"> {{ $valuePermission->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach
    @elseif(request()->routeIs('people-account.edit*'))
        @php
            $i = 0;
        @endphp
{{--        @foreach ($permissionsWeb as $permission)--}}
{{--            <label>--}}
{{--                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"--}}
{{--                    {{ $userPermissions->contains('id', $permission->id) ? 'checked' : '' }}>--}}
{{--                {{ $permission->name }} <!-- Hiển thị tên của quyền -->--}}
{{--            </label>--}}
{{--        @endforeach--}}
        @foreach($permission as $permissionKey=>$permissionItem)
            <div class="col-md-4">
                <button type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$permissionKey}}" class="col-form-label mb-3 mt-3 col-md-12 text-danger text-uppercase btn btn-sm bg-danger-light">{{ $permissionKey }}</button>
                @foreach($permissionItem as $permissionItemKey => $valuePermission)
                        <div class="checkbox" id="collapse_{{ $permissionKey }}">
                            <label>
                                <input {{ $userPermissions->contains('id', $valuePermission->id) ? 'checked' : '' }} type="checkbox" name="permissions[]" value="{{ $valuePermission->name }}"> {{ $valuePermission->name }}
                            </label>
                        </div>
                @endforeach
            </div>
        @endforeach
    @endif
</div>
