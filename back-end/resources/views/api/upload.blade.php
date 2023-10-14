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
<form action="{{ route('upload.image') }}" method="POST"  enctype="multipart/form-data">
    @csrf
    <div class="form-check">
        <input class="form-check-input" name="image" type="file"  id="flexCheckDefault">
    </div>
    <input type="submit" value="submit">
</form>

</div>

</body>
</html>
