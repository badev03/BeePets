
<div class="header">

    <div class="header-left">
        <a href="{{ route('dashboard') }}" class="logo">
            <img src="https://res.cloudinary.com/dgr1k5tf5/image/upload/v1697884317/tgaqy9cgyffuneqzysjb.png" alt="Logo">
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
{{--    @php--}}
{{--        $carts = session()->get('carts',[]);--}}
{{--        $total = 0;--}}
{{--    @endphp--}}
    <ul class="nav user-menu">
{{--        <li class="nav-item dropdown noti-dropdown">--}}
{{--            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">--}}
{{--                <i class="fe fe-cart"></i> <span class="badge badge-pill">{{ count($carts) ?? 0 }}</span>--}}
{{--            </a>--}}
{{--            <div class="dropdown-menu notifications">--}}
{{--                <div class="topnav-dropdown-header">--}}
{{--                    <span class="notification-title">My Carts</span>--}}
{{--                </div>--}}
{{--                <div class="noti-content">--}}
{{--                    <ul class="notification-list">--}}
{{--                        @if(count($carts) > 0)--}}
{{--                            @foreach($carts as $key=>$cart)--}}
{{--                                <div class="cart-item p-3">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-3">--}}
{{--                                            <img src="{{ asset($cart['image']) }}" alt="" width="60">--}}
{{--                                        </div>--}}
{{--                                        <div class="col-9">--}}
{{--                                            <div class="d-flex justify-content-between">--}}
{{--                                                <h6>{{ $cart['name'] }}</h6>--}}
{{--                                                <a href="javascript:void(0)" class="remove-cart btn-remove" data-id="{{ $key }}"><i--}}
{{--                                                        class="fa fa-trash"></i></a>--}}
{{--                                            </div>--}}
{{--                                            <div class="d-flex justify-content-between">--}}
{{--                                                <p>{{ $cart['quantity'] }} x {{ $cart['price'] }}</p>--}}
{{--                                                <p>{{ $cart['quantity'] * $cart['price'] }}</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}

{{--                        @else--}}
{{--                            <p class="text-center">No product in cart</p>--}}
{{--                        @endif--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--                <hr>--}}
{{--                <div class="topnav-dropdown-footer">--}}
{{--                    <div class="d-flex justify-content-center">--}}
{{--                        <a href="{{ route('carts.getCarts') }}" class="btn btn-primary text-white mx-2">Cart</a>--}}
{{--                        <a href="{{ route('order.index') }}" class="btn btn-primary text-white mx-2">Checkout</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </li>--}}
        <li class="nav-item dropdown noti-dropdown" id="noti_update">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <i class="fe fe-bell" id="hehe-noti"></i> <span class="badge rounded-pill">{{ $unreadNotificationCount }}</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Thông báo</span>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        <li id="notification-container"></li>
                        @foreach($notification as $key=>$value)
                            <li class="notification-message" id="noti-page">
                                <a href="#">
                                    <div class="notify-block d-flex">
                                    <span class="avatar avatar-sm flex-shrink-0">
                                    <img class="avatar-img rounded-circle" alt="Image" src="{{ $value->avatar }}">
                                    </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title"></span>{{ $value->message_admin }}</p>
                                            <p class="noti-time d-flex justify-content-center align-items-center">
                                                <span class="notification-time">{{ $value->created_at }}</span>
                                                <a href="{{ route('appointment.show' , $value->appointment_id) }}">xem chi tiết</a>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </li>


        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img"><img class="rounded-circle" src="{{ auth()->user()->avatar }}" width="31" alt="{{ auth()->user()->name }}"></span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header align-items-center">
                    <div class="avatar avatar-sm">
                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                        <h6>{{ Auth::user()->name }}</h6>
                    </div>
                </div>
                <a class="dropdown-item" href="{{ route('myProfile') }}">Hồ sơ</a>
                <a class="dropdown-item" href="{{ route('setting') }}">Cài đặt</a>
                <a class="dropdown-item" href="{{ route('admin.logout') }}">Đăng xuất</a>
            </div>
        </li>

    </ul>

</div>
@push('script')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        var pusher = new Pusher('59deaefaec6129103d3d', {
            cluster: 'ap1'
        });
        let currentTime = new Date();

        // Định dạng thời gian hiện tại (ví dụ: "DD-MM-YYYY HH:MM:SS")
        let formattedTime = `${currentTime.getDate()}-${currentTime.getMonth() + 1}-${currentTime.getFullYear()} ${currentTime.getHours()}:${currentTime.getMinutes()}:${currentTime.getSeconds()}`;
        var channel = pusher.subscribe('admin-notification');
        channel.bind('notification-event-admin', function(data) {
        console.log(data);
            let route = "{{ route('appointment.show', ':id') }}";
            route = route.replace(':id', data.appointment_id);
            let notification = `
                <li class="notification-message">
                    <a href="#">
                        <div class="notify-block d-flex">
                            <span class="avatar avatar-sm flex-shrink-0">
                                <img class="avatar-img rounded-circle" alt="User Image" src="${data.avatar}">
                            </span>
                            <div class="media-body flex-grow-1">
                                <p class="noti-details">${data.message}</p>
                                            <p class="noti-time d-flex justify-content-center align-items-center">
                                                <span class="notification-time">${formattedTime}</span>
                                                <a href="${route}">xem chi tiết</a>
                                            </p>
                            </div>
                        </div>
                    </a>
                </li>
    `;
            let currentNotificationCount = parseInt($('.badge.rounded-pill').text());
            currentNotificationCount++;
            $('.badge.rounded-pill').text(currentNotificationCount);
            // Thêm thông báo mới vào giao diện
            $('#notification-container').prepend(notification);
        });
    </script>
    <script>
        $('#noti_update').click(function () {
            $('.badge.rounded-pill').remove();
            var newData = '<span class="badge rounded-pill">0</span>';
            $('#hehe-noti').append(newData);
            $.ajax({
                type:'PUT',
                url: '{{ route('notification.update') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log(data)
                },
                error: function (error) {

                }
            })
        });

        let page = 1;
        let isLoading = false;
        $('.noti-content').on('scroll', function () {
            if (!isLoading && $(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight - 200) {
                fetchNotifications();

            }
        });
        function fetchNotifications() {
            if (isLoading) return;
            let route = '{{ route('notification.new') }}';
            isLoading = true;
            let routes = "{{ route('appointment.show', ':id') }}";
            $.ajax({
                url: route + '?page=' + page,
                method: 'GET',
                data: { page: page },
                success: function (response) {
                    console.log(response);
                    if (response && response.data && response.data.length > 0) {
                        response.data.forEach(function (notification) {
                            routes = routes.replace(':id', notification.appointment_id);
                            let notificationHTML = `<a href="#">
                            <div class="notify-block d-flex">
                                <span class="avatar avatar-sm flex-shrink-0">
                                    <img class="avatar-img rounded-circle" alt="Image" src="${notification.avatar}">
                                </span>
                                <div class="media-body flex-grow-1">
                                    <p class="noti-details">
                                        <span class="noti-title"></span>${notification.message_admin}
                                    </p>
                                    <p class="noti-time d-flex justify-content-center align-items-center">
                                        <span class="notification-time">${notification.formatted_created_at}</span>
                                        <a href="${routes}">xem chi tiết</a>
                                    </p>
                                </div>
                            </div>
                        </a>`;
                            $('#noti-page').append(notificationHTML);
                        });
                        page++;
                        isLoading = false;
                    }
                    else {
                        // Không có dữ liệu mới
                        $(window).off('scroll'); // Tắt sự kiện scroll
                    }
                },
                complete: function () {
                    isLoading = false;
                }
            });
        }

        // Gắn sự kiện scroll vào #notification-list
        $('#noti-page').empty();
        setTimeout(function() {
            fetchNotifications();
        }, 100);
        // Bắt đầu tải dữ liệu thông báo ban đầu khi trang được load
    </script>
@endpush
