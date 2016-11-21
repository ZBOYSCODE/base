$(document).ready(function(){

	var url = $("#frm").attr('action');

	$(document).on('click', '.tabp', function(){

		$(".tabp").removeClass('aselected');

	
		$(".collapse").collapse('hide');

		var panel = $(this).attr('data-panel');

		$("#"+panel).collapse('toggle');

		$(this).addClass('aselected');

	});

	$(document).on('click', '#guardar', function(){

		var rol = $("#rol").val();

		if(rol != ''){
			guadarPermisos(rol);
		} else {
			$.bootstrapGrowl("Seleccione un Rol.",{type:'danger'});
		}

	});

	$(document).on('change', '#rol', function(){

		var rol = $(this).val();

		// reseteamos todos los checkbox
		$(".permisos").prop('checked', false);

		if(rol != ''){
			getPermisos(rol);
		}
	});

	$(document).on('click', '.slc_all', function(){

		var clase = $(this).attr('data-class');

		if($(this).prop('checked')){
			$("."+clase).prop('checked', true);
		}else{
			$("."+clase).prop('checked', false);
		}

		

	});

	function getPermisos(rol)
	{
		var datos = {
			'rol' : rol
		}
	
		fun = $.xajax(datos, url+'/getPermisos');
		fun.success(function (data)
		{
			if(data.estado)
			{
				$.log(data);

				if(data.permisos){
					$.each(data.permisos, function(a, permiso){
						$('input[type="checkbox"][value="'+permiso+'"]').prop('checked', true);
					});
				}else{
					$(".ck_permisos").prop('checked', false);
				}

					

			}else{
				$.bootstrapGrowl(data.msg,{type:'danger'});
				$.log(data);
			}
		});
	}

	function guadarPermisos(rol)
	{

		var permisos = [];

		$('.ck_permisos').each(function(a, obj){

			if( $(obj).prop('checked') ){

				permisos.push( $(obj).val() );
			}

		});

		var datos = {
			'rol' : rol,
			'permisos' : permisos
		}
	
		fun = $.xajax(datos, url+'/updatePermisos');
		fun.success(function (data)
		{
			if(data.estado)
			{
				$.log(data);

				$.bootstrapGrowl(data.msg);

			}else{
				$.bootstrapGrowl(data.msg,{type:'danger'});
				$.log(data);
			}
		});

	}

});