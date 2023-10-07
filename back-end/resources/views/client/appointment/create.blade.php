@extends('client.app')

@section('content')
        Bác sĩ
    @foreach ($doctor as $doctor)
        <span>
            {{ $doctor->name }}
        </span>
    @endforeach

@endsection