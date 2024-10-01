@extends('layouts.base')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/login/css/login.css') }}">   
@endsection

@section('title','Crear cuenta')

@section('content')

<form method="POST" class="form" action="{{ route('register') }}" novalidate>
    @csrf
    <h2>Crear cuenta</h2>
    <div class="content-login">
        <div class="input-content">
            <input type="text" name="full_name" placeholder="Nombre completo"
                value="{{ old('full_name') }}" 
                autofocus>
            @error('full_name')
            <span class="text-danger">
                <span>{{ $message }}</span>
            </span>
            @enderror

        </div>

        <div class="input-content">
            <input type="text" name="email" placeholder="Correo eléctronico"
                value="{{ old('email') }}" 
                autofocus>

            @error('email')
            <span class="text-danger">
                <span>{{ $message }}</span>
            </span>
            @enderror    

        </div>

        <div class="input-content">
            <input type="password" name="password" placeholder="Contraseña">

            @error('password')
            <span class="text-danger">
                <span>{{ $message }}</span>
            </span>
            @enderror

        </div>

        <div class="input-content">
            <input type="password" name="password_confirmation" placeholder="Confirmar contraseña">
        </div>
    </div>

    <input type="submit" value="Registrarse" class="button">
    <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="link">Iniciar sesión</a></p>
</form>

@endsection
