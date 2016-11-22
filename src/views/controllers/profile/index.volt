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

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form class="form-alt" autocomplete="off" method="POST" action="profile/edit">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="fieldFirstname">Nombre</label>
                            <?php echo $this->tag->textField(array("firstname", "size" => 30, "class" => "form-control", "id" => "fieldFirstname")) ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="fieldLastname">Apellidos</label>
                            <?php echo $this->tag->textField(array("lastname", "size" => 30, "class" => "form-control", "id" => "fieldLastname")) ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="fieldRut">Rut</label>
                            <?php echo $this->tag->textField(array("rut", "size" => 30, "class" => "form-control", "id" => "fieldRut")) ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="fieldLocation">Ubicación</label>
                            <?php echo $this->tag->textField(array("location", "size" => 30, "class" => "form-control", "id" => "fieldLocation")) ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="fieldPhoneFixed">Teléfono 1</label>
                            <?php echo $this->tag->textField(array("phone_fixed", "size" => 30, "class" => "form-control", "id" => "fieldPhoneFixed")) ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="fieldPhoneMobile">Teléfono 2</label>
                            <?php echo $this->tag->textField(array("phone_mobile", "size" => 30, "class" => "form-control", "id" => "fieldPhoneMobile")) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4"></div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-sky-form btn-block"><i class="fa fa-floppy-o"></i> Guardar</button>
                        </div>
                    </div>
                </form>
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