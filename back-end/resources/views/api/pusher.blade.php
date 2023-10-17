<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 8 Phone Number OTP Auth Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<div class="container mt-5" style="max-width: 550px">
    <div id="notification-container-view">

    </div>
</div>
</body>
<script src="{{asset('backend/assets/js/jquery-3.7.0.min.js')}}"></script>
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
                                <p class="noti-details">${data}</p>
                                <p class="noti-time"><span class="notification-time">Just now</span></p>
                            </div>
                        </div>
                    </a>
                </li>
    `;
        $('#notification-container-view').append(notification);
    });
</script>
</html>
