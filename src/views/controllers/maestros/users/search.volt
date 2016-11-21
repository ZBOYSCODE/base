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

<?php use Phalcon\Tag; ?>

<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(array("maestros/users/index", "Ir Atrás")); ?></li>
            <li class="next"><?php echo $this->tag->linkTo(array("maestros/users/new", "Crear ")); ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Lista de resultados</h1>
</div>

<?php echo $this->getContent(); ?>

<div class="row">
    <p><?php $this->flash->output() ?></p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Identificador</th>
            <th>Nombre de Usuario</th>
            <th>Email</th>
            <th>Avatar</th>
            <th>Debe Cambiar Contraseña</th>
            <th>Expulsado</th>
            <th>Suspendido</th>
            <th>Activo</th>
            <th>Tipo de Usuario</th>
            <th>Fecha Creación</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($page->items as $user): ?>
            <tr>
                <td><?php echo $user->id ?></td>
            <td><?php echo $user->username ?></td>
            <td><?php echo $user->email ?></td>
            <td><img src="<?php echo $baseUri . $user->avatar ?>" style="max-width: 40px; max-height: 40px;"></td>
            <td><?php if($user->must_change_password == '0'){echo 'No';} else {echo 'Sí';} ?></td>
            <td><?php if($user->banned == 'N'){echo 'No';} else {echo 'Sí';} ?></td>
            <td><?php if($user->suspended == 'N'){echo 'No';} else {echo 'Sí';} ?></td>
            <td><?php if($user->active == 'N'){echo 'No';} else {echo 'Sí';} ?></td>
            <td><?php echo $roles[$user->role_id] ?></td>
            <td><?php echo $user->created_at ?></td>

                <td><?php echo $this->tag->linkTo(array("maestros/users/edit/" . $user->id, "Editar")); ?></td>
                <td><?php echo $this->tag->linkTo(array("maestros/users/delete/" . $user->id, "Eliminar")); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            <?php echo $page->current, "/", $page->total_pages ?>
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li><?php echo $this->tag->linkTo("maestros/users/search", "Primera") ?></li>
                <li><?php echo $this->tag->linkTo("maestros/users/search?page=" . $page->before, "Anterior") ?></li>
                <li><?php echo $this->tag->linkTo("maestros/users/search?page=" . $page->next, "Siguiente") ?></li>
                <li><?php echo $this->tag->linkTo("maestros/users/search?page=" . $page->last, "Última") ?></li>
            </ul>
        </nav>
    </div>
</div>
</div>
        </div>
{% endblock %}