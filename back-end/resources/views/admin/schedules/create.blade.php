@extends('layouts.partials.master')
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3>
                                Thêm lịch làm việc
                            </h3>
                        </div>
                        <div class="col">
                            <a class="btn btn-sm btn-primary float-end" href="{{ route('schedules.index') }}">Quay lại</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <form action="{{ route('schedules.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="values">Bác sĩ</label>
                                    <select class="form-control values select_size" id="values" multiple="multiple"
                                        name="doctor_id">
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>
                            <div class="col"></div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="values">Thời gian mỗi ca</label>
                                

                                    <input type="time" name="slot_time" id="time" class="form-control select_size"
                                        required>
                                </div>

                            </div>
                        </div>
                        @csrf

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label" for="values">Chọn ngày</label>
                                <input type="date" name="date" class="form-control select_size" required>
                            </div>

                            <div class="col">
                                <label class="form-label" for="values">Thời gian bắt đầu</label>

                                <input type="time" name="start_time" id="time" class="form-control select_size"
                                    required>
                            </div>
                            <div class="col">
                                <label class="form-label" for="values">Thời gian kết thúc</label>
                                <input type="time" name="end_time"  class="form-control select_size"
                                    required>




                            </div>

                        </div>


                    



                        <div class="col">

                        </div>
                </div>
                <button type="submit" class="btn btn-success">Thêm </button>
                </form>
            </div>
        </div>
    </div>

    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("select.select_size").select2({
                tags: true,
                tokenSeparators: [',', ' '],
            }).on('select2:selecting', function(e) {});
        });
    </script>

    <script>
        function selectAllCheckboxes(checkboxId) {
            // Lấy tất cả các dòng
            var rows = document.querySelectorAll('.row');

            // Lặp qua danh sách các dòng
            for (var i = 0; i < rows.length; i++) {
                // Trong mỗi dòng, lấy tất cả các ô input checkbox
                var checkboxes = rows[i].querySelectorAll('input[type="checkbox"]');

                // Lặp qua danh sách các checkbox và kiểm tra id của mỗi checkbox
                for (var j = 0; j < checkboxes.length; j++) {
                    if (checkboxes[j].id === checkboxId) {
                        // Nếu id của checkbox khớp với id của label được chọn
                        // thì đặt trạng thái checked cho checkbox này
                        checkboxes[j].checked = true;
                    }
                }
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addButton = document.getElementById('addDay');
            const form = document.querySelector('form');
            const dayRow = document.querySelector('.row.mb-3');

            addButton.addEventListener('click', function() {
                const clone = dayRow.cloneNode(true);
                form.insertBefore(clone, addButton);
            });
        });
    </script>
@endpush
