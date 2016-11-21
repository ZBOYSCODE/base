$(document).ready(function(){

	$(document).on('change', '#prefacturas_aprobadas', function(){

		var id = $(this).val();


		var dataIn = new FormData();

        dataIn.append("preinvoice_id",  id);

		//getInfoPrefactura(id);

		var url = $('#url').val();

		$.callAjax(dataIn, url+'/getDataPreinvoice', $(this));


        if($(this).val() === "")
            $('#get-consent').attr('disabled','disabled');
        else
            $('#get-consent').removeAttr('disabled');


	});

	$(document).on('click', '#persist_admission', function(){

        var attr = $(this).attr("disabled");

        if(!(typeof attr !== typeof undefined && attr !== false)) {

    		var preinvoice_id = $("#prefacturas_aprobadas").val();

    		if (preinvoice_id == ''){

				alertify.error("Debe seleccionar una prefactura");

    		} else {

                var patient_id = $('#patient').data('patient');
                var consent = $(this).data('consent');
               
    			var dataIn = new FormData();

    	        dataIn.append("preinvoice_id",  preinvoice_id);
    	        dataIn.append("consent",  		consent);
                dataIn.append("patient_id", patient_id);

    			var url = $('#url').val();

    			$.callAjax(dataIn, url+'/createAdmission', $(this));

    		}

    	}
    });
		
});