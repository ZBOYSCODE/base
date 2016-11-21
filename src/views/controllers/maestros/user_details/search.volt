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
            <li class="previous"><?php echo $this->tag->linkTo(array("maestros/userdetails/index", "Ir Atrás")); ?></li>
            <li class="next"><?php echo $this->tag->linkTo(array("maestros/userdetails/new", "Crear ")); ?></li>
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
                <th>Usuarios</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Rut</th>
            <th>Ubicación</th>
            <th>Teléfono 1</th>
            <th>Teléfono 2</th>
            <th>Comentarios</th>
            <th>Sexo</th>
            <th>Nacimiento</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($page->items as $user_detail): ?>
            <tr>
                <td><?php echo $users[$user_detail->user_id] ?></td>
            <td><?php echo $user_detail->firstname ?></td>
            <td><?php echo $user_detail->lastname ?></td>
            <td><?php echo $user_detail->rut ?></td>
            <td><?php echo $user_detail->location ?></td>
            <td><?php echo $user_detail->phone_fixed ?></td>
            <td><?php echo $user_detail->phone_mobile ?></td>
            <td><?php echo $user_detail->comments ?></td>
            <td><?php echo $user_detail->sexo ?></td>
            <td><?php echo $user_detail->birthdate ?></td>


                <td><?php echo $this->tag->linkTo(array("maestros/userdetails/edit/" . $user_detail->user_id, "Editar")); ?></td>
                <td><?php echo $this->tag->linkTo(array("maestros/userdetails/delete/" . $user_detail->user_id, "Eliminar")); ?></td>
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
                <li><?php echo $this->tag->linkTo("maestros/userdetails/search", "Primera") ?></li>
                <li><?php echo $this->tag->linkTo("maestros/userdetails/search?page=" . $page->before, "Anterior") ?></li>
                <li><?php echo $this->tag->linkTo("maestros/userdetails/search?page=" . $page->next, "Siguiente") ?></li>
                <li><?php echo $this->tag->linkTo("maestros/userdetails/search?page=" . $page->last, "Última") ?></li>
            </ul>
        </nav>
    </div>
</div>
</div>
        </div>
{% endblock %}