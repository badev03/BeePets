@extends('layouts.partials.master')
@section('title','hahaha')
@push('style')
    @livewireStyles
    <link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">
@endpush
@section('heading','hihihi')
@section('content')
    <div class="row">
            @include('admin.components.errors.errors')
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <h4 class="card-title">Danh sách {{ $title_web }}</h4>
                            <div class='d-flex flex-wrap'>
                                <a href="{{ route($urlbase.'create') }}" class="btn btn-sm bg-danger-light me-3 d-flex align-items-center">Hàng đợi là <span class="ms-2">{{ $count_queue }}</span></a>
                            </div>
                        </div>
                    </div>
                    <livewire:notification-fillter />
            </div>
        </div>
    </div>
@endsection
@push('script')
    @livewireScripts
    <script src="{{asset('backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/datatables/datatables.min.js')}}"></script>
@endpush
