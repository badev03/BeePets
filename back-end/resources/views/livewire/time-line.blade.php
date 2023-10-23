<div class="col-4 ms-3">
    <div class="row">
        @if (Session::has('success_message'))
            <div class="alert alert-success mt-3">
                {{ Session::get('success_message') }}
            </div>
        @endif
        <div class="mt-3 shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            <label class="form-label">Ngày gửi</label>
            <input wire:model="date_send" class="form-control" type="date"/>
            <label class="form-label mt-3">Thời gian gửi</label>
            <input wire:model="time_send" class="form-control" type="time"/>
            <label class="form-label mt-3">Đối tượng gửi thông báo</label>
            @foreach($roles as $key=>$item)
            <label style="gap: 0.5rem" class="d-flex">
                    <input type="checkbox" wire:model="roles_notification" value="{{ $item->id }}">{{ $item->name }}
            </label>
            @endforeach
            <label class="mb-2">Nội dung</label>
            <textarea wire:model="messageUser" class="form-control" name="description"></textarea>
            @error('messageUser') <span class="error text-danger d-block">{{ $message }}</span> @enderror
            <div class="d-flex align-items-center">
                <button wire:click="SetTime" class="btn me-2 btn-sm bg-success-light mt-3">Ok set thời gian</button>
                <button wire:click="clearFormSdt" class="col-3 mt-3 btn me-2 btn-sm bg-danger-light">Clear form</button>
            </div>
        </div>
    </div>
</div>
