<div class="row mt-3">
    <h6 class="card-title text-danger">Bộ lọc</h6>
    <div class="col-4 mt-3">
        <label class="form-label">Loại thú cưng</label>
        <select class="form-select" name="type_pet_id">
            @foreach($dataTypePet as $key=>$value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4 mt-3">
        <label class="form-label">Chọn bác sĩ</label>
        <select class="form-select doctor_id_index" name="doctor_id">
            @foreach($dataDoctor as $key=>$value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4 mt-3">
        <label class="form-label">Dịch vụ</label>
        <select class="form-select service_id_index" name="service_id">
            @foreach($dataService as $key=>$value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4 mt-3">
        <label class="form-label">Chọn ngày</label>
        <input style="height: 38px" type="date" class="form-control date_filter" id="date_filter">
    </div>
    <div class="col-4 mt-3">
        <label class="form-label">Ca làm việc</label>
        <select class="form-select time_appointments" id="time_appointments" name="time_appointments">
            <option value="Ca 1">Ca 1</option>
            <option value="Ca 2">Ca 2</option>
            <option value="Ca 3">Ca 3</option>
        </select>
    </div>
{{--    <div class="col-4 mt-3">--}}
{{--        <label class="form-label">Tên người dùng</label>--}}
{{--        <input style="height: 38px" id="search_input" name="name" type="text" class="form-control search_input">--}}
{{--    </div>--}}
</div>
<button id="filter_searchName" class="btn me-2 btn-sm bg-success-light mt-3">Lọc dữ liệu</button>
<a href="{{ route($urlbase.'index') }}" class="btn btn-sm bg-danger-light mt-3">Làm mới dữ liệu</a>
<hr class="hr"/>



{{--<div class="row mt-3">--}}
{{--    <h6 class="card-title text-danger">Tìm kiếm tài khoản </h6>--}}
{{--    <div class="col-4 mt-3">--}}
{{--        <label class="form-label">Số điện thoại người dùng</label>--}}
{{--        <input style="height: 38px" id="search_phone" name="phoneSearch" type="text" class="form-control">--}}
{{--    </div>--}}
{{--</div>--}}
{{--<button id="filter_searchPhone" class="btn me-2 btn-sm bg-success-light mt-3">Tìm kiếm</button>--}}
