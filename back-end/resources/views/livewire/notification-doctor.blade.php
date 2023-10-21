<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="row mt-3">
        <h6 class="card-title text-danger">Bộ lọc Tìm kiếm Bác sĩ</h6>
        <div class="col-4 mt-3">
            <label class="form-label">Số điện thoại</label>
            <input wire:model="searchName" class="form-control" type="text"/>
            <div class="d-flex align-items-center">
                <button wire:click="filterUsers" class="btn me-2 btn-sm bg-success-light mt-3">Tìm kiếm</button>
                <button wire:click="clearFormSdt" class="col-3 mt-3 btn me-2 btn-sm bg-danger-light">Clear form</button>
            </div>
        </div>
    </div>
    <hr class="hr"/>

    <div class="row">
        <div class="col-4 mt-3 d-flex flex-column shadow-lg p-3 mb-5 bg-body rounded">
            <label class="form-label">Gửi nhiều thông báo</label>
                <label style="gap: 0.5rem" class="d-flex">
                    <input type="checkbox" wire:model="notification"> Gửi đi cho tất cả bác sĩ
                </label>
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
        <div class="col-4">
            @if (Session::has('success_message'))
                <div class="alert alert-success mt-3">
                    {{ Session::get('success_message') }}
                </div>
            @endif
        </div>
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
                                   'route' => route('notifications.send-notifications-doctor')
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
                                    'route' => route('notifications.send-notifications-doctor')
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
