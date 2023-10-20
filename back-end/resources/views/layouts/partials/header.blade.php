
<div class="header">

    <div class="header-left">
        <a href="{{ route('dashboard') }}" class="logo">
            <img src="{{asset('backend/assets/img/logo.png')}}" alt="Logo">
        </a>
        <a href="index.html" class="logo logo-small">
            <img src="{{asset('backend/assets/img/logo-small.png')}}" alt="Logo" width="30" height="30">
        </a>
    </div>

    <a href="javascript:void(0);" id="toggle_btn">
        <i class="fe fe-text-align-left"></i>
    </a>
    <div class="top-nav-search">
        <form>
            <input type="text" class="form-control" placeholder="Search here">
            <button class="btn" type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <a class="mobile_btn" id="mobile_btn">
        <i class="fa fa-bars"></i>
    </a>

    {{--thông báo--}}
    @php
        $carts = session()->get('carts',[]);
        $total = 0;
    @endphp
    <ul class="nav user-menu">
        <li class="nav-item dropdown noti-dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <i class="fe fe-cart"></i> <span class="badge badge-pill">{{ count($carts) ?? 0 }}</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">My Carts</span>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        @if(count($carts) > 0)
                            @foreach($carts as $key=>$cart)
                                <div class="cart-item p-3">
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="{{ asset($cart['image']) }}" alt="" width="60">
                                        </div>
                                        <div class="col-9">
                                            <div class="d-flex justify-content-between">
                                                <h6>{{ $cart['name'] }}</h6>
                                                <a href="javascript:void(0)" class="remove-cart btn-remove" data-id="{{ $key }}"><i
                                                        class="fa fa-trash"></i></a>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p>{{ $cart['quantity'] }} x {{ $cart['price'] }}</p>
                                                <p>{{ $cart['quantity'] * $cart['price'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        @else
                            <p class="text-center">No product in cart</p>
                        @endif
                    </ul>
                </div>
                <hr>
                <div class="topnav-dropdown-footer">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('carts.getCarts') }}" class="btn btn-primary text-white mx-2">Cart</a>
                        <a href="#" class="btn btn-primary text-white mx-2">Checkout</a>
                    </div>
                </div>
            </div>

        </li>
        <li class="nav-item dropdown noti-dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <i class="fe fe-bell"></i> <span class="badge rounded-pill">{{ count($notification) }}</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        @foreach($notification as $key=>$value)
                        <li class="notification-message">
                            <a href="#">
                                <div class="notify-block d-flex">
                                    <span class="avatar avatar-sm flex-shrink-0">
                                    <img class="avatar-img rounded-circle" alt="Image" src="{{ $value->image }}">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title"></span>{{ $value->message }}</p>
                                        <p class="noti-time"><span class="notification-time">{{ $value->created_at }}</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                        <li id="notification-container"></li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="#">View all Notifications</a>
                </div>
            </div>
        </li>


        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img"><img class="rounded-circle" src="{{ asset('backend/assets/img/profiles/avatar-01.jpg') }}" width="31" alt="Ryan Taylor"></span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                        <h6>{{ Auth::user()->name }}</h6>
                        <p class="text-muted mb-0">Administrator</p>
                    </div>
                </div>
                <a class="dropdown-item" href="profile.html">My Profile</a>
                <a class="dropdown-item" href="settings.html">Settings</a>
                <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
            </div>
        </li>

    </ul>

</div>
@push('script')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        var pusher = new Pusher('2798806e868dbe640e2e', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('user-notification-3');
        channel.bind('notification-event', function(data) {

            let notification = `
                <li class="notification-message">
                    <a href="#">
                        <div class="notify-block d-flex">
                            <span class="avatar avatar-sm flex-shrink-0">
                                <img class="avatar-img rounded-circle" alt="User Image" src="assets/img/doctors/doctor-thumb-01.jpg">
                            </span>
                            <div class="media-body flex-grow-1">
                                <p class="noti-details">${data.message}</p>
                                <p class="noti-time"><span class="notification-time">${data.now}</span></p>
                            </div>
                        </div>
                    </a>
                </li>
    `;
            let currentNotificationCount = parseInt($('.badge.rounded-pill').text());
            currentNotificationCount++;
            $('.badge.rounded-pill').text(currentNotificationCount);
            // Thêm thông báo mới vào giao diện
            $('#notification-container').append(notification);
        });
    </script>
@endpush
