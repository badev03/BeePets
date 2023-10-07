<td class="d-flex" style="grid-gap:1rem">
    <div class="actions">
        @can('edit-'.$permission_crud)
            <a class="btn btn-sm bg-success-light" href="{{ route($urlbase . 'edit', $value->id) }}">
                <i class="fe fe-pencil"></i> Edit
            </a>
        @endcan
        @can('delete-'.$permission_crud)
            <a data-bs-toggle="modal" data-delete="{{ $value->id }}" href="#delete_modal" class="delete_data btn btn-sm bg-danger-light">
                <i class="fe fe-trash"></i> Delete
            </a>
        @endcan
    </div>
</td>

@if(count($data)>0)
    <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-content p-2">
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

@push('script')

    <script>
        $(document).ready(function () {
            $('.delete_data').click(function () {
                alert(1111)
                var id = $(this).data('delete');
                console.log(1111);
            })
        })
    </script>
@endpush
