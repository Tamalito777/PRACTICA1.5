@if (session('mensaje'))
    <div class="ContainerAlerta">
        <p>{{ session('mensaje') }}</p>
    </div>
@endif