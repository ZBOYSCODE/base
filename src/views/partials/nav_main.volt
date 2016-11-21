<header>
    <nav class="navbar navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">


                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="glyphicon glyphicon-menu-hamburger icon-lg" aria-hidden="false"></span>
                </button>
                <!-- logo -->


                <a class="navbar-brand" href="{{ url("") }}">
                    <!--//TODO - insertar logo-->
                    LOGO

                </a>

            </div>
            <div class="collapse navbar-collapse animated fadeIn" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav animated fadeIn text15">

                    <li> {{ link_to("maestros/userdetails", "Sistema") }}</li>
                    {#<li> {{ link_to("javascript://", "Ayuda" ,false) }}</li>#}

                    

                </ul>


                <ul class="nav navbar-nav navbar-form hidden-sm hidden-xs">
                    <div class="form-group">


                         {{ text_field("generalSearch","class":"form-control hidden","placeholder":"Busca turnos por Pacientes, Doctores, Fecha y Hora")  }}


                    </div>
                </ul>


                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="gi gi-user"></i><b> <i class="glyphicon glyphicon-user"></i> {{ session.get('auth-identity')['nombre'] }}</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">


                            <li><a href="{{ url('profile') }}">Perfil</a></li>
                            <li>{{ link_to("logout", "Salir" ) }}</li>


                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>