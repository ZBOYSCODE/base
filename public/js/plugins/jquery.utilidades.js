(function($){

	$.fn.extend({
		renderSelect: function(objet){
			slc = slc || null;

			var th = this;

			$.each(objet, function(indice, valor){
				// creamos el objeto <option>
				var option = jQuery('<option />', {
				    value	: indice,
				    text	: valor
				});

				$.log(option);

				// indicamos si uno las opciones es seleccionada por defecto
				if(slc != null && slc == indice){
					option.attr('selected', true);
				}

				// añadimos la opcion al select
				option.appendTo(th)
			});
		},

		alerta: function (msg, tipo_alerta){

			$(this).children().addClass('danger').hide('fast', function(){
				$(this).remove();
			});

			$('<div/>', {
			    class 	: 'alert '+tipo_alerta,
			    role 	: 'alert',
			    html 	: '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
			    			"<strong>Atención :</strong> "+msg
			}).appendTo(this);
		},

		quitar_alerta: function()
		{
			$(this).children().addClass('danger').hide('fast', function(){
				$(this).remove();
			});
		}
	});

	jQuery.xajax = function (datos, url, async)
	{

		if (typeof NProgress !== "undefined" && NProgress != null)
			NProgress.start();

		//valor por omisión
		async = async || 'true';
		return $.ajax({
            async	: async,
            type 	: 'POST',
            data 	: datos,
            url 	: url,
            dataType: 'json',
            success : function(data)
            {
                return data;
            },
			complete: function(xhr,status) {
				if (typeof NProgress !== "undefined" && NProgress != null)
					NProgress.done();
			}
        });

	}



	jQuery.log = function(msg){
		console.log(msg);
	}


	jQuery.isEmail = function(email) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}

	jQuery.priceFormat = function(number) {
		var resultado = 0;
		if($.isNumeric(number))
			resultado = number.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
		return resultado;

	}




})(jQuery)