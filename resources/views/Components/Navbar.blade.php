<div class="ContainerNavbar">
    <div class="ContainerText">
        <a href="/home">Home</a>
    </div>
    <div class="ContainerText">
        <a href="/reservaciones">Reservaciones</a>
    </div>
    @auth
        <div class="ContainerText">
            <span>{{ Auth::user()->name }} ({{ Auth::user()->rol }})</span>
        </div>
    @endauth
    <div class="ContainerText">
        <a href="/cerrarsesion">Cerrar Sesión</a>
    </div>
</div>