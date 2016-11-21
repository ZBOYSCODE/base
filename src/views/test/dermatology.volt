

{% extends "layouts/main.volt" %}

{% block content %}


<div class="card card-border atention-form">
    <div class="atention-form-header">

    </div>
    <div class="row">
        <div class="col-xs-12">

            <div class="atencion-form-container atention-form-width2">

                <form class="form-alt" action="test/ValidateForm" data-type="ajax" method="POST">

                    <div class="row {{ medicalHistory.style }}">
                        <fieldset>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="alergias">Alergias</label><br>
                                    <div id="alergias" class="btn-group " data-toggle="buttons">
                                      <label class="btn btn-sky radio-check-label active">
                                        <input id="extra-alergias-1" type="radio" name="extra-alergias" value="Si" autocomplete="off"> Sí
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-alergias-2" type="radio" name="extra-alergias" value="No" autocomplete="off"> No
                                      </label>
                                    </div>
                                </div>
                                <div class"box-error"><p id="alergias-error" class="error"></p></div>
                                <div class="form-group">
                                    <label for="esp-alergias">Indique Alergias</label>
                                    <input type="text" id="extra-esp-alergias" name="extra-esp-alergias" class="form-control" placeholder="Indique Alergias" value=""/>
                                </div>
                                <div class"box-error"><p id="esp-alergias-error" class="error"></p></div>
                            </div>
                           
                             <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="enfermedades-piel">Enfermedades a la Piel</label><br>
                                    <div id="enfermedades-piel" class="btn-group " data-toggle="buttons">
                                      <label class="btn btn-sky radio-check-label active">
                                        <input id="extra-enfermedades-piel-1" type="radio" name="extra-enfermedades-piel" value="Si" autocomplete="off"> Sí
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-enfermedades-piel-2" type="radio" name="extra-enfermedades-piel" value="No" autocomplete="off"> No
                                      </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="esp-enfermedades-piel">Indique Enfermedades</label>
                                    <input type="text" id="extra-esp-enfermedades-piel" name="extra-esp-enfermedades-piel" class="form-control" placeholder="Indique Enfermedades" value=""/>
                                </div>  
                            </div>
                        
                             <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="tratamiento-actual">Tratamiento Actual</label><br>
                                    <div id="tratamiento-actual" class="btn-group " data-toggle="buttons">
                                      <label class="btn btn-sky radio-check-label active">
                                        <input id="extra-tratamiento-actual-1" type="radio" name="extra-tratamiento-actual" value="Si" autocomplete="off"> Sí
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-tratamiento-actual-2" type="radio" name="extra-tratamiento-actual" value="No" autocomplete="off"> No
                                      </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="esp-tratamiento">Indique Tratamiento</label>
                                    <input type="text" id="extra-esp-tratamiento" name="extra-esp-tratamiento" class="form-control" placeholder="Indique Tratamiento" value=""/>
                                </div>
                            </div>
                             
                        </fieldset>
                    </div>
                    <hr class="hr-lighter">
                    <div class="row {{ medicalHistory.style }}">  
                        <fieldset>
                            <div class="atention-section-title">SÍNTOMAS</div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="sintomas-generales">Síntomas Generales</label><br>
                                  <div id="sintomas-generales" class="btn-group " data-toggle="buttons">
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-sintomas-generales-1" type="checkbox" name="extra-sintomas-generales[]" value="Fiebre Alta" autocomplete="off"> Fiebre Alta 
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-sintomas-generales-2" type="checkbox" name="extra-sintomas-generales[]" value="Decaimiento" autocomplete="off"> Decaimiento
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-sintomas-generales-3" type="checkbox" name="extra-sintomas-generales[]" value="Baja de Peso" autocomplete="off"> Baja de Peso
                                      </label>
                                  </div>
                                </div>
                            </div>
                             <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="sintomas-frecuentes">Síntomas Frecuentes</label><br>
                                  <div id="sintomas-frecuentes" class="btn-group " data-toggle="buttons">
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-sintomas-frecuentes-1" type="checkbox" name="extra-sintomas-frecuentes[]" value="Picazón" autocomplete="off">Picazón 
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-sintomas-frecuentes-2" type="checkbox" name="extra-sintomas-frecuentes[]" value="Dolor" autocomplete="off">Dolor
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-sintomas-frecuentes-3" type="checkbox" name="extra-sintomas-frecuentes[]" value="Ardor" autocomplete="off">Ardor
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-sintomas-frecuentes-4" type="checkbox" name="extra-sintomas-frecuentes[]" value="Aumento T° Zona" autocomplete="off"><i class="fa fa-arrow-up"> Temperatura zona</i>
                                      </label>
                                  </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="sintomas-frecuentes">Síntomas Frecuentes</label><br>
                                  <div id="sintomas-frecuentes" class="btn-group " data-toggle="buttons">
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-sintomas-frecuentes-5" type="checkbox" name="extra-sintomas-frecuentes[]" value="Adormecimiento zona" autocomplete="off">Adormecimiento zona
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-sintomas-frecuentes-6" type="checkbox" name="extra-sintomas-frecuentes[]" value="Heridas" autocomplete="off">Heridas
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-sintomas-frecuentes-7" type="checkbox" name="extra-sintomas-frecuentes[]" value="Sin Síntomas" autocomplete="off">Sin Síntomas
                                      </label>
                                  </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="row {{ medicalHistory.style }}">  
                        <fieldset>
                            <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="otros-sintomas">Otros Síntomas</label><br>
                                  <input type="text" id="extra-otros-sintomas" name="extra-otros-sintomas" class="form-control" placeholder="Otros Síntomas" value="" />
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <hr class="hr-lighter">

                    <div class="row {{ medicalHistory.style }}">  
                        <div class="atention-section-title">Zonas Corporales Comprometidas</div>
                        <fieldset>
                            <div class="col-sm-4">
                              <label for=""></label><br>
                              <div id="zonas-corporales" class="btn-group " data-toggle="buttons">
                                  <label class="btn btn-sky radio-check-label">
                                    <input id="extra-zonas-corporales-1" type="checkbox" name="extra-zonas-corporales[]" value="Cuerpo Entero" autocomplete="off">Cuerpo Entero
                                  </label>
                                  <label class="btn btn-sky radio-check-label">
                                    <input id="extra-zonas-corporales-2" type="checkbox" name="extra-zonas-corporales[]" value="Rostro" autocomplete="off">Rostro
                                  </label>
                                  <label class="btn btn-sky radio-check-label">
                                    <input id="extra-zonas-corporales-3" type="checkbox" name="extra-zonas-corporales[]" value="Cuello" autocomplete="off">Cuello
                                  </label>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <label for=""></label><br>
                              <div id="zonas-corporales" class="btn-group " data-toggle="buttons">
                                  <label class="btn btn-sky radio-check-label">
                                    <input id="extra-zonas-corporales-4" type="checkbox" name="extra-zonas-corporales[]" value="Antebrazos" autocomplete="off">Antebrazos
                                  </label>
                                  <label class="btn btn-sky radio-check-label">
                                    <input id="extra-zonas-corporales-5" type="checkbox" name="extra-zonas-corporales[]" value="Abdomen" autocomplete="off">Abdomen
                                  </label>
                                  <label class="btn btn-sky radio-check-label">
                                    <input id="extra-zonas-corporales-6" type="checkbox" name="extra-zonas-corporales[]" value="Glúteos" autocomplete="off">Glúteos
                                  </label>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <label for=""></label><br>
                              <div id="zonas-corporales" class="btn-group " data-toggle="buttons">
                                  <label class="btn btn-sky radio-check-label">
                                    <input id="extra-zonas-corporales-7" type="checkbox" name="extra-zonas-corporales[]" value="Zona Inguinal" autocomplete="off">Zona Inguinal
                                  </label>
                                  <label class="btn btn-sky radio-check-label">
                                    <input id="extra-zonas-corporales-8" type="checkbox" name="extra-zonas-corporales[]" value="Piernas" autocomplete="off">Piernas
                                  </label>
                                  <label class="btn btn-sky radio-check-label">
                                    <input id="extra-zonas-corporales-9" type="checkbox" name="extra-zonas-corporales[]" value="Cuero Cabelludo" autocomplete="off">Cuero Cabelludo
                                  </label>
                              </div>
                            </div>
                        </fieldset>
                    </div>
                    <br>
                    <div class="row {{ medicalHistory.style }}">  
                        <fieldset>
                            <div class="col-sm-4">
                              <label for=""></label><br>
                              <div id="zonas-corporales" class="btn-group" data-toggle="buttons">
                                  <label class="btn btn-sky radio-check-label">
                                    <input id="extra-zonas-corporales-10" type="checkbox" name="extra-zonas-corporales[]" value="Brazos" autocomplete="off">Brazos
                                  </label>
                                  <label class="btn btn-sky radio-check-label">
                                    <input id="extra-zonas-corporales-11" type="checkbox" name="extra-zonas-corporales[]" value="Manos" autocomplete="off">Manos
                                  </label>
                                  <label class="btn btn-sky radio-check-label">
                                    <input id="extra-zonas-corporales-12" type="checkbox" name="extra-zonas-corporales[]" value="Espalda" autocomplete="off">Espalda
                                  </label>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <label for=""></label><br>
                              <div id="zonas-corporales" class="btn-group " data-toggle="buttons">
                                  <label class="btn btn-sky radio-check-label">
                                    <input id="extra-zonas-corporales-13" type="checkbox" name="extra-zonas-corporales[]" value="Genitales" autocomplete="off">Genitales
                                  </label>
                                  <label class="btn btn-sky radio-check-label">
                                    <input id="extra-zonas-corporales-14" type="checkbox" name="extra-zonas-corporales[]" value="Muslos" autocomplete="off">Muslos
                                  </label>
                                  <label class="btn btn-sky radio-check-label">
                                    <input id="extra-zonas-corporales-15" type="checkbox" name="extra-zonas-corporales[]" value="Pies" autocomplete="off">Pies
                                  </label>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="otras-zonas">Otras Zonas</label><br>
                                <input type="text" id="extra-otras-zonas" name="extra-otras-zonas" class="form-control" placeholder="Otras Zonas" value="" />
                              </div>
                            </div>
                        </fieldset>
                    </div>

                    <hr class="hr-lighter">

                    <div class="row {{ medicalHistory.style }}">  
                        <fieldset>
                            <div class="atention-section-title">Estado Condición</div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="tiempo-dias">Menos de una semana</label>
                                    <input type="text" id="extra-tiempo-dias" name="extra-tiempo-dias" class="form-control" placeholder="Indique días" value=""/>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="tiempo-semanas">Menos de un mes</label>
                                    <input type="text" id="extra-tiempo-semanas" name="extra-tiempo-semanas" class="form-control" placeholder="Indique Semanas" value=""/>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="tiempo-meses">Menos de un año</label>
                                    <input type="text" id="extra-tiempo-meses" name="extra-tiempo-meses" class="form-control" placeholder="Indique meses" value=""/>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="tiempo-años">Más de un año</label>
                                    <input type="text" id="extra-tiempo-añoss" name="extra-tiempo-años" class="form-control" placeholder="Indique años" value=""/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="evolucion-condicion">Evolución Condición</label><br>
                                    <div id="evolucion-condicion" class="btn-group " data-toggle="buttons">
                                        <label class="btn btn-sky radio-check-label active">
                                          <input id="evolucion-condicion-1" type="radio" name="extra-evolucion-condicion" value="Ha Disminuído" autocomplete="off">Ha Disminuído
                                        </label>
                                        <label class="btn btn-sky radio-check-label">
                                          <input id="evolucion-condicion-2" type="radio" name="extra-evolucion-condicion" value="Sin Cambios" autocomplete="off">Sin Cambios
                                        </label>
                                        <label class="btn btn-sky radio-check-label">
                                          <input id="evolucion-condicion-3" type="radio" name="extra-evolucion-condicion" value="Ha Aumentado" autocomplete="off">Ha Aumentado
                                        </label>
                                    </div>  
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="row {{ medicalHistory.style }}">  
                        <fieldset>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="predominio-dolor">Predominio de Dolor</label><br>
                                    <div id="predominio-dolor" class="btn-group " data-toggle="buttons">
                                        <label class="btn btn-sky radio-check-label active">
                                          <input id="predominio-dolor-1" type="radio" name="extra-predominio-dolor" value="Matinal" autocomplete="off">Matinal
                                        </label>
                                        <label class="btn btn-sky radio-check-label">
                                          <input id="predominio-dolor-2" type="radio" name="extra-predominio-dolor" value="Vespertino" autocomplete="off">Vespertino
                                        </label>
                                        <label class="btn btn-sky radio-check-label">
                                          <input id="predominio-dolor-3" type="radio" name="extra-predominio-dolor" value="Nocturno" autocomplete="off">Nocturno
                                        </label>
                                    </div>  
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="intensidad-dolor">Intensidad Dolor</label><br>
                                    <div id="intensidad-dolor" class="btn-group " data-toggle="buttons">
                                        <label class="btn btn-sky radio-check-label active">
                                          <input id="intensidad-dolor-1" type="radio" name="extra-intensidad-dolor" value="Alto" autocomplete="off">Alto
                                        </label>
                                        <label class="btn btn-sky radio-check-label">
                                          <input id="intensidad-dolor-2" type="radio" name="extra-intensidad-dolor" value="Medio" autocomplete="off">Medio
                                        </label>
                                        <label class="btn btn-sky radio-check-label">
                                          <input id="intensidad-dolor-3" type="radio" name="extra-intensidad-dolor" value="Bajo" autocomplete="off">Bajo
                                        </label>
                                    </div>  
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="tratamientos-anteriores">Tratamientos Anteriores</label><br>
                                    <div id="tratamientos-anteriores" class="btn-group " data-toggle="buttons">
                                      <label class="btn btn-sky radio-check-label active">
                                        <input id="extra-tratamientos-anteriores-1" type="radio" name="extra-tratamientos-anteriores" value="Si" autocomplete="off"> Sí
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-tratamientos-anteriores-2" type="radio" name="extra-tratamientos-anteriores" value="No" autocomplete="off"> No
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="esp-tratamiento">Indique Tratamiento</label>
                                    <input type="text" id="extra-esp-tratamiento" name="extra-esp-tratamiento" class="form-control" placeholder="Indique Tratamiento" value=""/>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    
                    <div class="row {{ medicalHistory.style }}">  
                        <fieldset>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="familiares-condicion">Familia con Condición</label><br>
                                    <div id="familiares-condicion" class="btn-group " data-toggle="buttons">
                                      <label class="btn btn-sky radio-check-label active">
                                        <input id="extra-familiares-condicion-1" type="radio" name="extra-familiares-condicion" value="Si" autocomplete="off"> Sí
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-familiares-condicion-2" type="radio" name="extra-familiares-condicion" value="No" autocomplete="off"> No
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label for="esp-fam-condicion">Comentario</label>
                                    <textarea class="form-control" rows="7" name="extra-esp-fam-condicion" id="extra-esp-fam-condicion"></textarea>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <hr class="hr-lighter">

                    <div class="row {{ medicalHistory.style }}">  
                        <div class="atention-section-title">Descripción de Lesión de la Piel</div>
                        <fieldset>
                            <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="lesiones-planas">Lesiones Planas</label><br>
                                   <div id="lesiones-planas" class="btn-group " data-toggle="buttons">
                                       <label class="btn btn-sky radio-check-label active">
                                         <input id="extra-lesiones-planas-1" type="radio" name="extra-lesiones-planas" value="Mácula" autocomplete="off">Mácula
                                       </label>
                                       <label class="btn btn-sky radio-check-label">
                                         <input id="extra-lesiones-planas-2" type="radio" name="extra-lesiones-planas" value="Mancha" autocomplete="off">Mancha
                                       </label>
                                       <label class="btn btn-sky radio-check-label">
                                         <input id="extra-lesiones-planas-3" type="radio" name="extra-lesiones-planas" value="Infarto" autocomplete="off">Infarto
                                       </label>
                                       <label class="btn btn-sky radio-check-label">
                                         <input id="extra-lesiones-planas-4" type="radio" name="extra-lesiones-planas" value="Esclerosis" autocomplete="off">Esclerosis
                                       </label>
                                       <label class="btn btn-sky radio-check-label">
                                         <input id="extra-lesiones-planas-5" type="radio" name="extra-lesiones-planas" value="Telangiectasis" autocomplete="off">Telangiectasis
                                       </label>
                                   </div>  
                               </div>
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="lesiones-elevadas">Lesiones Elevadas</label><br>
                                   <div id="lesiones-elevadas" class="btn-group " data-toggle="buttons">
                                       <label class="btn btn-sky radio-check-label active">
                                         <input id="extra-lesiones-elevadas-1" type="radio" name="extra-lesiones-elevadas" value="Pápula" autocomplete="off">Pápula
                                       </label>
                                       <label class="btn btn-sky radio-check-label">
                                         <input id="extra-lesiones-elevadas-2" type="radio" name="extra-lesiones-elevadas" value="Placa" autocomplete="off">Placa
                                       </label>
                                       <label class="btn btn-sky radio-check-label">
                                         <input id="extra-lesiones-elevadas-3" type="radio" name="extra-lesiones-elevadas" value="Nódulo" autocomplete="off">Nódulo
                                       </label>
                                       <label class="btn btn-sky radio-check-label">
                                         <input id="extra-lesiones-elevadas-4" type="radio" name="extra-lesiones-elevadas" value="Vesícula" autocomplete="off">Vesícula
                                       </label>
                                       <label class="btn btn-sky radio-check-label">
                                          <input id="extra-lesiones-elevadas-5" type="radio" name="extra-lesiones-elevadas" value="Ampollas" autocomplete="off">Ampollas
                                       </label>
                                       <label class="btn btn-sky radio-check-label">
                                          <input id="extra-lesiones-elevadas-6" type="radio" name="extra-lesiones-elevadas" value="Ronchas" autocomplete="off">Ronchas
                                       </label>
                                       <label class="btn btn-sky radio-check-label">
                                          <input id="extra-lesiones-elevadas-7" type="radio" name="extra-lesiones-elevadas" value="Abscesos" autocomplete="off">Abscesos
                                       </label>
                                   </div>  
                               </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="row {{ medicalHistory.style }}">  
                        <fieldset>
                            <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="lesiones-elevadas">Lesiones Elevadas</label><br>
                                  <div id="lesiones-elevadas" class="btn-group " data-toggle="buttons">
                                      <label class="btn btn-sky radio-check-label active">
                                        <input id="extra-lesiones-elevadas-8" type="radio" name="extra-lesiones-elevadas" value="Quistes" autocomplete="off">Quistes
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-lesiones-elevadas-9" type="radio" name="extra-lesiones-elevadas" value="Costras" autocomplete="off">Costras
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-lesiones-elevadas-10" type="radio" name="extra-lesiones-elevadas" value="Escaras" autocomplete="off">Escaras
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                        <input id="extra-lesiones-elevadas-11" type="radio" name="extra-lesiones-elevadas" value="Escaras" autocomplete="off">Escaras
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                         <input id="extra-lesiones-elevadas-12" type="radio" name="extra-lesiones-elevadas" value="Queloide" autocomplete="off">Queloide
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                         <input id="extra-lesiones-elevadas-13" type="radio" name="extra-lesiones-elevadas" value="Cicatriz" autocomplete="off">Cicatriz
                                      </label>
                                      <label class="btn btn-sky radio-check-label">
                                         <input id="extra-lesiones-elevadas-14" type="radio" name="extra-lesiones-elevadas" value="Liquen" autocomplete="off">Liquen
                                      </label>
                                  </div>  
                              </div>
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="lesiones-deprimidas">Lesiones Deprimidas</label><br>
                                    <div id="lesiones-elevadas" class="btn-group " data-toggle="buttons">
                                       <label class="btn btn-sky radio-check-label active">
                                       <input id="extra-lesiones-deprimidas-1" type="radio" name="extra-lesiones-deprimidas" value="Atrofia" autocomplete="off">Atrofia
                                       </label>
                                       <label class="btn btn-sky radio-check-label">
                                         <input id="extra-lesiones-deprimidas-2" type="radio" name="extra-lesiones-deprimidas" value="Esclerósis" autocomplete="off">Esclerósis
                                       </label>
                                       <label class="btn btn-sky radio-check-label">
                                         <input id="extra-lesiones-deprimidas-3" type="radio" name="extra-lesiones-deprimidas" value="Excoriasión" autocomplete="off">Excoriasión
                                       </label>
                                       <label class="btn btn-sky radio-check-label">
                                         <input id="extra-lesiones-deprimidas-4" type="radio" name="extra-lesiones-deprimidas" value="Erosión" autocomplete="off">Erosión
                                       </label>
                                   </div>  
                               </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="row {{ medicalHistory.style }}">  
                        <fieldset>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="lesiones-deprimidas">Lesiones Deprimidas</label><br>
                                <div id="lesiones-elevadas" class="btn-group " data-toggle="buttons">
                                    <label class="btn btn-sky radio-check-label active">
                                    <input id="extra-lesiones-deprimidas-5" type="radio" name="extra-lesiones-deprimidas" value="Cicatriz" autocomplete="off">Cicatriz
                                    </label>
                                    <label class="btn btn-sky radio-check-label">
                                      <input id="extra-lesiones-deprimidas-6" type="radio" name="extra-lesiones-deprimidas" value="Úlcera" autocomplete="off">Úlcera
                                    </label>
                                    <label class="btn btn-sky radio-check-label">
                                      <input id="extra-lesiones-deprimidas-7" type="radio" name="extra-lesiones-deprimidas" value="Seno" autocomplete="off">Seno
                                    </label>
                                    <label class="btn btn-sky radio-check-label">
                                      <input id="extra-lesiones-deprimidas-8" type="radio" name="extra-lesiones-deprimidas" value="Gangrena" autocomplete="off">Gangrena
                                    </label>
                                </div>  
                              </div>
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="tamaño-lesion">Indique Tamaño Lesión</label>
                                   <input type="text" id="extra-tamaño-lesion" name="extra-tamaño-lesion" class="form-control" placeholder="Indique Tamaño Lesión" value=""/>
                               </div> 
                            </div>
                        </fieldset>
                    </div>
                  
                    <div class="row {{ medicalHistory.style }}">  
                        <div class="atention-section-title">Distribución y Número de la(s) lesión(es)</div>
                        <fieldset>
                            <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="distribusion-lesion">Distribusión Lesión</label><br>
                                   <select id="extra-distribusion-lesion" name="extra-distribusion-lesion" class="form-control" data-placeholder="Seleccione Distribusión">
                                       <option value="">Seleccione</option>
                                       <option value="Lesión única">Lesión única</option>
                                       <option value="Aisladas en zonas de la piel, alternadas con zonas de piel sana">Aisladas en zonas de la piel, alternadas con zonas de piel sana</option>
                                       <option value="Agrupadas en zonas de la piel, alternadas con zonas de piel sana">Agrupadas en zonas de la piel, alternadas con zonas de piel sana</option>
                                       <option value="Lesiones generalizadas en toda la piel">Lesiones generalizadas en toda la piel</option>
                                   </select>
                               </div>
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group">
                                  <label for="numero-lesion">Indique Número Lesión</label>
                                  <input type="text" id="extra-numero-lesion" name="extra-numero-lesion" class="form-control" placeholder="Indique Número Lesión" value=""/>
                               </div>
                            </div>
                        </fieldset>
                    </div>

                    <hr class="hr-lighter">

                    {{ partial("controllers/atention/forms/_form_base") }}

                    <hr class="hr-lighter">

                    <input type="submit" value="Submit">
                </form>

            </div>


        </div>
    </div>
</div>

{% endblock %}