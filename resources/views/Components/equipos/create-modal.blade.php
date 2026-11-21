<button type="button" class="ModalAbrir" onclick="document.getElementById('ModalCreateEquipo').showModal()">
    Registrar Equipo
</button>

<dialog id="ModalCreateEquipo" class="ModalPersonalizar">
    <form action="{{ route('equipos.create') }}" method="post">
        @csrf

        <div class="ModalAbierto">
            <h2>Registrar Equipo</h2>
            <button type="button" class="btn-cerrar" onclick="document.getElementById('ModalCreateEquipo').close()">X</button>
        </div>

        <div class="ModalBody">
            <div class="mb-3">
                <label class="ModalTexto">Código</label>
                <input type="text" name="codigo" class="ModalInput" value="{{ old('codigo') }}">
                @error('codigo')
                    <div class="MensajeError"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="ModalTexto">Nombre del equipo</label>
                <input type="text" name="nombre" class="ModalInput" value="{{ old('nombre') }}">
                @error('nombre')
                    <div class="MensajeError"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="ModalTexto">Especificaciones</label>
                <input type="text" name="especificaciones" class="ModalInput" value="{{ old('especificaciones') }}">
                @error('especificaciones')
                    <div class="MensajeError"><small>{{ $message }}</small></div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="ModalTexto">Estado</label>
                <select name="estado" class="ModalInput">
                    <option value="disponible" selected>Disponible</option>
                    <option value="reservado">Reservado</option>
                    <option value="mantenimiento">Mantenimiento</option>
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