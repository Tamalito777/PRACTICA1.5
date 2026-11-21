<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="ContainerLogin">
        <div class="TituloPagina">
            <h1>Iniciar Sesión</h1>
        </div>

        <x-alerts />

        <form action="{{ route('iniciarsesion') }}" method="post" class="FormLogin">
            @csrf

            <div class="mb-3">
                <label class="ModalTexto">Correo electrónico</label>
                <input type="email" name="email" class="ModalInput" value="{{ old('email') }}">
                @error('email')
                    <div class="MensajeError"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="ModalTexto">Contraseña</label>
                <input type="password" name="password" class="ModalInput">
                @error('password')
                    <div class="MensajeError"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="acciones-modal">
                <button type="submit" class="BotonGuardar">Entrar</button>
            </div>
        </form>
    </div>
</body>
</html>