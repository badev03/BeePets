<div>
    @include('admin.components.errors.errors')
    <div class="row mt-3">
        <h6 class="card-title text-danger">Nhập vào số điện thoại để thêm mới cuộc hẹn </h6>
        <div class="col-4 mt-3">
            <label class="form-label">Số điện thoại người dùng</label>
            <input wire:model="phone" style="height: 38px" name="phone" type="text" class="form-control">
        </div>
    </div>
    <button class="btn me-2 btn-sm bg-success-light mt-3" wire:click="addAppointment">Tìm kiếm</button>
    <button class="btn me-2 btn-sm bg-danger-light mt-3" wire:click="clearForm">Làm mới tìm kiếm</button>

    <div class="table-responsive mt-3">
        <table class="datatable table table-stripped">
            <thead id="thead_table">
            <td>#ID</td>
            <td>Name</td>
            <td>Số điện thoại</td>
            <td>Hành động</td>
            </thead>
            <tbody>
            @if(isset($search_phone))
                <tr>
                    <td>{{ $search_phone->id }}</td>
                    <td>{{ $search_phone->name }}</td>
                    <td>{{ $search_phone->phone }}</td>
                    <td class="d-flex" style="grid-gap:1rem">
                        <div class="actions">
                            <a href="{{ route('create-data.appointments' , $search_phone->id) }}"  class="btn btn-sm bg-success-light">
                                Thêm cuộc hẹn
                            </a>
{{--                                <div class="modal fade" wire:ignore.self id="add-appointments_{{ $search_phone->id }}" aria-hidden="true" role="dialog">--}}
{{--                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">--}}
{{--                                    <div class="modal-content">--}}
{{--                                        <div class="modal-header">--}}
{{--                                            <h5 class="modal-title">Thêm cuộc hẹn cho {{ $search_phone->name }}</h5>--}}
{{--                                        </div>--}}
{{--                                        <div class="modal-body">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-sm-6">--}}
{{--                                                    <label class="">Dịch vụ</label>--}}
{{--                                                    <select class="form-select" name="service_id" id="service_id" wire:model="service_id">--}}
{{--                                                        <option value="">Mời chọn dịch vụ</option>--}}
{{--                                                        @foreach($dataService as $keyDataService=>$valueDataService )--}}
{{--                                                            <option value="{{ $valueDataService->id }}">{{ $valueDataService->name }}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                    @if($errors->has('service_id'))--}}
{{--                                                        <div class="error text-danger mt-2">{{ $errors->first('service_id') }}</div>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                                <div class="col-sm-6">--}}
{{--                                                    <label class="">Loại thú cưng</label>--}}
{{--                                                    <select class="form-select" name="type_pet_id">--}}
{{--                                                        @foreach($dataTypePet as $keyDataTypePet=>$valueDataTypePet )--}}
{{--                                                            <option value="{{ $valueDataTypePet->id }}">{{ $valueDataTypePet->name }}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                    @if($errors->has('type_pet_id'))--}}
{{--                                                        <div class="error text-danger mt-2">{{ $errors->first('type_pet_id') }}</div>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}

{{--                                                <div class="col-sm-6 mt-3 mb-3">--}}
{{--                                                    <label for="validationCustom01">Bác sĩ</label>--}}
{{--                                                    <select class="form-select is-invalid" name="doctor_id" wire:model="doctor_id">--}}
{{--                                                    </select>--}}
{{--                                                    @if($errors->has('doctor_id'))--}}
{{--                                                        <div class="invalid-feedback">{{ $errors->first('doctor_id') }}</div>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                                <div class="col-sm-6 mb-3">--}}
{{--                                                    <label class="col-form-label col-md-2">Chọn ngày</label>--}}
{{--                                                    <input id="day-create" type="date" class="form-control api_day_create" name="date" value="{{ date('Y-m-d') }}"/>--}}
{{--                                                    @if($errors->has('date'))--}}
{{--                                                        <div class="error text-danger mt-2">{{ $errors->first('date') }}</div>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}

{{--                                                <div class="col-sm-6 ">--}}
{{--                                                    <label class="">Chọn ngày</label>--}}
{{--                                                    <input class="form-control" type="date" wire:model="service_id">--}}
{{--                                                </div>--}}
{{--                                                <div class="col-sm-6">--}}
{{--                                                    <label class="">Chọn ca</label>--}}
{{--                                                    <input class="form-control" type="text" wire:model="service_id">--}}
{{--                                                </div>--}}

{{--                                                <div class="col-sm-6 mt-3 mb-3">--}}
{{--                                                    <label class="">Họ và tên</label>--}}
{{--                                                    <input class="form-control is-invalid" type="text" wire:model.defer="service_id">--}}
{{--                                                    <div class="invalid-feedback">{{ $errors->first('service_id') }}</div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-sm-6 mt-3 mb-3">--}}
{{--                                                    <label class="">Số điện thoại</label>--}}
{{--                                                    <input class="form-control" type="text" wire:model="service_id">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="modal-footer">--}}
{{--                                            <button type="button" class="btn bg-danger-light" data-bs-dismiss="modal">Đóng</button>--}}
{{--                                            <button type="button" class="btn bg-success-light"  wire:click="StoreAppointments">Thêm cuộc hẹn</button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </td>
                </tr>
            @else
                @foreach($data as $key=>$value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->phone }}</td>
                        <td class="d-flex" style="grid-gap:1rem">
                            <div class="actions">
                                <a href="{{ route('create-data.appointments' , $value->id) }}"  class="btn btn-sm bg-success-light">
                                    Thêm cuộc hẹn
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

</div>
