$(document).ready(function(){

   $(document).on('click', '.btn-order', function () {

       var patient = $("#patient").data("patient");
       var method = $(this).attr("method");
   

       if(method == "up") {
           $(this).attr("method", "down");
       }
       else {

           $(this).attr("method", "up");
       }

       var order = $(this).data("order");
       var action = $(this).data("url");

       var dataIn  = new FormData();
       dataIn.append("patient", patient);
       dataIn.append("order", order);
       dataIn.append("method", method);


       //mifaces
       $.callAjax(dataIn, action, $(this));

   });


    $(document).on('click', '.btn-aprobar-swal', function () {

        var action = $(this).data("url");
        var budget = $(this).data("budget");


        var dataIn  = new FormData();
        dataIn.append("budget", budget);


        //mifaces
        $.callAjax(dataIn, action, $(this));
    });


   // Levantar Modal Detalles Presupuesto

   $(document).on("click", ".budget-details", function(){

       var action = $(this).data("url");
       var budget = $(this).data("budget");

       var dataIn = new FormData();
       dataIn.append("budget",budget);

       //mifaces
       $.callAjax(dataIn, action, $(this));

   });

   // Levantar Modal Nuevo Presupuesto

   $(document).on("click", ".new-budget", function(e){

       var action = $(this).data("url");

       var dataIn = new FormData();

       //mifaces
       $.callAjax(dataIn, action, $(this));

       e.preventDefault();

   });


    $(document).on('click', '#btn-confirmar-aprobar-swal', function () {

        var action = $(this).data("url");
        var budget = $(this).data("budget");
        var patient = $("#patient").data("patient");


        var dataIn  = new FormData();
        dataIn.append("budget", budget);
        dataIn.append("patient", patient);


        //mifaces
        $.callAjax(dataIn, action, $(this));
    });




    // Levantar Modal Detalles Prefactura

   $(document).on("click", ".prebill-details", function(){

       var action = $(this).data("url");
       var prebill_id = $(this).data("prebill");

       var dataIn = new FormData();

       dataIn.append("prebill_id", prebill_id)
       //mifaces
       $.callAjax(dataIn, action, $(this));

   });

    // Levantar Modal Nueva Prefactura

   $(document).on("click", ".new-prebill", function(){

        var action = $(this).data("url");
        var patient = $("#patient").data("patient");

        var dataIn = new FormData();
        dataIn.append("patient", patient);
        //mifaces
        $.callAjax(dataIn, action, $(this));

   });

  // Levantar Modal Detalles Admisión

   $(document).on("click", ".admission-details", function(){

        var action = $(this).data("url");
        var patient_id = $("#patient").data("patient");
        var admission_id = $(this).data("admission");

        var dataIn = new FormData();
        dataIn.append("patient_id", patient_id);
        dataIn.append("admission_id", admission_id);

        //mifaces
        $.callAjax(dataIn, action, $(this));

   });

   // Levantar Wizard Nueva Admisión

   $(document).on("click", ".new-admission", function(){

       var action = $(this).data("url");
       var patient = $("#patient").data("patient");

       var dataIn = new FormData();


        dataIn.append("patient", patient);

       //mifaces
       $.callAjax(dataIn, action, $(this));

   });

    // Redirigir desde Wizzard

   $(document).on("click", "#surgery-back", function(){
       var id = $('#patient').data('patient');
       var url = $(this).data("url")+id;
       $(location).attr("href", url);
   });



   // ================ Wizzard ========================== //

    //Initialize progress-bar size
    var barSize = 0;

    //Wizard
    $(document).on('show.bs.tab', '.a[data-toggle="tab"]', function(e){

        var $target = $(e.target);

        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(document).on('click', '.next-step', function(e){

        if(!($(this).hasClass("disabled"))) {

            var $active = $('.wizard .nav-tabs li.active');

            $active.removeClass("prev").addClass("prev");

            nextTab($active);
            if ($('.tab-pane').length - 1 != 0)
                barSize = barSize + Math.floor(100 / ($('.tab-pane').length - 1));
            else
                barSize = 100;
            $('.progress-bar').attr('style', 'width:' + barSize + '%');

            $('.wizard .nav-tabs li').not('.active').addClass('disabled');
            $('.wizard .nav li').not('.active').find('a').removeAttr("data-toggle");
        }

    });

    $(document).on('click', '.prev-step', function(e){

        if(!($(this).hasClass("disabled"))) {
            var $active = $('.wizard .nav-tabs li.active');

            $active.removeClass("prev");

            prevTab($active);
            if ($('.tab-pane').length - 1 != 0)
                barSize = barSize - Math.floor(100 / ($('.tab-pane').length - 1));
            else
                barSize = 0;

            $('.progress-bar').attr('style', 'width:' + barSize + '%');

            $('.wizard .nav-tabs li').not('.active').addClass('disabled');
            $('.wizard .nav li').not('.active').find('a').removeAttr("data-toggle");
        }
    });


    $(document).on('click', '#desc-apply', function(){
        $('#presupuesto-error').html('');

        var descuento = $('#descuento').val();
        var subtotal = $(this).data('total');
        var total = subtotal - descuento;

        if(descuento >= subtotal){

          $('#presupuesto-error').html('* Descuento no Válido.');
          $('#tbody-budget-total tr td:last-child').html("$ 0");
          $('#descuento').val('0');

        }else{

          $('#tbody-budget-total tr td:last-child').html("$ "+ $.priceFormat(total));
          $('#descuento').attr('data-descuento', descuento);
          $(this).attr('data-total', total);

        }

    });



    $(document).on('change', '#procedures', function(e){
        
        $('#create-newBudget').removeClass('disabled');

        var id = $(this).val();
        var action = $(this).data("url");

        var dataIn = new FormData();
        dataIn.append("id",id);

        //mifaces
        $.callAjax(dataIn, action, $(this));

        e.preventDefault();
    });



    $(document).on('click', '#desc-apply', function(){

        var descuento = $('#descuento').val();
        var subtotal = $(this).data('total');
        var total = subtotal - descuento;

        if(descuento >= subtotal){
          $('#presupuesto-error').html('* Descuento no Válido.');
          $('#tbody-budget-total tr td:last-child').html("$ 0");
          $('#descuento').val('0');
        }else{
          $('#tbody-budget-total tr td:last-child').html("$ "+$.priceFormat(total));
          $('#descuento').attr('data-descuento',descuento);
        }

    });

     $(document).on('focus', '#descuento', function(){
        $('#presupuesto-error').html('');
     });

        
    $(document).on('click', '#create-newBudget', function(e){

        var procedure_id = $('#procedures').val();
        var action = $(this).data("url");
        var subtotal = $('#desc-apply').data('total');      
        var descuento = $('#descuento').val();
        var patient_id = $('#patient').data('patient');
        var specialist_id = $('#specialists').val();

        var elem = $(this);
        
        if(specialist_id == 0){

           $('#presupuesto-error').html('* Debe Seleccionar un Especialista.');

        }else{

           var dataIn = new FormData();

           dataIn.append("patient_id", patient_id);
           dataIn.append("procedure_id", procedure_id);
           dataIn.append("subtotal",subtotal);
           dataIn.append("descuento",descuento);
           dataIn.append("specialist_id",specialist_id);

           swal({
             title: '¿Desea Crear Presupuesto?',
             text: "Asegurese de verificar la información.",
             type: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#53ac53',
             cancelButtonColor: '#29b6d8',
             confirmButtonText: 'Aceptar',
             cancelButtonText: 'Cancelar'
           }).then(function() {
             //mifaces
             $.callAjax(dataIn, action, elem);
           }).done();  
        }

        e.preventDefault();

    });

    $(document).on('change', '#approve_consent',function(){

        var state = $(this).is(':checked');

        if(state == true){
            $('#persist_admission').removeAttr('disabled');
            $('#persist_admission').attr('data-consent',1);
        }else{
            $('#persist_admission').attr('disabled','disabled');
            $('#persist_admission').attr('data-consent',0);
        }
    });


    $(document).on('click', '#get-calendar', function () {

        var action = $(this).data("url");

        var dataIn = new FormData();

        /** solo de test **/
        var arr = [];

        $(".rol-1").each(function() {

            var idselect = $(this).attr('id');
            var user  = $("#"+idselect+" option:selected").attr('data-id');
            arr.push( user );
        });


        for (var i = 0; i < arr.length; i++) {

            dataIn.append('specialists[]', arr[i]);
        }


        //mifaces
        $.callAjax(dataIn, action, $(this));

    });

    $(document).on('change', '#datepicker', function () {

        var action = $(this).data("url");

        var dataIn = new FormData();
        dataIn.append('date', $(this).val());
        /** solo de test **/
        var arr = [];

        $(".rol-1").each(function() {

            var idselect = $(this).attr('id');
            var user  = $("#"+idselect+" option:selected").attr('data-id');
            arr.push( user );
        });


        for (var i = 0; i < arr.length; i++) {

            dataIn.append('specialists[]', arr[i]);
        }


        //mifaces
        $.callAjax(dataIn, action, $(this));

    });


    $(document).on('click', '#print-stimate-noajax', function () {

        var patient = $("#print-div").data("patient");
        var rut = $("#print-div").data("rut");

        var htmlextra = "";
        htmlextra += "<div class='text-center font-lg themed-bg-primary'>PRESUPUESTO DE CIRUGÍA</div>"
        htmlextra += "<h3 class='themed-color-default'>Nombre: "+patient+"</h3>";
        htmlextra += "<h4 class='themed-color-default'>RUT: "+rut+"</h4>";

        PrintElem("print-div", htmlextra);


    });


 
         
    $(document).on('change', '#specialists', function(){
        $('#presupuesto-error').html('');
    });
  
    /* Procedimientos Post Ajax Call */
    $(document).ajaxComplete(function(event,xhr,options){


        if(options.callName != null )
        {
            if(options.callName == "budget-details") {
                modalBudgetDetails();
            }

            if(options.callName == "new-budget") {
                modalNewBudget();
                App.init();
            }

            if(options.callName == "create-newBudget") {
                hideModalNewBudget(); 
            }

            if(options.callName == "new-prebill") {
                wizardSettings();
            }

            if(options.callName == "prebill-details") {
                modalPreBillDetails();
            }

             if(options.callName == "admission-details") {
                modalAdmissionDetails();
            }

             if(options.callName == "new-admission") {
                wizardSettings();
            }

           
        }

    });

    function nextTab(elem) {
        $(elem).next('li').find('a').attr("data-toggle","tab").click();
    }

    function prevTab(elem) {
        $(elem).prev('li').find('a').attr("data-toggle","tab").click();
    }

    function modalBudgetDetails(){
        $("#budget_details").modal();
    }

    function modalNewBudget(){
       $("#budget_modal").modal();
    }

    function hideModalNewBudget(){
       $("#budget_modal").modal('hide');
    }

    function modalPreBillDetails(){
        $("#prebill_details").modal();
    }

     function modalAdmissionDetails(){
         $("#admission_details").modal();
    }

    function wizardSettings(){
        //INICIAMOS CONFIG DE WIZARD UI
        App.init();
    }




});

function PrintElem(divName, extra) {

    var printContents = document.getElementById(divName).innerHTML;

    var allLinks = $('head').clone().find('script').remove().end().html();
    var keepColors = '<style>body {-webkit-print-color-adjust: exact !important; }</style>';


    var win = window.open("", "Title", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=780, height=200, top="+(screen.height-400)+", left="+(screen.width-840));

    win.document.write('<html><head>' + keepColors + allLinks + '</head><body onload="window.print()">' + extra + printContents + '</body></html>');

    win.print();


}