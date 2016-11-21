<div class="item header-item">
    <a href="javascript://">
        <span class="glyphicon glyphicon-th-large"></span>
        Ocultar / Mostrar
    </a>
</div>

<div class="scrollbar scrollbar-sidebar" id="style-7">
    <div class="force-overflow force-overflow-sidebar">
<div id="userdetails" class="item" data-toggle="collapse" data-parent="#accordion" href="#detalles_usuario">
    <i class="fa fa-users"></i>
    Detalles de Usuario
</div>

<div id="detalles_usuario" class="panel-collapse collapse sidebar-collapse">
    <div class="item sub-item">
        <a href="{{ url('maestros/userdetails') }}">
            <div>
            <i class="fa fa-search"></i>
            Buscar
            </div>
        </a>
    </div>
    <div class="item sub-item">
        <a href="{{ url('maestros/userdetails/search') }}">
            <div>
            <i class="fa fa-list"></i>
            Listar
            </div>
        </a>
    </div>
    <div class="item sub-item">
        <a href="{{ url('maestros/userdetails/new') }}">
            <div>
            <i class="fa fa-database"></i>
            Crear
            </div>
        </a>
    </div>
</div>

<div id="users" class="item" data-toggle="collapse" data-parent="#accordion" href="#usr">
    <i class="fa fa-users"></i>
    Usuarios
</div>

<div id="usr" class="panel-collapse collapse sidebar-collapse">
    <div class="item sub-item">
        <a href="{{ url('maestros/users') }}">
            <div>
            <i class="fa fa-search"></i>
            Buscar
            </div>
        </a>
    </div>
    <div class="item sub-item">
        <a href="{{ url('maestros/users/search') }}">
            <div>
            <i class="fa fa-list"></i>
            Listar
            </div>
        </a>
    </div>
    <div class="item sub-item">
        <a href="{{ url('maestros/users/new') }}">
            <div>
            <i class="fa fa-database"></i>
            Crear
            </div>
        </a>
    </div>
</div>
        </div>
    </div>