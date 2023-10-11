<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 8 Phone Number OTP Auth Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5" style="max-width: 550px">

    <div class="alert alert-danger" id="error" style="display: none;"></div>

    <h3>Add Phone Number</h3>

    <div class="alert alert-success" id="successAuth" style="display: none;"></div>

    <form>
        <label>Phone Number:</label>

        <input type="text" id="number" class="form-control" placeholder="+91 ********">

        <div id="recaptcha-container"></div>

        <button type="button" class="btn btn-primary mt-3" onclick="sendOTP();">Send OTP</button>
    </form>


    <div class="mb-5 mt-5">
        <h3>Add verification code</h3>

        <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>

        <form>
            <input type="text" id="verification" class="form-control" placeholder="Verification code">
            <button type="button" class="btn btn-danger mt-3" onclick="verify()">Verify code</button>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>


<script>
    var firebaseConfig = {
        apiKey: "AIzaSyAy-p7LI0CaVFvG57Ppy9K6o5y_w00TgFw",
        authDomain: "laraveltest-607f2.firebaseapp.com",
        projectId: "laraveltest-607f2",
        storageBucket: "laraveltest-607f2.appspot.com",
        messagingSenderId: "1043415196689",
        appId: "1:1043415196689:web:b49dbe270025b7739cfdb0",
        measurementId: "G-M6N42QBZTW"
    };
    firebase.initializeApp(firebaseConfig);
</script>
<script type="text/javascript">
    window.onload = function () {
        render();
    };

    function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }

    function sendOTP() {
        var number = $("#number").val();

        $.ajax({
            url: '{{ route('check-phone') }}',
            type: 'POST',
            data: { phone: number },
            success: function (response) {
                console.log(response.exists)
                if (!response.exists) {
                    firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
                        window.confirmationResult = confirmationResult;
                        coderesult = confirmationResult;
                        console.log(coderesult);
                        $("#successAuth").text("Message sent");
                        $("#successAuth").show();
                    }).catch(function (error) {
                        $("#error").text(error.message);
                        $("#error").show();
                    });
                } else {
                    console.log(response)
                    $("#error").text(response.msg);
                    $("#error").show();
                }
            },
            error: function (error) {
               // console.log(error);
            }
        });
    }

    function verify() {
        var code = $("#verification").val();
        var number = '0981608298';
        coderesult.confirm(code).then(function (result) {
            $.ajax({
                url: '{{ route('check-verify') }}',
                type: 'POST',
                data: { phone: number },
                success: function (response) {
                    console.log(response.users);
                },
                error: function (error) {
                    $("#error").text("Có lỗi xảy ra khi kiểm tra số điện thoại.");
                    $("#error").show();
                }
            });
        }).catch(function (error) {
            $("#error").text(error.message);
            $("#error").show();
        });
    }
</script>
</body>

</html>
