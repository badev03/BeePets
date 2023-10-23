<div class="modal fade" id="viewer{{$value->id}}" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông báo cho <h5 class="text-danger mb-0 ms-2">{{ $value->name }}</h5> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('notifications.send-notifications-user') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="mb-3">
                                <label class="mb-2">Nội dung</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="col-4 btn btn-primary w-100">Gửi thông báo</button>
                </form>
            </div>
        </div>
    </div>
</div>
