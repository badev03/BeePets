<div class="modal fade" id="viewer" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Danh sách {{ $title_web }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="mb-3">
                                <label class="mb-2">Name</label>
                                <input type="text" id="name" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="mb-3">
                                <label class="mb-2">Slug</label>
                                <input type="text" id="slug" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="mb-3">
                                <label class="mb-2">Mô tả</label>
                                <input type="text" id="description" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="mb-3">
                                <label class="mb-2">Image</label>
                                <img src="" id="image" style="width: 100%; object-fit: none">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đóng</button>
                </form>
            </div>
        </div>
    </div>
</div>
