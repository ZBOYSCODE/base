
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Informe</title>
    
 
    <style>

        .timeline-header{
            padding-right: 20px;
        }

        .timeline-item .timeline-item-header {
            padding: 5px;
        }

        .timeline-item .timeline-item-header .timeline-search{
            padding: 20px;
            border-bottom: 1px solid #f2f2f2;
            margin-bottom: 20px;
        }

        .timeline-item .timeline-item-header .timeline-date i {
            font-size: 25px;
            color: #9fa4a5;
        }

        .timeline-item .timeline-item-header .timeline-date span {
            display: block;
        }

        .timeline-item .timeline-item-header .timeline-date {
            text-align: right;
            color: #9fa4a5;
            font-size: 10px;
        }

        .timeline-item .timeline-item-body {
            padding: 5px;
            font-size: 12px;
            color: #828282;
        }

        .timeline-item .timeline-item-body .timeline-item-tittle span{
            display: block;
        }

        .timeline-item .timeline-item-body .timeline-item-tittle h1 {
            font-size: 13px;
            color: #00A388;
            font-weight: bolder;
            padding: 1px;
            margin: 1px;
        }

        .timeline-item .timeline-item-body .timeline-item-examenes-box {
            /*margin-top: 5px;*/
            width: 100%;
            margin: 5px auto;

        }

        .timeline-item .timeline-item-body .timeline-item-tittle span {
            font-size: 10px;
            color: #9fa4a5;
            font-weight: lighter;
        }

        .timeline-btn-edit{
            border: none;
            background-color: transparent;
            font-size: 15px;
            padding-top: 2px;
            padding-right: 4px;
            width: 25px;
        }

        .timeline-btn-edit:hover{
            background-color: #00A388;
            border-radius: 4px;
            color: white;
        }

        .timeline-btn-delete{
            border: none;
            background-color: transparent;
            font-size: 15px;
            padding-top: 2px;
            width: 25px;
        }

        .timeline-btn-delete:hover{
            background-color: #e7756c;
            border-radius: 4px;
            color: white;
        }


        .timeline-item .examenes-table tbody tr {
            border-top: 7px solid white;
        }

        .timeline-item .examenes-table tbody tr td{
            height: 40px;
            text-align: left;
            padding: 5px;
        }

        .name-specialist{
            margin: 0 auto;
            width: 57%;
        }

        .timeline-item-tittle{
            margin: 0 auto;
            width: 57%;
        }
        
        .to-center {
              text-align: center;
        }

        .pull-left{
            float: left;
        }
        
    </style>
</head>
    
