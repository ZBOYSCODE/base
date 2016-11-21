<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>{{ config.appTitle }}</title>

        <meta name="viewport"       content="width=device-width, initial-scale=1.0">
        <meta name="description"    content={{ '"' ~ config.appName  ~ '"' }} >
        <meta name="author"         content={{ '"' ~ config.appAutor  ~ '"' }}>
        <meta name="theme-color" content="#1e96ee">

        <link rel="shortcut icon" href="{{ url("img/favicon-128.png") }}">

        {# CSS GENERICAS #}
        {{ stylesheet_link('css/plugins/bootstrap/bootstrap.min.css') }}
        {{ stylesheet_link('css/plugins/bootstrap/bootstrap-theme.min.css') }}
        {{ stylesheet_link('css/main/jquery-ui.min.css') }}
        {{ stylesheet_link('css/main/font-awesome.min.css') }}
        {{ stylesheet_link('css/plugins/datepicker-custom.css') }}
        {{ stylesheet_link('css/plugins/nprogress.css') }}
        {{ stylesheet_link('css/plugins/animate.css') }}
        {{ stylesheet_link('css/plugins/sweetalert2.min.css') }}
        {{ stylesheet_link('css/plugins/bootstrap-timepicker.css') }}
        {{ stylesheet_link('css/plugins/chosen.min.css') }}
        {{ stylesheet_link('css/pages/surgery_room/wizard.css') }}
        {{ stylesheet_link('css/plugins/alertify.core.css') }}
        {{ stylesheet_link('css/plugins/alertify.default.css')}}

        {# CSS CUSTOM #}
        {{ stylesheet_link('css/main/app.css') }}
        {{ stylesheet_link('css/pages/_components/timetable.css') }}

        {{ assets.outputCss() }}

    </head>
    <body>
        <div id="nav-main">
            {{ partial("partials/nav_main") }}
        </div>
        <div class="clearfix">
            <div class="container-fluid">

                {% block content %}{% endblock %}

            </div>
        </div>

        {# JS GENERICAS #}
        {{ javascript_include('js/main/jquery-2.2.0.min.js') }}
        {{ javascript_include('js/plugins/jquery-ui.min.js') }}
        {{ javascript_include('js/plugins/bootstrap.min.js') }}
        {{ javascript_include('js/plugins/jquery.others-plugins.js') }}
        {{ javascript_include('js/plugins/sweetalert2.min.js') }}
        {{ javascript_include('js/plugins/bootstrap-timepicker.js') }}
        {{ javascript_include('js/plugins/alertify.js') }}
        
        {# Chosen #}
        {{ javascript_include('js/plugins/chosen.jquery.min.js') }}

        {# Mask #}
        {{ javascript_include('js/plugins/jquery.mask.min.js') }}


        {# CSS CUSTOM #}
        {{ javascript_include('js/plugins/mifaces.js') }}
        {{ javascript_include('js/plugins/jquery.utilidades.js') }}
        {{ javascript_include('js/main/app.js') }}
        {{ javascript_include('js/socket/scheduling.js') }}

    

        {# Lógica para socket - para habilitar editar config.php #}
        {% if config.get("switchUtils") !== null and config.get("switchUtils")["socket"] %}

            <script src="http://64.79.70.107:8089/socket.io/socket.io.js"></script> 
            <script>
                var nodeServer = 'http://64.79.70.107:8089';
                var socket = io(nodeServer);
            </script>

        {% endif %}

        {{ assets.outputJs() }}

    </body>
</html>