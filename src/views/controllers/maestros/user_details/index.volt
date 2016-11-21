{% extends "layouts/main.volt" %}
{% block content %}
<div class="sidebar-left">
    {{ partial("controllers/maestros/sidebar/sidebar_left") }}
</div>

<div class="sidebar-content-right-section">
<div class="padding-lg">
<?php
/**
 * @var \Phalcon\Mvc\View\Engine\Php $this
 */
?>

<div class="page-header">
    <h1>
        Buscar detalles de usuario
    </h1>
    <p class="btn btn-sky-form" >
        <?php echo $this->tag->linkTo(array("maestros/userdetails/new", "Crear detalles de usuario")) ?>
    </p>
</div>

<?php echo $this->getContent() ?>

<div class="row">      <div class="col-md-2"></div><div class="col-md-8">
    <p><?php $this->flash->output() ?></p>
<?php
    echo $this->tag->form(
        array(
            "maestros/userdetails/search",
            "autocomplete" => "off",
            "class" => "form-alt"
        )
    );
?>


<div class="form-group">
    <label for="fieldUserId">Usuarios</label>
   <?php echo $this->tag->selectStatic(array("user_id", $users,"type" => "number", "class" => "form-control", "id" => "fieldUserId")) ?>
 </div>

<div class="form-group">
    <label for="fieldFirstname">Nombre</label>
   <?php echo $this->tag->textField(array("firstname", "size" => 30, "class" => "form-control", "id" => "fieldFirstname")) ?>
 </div>

<div class="form-group">
    <label for="fieldLastname">Apellidos</label>
   <?php echo $this->tag->textField(array("lastname", "size" => 30, "class" => "form-control", "id" => "fieldLastname")) ?>
 </div>

<div class="form-group">
    <label for="fieldRut">Rut</label>
   <?php echo $this->tag->textField(array("rut", "size" => 30, "class" => "form-control", "id" => "fieldRut")) ?>
 </div>

<div class="form-group">
    <label for="fieldLocation">Ubicación</label>
   <?php echo $this->tag->textField(array("location", "size" => 30, "class" => "form-control", "id" => "fieldLocation")) ?>
 </div>

<div class="form-group">
    <label for="fieldPhoneFixed">Teléfono 1</label>
   <?php echo $this->tag->textField(array("phone_fixed", "size" => 30, "class" => "form-control", "id" => "fieldPhoneFixed")) ?>
 </div>

<div class="form-group">
    <label for="fieldPhoneMobile">Teléfono 2</label>
   <?php echo $this->tag->textField(array("phone_mobile", "size" => 30, "class" => "form-control", "id" => "fieldPhoneMobile")) ?>
 </div>

<div class="form-group">
    <label for="fieldSexo">Sexo</label>
   <?php echo $this->tag->selectStatic(array("sexo", array(''=>'-', 'M' => 'Masculino', 'F' => 'Femenino'), "class" => "form-control", "id" => "fieldSexo")) ?>
 </div>

<div class="form-group">
    <label for="fieldBirthdate">Nacimiento</label>
   <?php echo $this->tag->textField(array("birthdate", "size" => 30, "class" => "form-control", "id" => "fieldBirthdate")) ?>
 </div>


<div class="form-group">

        <?php echo $this->tag->submitButton(array("Buscar", "class" => "btn btn-sky-form btn-block")) ?>
 </div>

<?php echo $this->tag->endForm(); ?>    </div></div>
</div>
    </div>
{% endblock %}
