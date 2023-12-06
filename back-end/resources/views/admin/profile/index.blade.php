
@extends('layouts.partials.master')
@push('style')
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
@endpush
@section('content')
    <div class="row">
        @if(session()->has('success'))
        <div class="alert-success alert">
            {{ session('success') }}
        </div>
    @endif
        <div class="col-md-12">
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-auto profile-image">
                        <a href="#">
                            <img class="rounded-circle" alt="{{$user->avatar?:'chưa cập nhật'}}"  src="{{$user->avatar}}">
                        </a>
                    </div>
                    <div class="col ml-md-n2 profile-user-info">
                        <h4 class="user-name mb-0">{{$user->name}}</h4>

                        <div class="user-Location"><i class="fa-solid fa-location-dot"></i>{{$user->address?:' Chưa cập nhật...'}}</div>


                        <div class="about-text">{{$user->description?:' Chưa cập nhật...'}}</div>

                    </div>
                </div>
            </div>
            <div class="profile-menu">
                <ul class="nav nav-tabs nav-tabs-solid">
                    <li class="nav-item">
                        <a class="nav-link active"
                            data-bs-toggle="tab" href="#per_details_tab">Về Tôi</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content profile-tab-cont">

                <div class="tab-pane fade show active" id="per_details_tab">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title d-flex justify-content-between">
                                        <span>Thông tin chi tiết</span>
                                    </h5>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted">Name</p>
                                        <p class="col-sm-10">{{$user->name ?: 'Chưa cập nhật...'}}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted">Date of Birth</p>
                                        <p class="col-sm-10">{{$user->birthday ?: 'Chưa cập nhật...'}}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted">Email ID</p>
                                        <p class="col-sm-10">{{$user->email ?: 'Chưa cập nhật...'}}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted">Mobile</p>
                                        <p class="col-sm-10">{{$user->phone ?: 'Chưa cập nhật...'}}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted">Address</p>
                                        <p class="col-sm-10 mb-0">{{$user->address ?: 'Chưa cập nhật...'}}<br></p>
                                    </div>
                                </div>

                            </div>

                            <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Personal Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="mb-2">First Name</label>
                                                            <input type="text" class="form-control" value="John">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="mb-2">Last Name</label>
                                                            <input type="text" class="form-control" value="Doe">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="mb-2">Date of Birth</label>
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control datetimepicker"
                                                                    value="24-07-1983">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="mb-2">Email ID</label>
                                                            <input type="email" class="form-control"
                                                                value="johndoe@example.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="mb-2">Mobile</label>
                                                            <input type="text" value="+1 202-555-0125"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <h5 class="form-title"><span>Address</span></h5>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="mb-2">Address</label>
                                                            <input type="text" class="form-control"
                                                                value="4663 Agriculture Lane">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="mb-2">City</label>
                                                            <input type="text" class="form-control" value="Miami">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="mb-2">State</label>
                                                            <input type="text" class="form-control" value="Florida">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="mb-2">Zip Code</label>
                                                            <input type="text" class="form-control" value="22434">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="mb-3">
                                                            <label class="mb-2">Country</label>
                                                            <input type="text" class="form-control"
                                                                value="United States">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div id="password_tab" class="tab-pane fade">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Thay đổi mật khẩu</h5>
                            <div class="row">
                                <div class="col-md-10 col-lg-6">
                                    <form action="{{route('myProfile.changePassword')}}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="mb-2">Mật khẩu cũ</label>
                                            <input type="password" class="form-control" name="old_password">
                                            @error('old_password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-2">Mật khẩu mới</label>
                                            <input type="password" class="form-control" name="new_password">
                                            @error('new_password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-2">Nhập lại mật khẩu</label>
                                            <input type="password" class="form-control" name="new_password_confirmation">
                                            @error('new_password_confirmation')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <button class="btn btn-primary" type="submit">Lưu lại</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')

    <script src="{{asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/datatables/datatables.min.js')}}"></script>

@endpush






