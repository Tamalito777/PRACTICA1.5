@props([
    'equipo'
])

<button type="button" class="ModalAbrir" onclick="document.getElementById('ModalReservar-{{ $equipo->id }}').showModal()">
    Reservar
</button>

<dialog id="ModalReservar-{{ $equipo->id }}" class="ModalPersonalizar">
    <form action="{{ route('reservaciones.create') }}" method="post">
        @csrf
        <input type="hidden" name="equipo_id" value="{{ $equipo->id }}">

        <div class="ModalAbierto">
            <h2>Reservar {{ $equipo->nombre }}</h2>
            <button type="button" class="btn-cerrar" onclick="document.getElementById('ModalReservar-{{ $equipo->id }}').close()">X</button>
        </div>

        <div class="ModalBody">
            <div class="mb-3">
                <label class="ModalTexto">Fecha y hora de inicio</label>
                <input type="datetime-local" name="fecha_inicio" class="ModalInput" required>
                @error('fecha_inicio')
                    <div class="MensajeError"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="ModalTexto">Fecha y hora de fin (opcional)</label>
                <input type="datetime-local" name="fecha_fin" class="ModalInput">
                @error('fecha_fin')
                    <div class="MensajeError"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="acciones-modal">
                <button type="button" class="BotonEliminarNo" onclick="document.getElementById('ModalReservar-{{ $equipo->id }}').close()">Cancelar</button>
                <button type="submit" class="BotonGuardar">Confirmar Reserva</button>
            </div>
        </div>
    </form>
</dialog>