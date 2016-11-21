<div id="change-password-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header card">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-key"></i> Cambiar Contraseña</h4>
            </div>
            <div class="modal-body">

                <div class="card">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 form-alt">
                            <div class="form-group">
                                <label for="fieldType">Contraseña Actual</label>
                                <input type="password" name="password-actual" id="password-actual" class="validate form-control">
                                <div class="box-error"><p id="password-actual-error" class="error"></p> </div>
                            </div>
                            <div class="form-group">
                                <label for="fieldType">Nueva Contraseña</label>
                                <input type="password" name="password-nueva" id="password-nueva" class="validate form-control">
                                <div class="box-error"><p id="password-nueva-error" class="error"></p> </div>
                            </div>
                            <div class="form-group">
                                <label for="fieldType">Repetir Nueva Contraseña</label>
                                <input type="password" name="password-nueva-ext" id="password-nueva-ext" class="validate form-control">
                                <div class="box-error"><p id="password-nueva-ext-error" class="error"></p> </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer card">
                <div class="row">
                    <div class='col-xs-12'>
                        <input id="descuentoinput" type="hidden" value="0">
                        <span id="btn-chpass" class="btn btn-sky-form  btn-block"
                              data-callName="changepassword"
                              data-url="{{ url("profile/changepassword") }}">
                            Cambiar
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>