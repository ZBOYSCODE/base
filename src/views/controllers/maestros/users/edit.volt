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

<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(array("maestros/users", "Atrás")) ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Editar usuarios
    </h1>
</div>

<?php echo $this->getContent(); ?>

<div class="row">      <div class="col-md-2"></div><div class="col-md-8">
    <p><?php $this->flash->output() ?></p>
<?php
    echo $this->tag->form(
        array(
            "maestros/users/save",
            "autocomplete" => "off",
            "class" => "form-alt"
        )
    );
?>


<div class="form-group">
    <label for="fieldUsername">Nombre de Usuario</label>
   <?php echo $this->tag->textField(array("username", "size" => 30, "class" => "form-control", "id" => "fieldUsername")) ?>
 </div>

<div class="form-group">
    <label for="fieldEmail">Email</label>
   <?php echo $this->tag->textField(array("email", "size" => 30, "class" => "form-control", "id" => "fieldEmail")) ?>
 </div>

<div class="form-group">
    <label for="fieldAvatar">Avatar</label>
   <?php echo $this->tag->textField(array("avatar", "size" => 30, "class" => "form-control", "id" => "fieldAvatar")) ?>
 </div>

<div class="form-group">
    <label for="fieldPassword">Password</label>
   <?php echo $this->tag->passwordField(array("password", array(), "class" => "form-control", "id" => "fieldPassword")) ?>
 </div>

<div class="form-group">
    <label for="fieldBanned">Expulsado</label>
   <?php echo $this->tag->selectStatic(array("banned", array('Y'=>'Sí', 'N'=>'No'), "class" => "form-control", "id" => "fieldBanned")) ?>
 </div>

<div class="form-group">
    <label for="fieldSuspended">Suspendido</label>
   <?php echo $this->tag->selectStatic(array("suspended", array('Y'=>'Sí', 'N'=>'No'), "class" => "form-control", "id" => "fieldSuspended")) ?>
 </div>

<div class="form-group">
    <label for="fieldActive">Activo</label>
   <?php echo $this->tag->selectStatic(array("active", array('Y'=>'Sí', 'N'=>'No'), "class" => "form-control", "id" => "fieldActive")) ?>
 </div>

<div class="form-group">
    <label for="fieldRoleId">Tipo de Usuario</label>
   <?php echo $this->tag->selectStatic(array("role_id", $roles, "type" => "number", "class" => "form-control", "id" => "fieldRoleId")) ?>
 </div>


<?php echo $this->tag->hiddenField("id") ?>

<div class="form-group">

        <?php echo $this->tag->submitButton(array("Guardar", "class" => "btn btn-sky-form btn-block")) ?>
 </div>

<?php echo $this->tag->endForm(); ?>    </div></div>
</div>
    </div>
{% endblock %}
