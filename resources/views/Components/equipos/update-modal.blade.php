@props([
    'equipo'
])

<button type="button" class="ModalAbrir" onclick="document.getElementById('ModalUpdateEquipo-{{ $equipo->id }}').showModal()">
    Actualizar
</button>

<dialog id="ModalUpdateEquipo-{{ $equipo->id }}" class="ModalPersonalizar">
    <form action="{{ route('equipos.update', $equipo->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="ModalAbierto">
            <h2>Actualizar Equipo</h2>
            <button type="button" class="btn-cerrar" onclick="document.getElementById('ModalUpdateEquipo-{{ $equipo->id }}').close()">X</button>
        </div>

        <div class="ModalBody">
            <div class="mb-3">
                <label class="ModalTexto">Código</label>
                <input type="text" name="codigo" class="ModalInput" value="{{ $equipo->codigo }}">
                @error('codigo')
                    <div class="MensajeError"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="ModalTexto">Nombre del equipo</label>
                <input type="text" name="nombre" class="ModalInput" value="{{ $equipo->nombre }}">
                @error('nombre')
                    <div class="MensajeError"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="ModalTexto">Especificaciones</label>
                <input type="text" name="especificaciones" class="ModalInput" value="{{ $equipo->especificaciones }}">
                @error('especificaciones')
                    <div class="MensajeError"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="ModalTexto">Estado</label>
                <select name="estado" class="ModalInput">
                    <option value="disponible" {{ $equipo->estado === 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="reservado" {{ $equipo->estado === 'reservado' ? 'selected' : '' }}>Reservado</option>
                    <option value="mantenimiento" {{ $equipo->estado === 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                </select>
                @error('estado')
                    <div class="MensajeError"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="acciones-modal">
                <button type="submit" class="BotonGuardar">Guardar</button>
            </div>
        </div>
    </form>
</dialog>