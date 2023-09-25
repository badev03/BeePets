<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>
<body>
<h1>{{ $title }}</h1>

<form action="{{ route($urlbase . 'store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @foreach($colums as $colum => $name)
  
        <div>
            <label for="{{ $colum }}">{{ $name }}</label>
            @if($colum == FIELD_IMAGE)
                <input type="file" name="{{ $colum }}" id="{{ $colum }}">
            @elseif($colum ==FIELD_DESC)
           <textarea name="{{ $colum }}" id="{{ $colum }}" cols="30" rows="10"></textarea>
           @else
           <input type="text" name="{{ $colum }}" id="{{ $colum }}">
            @endif
           
        </div>
    @endforeach

    <button type="submit">Save</button>
</form>
</body>
</html>
