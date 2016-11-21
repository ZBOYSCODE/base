var errorform = '';
var croperror = 'true';

$(document).on('ready', function() {

    $(document).on('click', "#chpass", function(){
        openmodal("change-password-modal");
    });

    $(document).on('click', "#chavatar", function(){
        $("#change-avatar-modal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });

    $(document).on('click', "#btn-chpass", function(){
        var password = document.getElementById("password-actual").value;
        var passwordnueva = document.getElementById("password-nueva").value;
        var passwordnuevaext = document.getElementById("password-nueva-ext").value;
        var send = true;

        if (password === '' || password == null) {
            document.getElementById("password-actual-error").innerHTML = 'Debe ingresar su contraseña actual';
            send = false;
        } else {
            document.getElementById("password-actual-error").innerHTML = '';
        }
        if (passwordnueva != passwordnuevaext) {
            //mostrar error
            document.getElementById("password-nueva-ext-error").innerHTML = 'Las contraseñas no coinciden';
        } else if(passwordnueva === '' || passwordnueva == null) {
            document.getElementById("password-nueva-ext-error").innerHTML = 'Las contraseñas no pueden ser vacias';
        } else if (send) {
            //hide errores
            document.getElementById("password-nueva-ext-error").innerHTML = '';
            //call ajax
            var action = $(this).data("url");
            var cuenta = $(this).data("cuenta");
            var dataIn = new FormData();
            dataIn.append("password-actual", password);
            dataIn.append("password-nueva", passwordnueva);
            dataIn.append("password-nueva-ext", passwordnuevaext);

            document.getElementById("password-actual").value = '';
            document.getElementById("password-nueva").value = '';
            document.getElementById("password-nueva-ext").value = '';

            $.callAjax(dataIn, action, $(this));
        }

    });

    $(document).on('click', "#btn-chav", function(){
        var dataIn = new FormData($("#form-img")[0]);
        var action = $(this).data("url");
        $.callAjax(dataIn, action, $(this));
        var $el = $('#avatar');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();

    });

    $(document).ajaxComplete(function(event,xhr,options){

        if(options.callName != null )
        {
            if(options.callName == "changepassword"){
                if (errorform != 'true') {
                    closemodal("change-password-modal");
                    errorform = 'false';
                }

            }

            if(options.callName == "uploadavatar"){
                if (croperror != 'true') {
                    closemodal("change-avatar-modal");
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    croperror = 'false';
                }

            }

        }

    });


});



//modal para mostrar modal
function openmodal(e) {
    $("#"+e).modal('show');
}

function closemodal(e) {
    $("#"+e).modal('hide');
}


