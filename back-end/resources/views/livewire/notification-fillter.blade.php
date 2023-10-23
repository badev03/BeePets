<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="row mt-3">
        <h6 class="card-title text-danger">Bộ lọc Tìm kiếm User</h6>
        <div class="col-4 mt-3">
            <label class="form-label">Số điện thoại người dùng</label>
            <input wire:model="searchName" class="form-control" type="text"/>
            <button wire:click="filterUsers" class="btn me-2 btn-sm bg-success-light mt-3">Tìm kiếm</button>
        </div>
        <div class="col-4 mt-3">
            <label class="form-label">Quyền user</label>
            <select class="form-select" wire:model="searchRoles">
                @foreach ($user as $key=>$item)
                    <option value="{{ $item->role_id }}">
                        {{ $item->name }}</option>
                @endforeach
            </select>
            <button wire:click="filterUsers" id="filter_searchName" class="btn me-2 btn-sm bg-success-light mt-3">Lọc dữ liệu</button>
        </div>
    </div>
    <hr class="hr"/>

    <div class="row">
        <div class="col-4 mt-3 d-flex flex-column shadow-lg p-3 mb-5 bg-body rounded">
            @if (Session::has('success_message'))
                <div class="alert alert-success mt-3">
                    {{ Session::get('success_message') }}
                </div>
            @endif
            <label class="form-label">Gửi nhiều thông báo</label>
            @foreach ($user as $key=>$item)
                <label style="gap: 0.5rem" class="d-flex">
                    <input type="checkbox" wire:model="notification" value="{{ $item->role_id }}"> {{ $item->name }}
                </label>
            @endforeach
            @error('notification') <span class="error">Không được để trống</span> @enderror
            <div class="row mt-3">
                <div class="col-12 col-sm-12">
                    <div class="mb-3">
                        <label class="mb-2">Nội dung</label>
                        <textarea wire:model="messageUser" class="form-control" name="description"></textarea>
                        @error('messageUser') <span class="error text-danger d-block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex mr-2 align-items-center">
                <button wire:click="filterUsers"  class="col-3 btn me-2 btn-sm bg-success-light">Chọn gửi</button>
                <button wire:click="clearForm" class="col-3 btn me-2 btn-sm bg-danger-light">Clear form</button>
            </div>
        </div>

        <livewire:time-line />
    </div>


    @include(errors_notification)


    <div class="table-responsive mt-3">
        <table class="datatable table table-stripped">
            <thead id="thead_table">
                <td>#ID</td>
                <td>Name</td>
                <td>Số điện thoại</td>
                <td>Hành động</td>
            </thead>
            <tbody id="tbody_table_notification">
            @if(isset($filteredUsers))
                @foreach($filteredUsers as $key=>$value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->phone }}</td>
                        <td class="d-flex" style="grid-gap:1rem">
                            <div class="actions">
                                <a class="btn btn-sm bg-success-light" href="#viewer{{ $value->id }}" data-bs-check="{{ $value->id }}" data-bs-toggle="modal">
                                    Thông báo
                                </a>
                                @include('admin.components.button.view' , [
                                    'route' => route('notifications.send-notifications-user')
                                ])
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                @foreach($data as $key=>$value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->phone }}</td>
                        <td class="d-flex" style="grid-gap:1rem">
                            <div class="actions">
                                <a class="btn btn-sm bg-success-light" href="#viewer{{ $value->id }}" data-bs-check="{{ $value->id }}" data-bs-toggle="modal">
                                    Thông báo
                                </a>
                                @include('admin.components.button.view' , [
                                    'route' => route('notifications.send-notifications-user')
                                ])
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>

