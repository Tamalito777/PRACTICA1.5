<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <title>Reservaciones</title>
</head>
<body>
    <x-navbar />

    <div class="TituloPagina">
        <h1>RESERVACIONES</h1>
    </div>

    <x-alerts />

    <div class="ContainerTabla">
        <table class="Tabla1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>USUARIO</th>
                    <th>EQUIPO</th>
                    <th>FECHA INICIO</th>
                    <th>FECHA FIN</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservaciones as $reservacion)
                    <tr>
                        <td>{{ $reservacion->id }}</td>
                        <td>{{ $reservacion->usuario->name ?? 'Usuario' }}</td>
                        <td>{{ $reservacion->equipo->nombre ?? 'Equipo' }}</td>
                        <td>{{ $reservacion->fecha_inicio }}</td>
                        <td>{{ $reservacion->fecha_fin ?? 'No definida' }}</td>
                        <td>{{ $reservacion->estado }}</td>
                        <td>
                            @if ($reservacion->estado === 'activa')
                                <form action="{{ route('reservaciones.cancelar', $reservacion->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="BotonEliminarSi">Cancelar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No hay reservaciones registradas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>