@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('title', 'Acceso al panel')

@section('auth_header', 'Iniciar sesión en el panel de administración')

@section('auth_body')
    <form action="{{ route('login') }}" method="POST">
        @csrf

        <x-adminlte-input name="email" label="Correo electrónico" type="email" placeholder="ejemplo@correo.com" required autofocus style="border-right: 1px solid #ced4da !important" />

        <x-adminlte-input name="password" label="Contraseña" type="password" placeholder="••••••••" required style="border-right: 1px solid #ced4da !important" />

        {{-- Checkbox "Recuérdame" --}}
        <div class="mb-3">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label" for="remember">Recuérdame</label>
            </div>
        </div>

        <x-adminlte-button class="btn-block mt-2" type="submit" theme="primary" label="Entrar" />
    </form>
@endsection

@section('auth_footer')
@endsection
