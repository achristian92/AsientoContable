@extends('layouts.auth.app')
@section('title','Iniciar sesión')
@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input type="text"
                   class="form-control"
                   name="email"
                   placeholder="Correo"
                   value="{{ old('email') }}"
                   required autofocus>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <div class="form-group d-flex justify-content-between">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input"  id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Recordar</label>
            </div>
            <a href="{{ route('password.request') }}">Restablecer contraseña</a>
        </div>
        <button class="btn btn-primary btn-block">Ingresar</button>
        <hr>
        <p class="text-muted">No tienes cuenta?</p>
        <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">Regístrate ahora!</a>
    </form>
@endsection
