<div>
    @if(isset($dataFilterService))
        @dd($dataFilterService)
    @endif
    <div class="card-body px-0">
        <div class="table-responsive">
            <table class="datatable table table-stripped">
                <thead id="thead_table">
                <td>#ID</td>
                @foreach ($colums as $colum=>$name)
                    <td>{{$name}}</td>
                @endforeach
                <td>Trạng thái</td>
                <td>Ngày hẹn</td>
                <td>Thời gian cuộc hẹn</td>
                <td>Hành động</td>
                </thead>
                <tbody id="tbody_table">
                @foreach($data as $key=>$value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->doctor_id }}</td>
                        <td>{{ $value->user_id }}</td>
                        <td>{{ $value->type_pet_id }}</td>
                        <td>{{ $value->service_id }}</td>
                        <td>{!! $value->description !!}</td>
                        <td>
                            @if($value->status == 0)
                                <button class="btn btn-sm bg-info-light">
                                    {{ 'Chờ xác nhận' }}
                                </button>
                            @elseif($value->status == 1)
                                <button class="btn btn-sm bg-success-light">
                                    {{ 'Xác nhận' }}
                                </button>
                            @elseif($value->status == 3)
                                <button class="btn btn-sm bg-danger-light">
                                    {{ 'Hoàn thành' }}
                                </button>
                            @endif
                        </td>
                        <td>{!! $value->date !!}</td>
                        <td>
                                            <span class="text-primary d-block">{{ $value->start_time }}
                                                - {{ $value->end_time }} AM</span>
                        </td>
                        @include('admin.components.button.action-index-status')
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
