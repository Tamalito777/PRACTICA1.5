<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <title>Inicio - Equipos de Cómputo</title>
</head>
<body>
    <x-navbar />

    <div class="TituloPagina">
        <h1>SISTEMA DE RESERVACIÓN DE EQUIPOS DE CÓMPUTO</h1>
    </div>

    <x-alerts />

    <div class="ContainerHome">
        <p>Usuario: <strong>{{ $usuario->name }}</strong></p>
        <p>Rol: <strong>{{ $usuario->rol }}</strong></p>
    </div>

    @if ($usuario->rol === 'administrador')
        <div class="ContainerAccion">
            <x-equipos.create-modal />
        </div>
    @endif

    <div class="ContainerTabla">
        <table class="Tabla1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CÓDIGO</th>
                    <th>NOMBRE</th>
                    <th>ESPECIFICACIONES</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($equipos as $equipo)
                    <tr>
                        <td>{{ $equipo->id }}</td>
                        <td>{{ $equipo->codigo }}</td>
                        <td>{{ $equipo->nombre }}</td>
                        <td>{{ $equipo->especificaciones ?? 'Sin especificaciones' }}</td>
                        <td>{{ $equipo->estado }}</td>
                        <td>
                            @if ($equipo->estado === 'disponible')
                                <x-reservaciones.reservar-modal :equipo="$equipo" />
                            @endif

                            @if ($usuario->rol === 'administrador')
                                <x-equipos.update-modal :equipo="$equipo" />
                                <x-equipos.delete-modal :equipo="$equipo" />
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No hay equipos disponibles para mostrar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>