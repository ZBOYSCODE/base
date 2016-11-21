
{% extends "layouts/main.volt" %}

{% block content %}


<div class="card card-border atention-form">
    <div class="atention-form-header">
        <div class="atention-form-title {{ medicalHistory.style }}">
            <i class="{{ medicalHistory.icon }}"></i>
            <b>{{ medicalHistory.name }}</b>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">

            <div class="atencion-form-container atention-form-width">

                <form id="atentionForm" method="POST" data-type="ajax" class="form-alt">

                    <div class="row {{ medicalHistory.style }}">
                        <fieldset>
                            <div class="col-sm-8">

                                <div class="form-group">
                                    <label for="peso">* Diagnóstico (CIE-10)</label>

                                    <select id="extra-diagnostico" name="extra-diagnostico" class="form-control">

                                        <option value="">Seleccione Diagnóstico</option>
                                        <option value="1">Mástitis Crónica</option>
                                        <option value="2">Mástitis fibroquística </option>
                                        <option value="3">Mástitis flemonosa  </option>
                                        <option value="4">Mástitis infecciosa   </option>
                                        <option value="5">Mástitis neonatal    </option>
                                        <option value="6"> (Próximamente todo el CIE-10)</option>

                                    </select>

                                </div>
                            </div>
                            <div class="col-sm-4 atention-forms-buttons">
                                <div class="form-group">
                                    <button id="agregar-Examen" type="button" class="add-form-button btn btn-sky btn-block {{ medicalHistory.style }}"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="row {{ medicalHistory.style }}">
                        <fielset>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="Posicion">Posición</label><br>
                                    <div id="Posicion" class="btn-group " data-toggle="buttons">
                                        <label class="btn btn-sky radio-check-label">
                                            <input id="extra-posicion-1" type="radio" name="extra-posicion" value="Izquierdo" autocomplete="off"> Izquierdo
                                        </label>
                                        <label class="btn btn-sky radio-check-label">
                                            <input id="extra-posicion-2" type="radio" name="extra-posicion" value="Derecho" autocomplete="off"> Derecho
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="condicion">Condición</label><br>
                                    <div id="condicion" class="btn-group " data-toggle="buttons">
                                        <label class="btn btn-sky radio-check-label">
                                            <input id="extra-condicion-1" type="radio" name="extra-condicion" value="Crónico" autocomplete="off"> Crónico
                                        </label>
                                        <label class="btn btn-sky radio-check-label">
                                            <input id="extra-condicion-2" type="radio" name="extra-condicion" value="Agudo" autocomplete="off"> Agudo
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </fielset>
                    </div>


                    <div class="row {{ medicalHistory.style }}">
                        <fielset>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tipo-diagnostico">Tipo Diagnóstico</label><br>
                                    <div id="Posicion" class="btn-group " data-toggle="buttons">
                                        <label class="btn btn-sky radio-check-label">
                                            <input id="extra-tipo-diagnostico-1" type="radio" name="extra-tipo-diagnostico" value="Si" autocomplete="off"> Hipotesis
                                        </label>
                                        <label class="btn btn-sky radio-check-label">
                                            <input id="extra-tipo-diagnostico-2" type="radio" name="extra-tipo-diagnostico" value="No" autocomplete="off"> Confirmado
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </fielset>
                    </div>


                    <div class="row {{ medicalHistory.style }}">
                        <div class="col-sm-12">

                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">* Complemento Diagnóstico </label>

                                        <textarea type="text" id="description" name="description" class="form-control" rows="10"></textarea>
                                    </div>
                                <div>
                            </div>
                        </fieldset>
                    </div>

                    <hr class="hr-lighter">



                    {{ partial("controllers/atention/forms/_buttons") }}

                </form>

            </div>


        </div>
    </div>
</div>

{% endblock %}