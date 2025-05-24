@extends('layouts.admin')

@section('page_header')
    <h1>{{ $title ?? 'Dashboard' }}</h1>
@stop

@section('main_content')
    <div class="container-fluid">
        <p>{{ $content ?? 'Default content 222' }}</p>
    </div>
@stop

@push('scripts')
    <script>
        console.log('Dashboard loaded');
    </script>
@endpush