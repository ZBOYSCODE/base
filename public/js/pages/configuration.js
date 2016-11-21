 /* Preview variables LoadPreview Settings */

 var status ="";
 var days ={};
 var hours ={};

 var error_configuracion = "false";
 var error_valida = "false";

$(document).on('ready', function() {


    $(document).on('click', '.configurar', function () {
        
        var id = $(this).data("id");
        var action = $(this).data("url");

        var dataIn  = new FormData();
        dataIn.append("id", id);

        //mifaces
        $.callAjax(dataIn, action, $(this));

    });

    /*Crear Configuración*/
    $(document).on('click', '#new-configuration', function (e) {
      
      var since_date = new Date($('#since').val());
      var until_date = new Date($('#until').val());
      var start_time = $('#hora_Inicio').val();
      var finish_time = $('#hora_Fin').val();
      var split_st = start_time.split(':');
      var total_st = (split_st[0]*60 + split_st[1])* 60;
      var split_ft = finish_time.split(':');
      var total_ft = (split_ft[0]*60 + split_ft[1])* 60;

      if(since_date.getTime() > until_date.getTime()){
        $('#since_date-error').html('*Esta fecha debe ser menor a la siguiente.');
      }

      else if(total_st >= total_ft){
        $('#finish_time-error').html('*Esta hora debe ser mayor a la anterior.');
      }
      
      else{

      	var action = $(this).data("url");
        var specialist_id = $("#specialist-selected").data("specialist")
        var usb_id = $("#specialist-selected").data("usb")

        var dataIn  = new FormData($('#configuration_Form')[0]);
        dataIn.append("specialist_id",specialist_id);
        dataIn.append("usb_id",usb_id);
          //mifaces
        $.callAjax(dataIn, action, $(this)); 
      }

      e.preventDefault();

    });


    $(document).on('click', '.radio-check-label', function () {
       $("#days-error").html("");
    });


    $(document).on('click', '#add-Restriccion', function (e) {
        e.preventDefault();
    });


    $(document).on('click', '#preview-configuration', function (e) {
     
        var since_date = new Date($('#since').val());
        var until_date = new Date($('#until').val());
        var start_time = $('#hora_Inicio').val();
        var finish_time = $('#hora_Fin').val();
        var split_st = start_time.split(':');
        var total_st = (split_st[0]*60 + split_st[1])* 60;
        var split_ft = finish_time.split(':');
        var total_ft = (split_ft[0]*60 + split_ft[1])* 60;

        if(since_date.getTime() > until_date.getTime()){
          $('#since_date-error').html('*Esta fecha debe ser menor a la siguiente.');
        }

        else if(total_st >= total_ft){
          $('#finish_time-error').html('*Esta hora debe ser mayor a la anterior.');
        }
        
        else{
          var action = $(this).data("url");
          var dataIn  = new FormData($('#configuration_Form')[0]);
          //mifaces
          $.callAjax(dataIn, action, $(this)); 
        }
         e.preventDefault();

     });


    $(document).on('click', '.delete-configuration', function () {
        
        var id = $(this).data('id');
        var action = $(this).data('url');  
        var specialist_id = $("#specialist-selected").data("specialist");
        var usb_id = $("#specialist-selected").data("usb");

        var dataIn  = new FormData();

        dataIn.append("specialist_id",specialist_id);
        dataIn.append("usb_id",usb_id);
        dataIn.append("id", id);

        swal({
            title: '¿Desea Eliminar la Configuración?',
            text: "Esta acción es irreversible.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f18c9e',
            cancelButtonColor: '#0bacd3',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then(function(){          
            $.callAjax(dataIn, action, $(this));           
        }).done();
    });


    $(document).on('change', '#hora_Fin', function () {
      $('#finish_time-error').html('');
    });


    $(document).on('focus', '#since', function () {
      $('#since_date-error').html('');
    });


    $(document).on('click', '#hide-preview', function (e) {
        $("#configuration_collapse").collapse('show');
        $("#preview").collapse('hide');
        $("#preview-configuration").removeAttr('disabled');
        $('#hours_List tbody').html("");
        $('.preview-days > ul > li.active').removeClass('active');
        e.preventDefault();
    });

    $(document).on('click', '.configurar_examenes', function () {
        
        var action = $(this).data("url");

        var dataIn  = new FormData();

        //mifaces
        $.callAjax(dataIn, action, $(this));

    });

    $(document).on('click', '#add-Exam', function (e) {

        var action = $(this).data("url");
        var id_append = $('#new_exam_inputs div.box-append:last').data('id');
        
        var dataIn  = new FormData();
        dataIn.append('id_append',id_append);

        //mifaces
        $.callAjax(dataIn, action, $(this));  

        e.preventDefault(); 
    });
    

    function modalconfigurar(){
      $("#configuration_modal").modal();
      $("#since").datepicker();
      $("#until").datepicker();
      $('#hora_Inicio').timepicker();
      $('#hora_Fin').timepicker();
      $('#hora_Restrict_Inicio').timepicker();
      $('#hora_Restrict_Fin').timepicker();
    }

    function loadPreviewSettings(){

        $(".days-error").html("");   

        if(status == "1"){
            status = "";
            swal('¡Operación Fallida!',
                'Revise que los datos sean correctos.',
                'error').done();
        }else{
            if (status == "2") {
                status = "";
                $("#preview-configuration").attr('disabled','disabled');
                $("#configuration_collapse").collapse('hide');
                $("#preview").collapse('show');

                $.each(days, function( i, val ){
                  $('#preview_day'+val+'').addClass('active');
                });

                $.each(hours, function( i, val ){
                  $('#hours_List tbody').append("<tr><td>"+val+"</td></tr>");
                });
               
            }else{
                if (status == "3") {
                    $("#days-error").html("*Debe Seleccionar al menos un día.");
                }
                status = "";
            }
        }    
    }

    $(document).on('change', "#config-branchoffice", function () {

        var branchoffice = $(this).val();
        var action = $(this).data('url');


        var dataIn  = new FormData();

        dataIn.append("branchoffice",branchoffice);

        $.callAjax(dataIn, action, $(this));

    });


    $(document).on('change', "#especialidad", function () {

        var branchoffice = $("#config-branchoffice").val();
        var speciality = $(this).val();
        var action = $(this).data('url');


        var dataIn  = new FormData();

        dataIn.append("branchoffice",branchoffice);
        dataIn.append("speciality",speciality);

        $.callAjax(dataIn, action, $(this));

    });


    $(document).on('click', "#seleccionar-usb-config", function () {

        var usb = $("#especialista").val();
        var action = $(this).data('url');

        var dataIn  = new FormData();

        dataIn.append("usb",usb);

        $.callAjax(dataIn, action, $(this));
    });

    $(document).on('click', "#remove-Exam", function (e) {
        
        var item = $(this).closest('div.row');

        item.addClass('fadeOut');

        item.delay(2000, function() {
            $(this).remove();
        });

        e.preventDefault();
    });


    /*Crear Configuración*/
    $(document).on('click', '#new-configuration-exam', function (e) {

        var action = $(this).data("url");
        var specialist_id = $("#specialist-selected").data("specialist")
        var usb_id = $("#specialist-selected").data("usb")
        var dataIn  = new FormData($('#configuration_Form')[0]);


        $('[id^="examenes-"]').each(function() {

            dataIn.append("exams[]",$(this).val());

        });        

        $('[id^="time-"]').each(function() {

            dataIn.append("time[]",$(this).val());

        });               

        dataIn.append("specialist_id",specialist_id);
        dataIn.append("usb_id",usb_id);

          //mifaces
        $.callAjax(dataIn, action, $(this)); 

        e.preventDefault();        

    });    


    /*Crear Configuración*/
    $(document).on('click', '#btn-conflict-exam', function (e) {

        var action = $(this).data("url");
        var specialist_id = $("#specialist-selected").data("specialist")
        var usb_id = $("#specialist-selected").data("usb")
        var dataIn  = new FormData($('#configuration_Form')[0]);


        $('[id^="examenes-"]').each(function() {

            dataIn.append("exams[]",$(this).val());

        });        

        $('[id^="time-"]').each(function() {

            dataIn.append("time[]",$(this).val());

        });               

        dataIn.append("specialist_id",specialist_id);
        dataIn.append("usb_id",usb_id);

          //mifaces
        $.callAjax(dataIn, action, $(this)); 

        e.preventDefault();        

    });       


    /* Procedimientos Post Ajax Call */
    $(document).ajaxComplete(function(event,xhr,options){

        if(options.callName != null )
        {
            if(options.callName == "configurar"){
                modalconfigurar();
                $("#configuration_collapse").collapse('show');
                $(window.App.init);
            }

            if (options.callName == "preview-configuration") {
                loadPreviewSettings();
            }

            if (options.callName == "new-configuration") {
                newConfiguration();
            }

            if (options.callName == "exist-configuration") {
                existConfiguration();
            }

            if (options.callName == "exist-configuration-exam") {
                existConfigurationExam();
            }            

            if (options.callName == "conflict-exam") {
                setConfigurationExam();
            }                        

            if (options.callName == "configurar_examenes") {
                modalconfigurarexamenes();
                $("#configuration_collapse").collapse('show');
                $(window.App.init);
            }

            if (options.callName == "box-append") {
                $('.hora').timepicker();
                $(window.App.init);
            }
            
        }

    });

});



 /**
  * Metodos custom
  */

function modalconfigurarexamenes(){
    $("#exam_configuration_modal").modal();
    $("#since").datepicker();
    $("#until").datepicker();
    $('#hora').timepicker();
}

function modalconfigurar(){
    $("#configuration_modal").modal();
    $("#since").datepicker();
    $("#until").datepicker();
    $('#hora_Inicio').timepicker();
    $('#hora_Fin').timepicker();
    $('#hora_Restrict_Inicio').timepicker();
    $('#hora_Restrict_Fin').timepicker();
 }

 function loadPreviewSettings(){

     $(".days-error").html("");

     if(status == "1"){
         status = "";
         swal('¡Operación Fallida!',
             'Revise que los datos sean correctos.',
             'error').done();
     }else{
         if (status == "2") {
             status = "";
             $("#preview-configuration").attr('disabled','disabled');
             $("#configuration_collapse").collapse('hide');
             $("#preview").collapse('show');

             $.each(days, function( i, val ){
                 $('#preview_day'+val+'').addClass('active');
             });

             $.each(hours, function( i, val ){
                 $('#hours_List tbody').append("<tr><td>"+val+"</td></tr>");
             });

         }else{
             if (status == "3") {
                 $("#days-error").html("*Debe Seleccionar al menos un día.");
             }
             status = "";
         }
     }
 }

function setConfiguration(){

     var base_url = $("#configuration_Form").data("base-url");

     var action = base_url+"configuracion/setconfiguration";
     var specialist_id = $("#specialist-selected").data("specialist")
     var usb_id = $("#specialist-selected").data("usb")

     var dataIn  = new FormData($('#configuration_Form')[0]);
     dataIn.append("specialist_id",specialist_id);
     dataIn.append("usb_id",usb_id);
     //mifaces
     $.callAjax(dataIn, action, $("#new-configuration"));
 }

 function existConfiguration(){

    if(error_configuracion == "true"){

        $('#configuration_modal').modal('hide');
        error_configuracion = "false";
        return;

    }


     $(".days-error").html("");

     if(status == "1"){
         status = "";

         swal({
             title: '¡Configuración con tope de turno!',
             text: "¿Desea crearla de todas maneras?",
             type: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#739e73',
             cancelButtonColor: '#0bacd3',
             confirmButtonText: 'Aceptar',
             cancelButtonText: 'Cancelar'
         }).then(function(){
             setConfiguration();
         }).done();
     }

     else if(status == "2"){
         setConfiguration();
     }

     else if(status == "3"){
         $("#days-error").html("*Debe Seleccionar al menos un día.");
         status = "";
     }

     else if(status == "0"){
         status = "";
         swal('¡Operación Fallida!',
             'Revise que los datos sean correctos.',
             'error').done();
     }

 }

 function existConfigurationExam(){

    if(error_valida == "true"){
        $("#exam_configuration_modal").modal('hide');
        error_valida = "false";
    }

 }


 function setConfigurationExam(){

    if(error_valida == "true"){
        $("#exam_configuration_modal").modal('hide');
        swal.closeModal();
        error_valida = "false";
    }

 }