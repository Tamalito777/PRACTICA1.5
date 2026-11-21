@props([
    'equipo'
])

<button type="button" class="ModalAbrir" onclick="document.getElementById('ModalDeleteEquipo-{{ $equipo->id }}').showModal()">
    Eliminar
</button>

<dialog id="ModalDeleteEquipo-{{ $equipo->id }}" class="ModalPersonalizar">
    <form action="{{ route('equipos.delete', $equipo->id) }}" method="post">
        @csrf
        @method('DELETE')

        <div class="ModalAbierto">
            <h2>¿Eliminar equipo?</h2>
            <button type="button" class="btn-cerrar" onclick="document.getElementById('ModalDeleteEquipo-{{ $equipo->id }}').close()">X</button>
        </div>

        <div class="ModalBody">
            <p class="ModalTexto">¿Estás seguro que quieres eliminar el equipo {{ $equipo->nombre }}?</p>

            <div class="acciones-modal">
                <button type="button" class="BotonEliminarNo" onclick="document.getElementById('ModalDeleteEquipo-{{ $equipo->id }}').close()">Cancelar</button>
                <button type="submit" class="BotonEliminarSi">Eliminar</button>
            </div>
        </div>
    </form>
</dialog>