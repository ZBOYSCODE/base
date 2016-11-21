var benefits;
var surgery_roles;
var list_specialist = [];
var specialist;


$(document).ready(function(){

	$(document).on('change', '#presupuesto_aprobadas', function(){

		var dataIn = new FormData();
        	dataIn.append("estimate_id",  $(this).val());

		$.callAjax(dataIn, $('#url').val()+'/getDataEstimate', $(this));

		if($(this).val() === "")
			$('#get-consent').attr('disabled','disabled');
		else
			$('#get-consent').removeAttr('disabled');

	});


	function mostrar_benefits(){

		var $list_benefits = $("#list_benefits");

			$list_benefits.html("<h4>Lista de prestaciones</h4>");


		if( benefits.length > 0 ) {

			$.each(benefits, function(i, benefit){

				$div = $("<div />", {
					id: "benefits-"+benefit.id,
					"class": "list_benefits",
					text: benefit.name+" $"+benefit.price,
				});

				$div.appendTo($list_benefits)

			});

		} else {

			$list_benefits.html("<h4>Sin prestaciones asociadas</h4>");

		}
	}

	function mostrar_datos_cirujano() {

		$sp = $("<label />", {
			"class": "label-mountain",
			id: "specialist-"+specialist.id,
			"data-id": specialist.id,
			text: "Cirujano principal: Dr(@). "+specialist.nombre
		});

		$("#datos_specialist").html($sp);
	}

	function mostrar_surgery_roles(){

		$list = $("#list_surgery_roles")
		$list_slc = $("#list_user_surgery_roles")

		$list.html("");
		$list_slc.html("");

		list_specialist = [];

		var count = 2;
		
		$.each(surgery_roles, function(id, valor){

			for (var i = 0; i < valor.quantity; i++) {

				$group = $("<div />", {
					"class": "form-group"
				});

				// creamos el div que contiene el nombre del rol
				$div = $("<label />", {
					"for": "slc_sr"+id,
					"class": "list_surgery_roles label-mountain",
					text: valor.name,
				});

				// añadimos el div al html
				$div.appendTo($group);

				// creamos el select perteneciente al rol
				var select = $("<select />", {
					id: "slc_sr"+count,
					"data-surgery_roles": id,
					"class": "form-control chosen-select list_user_surgery_roles rol-"+id,
					"data-placeholder": "Seleccione un usuario"
				});

				if(count == 2) {
					select.attr({'disabled':'disabled'})
				}

				var option = $('<option/>');
					option.attr({ 'value': '0' });
					option.appendTo(select) // añadimos una opción vacía

				// recorremos los usuarios pertenecientes al rol
				$.each(valor.users, function(i, user){

					if(user.surgery_role_id == 1){
						list_specialist.push( user.id )
					}

					// creamos las opciones del select
					var option = $('<option/>');
						option.attr({ 'value': user.user_surgery_rol }).text( user.name );

						if(count == 2 && user.id == specialist.id ) {

							option.attr({'selected':'selected'})

						}

						option.attr({'data-id':user.id})
					
					// añadimos las opciones al select
					option.appendTo(select)
				});
					

				//añadimos el select al html
				select.appendTo($group)

				if( count % 2 == 0){
					$group.appendTo($list);
				} else {
					$group.appendTo($list_slc);
				}
				
				count++;
			
			} // end for

		});

		$(window.App.init);
	}



	/*
	$(document).on('change', '#list_surgery_roles', function(){

		var id = $(this).val();

		var dataIn = new FormData();
        dataIn.append("surgery_roles_id",  id);

		$.callAjax(dataIn, $('#url').val()+'/getUsersbySurgeryRol', $(this));
	});
	*/

	$(document).on('change', '#prebill_consent', function(){

		if($(this).is(':checked'))
			$('#get-users-surgery-roles').removeAttr('disabled');
        else 
        	$('#get-users-surgery-roles').attr('disabled','disabled');

	});	

	/*

	$(document).on('click', '#get-persist-prebill', function(){

		if($("#prebill_consent").is(':checked')) 
            var consent = true;
        else
            var consent = false;

        var list_usr = [];

        $(".list_user_surgery_roles").each(function() {
			
        	var usr = $(this).val();
        	list_usr.push( usr );

        });        

		var url = $(this).data('url');
		var surgeryTime = $('#surgery-time').val();
		var surgeryDate = $('#surgery-date').val();
		var surgeryDuration = $('#surgery-duration').val();
		var bedDays = $('#bed-days').val();
		var surgeryRoom = $('#room').val();
		var bed = $('#bed').val();
		var turns = $('#selected-turns').val();
		var patient_id = $('#patient').data('patient');	
		var estimate_id = $("#presupuesto_aprobadas").val();		          

		var dataIn = new FormData();

        dataIn.append("estimate",			estimate_id);
        dataIn.append("consent",  				consent);
        dataIn.append("users_surgery_roles",  	list_usr);
        dataIn.append('list_specialist',		list_specialist);

        dataIn.append('turns',		turns);

        dataIn.append("surgeryTime",  surgeryTime);
        dataIn.append("surgeryDate",  surgeryDate);
        dataIn.append("surgeryDuration",  surgeryDuration);
        dataIn.append("bedDays",  bedDays);	        

        dataIn.append("surgeryRoom",  surgeryRoom);
        dataIn.append("bed",  bed);	   
        dataIn.append("patient_id", patient_id);     	        



		$.callAjax(dataIn, url, $(this));
    			
	});

	*/


	$(document).on('click', '#get-persist-prebill', function(){

		if($("#prebill_consent").is(':checked')) 
            var consent = 'Firmado';
        else
            var consent = 'Pendiente';

		var surgeryTime = $('#surgery-time').val();
		var surgeryDate = $('#surgery-date').val();
		var surgeryDuration = $('#surgery-duration').val();
		var bedDays = $('#bed-days').val();
		var surgeryRoom = $('#room_chosen .chosen-single span').html()
		var bed = $('#bed_chosen .chosen-single span').html()

		$('#details-time').html(surgeryTime);
		$('#details-date').html(surgeryDate);
		$('#details-duration').html(surgeryDuration);
		$('#details-bed-days').html(bedDays);
		$('#details-room').html(surgeryRoom);
		$('#details-bed').html(bed);
		$('#details-consent').html(consent);


	});



	$(document).on('click', '#persist_prebill', function(){


		var estimate_id = $("#presupuesto_aprobadas").val();

		if (estimate_id == ''){

			alertify.error("Debe seleccionar un presupuesto");


		} else {


			if($("#prebill_consent").is(':checked')) {  
	            var consent = true;
	        } else {

	            var consent = false;

				alertify.error("El paciente debe dar su consentimiento.");
	            return false;
	        } 

	        var list_usr = [];
	        var estado_users = true;


	        $(".list_user_surgery_roles").each(function() {
				
	        	var usr = $(this).val();

	        	if(usr == 0){


					alertify.error("Debe asignar los roles correspondientes.");
	        		estado_users = false;
	        		return false;
	        	}

	        	list_usr.push( usr )
	        });

	        if(estado_users == false){
	        	return false;
	        }

			var url = $(this).data('url');
			var surgeryTime = $('#surgery-time').val();
			var surgeryDate = $('#surgery-date').val();
			var surgeryDuration = $('#surgery-duration').val();
			var bedDays = $('#bed-days').val();
			var surgeryRoom = $('#room').val();
			var bed = $('#bed').val();
			var turns = $('#selected-turns').val();

			var patient_id = $('#patient').data('patient');	          


			var dataIn = new FormData();

	        dataIn.append("estimate",			estimate_id);
	        dataIn.append("consent",  				consent);
	        dataIn.append("users_surgery_roles",  	list_usr);
	        dataIn.append('list_specialist',		list_specialist);

	        dataIn.append('turns',		turns);

	        dataIn.append("surgeryTime",  surgeryTime);
	        dataIn.append("surgeryDate",  surgeryDate);
	        dataIn.append("surgeryDuration",  surgeryDuration);
	        dataIn.append("bedDays",  bedDays);	        

	        dataIn.append("surgeryRoom",  surgeryRoom);

	        dataIn.append("bed",  bed);	        

	        dataIn.append("patient", patient_id);




			$.callAjax(dataIn, url, $(this));

		}

	});

	$(document).on('click', '#get-beds-and-rooms', function(){

		var url = $(this).data('url');
		var surgeryTime = $('#surgery-time').val();
		var surgeryDate = $('#surgery-date').val();
		var surgeryDuration = $('#surgery-duration').val();
		var bedDays = $('#bed-days').val();


		var dataIn = new FormData();
        
        dataIn.append("surgeryTime",  surgeryTime);
        dataIn.append("surgeryDate",  surgeryDate);
        dataIn.append("surgeryDuration",  surgeryDuration);
        dataIn.append("bedDays",  bedDays);


		$.callAjax(dataIn, url, $(this));

	});	

	$(document).on('click','.turn',function(){

		if(!$(this).hasClass('active-turn')){

			$("#get-beds-and-rooms").removeAttr('disabled');

       	} else{

	       	if ($(".active-turn").length == 1){
	       		$("#get-beds-and-rooms").attr('disabled','disabled');
	       	} else{
	       		$("#get-beds-and-rooms").removeAttr('disabled');
	       	}

       	}

	});

	$(document).on('change','.list_user_surgery_roles',function(){

		estado_users = true;

        $(".list_user_surgery_roles").each(function() {
			
        	var usr = $(this).val();

        	if(usr == 0)
        		estado_users = false;

        });

        if(estado_users)
        	$('#get-calendar').removeAttr('disabled');
        else
        	$('#get-calendar').attr('disabled','disabled');

	});






	/* Procedimientos Post Ajax Call */
	$(document).ajaxComplete(function(event,xhr,options){
	    if(options.callName != null )
	    {
	        if(options.callName == "mostrar_list") {

				//mostrar_benefits();
	            mostrar_surgery_roles();
	            mostrar_datos_cirujano();
	        }

	        if(options.callName == "get-beds-and-rooms") {

	        	$(window.App.init);

	        }	  	        
	        
	    }

	});
});


