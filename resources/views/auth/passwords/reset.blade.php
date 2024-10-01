@extends()

@section('styles')
@endsection

@section('content')

<form method="POST" class="form" action="#">
    @csrf
    
    <input type="hidden" name="token" value="{{ $token }}">

    <h2 class="reset-title">Crear contraseña</h2>

    <div class="content-reset">
        <input class="form-email" id="email" type="email" name="email" placeholder="Ingrese el correo electrónico" value="" required>

        @error('email')
        <span class="text-danger">
            *{{ $message }}
        </span>
        @enderror
    </div>

    <div class="content-reset">
        <input class="form-password" id="password" type="password" name="password" placeholder="Ingrese la nueva contraseña" required>

        @error('password')
        <span class="text-danger">
            *{{ $message }}
        </span>
        @enderror
    </div>

    <div class="content-reset">
        <input class="form-password-confirm" id="password-confirm" type="password" name="password_confirmation"  placeholder="Confirme la contraseña" required>
    </div>

    <input type="submit" value="Enviar" class="button send">

</form>

@endsection