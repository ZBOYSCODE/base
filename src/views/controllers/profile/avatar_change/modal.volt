<div id="change-avatar-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div id="modal-inner-content" class="modal-content">
            <div class="modal-header card">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-picture-o"></i> Cambiar Avatar</h4>
            </div>
            <div class="modal-body">

                <div class="card">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <form id="form-img" class="col-md-8 form-alt">
                            <div class="form-group">
                                <label for="fieldType">Nuevo Avatar</label>
                                <input type="file" name="avatar" id="avatar" class="form-control">
                                <div class="box-error"><p id="avatar-error" class="error"></p> </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer card">
                <div class="row">
                    <div class='col-xs-12'>
                        <input id="descuentoinput" type="hidden" value="0">
                        <span id="btn-chav" class="btn btn-sky-form  btn-block"
                              data-callName="changeAvatar"
                              data-url="{{ url("profile/changeavatar") }}">
                            Cambiar
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>