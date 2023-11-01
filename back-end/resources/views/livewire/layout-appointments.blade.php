<div>
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
        <livewire:filter-service :dataService="$dataService"/>

        <div class="col-4 mt-3">
            <label class="form-label">Chọn ngày</label>
            <input style="height: 38px" type="date" class="form-control" id="date_filter">
        </div>
        <div class="col-4 mt-3">
            <label class="form-label">Ca làm việc</label>
            <select class="form-select" id="time_appointments" name="time_appointments">
                <option value="Ca 1">Ca 1</option>
                <option value="Ca 2">Ca 2</option>
                <option value="Ca 3">Ca 3</option>
            </select>
        </div>
        <div class="col-4 mt-3">
            <label class="form-label">Tên người dùng</label>
            <input style="height: 38px" id="search_input" name="name" type="text" class="form-control">
        </div>
    </div>
    <button id="filter_searchName" class="btn me-2 btn-sm bg-success-light mt-3">Filter</button>
    <a href="{{ route($urlbase.'index') }}" class="btn btn-sm bg-danger-light mt-3">Clear Filter</a>
    <hr class="hr"/>

    <h6 class="card-title text-danger">Bộ lọc ngày</h6>
    <div class="row">
        <div class="col-4 mt-3">
            <label class="form-label">Ca sắp tới</label>
            <select class="form-select" name="type_pet_id">
                @foreach($dataTypePet as $key=>$value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if(isset($dataFilterService))
     @dd($dataFilterService)
    @endif
    <livewire:render-appointments :dataFilterService="$dataFilterService"></livewire:render-appointments>
</div>
