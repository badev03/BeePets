<div class="col-4 mt-3">
    <label class="form-label">Dịch vụ</label>
    <select class="form-select" name="service_id" wire:change="Service" wire:model="service_id">
        @foreach($dataService as $key=>$value)
            <option value="{{ $value->id }}">{{ $value->name }}</option>
        @endforeach
    </select>
</div>
