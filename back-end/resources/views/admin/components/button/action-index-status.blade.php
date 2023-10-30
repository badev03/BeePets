<td class="d-flex" style="grid-gap:1rem">
    <div class="actions">
        @if($value->date < date('Y-m-d'))
            <a class="btn btn-sm bg-success-light" href="#">
                <svg fill="#26af48" width="16px" height="10px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg" stroke="#26af48"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M1599.04 1523.627 396.373 320.96C546.88 188.053 743.787 106.667 960 106.667c470.507 0 853.333 382.826 853.333 853.333 0 216.107-81.386 413.12-214.293 563.627M106.667 960c0-216.213 81.28-413.12 214.293-563.627L1523.627 1599.04c-150.507 132.907-347.52 214.293-563.627 214.293-470.507 0-853.333-382.826-853.333-853.333M960 0C429.76 0 0 429.76 0 960s429.76 960 960 960c530.133 0 960-429.76 960-960S1490.133 0 960 0" fill-rule="evenodd"></path> </g></svg>
                </i> No Edit
            </a>
        @elseif( date('Y-m-d') >= $value->date)
            <a class="btn btn-sm bg-danger-light" href="#finished_{{ $value->id }}" data-bs-toggle="modal">
                <svg fill="#e63c3c" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" xml:space="preserve" width="19px" height="19px"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:none;} </style> <path d="M19.3,5.3L9,15.6l-4.3-4.3l-1.4,1.4l5,5L9,18.4l0.7-0.7l11-11L19.3,5.3z"></path> <rect class="st0" width="24" height="24"></rect> </g></svg>
                </i> Hoàn thành
            </a>
        @else
            @can('edit-'.$permission_crud)
                <a class="btn btn-sm bg-success-light" href="{{ route($urlbase . 'edit', $value->id) }}">
                    <i class="fe fe-pencil"></i> Edit
                </a>
            @endcan
        @endif
        @can('delete-'.$permission_crud)
            <a data-bs-toggle="modal" data-delete="{{ $value->id }}" href="#delete_modal_{{ $value->id }}" class="delete_data btn btn-sm bg-danger-light">
                <i class="fe fe-trash"></i> Delete
            </a>
        @endcan
    </div>
</td>

@if(count($data)>0)
    <div class="modal fade" id="delete_modal_{{ $value->id }}" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-content p-2 text-center">
                        <h4 class="modal-title">Delete</h4>
                        <p class="mb-4">Bạn có chắc chắn muốn xóa</p>
                        <div class="d-flex justify-content-center" style="gap: 1rem">
                            <form action="{{ route($urlbase . 'destroy', $value->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button class="btn bg-success-light"
                                        type="submit">Xóa
                                </button>
                            </form>
                            <button type="button" class="btn bg-danger-light" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endif


@if(count($data)>0)
    <div class="modal fade" id="finished_{{ $value->id }}" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-content p-2 text-center">
                        <h4 class="modal-title">Xác nhận hoàn thành</h4>
                        <p class="mb-4">Bạn có chắc chắn muốn xác nhận đã hoàn thành không</p>
                        <div class="d-flex justify-content-center" style="gap: 1rem">
                            <form action="{{ route($urlbase . 'destroy', $value->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button class="btn bg-success-light"
                                        type="submit">Xác Nhận
                                </button>
                            </form>
                            <button type="button" class="btn bg-danger-light" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endif

@push('script')
    <script>
        $(document).ready(function () {
            $('.delete_data').click(function () {
                var id = $(this).data('delete');
            })
        })
    </script>
@endpush