<body>

    <div class="row">
        <div class="to-right report-generate-info">
            <p><i>Generado el: {{generate_datetime}}</i></p>
        </div>

        <div class="themed-color-default ">
            <span class="report-title">{{report_name}}</span> <br>
            <span class="report-title">{{patient_name}}</span> <br>
            <span class="report-title">{{patient_nro_doc}}</span> <br>
        </div>

    </div>

    <div class="card card-border paciente-timeline">


        {% if history is empty %}
            <div class="text-center text-danger">

                <hr class="hr-lighter">
                <div class="agenda-no-results"><i class="fa fa-exclamation-triangle"></i> Historia Clínica sin datos. </div>
                <hr class="hr-lighter">
            </div>

        {% else %}







            <div class="row">
                <div class="col-sm-offset-2 col-sm-8">
                    {% for  fecha, mharray in history %}
                        {% for obj in mharray  %}

                            <div class="timeline-item">

                                <div class="timeline-item-header">

                                    <div class="timeline-item-header">

                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="widget-horizontal no-border widget-xs no-margin">
                                                    

                                                    <div class="widget-right to-left">
                                                        {% set first_name_specialist = obj[0].UsersSpecialtiesBranchoffices.Users.UserDetails.firstname %}
                                                        {% set last_name_specialist = obj[0].UsersSpecialtiesBranchoffices.Users.UserDetails.lastname %}
                                                        {% set especialidad = obj[0].UsersSpecialtiesBranchoffices.Specialties.name %}

                                                        <h1><b>Doctor: {{ first_name_specialist ~" "~last_name_specialist }}</b></h1>
                                                        <span> {{ especialidad }}</span>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-xs-6">
                                                <div class="timeline-date">
                                                    <span><i class="fa fa-calendar-o"></i></span>
                                                    <span> {{ utility._timeAgo(fecha) }}</span>
                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="timeline-item-body">
                                        <div class="timeline-item-tittle">
                                            <h1> Fecha:  {{ utility._getDateFormatFull(fecha) }}</h1>
                                            <!--<span> <b>Miércoles, 7/09/2016.</b></span>-->
                                        </div>

                                        <div class="timeline-item-examenes-box">
                                            <table class="examenes-table hoverable-table">
                                                <tbody>

                                                {% for mh in obj %}



                                                    {# Seteamos la clase css a usar dependiendo del estado del medical history #}
                                                    {% if mh.state_id == 1 %}
                                                        {% set status = "default" %}
                                                        {% set msg = "Información General" %}

                                                    {% elseif mh.state_id ==  2 %}
                                                        {% set status = "danger" %}
                                                        {% set msg = "La información ha sido calificada con problemas." %}

                                                    {% elseif mh.state_id == 3 %}
                                                        {% set status = "warning" %}
                                                        {% set msg = "La información ha sido calificada regular." %}

                                                    {% elseif mh.state_id == 4 %}
                                                        {% set status = "nice" %}
                                                        {% set msg = "La información ha sido calificada excelente." %}

                                                    {% else %}
                                                        {% set status = "default" %}
                                                        {% set msg = "" %}
                                                    {% endif %}




                                                    <tr class="examen-toggle" data-toggle="collapse" data-target="{{ "#hc" ~ mh.id }}">

                                                        <td class="examen-estado  {{ status }}">
                                                            <i class="fa fa-circle"></i>
                                                        </td>

                                                        <td>

                                                            {# Nombre del common #}
                                                            <b>{{ mh.MedicalHistoryType.name }}</b> <br>

                                                            {# Nombre del descripcion del estado #}
                                                            <span class="examen-comment"> {{ msg }}</span>


                                                            {# Datos del examen o common #}
                                                            <div id="{{ "hc" ~ mh.id }}" class="collapse">
                                                                <hr>
                                                                <div class="inline">
                                                                    <p class="to-right examen-time">

                                                                        <i class="glyphicon glyphicon-time"></i>
                                                                        {{ date("H:i", utility._strtotime(mh.created_at)) }} hrs

                                                                    </p>

                                                                </div>


                                                                {% if mh.MedicalHistoryType.id == 16 %}
                                                                    <div class="margin-bottom">
                                                                        <a href="{{ url("public/files/receta.pdf") }}" target="_blank" class="timeline-btn-download"><i class="fa fa-arrow-circle-down"></i> Descargar Receta</a>
                                                                    </div>
                                                                {% endif %}

                                                                <p>

                                                                    {% for dato in mh.MedicalHistoryCommonExtra %}

                                                                        <span>
                                                                    <b>
                                                                        {{ dato.field_name }}:
                                                                    </b>
                                                                            {{ dato.field_value }}
                                                                </span> <br>

                                                                    {% endfor %}
                                                                </p>


                                                                <p>
                                                                    <i>Observación: {{ mh.description }}.</i>
                                                                </p>
                                                            </div>

                                                        </td>



                                                    </tr>

                                                {% endfor %}

                                                </tbody>
                                            </table>

                                        </div>

                                        <!--
                                <div class="examen-action-buttons">
                                    <span> <i class="fa fa-envelope"></i> </span>
                                     <a href="{{ url("public/files/receta.pdf") }}" target="_blank">
                                        <span> <i class="fa fa-print"></i> </span>
                                    </a>
                                </div>
                                -->


                                    </div>

                                </div>

                            </div>

                        <pagebreak />
                        {% endfor %}

                    {% endfor %}
                </div>

            </div>




        {% endif %}

    </div>

</body>
</html>