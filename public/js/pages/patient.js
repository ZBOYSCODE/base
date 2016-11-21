$(document).on('ready', function() {

	var url 	= $('#editar-paciente').attr('data-url');

	$(document).on('click', '#btn-create', function(){

				//alert("Boton funcionando en al ruta");
				var action = $(this).data("url");
        var dataIn  = new FormData($("#modal")[0]);
        $.callAjax(dataIn, action, $(this));

    });

	$(document).on('click', "#btn-enviar", function() {

		 var action = $(this).data("url");
		 var dataIn  = new FormData($("#form-perfil")[0]);
			$.callAjax(dataIn, action, $(this));

 });

		$(document).on('change', "#district", function() {

        var action = $(this).data("url");
				var dataIn  = new FormData();
				var id_region = $("#district").val();
				dataIn.append('id_region',id_region);
        $.callAjax(dataIn, action, $(this));

    });


    $(document).on('click', '#editar-paciente', function(){

    	editar_paciente();

    });


    function editar_paciente(){

    	var datos = {
    	'iduser' 				: $("#iduser").val(),
			'username' 			: $("#username").val(),
			'email' 				: $("#email").val(),
			'firstname' 		: $("#firstname").val(),
			'lastname' 			: $("#lastname").val(),
			'location' 			: $("#location").val(),
			'phone_fixed' 		: $("#phone_fixed").val(),
			'phone_mobile' 		: $("#phone_mobile").val(),
			'medical_plan_id' : $("#medical_plan_id").val(),
			'comments' 			: $("#comments").val(),
			'rut' 					: $("#rut").val()


		}

		fun = $.xajax(datos, url+'/store');

		fun.success(function (data)
		{
			if(!data.success) {


				alertify.error(data.msg);


			} else {

				alertify.success("Paciente actualizado.");


			}

		});

    }


});




$(document).ajaxComplete(function(event,xhr,options){


	if(options.callName != null )
	{
			if(options.callName == "btn-create-patient") {
					$(window.App.init);
			}

			if(options.callName == "district") {
					$(window.App.init);
			}
	}

});
