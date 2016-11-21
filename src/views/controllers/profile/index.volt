{% extends "layouts/main.volt" %}
{% block content %}


    <div class="">

    </div>
    <div class="card card-border padding-lg themed-bg-snow">

        <h3 class="label-mountain">Configuración Perfil Usuario</h3>

        <hr class="hr-lighter">

        <div class="padding-lg">

            <div id="avatar_render">
                {{ partial("controllers/profile/avatar") }}
            </div>
            



            <div class="row profile-buttons">

                <div class="col-sm-6 ">
                    <span id="chavatar" class="btn btn-sky btn-block pull-right"><i class="fa fa-file-image-o"></i> Cambiar Avatar</span>
                </div>

                <div class="col-sm-6 ">
                    <span id="chpass" class="btn btn-sky btn-block pull-right"><i class="fa fa-lock"></i> Cambiar Contraseña</span>
                </div>

            </div>

        </div>

    </div>




    <div id="modal-chpass">
        {{ partial("controllers/profile/password_change/modal") }}
    </div>
    <div id="modal-chav">
        {{ partial("controllers/profile/avatar_change/modal") }}
    </div>

{% endblock %}