<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>{{ config.appTitle }}</title>

    <meta name="viewport"       content="width=device-width, initial-scale=1.0">
    <meta name="description"    content={{ '"' ~ config.appName  ~ '"' }} >
    <meta name="author"         content={{ '"' ~ config.appAutor  ~'"' }}>

    <link rel="shortcut icon" href="{{ url("img/favicon.ico") }}">

        {# CSS GENERICAS #}
        {{ stylesheet_link('css/plugins/bootstrap/bootstrap.min.css') }}
        {{ stylesheet_link('css/plugins/bootstrap/bootstrap-theme.min.css') }}
        {{ stylesheet_link('css/main/jquery-ui.min.css') }}
        {{ stylesheet_link('css/main/font-awesome.min.css') }}
        {{ stylesheet_link('css/plugins/datepicker-custom.css') }}
        {{ stylesheet_link('css/plugins/nprogress.css') }}
        {{ stylesheet_link('css/plugins/animate.css') }}
        {{ stylesheet_link('css/plugins/alertify.core.css') }}
        {{ stylesheet_link('css/plugins/alertify.default.css')}}

        {# CSS CUSTOM #}
        {{ stylesheet_link('css/main/app.css') }}
        {{ stylesheet_link('css/pages/_components/timetable.css') }}

        {{ assets.outputCss() }}
</head>

<body class="padding-body-alt">


        {% block content %}{% endblock %}



        {# JS GENERICAS #}
        {{ javascript_include('js/main/jquery-2.2.0.min.js') }}
        {{ javascript_include('js/plugins/jquery-ui.min.js') }}
        {{ javascript_include('js/plugins/bootstrap.min.js') }}
        {{ javascript_include('js/plugins/jquery.others-plugins.js') }}
        {{ javascript_include('js/plugins/chosen.jquery.min.js') }}
        {{ javascript_include('js/plugins/bootstrap-timepicker.js') }}
        {{ javascript_include('js/plugins/alertify.js') }}
        
        {# CSS CUSTOM #}
        {{ javascript_include('js/plugins/mifaces.js') }}
        {{ javascript_include('js/plugins/jquery.utilidades.js') }}
        {{ javascript_include('js/main/app.js') }}

        {{ assets.outputJs() }}

</body>
</html>
