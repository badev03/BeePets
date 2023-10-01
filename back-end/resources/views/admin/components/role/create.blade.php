<label class="col-form-label col-md-2 text-success">Vai trò</label>
<div class="mb-3 row">
    <div class="col-md-8 mb-3">
        <select class="form-select" name="role">
            @foreach($role as $roleKey=>$roleItem)
                <option value="{{ $roleItem->name }}">{{ $roleItem->name }}</option>
            @endforeach
        </select>
        @if($errors->has('role'))
            <div class="error text-danger mt-2">{{ $errors->first('role') }}</div>
        @endif
    </div>
</div>
