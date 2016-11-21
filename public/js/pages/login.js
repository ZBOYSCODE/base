$(document).on('ready', function() {

    var user_correcto   = false;
    var url             = $('#frm-login').attr('action');

    
     $(document).on('click', '#btn-login', function(e){

        e.preventDefault();

        var token       = $("#token").val();            
        var email       = $("#username").val();         
        var password    = $("#inputPassword").val();    
        
        var estado      = false;
        var msg         = [];

        if(token == '') {
            estado  = true;

            msg.push("Error: Favor recargar la página");
        }

        if(email == '') {
            estado  = true;
            msg.push("Por favor, Ingrese el usuario");
        }

        if(password == '') {
            estado  = true;
            msg.push("Por favor, Ingrese la contraseña");
        }

        if(!estado) {

            logIn();
             
        } else {
            $.each(msg, function(index, mensaje){
                alertify.error(mensaje);
            });
        }
        
    });


    $(document).on('input', '#username' , function() {
        
        showAvatars();  
    });


    function logIn() {

        var datos = $("#frm-login").serialize();


        fun = $.xajax(datos, url+'/loginUser');

        fun.success(function (data)
        {
            if(!data.success) {
                alertify.error(data.msg);
            } else {

                window.location.href = data.redirect;

            }

        });

    }


});



function showAvatars(){

        var email = $('#username').val();
        var url = $('#inputPassword').data('url');

        var isEmail = $.isEmail(email);

        if(email == null || email.length == 0 || /^\s+$/.test(email) || isEmail == false){
                       
            $('.email-error').html("* Debe ingresar un email válido.");
            
        }else{

            $('.email-error').html("");

            var datos = { 'email' : email };
            
            response = $.xajax(datos, url);

            response.success(function (data){


                var base_url = $('#frm-login').data('base-url');
                
                if (data.avatar){
                     $('#profile-img-default').attr("src" ,  base_url+data.avatar);
                     $('#wide-img').attr({"src" :  base_url+data.avatar,
                                          "class": "blur"});
                     $('#wide-card-img').removeClass("hidden"); 
                     $('.login-card-header').addClass("blue-filter");     
                     $('#wide-card-img').attr("src" , base_url+data.avatar);
                                    
                } else{
                    $('#profile-img-default').attr("src" , base_url+"/pic/avatars/default.png");
                    $('#wide-card-img').attr("src" , "");
                    $('#wide-img').attr("src" , "");
                }
                    
            });
        }  

    }



