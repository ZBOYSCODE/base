$(function(){
	var scrollAddData=true;
	var formScroll = $('form[data-scroll]');



	$(document).on('change','.select-chosen', function(e) {

		if($(this).data('trigger')!==undefined){
			var dataIn	= new FormData();
			dataIn.append("from", $(this).attr('name'));
			dataIn.append("to", $(this).data('trigger'));
			dataIn.append("id", $(this).val());

			jQuery.callAjax(dataIn,'getSelectBy',$(this));
		}

		if($(this).data('submit')!==undefined){
			$(this).parents('form').submit();
		}
	});

	$(document).on("click","[type='reset']", function(event){
		$(this).parents('form').find('input').val('');
		$(this).parents('form').find('.select-chosen:enabled').val('').trigger("chosen:updated");

		var dataAjax	= $(this).data('ajax');

		if($(this).parents('form').data('type')=='ajax' & dataAjax!=false){
			$(this).parents('form').submit();
		}
	});


	$(document).on("click","[data-action]",function(event) {

		var dataIn	= new FormData();
		var action		= $(this).data('action');
		var dataAjax	= $(this).data('ajax');
		var dataInStr	= "";
		var dataSep		= "";

		var poData = unserialize($(this).data('val'));
		$.each(poData, function(index, value) {
			dataIn.append(index,  value);
			dataInStr = dataInStr + dataSep + index + "=" + value;dataSep="&";
		});



		if($(this).data('delete')!=undefined){
			if($(this).data('delete')=='true'){
				if(!confirm("Esta seguro de Eliminar el Registro"))
					return false;
			}else{
				if(!confirm($(this).data('delete')))
					return false;
			}
		}

		//reviso si hay informacion de otros formularios que enviar
		var addForm = $(this).data('add-form');
		if (typeof addForm !== typeof undefined && addForm !== false) {
			$.each(addForm.split(","), function(index, value) {
				var poData = jQuery($( value ).serializeArray());
				for (var i=0; i<poData.length; i++){
					dataIn.append(poData[i].name, poData[i].value);
					dataInStr = dataInStr + dataSep + poData[i].name + "=" + poData[i].value;dataSep="&";
				}
			});
		}

		if(dataAjax!=false){
			jQuery.callAjax(dataIn,action,$(this));
			event.preventDefault();
		}else{
			event.preventDefault();
			$tmpForm = $("<form></form>");
			$tmpForm.attr('action',action).attr('method','POST');
			if($(this).data('new')!=undefined){
				$tmpForm.attr('target','_blank');

				if($(this).data('eval')!== undefined){
					eval($(this).data('eval'));
				}
			}

			if(dataInStr!=""){
				dataTmp=dataInStr.split('&');
				$.each(dataTmp, function(i, val){
					dataTmpInput=val.split('=');
					$tmpForm.append('<input type="hidden" name="'+dataTmpInput[0]+'" value="'+dataTmpInput[1]+'"/>');
				});
			}
			$tmpForm.submit();
		}

	});


	$(document).on('submit', 'form', function(event){
		if($(this).data('type')=='ajax'){
			//serializo los inputs del formulario a enviar
			var dataIn	= new FormData($( this )[0]);

			//reviso si hay informacion de otros formularios que enviar
			var addForm = $(this).data('add-form');
			if (typeof addForm !== typeof undefined && addForm !== false) {
				$.each(addForm.split(","), function(index, value) {

					var poData = jQuery($( value ).serializeArray());
					for (var i=0; i<poData.length; i++)
						dataIn.append(poData[i].name, poData[i].value);
				});
			}

			var action	= $( this ).attr('action');
			var getValues = action.split('?');
			if(getValues[1]!== typeof undefined){
				var poData = unserialize(getValues[1]);
				$.each(poData, function(index, value) {
					dataIn.append(index,  value);
				});
			}

			jQuery.callAjax(dataIn,action,$(this));
			event.preventDefault();
		}
	});


	jQuery.callAjax = function(dataIn, action, parent) {

		// callName: nombre de la llamada manejar el ajaxComplete en cualquier lado
		// dejamos el id ó el atributo data-callName
		// si no tiene ninguno definido lo dejamos como string vacio
		var callName = "";
		if(parent.data('callname')!== undefined)
			callName = parent.data('callname');
		else if(parent.attr('id')!== undefined)
			callName = parent.attr("id");

        var objRet;
		if (typeof NProgress !== "undefined" && NProgress != null)
			NProgress.start();
		$.ajax({
			type		: 'POST',
			url			: action,
			data		: dataIn,
      		processData	: false,
      		contentType	: false,
			dataType	: 'json',
			cache 		: false,
			callName	: callName,
			error: function (request,error) {
				alertify.error('* Error inesperado, intente nuevamente.');
				if (typeof NProgress !== "undefined" && NProgress != null)
					NProgress.done();
			},
			success: function(results){
				$.each(results, function(ind, result) {

					if(result.type=='socket'){
						if (typeof socket !== "undefined" && socket != null){
							$.each(result.sockets, function(index, value) {
								socket.emit('message',value);
							});
						}
					}

					if(result.type=='newWin'){
						newpage = result.win;
						params  = 'width='+screen.width;
						params += ', height='+screen.height;
						params += ', top=0, left=0'
						params += ', fullscreen=yes,';
						window.open(result.name, result.name, params+' resizable=no, scrollbars=yes, toolbar=no, menubar=no, location=no, directories=no, status=no');
					}

					if(result.type=='redir'){
						window.location.href = result.redir;
					}

					if(result.type=='errorForm'){

						$( "p[id$='-error']" ).html( "" );
						$.each(result.data, function(index, value) {

							var input = value[0];
							$("#"+input+"-error").html("");
							var msg = value[1];
							$("#"+input+"-error").html("*"+msg);

						});
					}

					if(result.type=='render') {
						$.each(result.renders, function (index, value) {
							//console.log(parent.data('scroll'));
							if (parent.prop('tagName') == 'FORM' && parent.data('scroll') !== undefined && parent.data('scroll') == 'append') {
								$('#' + index).append(value);
							} else {
								$('#' + index).html(value);
							}

						});
					}

					if(result.type=='renderappend') {
						$.each(result.renders, function (index, value) {
							$('#' + index).append(value);
						});

					}

					if(result.type=='msg'){
						$.each(result.msgs, function(index, value) {
							 //$.bootstrapGrowl(value, { type: index, align: 'center',width: 'auto' });

							if( index == "warning" )
								alertify.warning(value);
							else if( index == "success" )
								alertify.success(value);
							else if( index == "danger" )
								alertify.error(value);
							else
								alertify.log(value);

							//console.log(index +' '+ value);
						});
					}

					if(result.type=='data') {
						var key = Object.keys(result.dataview)[0];
						var value = result.dataview[key];
						eval(key +" = '"+ value +"';");
					}

					if(result.type=='dataSelect'){

						//puede ser llamado por un Form o un select
						var pTmp;
						var slc;

						//Eliminamos los valores previos
						$.each(result.renders, function(indice, valor){
							pTmp = $("#"+indice);
							pTmp.find("option").remove();
						});

						//renderizamos las opciones
						//se recorren todos los renders
						$.each(result.renders, function(indice, valor){

							slc 	=	valor.selected;

							//se recorren los valores para cada render
							$.each(valor.data, function(option_key, option_value) {
								// creamos el objeto <option>
								var option = jQuery('<option />', {
									value: option_key,
									text: option_value
								});

								// indicamos si uno las opciones es seleccionada por defecto
								if (typeof slc !== undefined && slc != null && slc == option_value) {
									option.attr('selected', true);
								}

								// añadimos la opcion al select
								pTmp = $("#" + indice);
								option.appendTo(pTmp);
							});
						});


						//Actualizamos si son chosen select
						$.each(result.renders, function(indice, valor){
							pTmp = $("#"+indice);
							if(pTmp.hasClass('chosen-select')){
								pTmp.trigger("chosen:updated");
							}
						});

					}

					if(result.type=='swal') {


						$.each(result.renders, function(index, value) {

							if(typeof value.config.title === "undefined") {
								value.config.title = "";
							}

							if(typeof value.config.timer === "undefined") {
								value.config.timer = null;
							}

							if(typeof value.html === "undefined") {
								value.config.html = null;
							}


							swal({
								type: index,
								showConfirmButton: false,
								showCancelButton: false,
								title: value.config.title,
								timer: value.config.timer,
								html: value.html
							}).done();

						});

					}


					if(result.type=='json') {

						$.each(result.datajson, function(index, value) {
							var evalstr = index + " = ";
							evalstr += JSON.stringify(value);

							eval(evalstr);

						});

					}

					if(result.type=='dataForm') {
						$.each(result.data, function(index, value) {

							$("#" + index).val(value);

						});
					}

				});

			},
			complete: function(xhr,status){
				if (typeof NProgress !== "undefined" && NProgress != null)
					NProgress.done();
				if(parent.data('eval')!== undefined){
					eval(parent.data('eval'));
					//var fn = new Function(parent.data('eval'));
					//console.log(parent.data('eval')+':'+fn() !== undefined); // true, strict mode
				}

				//TODO, config especiales no se si tendre que sacarlas y colocarlas en un mejor lugar
				if(parent.data('scroll')!==undefined)
					parent.data('scroll','true');
				scrollAddData = true;
			}
        });
		return objRet;
	}

	function unserialize(str) {
	  str = decodeURIComponent(str);
	  var chunks = str.split('&'),
	      obj = {};
	  for(var c=0; c < chunks.length; c++) {
	    var split = chunks[c].split('=', 2);
	    obj[split[0]] = split[1];
	  }
	  return obj;
	}

	if (typeof socket !== "undefined" && socket != null){
		socket.on('message', function (msg) {
			eval(msg);
		});
	}


    /* Scroll submit*/
    if(formScroll!==undefined && formScroll != null){
        $(window).scroll(function() {
			//console.log(($(window).scrollTop() + $(window).height() > ($(document).height()-300)) + ' - ' + scrollAddData);
            if(($(window).scrollTop() + $(window).height() > $(document).height() - 300) && scrollAddData){//TODO, esto es necesario para no hacerlo muchas veces----> && PF.obj.listing.calling == false) {
				scrollAddData = false;
				formScroll.data('scroll','append');
				if(formScroll.data('scroll-fnc')!==undefined){
					eval(formScroll.data('scroll-fnc')+'()');
				}
				formScroll.submit();
            }
        });
    }
});
