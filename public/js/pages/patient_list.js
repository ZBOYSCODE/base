$(document).ready(function(){

	// Variables globales
	var url 	= $("#form-busqueda").attr('action');
	var limit 	= $("#limit").val();
	var current	= $("#current").val();

	// Ejecutar
	get_list();

	// Eventos

	$(document).on('keyup', '#input-buscar', function(){
		get_list();
	});

	$(document).on('submit', '#form-busqueda', function(e){
		e.preventDefault();
	});

	// Navegación
	$(document).on('click', '.nav_paginacion', function(){

		var func = $(this).attr('data-func');

		switch(func) {
			case "first": 	current = first; 	break
			case "next": 	current = next; 	break
			case "before": 	current = before; 	break
			case "last": 	current = last; 	break
		}

		get_list();
	});

	// Funciones

	/**
	 * Retorna la lista de usuarios paginada
	 *
	 */
	function get_list()
	{

		var datos = {
			'pagination': true,
			'limit'		: limit,
			'page'		: current,
			'role'		: 4,
			'search'	: $("#input-buscar").val()
		}

		fun = $.xajax(datos, url+'/searchPatient');

		fun.success(function (data)
		{

			if(data.total_items > 0){

				$("#table_body").empty();

				// seteamos los valores
				$("#limit").val(data.limit);
				$("#before").val(data.before);
				$("#first").val(data.first);
				$("#next").val(data.next);
				$("#last").val(data.last);
				$("#items").val(data.total_items);

				// 
				$("#current_txt").text(data.current);
				$("#total_txt").text(data.total_pages);
				$("#items_txt").text(data.total_items);

				// seteamos las variables
				next 	= data.next;
				before 	= data.before;
				first 	= data.first;
				last 	= data.last;
				limit	= data.limit;

				var cont = 1;

				$.each(data.items, function(index,paciente){

					var nombre = '';
					var direccion = '';
					var telefono = '';
					var plan_medico = '';
					var rut = '';
					var avatar = '';


					if(paciente.firstname != null){
						nombre += paciente.firstname+" ";
					}

					if(paciente.lastname != null){
						nombre += paciente.lastname;
					}

					if(paciente.location != null){
						direccion = paciente.location;
					}

					if(paciente.phone_fixed != null) {
						telefono += paciente.phone_fixed+" / ";
					}

					if(paciente.phone_mobile != null) {
						telefono += paciente.phone_mobile+" ";
					}

					if(paciente.medical_plan_id !=  null) {
						plan_medico = paciente.medical_plan_id;
					}

					if (paciente.rut != null) {
						rut = paciente.rut;
					}

					if (paciente.avatar != null) {
						avatar = paciente.avatar;
					}

					if (cont % 2 == 0) {
						fondo = "active";
						borde = "td-left-border-1";
					}

					if (cont % 2 != 0) {
						fondo = "info";
						borde = "td-left-border-2";
					}

					var base_url = $("#form-busqueda").data('base-url');

					$tr  = "<tr align ='center' id='"+paciente.id+"' class='"+fondo+"'>";
					$tr += "<td class='"+borde+"'><img class='avatar-list' src='"+base_url+avatar+"'></td>";
					$tr += "<td>"+nombre+"</td>";
					$tr += "<td>"+rut+"</td>";

					if(paciente.email == null)
					{
						var email = "-";
					}
					else {
						var email = paciente.email;
					}

					$tr += "<td>"+email+"</td>";
					$tr += "<td>"+direccion+"</td>";
					$tr += "<td>"+telefono+"</td>";
					$tr += "<td>"+plan_medico+"</td>";
					$tr += "<td><a class='btn ficha-view btn-sm' href='"+url+"/edit/"+paciente.id+"' >Ver Ficha</a></td>";
					$tr += "</tr>";

					$("#table_body").append($tr);
                    cont++;
				});

			} else {

				$("#table_body").empty();
				$("#table_body").append("<tr><td class='text-center' colspan='8'>Sin resultados</td></tr>");
				console.log("Sin resultados");


			}
			
		});

	}

});