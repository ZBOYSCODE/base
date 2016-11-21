$(document).ready(function(){

	// url del controlador
	var url = $('#url').val();

	// activamos la librería chosen para los select
	$(".select-chosen").chosen({width: "100%"});

	// evento para añadir favoritos
	$(document).on('click', '.btn-add-fav', function() {

		var slc 	= $(this).attr('data-select');
		var list 	= $("#"+slc).val();
		var tabla	= $(this).attr('data-table');

		guardar_favoritos(slc, list, tabla);
	});

	// evento para eliminar un favorito
	$(document).on('click', '.delete-favorito', function() {

		var id = $(this).attr('data-id');
		deleteFavoritos(id);
	});

	// función para guardar favoritos
	function guardar_favoritos(slc, list, tabla) {

		// verii¡ficamos que la lista de favoritos no venga vacía
		if(list == null){
			alertify.error("Debe seleccionar una opción");
			return false;
		}

		var datos = {
			'table':tabla,
			'list':list
		}

		// mandamos los datos por ajax
		fun = $.xajax(datos, url+'/addFav');

        fun.success(function (data)
        {
            if(!data.success) {
            	$.each(data.msg, function(i, msg) {

					alertify.error(msg);
            	});
				
			} else {

				alertify.success("Favoritos actualizados.");
				updateFavoritos(tabla);
			}
        });
	}

	// función para actualizar la lista de favoritos 
	function updateFavoritos(tabla) {

		var datos = {
			'table':tabla
		}

		fun = $.xajax(datos, url+'/getFavByTable');

        fun.success(function (data)
        {
            if(!data.success) {
            	
            	$.each(data.msg, function(i, msg) {

					alertify.error(msg);
            	});
				
			} else {

				var html = '';
				$.each(data.result, function(index, valor){
					html += "<div id='fav_"+valor.id+"' >"+valor.name+" <span><a href='#' data-id='"+valor.id+"' class='delete-favorito'><strong>x</strong></a></span></div>";
				});

				$("#favs_"+data.table).html(html);
			}
        });
	}

	// función para eliminar un favorito
	function deleteFavoritos(idfav) {


		// verii¡ficamos que la lista de favoritos no venga vacía
		if(idfav == null){

			alertify.error("Debe seleccione una opción.");
			return false;
		}


		var datos = {
			'idfav':idfav
		}

		fun = $.xajax(datos, url+'/deleteFav');

        fun.success(function (data)
        {
            if(data.success) {


				alertify.success("ELiminado con exito.");

            	delete_element( "#fav_"+data.idfav );
				
			} else {

				$.each(data.msg, function(i, msg) {
					alertify.error(msg);

            	});

			}
        });

	}

	// removemos un elemento de forma elegantisima
	function delete_element(element) {

		var element = $(element);

		element.hide('slow', function(){
			element.remove();
		});
	}

});







