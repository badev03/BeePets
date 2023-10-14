
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
    <ul class="nav user-menu">

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
                                        <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
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
                        <img src="{{asset('backend/assets/img/profiles/avatar-01.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
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

        var channel = pusher.subscribe('my-event');
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
                                <p class="noti-time"><span class="notification-time">Just now</span></p>
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
