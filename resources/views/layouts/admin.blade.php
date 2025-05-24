@extends('adminlte::page')

@section('title', 'Admin Panel')

@section('content_header')
    @yield('page_header')
@stop
@section('css')
    @stack('styles')
@stop

@section('js')
    @stack('scripts')
@stop

@section('content')
@if(session('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-ban"></i> Error!</h5>
    {{ session('error') }}
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> Éxito!</h5>
    {{ session('success') }}
</div>
@endif
    <!-- Contenido principal dinámico -->
    @yield('main_content')
@stop

