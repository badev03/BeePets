<div class="modal fade" id="viewer" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xem {{ $title_web }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="mb-3">
                                <label class="mb-2">Tên dịch vụ</label>
                                <input type="text" class="form-control" id="name" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="mb-3">
                                <label class="mb-2">Slug</label>
                                <input type="text" class="form-control" id="slug" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="mb-3">
                                <label class="mb-2">Mô tả</label>
                                <input type="text" class="form-control" id='description' disabled>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="mb-3">
                                <label class="mb-2">Image</label>
                                <img id="image" src="" alt="" class="object-fit-contain" style="width: 100%; height: 200px">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>


