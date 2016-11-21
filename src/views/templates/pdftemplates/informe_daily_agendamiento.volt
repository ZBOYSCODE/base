
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Informe</title>
    
    <link rel="stylesheet" type="text/css" href="css/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main/app.css">
    <link rel="stylesheet" type="text/css" href="css/pages/_components/timetable.css">
    <link rel="stylesheet" type="text/css" href="css/pages/pdftemplates/particular.css">
    
    <style>
        .special-col{ 
            width: 10% !important;
        }
        .special-hidden{
            display: none !important;
        }

        body td{       
            text-align: center;
            font-size: 1em !important;
        }
        body thead tr th{
            font-size: 1.1em !important;
        }
    </style>

</head>
<body>

    <div class="row">
        <div class="to-right report-generate-info">
            <p><i>Generado el: {{generate_datetime}}</i></p>
        </div>

        <div class="themed-color-default to-center">
            <span class="report-title">{{report_name}}</span> <br>
            <span class="report-subtitle">{{date}} </span> <br><br>
        </div>

    </div>

    {% if dailyTurns == false %}

    <div class="text-center text-danger">

        <hr class="hr-lighter">
        <div class="agenda-no-results">No hay turnos para la fecha y parámetros seleccionados. </div>
        <hr class="hr-lighter">
    </div>

    {% else %}


    <section class="vista-diaria">

        <div class="">
             <table id="diaria-table" class="my-table agnd-dia-table table" data-offset="70">
            <thead>
                <tr>
                    <th class="special-col" width="2%">Horas</th>
                    <th class="visible-sm visible-md visible-lg special-col" width="2%">Espera</th>
                    <th class="visible-sm visible-md visible-lg special-col" width="2%">Recepción</th>
                    <th class="visible-sm visible-md visible-lg special-col" width="2%">Atención</th>
                    <th>Paciente</th>
                    <th>Especialista</th>
                </tr>
            </thead>
            <tbody>

                {% for turno in dailyTurns %}
                    
                    {%  set tipo = "bloque-hora-" ~ (turno.turn_state_id) %}

                    {% if turno.datetime_reception == null %}
                        {% set hora_recepcion = "-"%}
                    {% else %} 
                         {% set hora_recepcion = date("H:i:s", utility._strtotime(turno.datetime_reception)) %}
                    {% endif %}


                    {% if turno.datetime_attention == null %}
                            {% set hora_atencion = "-"%}
                    {% else %}
                             {% set hora_atencion = date("H:i:s", utility._strtotime(turno.datetime_attention)) %}
                    {% endif %}

                    {% if turno.nameTurnCategory == null %}
                            {% set motivo = "-" %}
                    {% else %}
                             {% set motivo = turno.nameTurnCategory %}
                    {% endif %}

                    {% if turno.turn_state_id == 100 %}
                            {% set rutPaciente = "-" %}
                            {% set especialista = "-" %}
                    {% else %}
                             {% set rutPaciente = turno.rutPatient %}
                             {% set especialista = turno.firstnameSpecialist ~ " " ~ turno.lastnameSpecialist %}
                    {% endif %}

                    {% if turno.overcrowd == 1 %}
                        {% set class_overcrowd = "overcrowd" %}
                    {% else %}
                        {% set class_overcrowd = "" %}
                    {% endif %}

                    

                    {% set hora_turno = date("H:i", utility._strtotime(turno.datetime_turn)) %}


                    <tr align="center" id="{{ turno.idTurn }}" class="turnos {{ tipo }} {{ class_overcrowd }}" data-especialista = "{{ turno.idSpecialist }}">

                        <td>{{ hora_turno }}</td>
                        <td class="visible-sm visible-md visible-lg">
                            {% if turno.turn_state_id == 100 %}
                                -
                            {% else %}
                                Pendiente
                            {% endif %}
                        
                        </td>

                        <td class="visible-sm visible-md visible-lg">{{ hora_recepcion }}</td>

                        <td class="visible-sm visible-md visible-lg">{{ hora_atencion }}</td>
                        <td>

                            <div class="row bubbleTrigger" data-target = "{{ "#bubble-"~turno.idTurn }}">
                                <div class="col-sm-12">

                                    {% if turno.turn_state_id == 1 %}

                                        Disponible

                                    {% else %}
                                        
                                        {% if rutPaciente == "-" %}
                                           
                                           {{ rutPaciente }}

                                        {% else %}
                                         
                                        {{ link_to("javascript:void(0)",turno.firstnamePatient ~ " " ~ turno.lastnamePatient, "class":"link-disabled" , false) }}

                                        <br>
                                        {{ rutPaciente }}

                                        <div id="bubble-{{ turno.idTurn }}" class="bubble bubble-dynamic viewPort-Left">

                                            <div class="widget widget-full">
                                                <div class="widget-body">
                                                    {{ image(turno.avatarPatient,"class":"img-circle img-thumbnail widget-img") }} <br>
                                                    {{ turno.firstnamePatient ~ " " ~ turno.lastnamePatient }} <br>
                                                    {{ turno.rutPatient }}

                                                    <hr class="hr-lighter">
                                                    <div>{{ turno.nameMedicalPlan }}</div>
                                                    <div class="row">
                                                        <i class="glyphicon glyphicon-home"></i> {{ turno.locationPatient }}
                                                        &nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-phone"></i> {{ turno.phoneMobilePatient }}
                                                    </div>
                                                </div>
                                                <div class="to-bottom">
                                                    {{ link_to("paciente/edit/"~turno.patientId,"Ver Ficha", "class":"btn ficha-view btn-sm",false) }}
                                                </div>
                                            </div>
                                        </div>
                                        {% endif %}

                                    {% endif %}

                                </div>
                            </div>


                        </td>

                        <td>
                            {{ especialista }}
                        </td>

                        


                    </tr>

                {% endfor %}

            </tbody>
        </table>
        </div>


    </section>


    {% endif %}


</body>
</html>