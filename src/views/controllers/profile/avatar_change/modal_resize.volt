<div class="modal-header card">
    <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><i class="fa fa-picture-o"></i> Redimensionar Avatar</h4>
</div>
<div class="modal-body">

    <div class="card">
        <div class="row">
            <div id="form-img" class="col-md-12 form-alt">
                <div class="component">
                    <div class="overlay">
                        <div class="overlay-inner">
                        </div>
                    </div>

                    {# dummy es para obligar traer de la cache #}
                    <img class="resize-image" src="{{ avatar ~ '?dummy=' ~ date("y-m-d_h_i_s") }}" alt="image for resizing">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 form-alt">
               Puede utilizar el boton shift (<i class="fa fa-arrow-up"></i>) para mantener la relación de aspecto
            </div>
        </div>
    </div>
</div>
<div class="modal-footer card">
    <div class="row">
        <div class='col-xs-12'>
            <input id="descuentoinput" type="hidden" value="0">
            <span id="js-crop-btn" class="btn btn-sky-form  btn-block js-crop"
                  data-callName="uploadavatar"
                  data-url="{{ url("profile/uploadavatar") }}">
                        <i class="fa fa-crop"></i> Guardar
            </span>

        </div>
    </div>
</div>