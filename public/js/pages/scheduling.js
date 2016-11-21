var view_type    = "diaria";
var selected_doc = 0;

var error_valida    = false;
var error_schedule  = "false";
var error_confirm   = "false";
var error_overcrowd = "false";
var error_examen    = "false";

$(document).on('ready', function() {


    var select_turn = null;


    $('.money').mask('000.000.000.000.000', {reverse: true});

    /* interaccion con widget doctores */
    $(document).on('click', ".doctor", function() {

        var status = "undefined";


        if($(this).hasClass("hovered")) {
             status = "selected";
        }

        $(".doctor").removeClass("hovered");
        $(".doctor").removeClass("themed-lighter-2");



        if(status == "undefined") {
            $(this).addClass("hovered");
            $(this).addClass("themed-lighter-2");
        }

        var id_especialista = $(this).attr("id");

        selected_doc = $(this).attr("data-usb");


        $("#doc_selected").val(id_especialista);


        if(view_type == "diaria") {

            daily_filter_turns_by_specialist(id_especialista, status);

        }

        else if(view_type == "semanal") {
            //mifaces para traer el calendario semanal completo

            var date = $("#fecha").val();
            var usb = $(this).data("usb");
            var action = $(this).data("url");

            var dataIn	= new FormData();

            dataIn.append("date",  date);
            dataIn.append("usb",  usb);

            $.callAjax(dataIn,action,$(this));
        }
    });

  
    /* muestra bubble escondida al entrar a la clase */
    $(document).on('mouseenter', '.bubbleTrigger' , function() {
        $("div[id^='bubble-']").hide();

        var toShow = $(this).data("target");
        var bubble = $(toShow);
         $(toShow).css({"display": "block"});


        /*
        if(checkVisible(bubble) == false){

           $(toShow).removeClass("viewPort-Left");
           $(toShow).removeClass("viewPort-Right").addClass("viewPort-Right");
        }
        */
       
    });


    /* cierra el bubble al quitar el mouse, solo si no hay select focuseados */
    $(document).on('mouseleave', '.bubbleTrigger' , function() {
        var toHide = $($(this).data("target"));
        var any_selected = false;

        $('.chosen-container', $(this)).each(function () {
            if($(this).hasClass("chosen-container-active")) {
                any_selected = true;
            }
        });

        if(!any_selected)
            toHide.hide();

    });


    $(document).on('click', '#dia', function () {

        var fecha = $("#fecha").val();
        var specialty = $("#especialidad").val();
        var action = $(this).data("url");

        var dataIn	= new FormData();

        dataIn.append("date",  fecha);
        dataIn.append("specialty",  specialty);


        //mifaces
        $.callAjax(dataIn, action, $(this));

    });


    $(document).on('click', '#semana', function () {

        var fecha = $("#fecha").val();
        var specialty = $("#especialidad").val();
        var specialist = $("")
        var action = $(this).data("url");

        var dataIn	= new FormData();

        dataIn.append("date",  fecha);
        dataIn.append("usb", selected_doc);
        dataIn.append("specialty",  specialty);



        //mifaces
        $.callAjax(dataIn, action, $(this));

    });


    $(document).on('click', '.agendar', function () {

        // id especialista
        var especialista = $(this).parent().parent().attr('data-especialista');
        selected_doc =  $(".profesionales > #"+especialista).attr('data-usb');

       
        var id = $(this).data("id");
        
        var action = $(this).data("url");

        var dataIn  = new FormData();

        dataIn.append("id", id);

        //mifaces
        $.callAjax(dataIn, action, $(this));

    });

    $(document).on('click', '.reagendar', function () {
        
        var id      = $(this).data("id");// TURNO
        var action  = $(this).data("url");

        var datos = {
            'idturn'        : id,
            'select_turn'   : select_turn
        }

        var url = $("#frm").val();

        fun = $.xajax(datos, url+action);

        fun.success(function(data){

            if(data.success) {

                $("#closebtn").trigger('click');

                alertify.success("Reagendamiento exitoso.");

                $("#datepicker").trigger('change');

                select_turn = null;

            } else {


                alertify.error("Error al reagendar.");

            }

        });

    });


    $(document).on('click', '.confirmar', function () {

        var especialista = $(this).parent().parent().attr('data-especialista');
        selected_doc =  $(".profesionales > #"+especialista).attr('data-usb');

        var id = $(this).data("id");
        var action = $(this).data("url");
        var dataIn  = new FormData();

        dataIn.append("id", id);
        dataIn.append("specialist", $("#doc_selected").val());

        //mifaces
        $.callAjax(dataIn, action, $(this));

    });


     $(document).on('click', '.recepcionar', function () {

        var especialista = $(this).parent().parent().attr('data-especialista');
        selected_doc =  $(".profesionales > #"+especialista).attr('data-usb');

        var id = $(this).data("id");
        
        var action = $(this).data("url");

        var dataIn  = new FormData();

        dataIn.append("id", id);

        //mifaces
        $.callAjax(dataIn, action, $(this));

    });


    $(document).on('click', '.pagar', function () {

        var especialista = $(this).parent().parent().attr('data-especialista');
        selected_doc =  $(".profesionales > #"+especialista).attr('data-usb');

        var id = $(this).data("id");
        
        var action = $(this).data("url");

        var dataIn  = new FormData();

        dataIn.append("id", id);

        //mifaces
        $.callAjax(dataIn, action, $(this));

    });

    $(document).on('click', '.cancelar-turno', function () {

        var id = $(this).data("id");
        var action = $(this).data("url");
        var specialty = $(this).data("specialty");
        var fecha = $("#fecha").val();

        var dataIn  = new FormData();
        dataIn.append("id", id);
        dataIn.append("specialty", specialty);
        dataIn.append("date", fecha);

        if(view_type == "semanal"){

            dataIn.append("type",  "week");
        }
        else if(view_type == "diaria") {

            dataIn.append("type",  "day");
        }

        //mifaces
        $.callAjax(dataIn, action, $(this));

    });

    $(document).on('click', '.bloquear-turno', function () {

        var id = $(this).data("id");
        var action = $(this).data("url");
        var specialty = $(this).data("specialty");
        var fecha = $("#fecha").val();

        var dataIn  = new FormData();
        dataIn.append("id", id);
        dataIn.append("specialty", specialty);
        dataIn.append("date", fecha);

        if(view_type == "semanal"){

            dataIn.append("type",  "week");
        }
        else if(view_type == "diaria") {

            dataIn.append("type",  "day");
        }

        //mifaces
        $.callAjax(dataIn, action, $(this));

    });


    $(document).on('change', '#datepicker', function () {

        var fecha = $("#fecha").val();
        var specialty = $("#especialidad").val();
        var action = $(this).data("url");

        var dataIn  = new FormData();

        if(view_type == "semanal"){

            dataIn.append("type",  "week");
        }
        else if(view_type == "diaria") {

            dataIn.append("type",  "day");
            dataIn.append("specialty", specialty);
        }

        dataIn.append("date",  fecha);
        dataIn.append("usb",  selected_doc);

        //mifaces
        $.callAjax(dataIn, action, $(this));
    });




    $(document).on('change', '#datepicker_reagendar', function (e) {


        e.preventDefault();

        var specialty = $("#especialidad").val();
        var action = $(this).data("url");

        var dataIn  = new FormData();

        dataIn.append("type",  "day");
        dataIn.append("specialty", specialty);

        dataIn.append("contenedor", 'calendario_reagendar');

        dataIn.append("date",  $(this).val());
        dataIn.append("specialist", $("#doc_selected").val() );

        dataIn.append("usb",  selected_doc);

        //mifaces
        $.callAjax(dataIn, action, $(this));
    });


    $(document).on('change', "#especialidad", function () {

        var speciality = $(this).val();
        var action = $(this).data("url");
        var fecha = $("#fecha").val();

        var dataIn	= new FormData();

        dataIn.append("speciality", speciality);
        dataIn.append("date",  fecha);
        dataIn.append("usb",  selected_doc);

        if(view_type == "semanal"){

            dataIn.append("type",  "week");
        }
        else if(view_type == "diaria") {

            dataIn.append("type",  "day");
            dataIn.append("specialty", speciality);
        }

        //mifaces
        $.callAjax(dataIn, action, $(this));

    });


    $(document).on('click', "#btn-agendar", function () {

        var speciality = $("#especialidad").val();
        var fecha = $("#fecha").val();
        var action = $(this).data("url");



        var dataIn	= new FormData($("#scheduleForm")[0]);

        dataIn.append("specialty",  speciality);
        dataIn.append("date",  fecha);





        if(view_type == "semanal"){

            dataIn.append("type",  "week");
        }
        else if(view_type == "diaria") {

            dataIn.append("type",  "day");
            dataIn.append("specialty", speciality);
        }


        //mifaces
        $.callAjax(dataIn, action, $(this));

    });


    $(document).on('click', "#btn-confirmar", function () {
        var speciality = $("#especialidad").val();
        var fecha = $("#fecha").val();
        var action = $(this).data("url");


        var dataIn	= new FormData($("#confirmForm")[0]);


        dataIn.append("date",  fecha);
        dataIn.append("specialty",  speciality);





        if(view_type == "semanal"){

            dataIn.append("type",  "week");
        }
        else if(view_type == "diaria") {

            dataIn.append("type",  "day");
            dataIn.append("specialty", speciality);
        }

        //mifaces
        $.callAjax(dataIn, action, $(this));


    });


    $(document).on('click', "#btn-recepcionar", function () {
        var speciality = $("#especialidad").val();
        var fecha = $("#fecha").val();
        var action = $(this).data("url");


        var dataIn	= new FormData($("#receptionForm")[0]);


        dataIn.append("date",  fecha);
        dataIn.append("specialty",  speciality);




        if(view_type == "semanal"){

            dataIn.append("type",  "week");
        }
        else if(view_type == "diaria") {

            dataIn.append("type",  "day");
            dataIn.append("specialty", speciality);
        }


        //mifaces
        $.callAjax(dataIn, action, $(this));


    });

    






  



    $(document).on('click', "#btn-pagar", function () {

        var speciality = $("#especialidad").val();
        var fecha = $("#fecha").val();
        var action = $(this).data("url");

        var dataIn = new FormData($("#payForm")[0]);

        dataIn.append("date",  fecha);
        dataIn.append("specialty",  speciality);




        if(view_type == "semanal"){

            dataIn.append("type",  "week");
        }
        else if(view_type == "diaria") {

            dataIn.append("type",  "day");
            dataIn.append("specialty", speciality);
        }


        //mifaces
        $.callAjax(dataIn, action, $(this));


    });


    $(document).on("click", ".category-turn", function () {

        $("#category").val($(this).data("category"));
        $("#motivos").removeClass("hidden").addClass("hidden");
        $("#buscador").removeClass("hidden");

    });




    $(document).on("click", ".reagendar-turno", function () {

        $("#view-confirmar").addClass("hidden");
        $("#view-reagendar").removeClass("hidden");

        select_turn = $(this).data('id');

        $(window.App.init);

    });



    $(document).on("click", '#btn-create-patient', function(){

        $("#buscador").addClass('hidden');
        $("#modal-create-patient").removeClass('hidden');


        $(window.App.init);

    });


    $(document).on("click", ".select-patient", function () {

        $("#user").val($(this).data("user"));
        var action = $(this).data("url");


        var dataIn	= new FormData($("#scheduleForm")[0]);


        //mifaces
        $.callAjax(dataIn, action, $(this));

    });


    $(document).on('keyup', '#input-buscar', function(){
        get_list();
    });


    $(document).on('submit', '#form-busqueda', function(e){
        e.preventDefault();
    });

    $(document).on("click", "#generate-pdf-diaria", function () {

        $("#pdfDailyForm_date").val($("#fecha").val());
        $("#selected_specialty").val($("#especialidad").val());
        
        $("#pdfDailyForm").submit();
    });

    $(document).on('click', '#crear-paciente', function(){


        createPatient();

    });

    $(document).on('click', '#levantar-config-overcrowd', function() {

        var action = $(this).data("url");
        var date = $("#fecha").val();
        var specialty = $("#especialidad").val();


        var dataIn	= new FormData();

        dataIn.append("date", date);
        dataIn.append("specialty", specialty);

        //mifaces
        $.callAjax(dataIn, action, $(this));

    });
    
    $(document).on('click', '#btn-initsobrecupo', function () {

        var action = $(this).data("url");
        var dataIn	= new FormData($("#ovecrowd-form")[0]);

        //mifaces
        $.callAjax(dataIn, action, $(this));
        
    });



    $(document).on('click', '#btn-overcrowdpersist', function () {
        var action = $(this).data("url");
        var specialty = $("#especialidad").val();
        var dataIn	= new FormData($("#scheduleForm")[0]);

        dataIn.append("type",  "day");
        dataIn.append("specialty", specialty);

        //mifaces
        $.callAjax(dataIn, action, $(this));
    });

    $(document).on('click','#closebtnSchedule',function(){

        var action = $(this).data("url");
        var id     = $(this).data("turn");
        var dataIn  = new FormData();


        dataIn.append("id",id);

        //mifaces
        $.callAjax(dataIn, action, $(this));
        
    });


    $(document).on('click', '#agendar-examen', function () {
        var action = $(this).data("url");

        var dataIn  = new FormData();

        //mifaces
        $.callAjax(dataIn, action, $(this));
    });


    $(document).on('click','#btn-buscar-examenes', function () {

        var action = $(this).data("url");

        var dataIn  = new FormData($("#schedule-exam-form")[0]);

        //mifaces
        $.callAjax(dataIn, action, $(this));

    });


    $(document).on('click', '.seleccionar-turn-examen', function () {

        var action = $(this).data("url");
        var turn = $(this).data("id");

        var dataIn  = new FormData();
        dataIn.append("turn", turn);


        //mifaces
        $.callAjax(dataIn, action, $(this));

    });


    //por defecto inicializamos dom para diaria
    init_diaria();
    init_view();

});





/* Procedimientos Post Ajax Call */
$(document).ajaxComplete(function(event,xhr,options){


    if(options.callName != null )
    {
        if(options.callName == "dia") {
            init_diaria();
        }
        if(options.callName == "semana") {
            init_semanal();
        }

        if(options.callName.indexOf("agendar-") >= 0){

            modalagendar();
        }

        if(options.callName.indexOf("confirmar-") >= 0){

            modalconfirmar();
        }

        if(options.callName.indexOf("recepcionar-") >= 0){

            modalrecepcionar();
        }

        if(options.callName.indexOf("cancelar-turno-") >= 0){

            hidemodalconfirmar();
            hidemodalpagar();
        }

         if(options.callName.indexOf("bloquear-turno-") >= 0){

            hidemodalconfirmar();
            hidemodalagendar();
        }

        if(options.callName.indexOf("pagar-") >= 0){

            modalpagar();
        }

        if(options.callName == "schedule") {

            if(error_valida){
                error_valida = false
            } else {
                hidemodalagendar();
            }

        }

        if(options.callName == "confirm") {

            if(error_valida){
                error_valida = false
            } else {
                hidemodalconfirmar();
            }
        }

        if(options.callName == "scheduleSelectPatient") {
            scheduleForm();
        }

        if(options.callName == "reception") {
            hideSwag();
        }

        if(options.callName == "pay") {

            if(error_valida){
                error_valida = false
            } else {
                hidemodalpagar();
            }
            
        }

        if(options.callName == "levantar-config-overcrowd"){
            initSwalSobrecupo();
        }

        if(options.callName == "initsobrecupo"){
            finalizeInitSobrecupo();
        }

        if(options.callName == "agendar-examen"){
            modalExamenes();
        }

        if(options.callName == "seleccionar-turn-examen"){
            finalizeModalExamenes();
        }


    }




});




/* inicializaciones y procedimientos necesarios para agendamiento semanal */
function init_semanal () {
    if(!isMobile()) {
        stick_head("semanal-table");
    }

    $("#semana").addClass('active');
    $("#dia").removeClass('active');


    var specialist = $('.especialistas-hidden').children().children().children().first();
    


    selected_doc = specialist.data('usb');

    specialist.addClass('hovered themed-lighter-2');

};

/* inicializaciones y procedimientos necesarios para agendamiento diario */
function init_diaria() {
    stick_head("diaria-table");
    $("#dia").addClass('active');
    $("#semana").removeClass('active');    
};


/* inicializaciones y procedimientos necesarios para la vista agendamiento de forma general */
function init_view() {

    var sticked = false;

    //corremos sticky si no es mobile < 770px
    if(!isMobile())
    {
        $("#sticker-sidebar").sticky({topSpacing:71});
        sticked = true;

    }

    //paramos sticky si colapsa a los 770px
    $( window ).resize(function() {
        if(isMobile() && sticked) {
           $("#sticker-sidebar").unstick();
        }
    });
}

function modalagendar(){
    $("#schedule_modal").modal({
        backdrop: 'static',
        keyboard: false
    });
}


function modalExamenes() {
    $("#exam-modal").modal();
    App.init();
}


function finalizeModalExamenes(){
    if(error_examen != "true") {
        //removemos modal para abrir otro
        $("#exam-modal").hide();
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        $('#modal').empty();

        $("#schedule_modal_agendar").modal();
        error_examen  = "false";
    }
}

function modalconfirmar(){
    $("#confirm_modal").modal();
}


function modalrecepcionar(){
    $("#reception_modal").modal();
}


function modalpagar(){
    $("#pay_modal").modal();
}


function hidemodalagendar() {

    if(error_schedule != "true"){
        $("#schedule_modal").modal('hide');
        $("#schedule_modal_agendar").modal('hide');
        error_schedule = "false";
    }

}


function hidemodalconfirmar() {
    
    if(error_confirm != "true"){
        $("#confirm_modal").modal('hide');
        error_confirm = "false";
    }

}

function hidemodalpagar() {
    $("#pay_modal").modal('hide');
}

function scheduleForm() {

    $("#buscador").removeClass("hidden").addClass("hidden");
    $("#confirmar").removeClass("hidden");
    $("#btn-agendar").removeClass("disabled");
    $("#btn-agendar").removeClass("hidden");
    $("#btn-create-patient").removeClass("hidden");

    //caso para sobrecupo
    $("#btn-overcrowdpersist").removeClass("disabled");
    $("#btn-overcrowdpersist").removeClass("hidden");

}

function hideSwag() {
    swal.closeModal();
}


function initSwalSobrecupo() {
    window.App.init();
}


function finalizeInitSobrecupo() {
    if(error_overcrowd == "false"){
        swal.closeModal();
        $("#schedule_modal").modal();
    }
    else if(error_overcrowd == "true"){
        $("#modal").html("");
    }
}




/* funcion para verificar si la ventana es < 770px */
function isMobile() {
    if(window.matchMedia('(max-width: 770px)').matches) {
        return true;
    }
    else {
        return false;
    }
}


/*
   funcion para filtrar las filas de la vista diaria por especialista selecciondo
*/

function daily_filter_turns_by_specialist(id_especialista, status) {

    if(status == "selected") {
        $(".turnos").removeClass("hidden");
        return;
    }

    //dejamos todos las filas de la vista diaria ocultas
    $(".turnos").each(function (i, obj) {
        $(this).removeClass("hidden").addClass("hidden");
    });


    //le quitamos hidden a las que le corresponda al especialista
    $(".turnos").each(function (i, obj) {

        var id = $(this).data("especialista");

        if(id == id_especialista)
            $(this).removeClass("hidden");

    });
}


/**
 * Retorna la lista de usuarios paginada
 *
 */
function get_list()
{

    var datos = {
        'pagination': true,
        'limit'		: 10,
        'page'		: 1,
        'role'		: 4,
        'search'	: $("#input-buscar").val()
    }

    var url = $("#form-busqueda").attr('action');

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
                $tr += "<td><span class='select-patient btn ficha-view btn-sm' data-callName='scheduleSelectPatient' data-url='agendamiento/scheduleform' data-user='"+paciente.id+"' >Seleccionar</span></td>";
                $tr += "</tr>";

                $("#table_body").append($tr);
                cont++;
            });

        } else {

            $("#table_body").empty();
            $("#table_body").append("<tr><td class='text-center' colspan='8'>Sin resultados</td></tr>");


        }

    });

}

function createPatient() {

    var url = $("#form-busqueda").attr('action');

    var datos = {
        'firstname'         : $('#firstname').val(),
        'lastname'          : $('#lastname').val(),
        'tipodoc'           : $('#tipodoc').val(),
        'rut'               : $('#rut').val(),
        'medical_plan_id'   : $('#medical_plan_id').val(),
        'fecha_nacimiento'  : $('#fecha_nacimiento').val(),
        'sexo'              : $('#sexo').val(),
        'phone_fixed'       : $('#phone_fixed').val()
    }

    fun = $.xajax(datos, url+'/storeNewPatient');

    fun.success(function (data)
    {
        if(data.success) {


            alertify.success("Paciente creado con éxito.");

            $("#modal-create-patient").addClass('hidden');

            // redireccionar
            //<span class="select-patient btn ficha-view btn-sm" data-callname="scheduleSelectPatient" data-url="agendamiento/scheduleform" data-user="12">Seleccionar</span>

            $("#user").val(data.iduser);
            var action = "agendamiento/scheduleform";
            var dataIn  = new FormData($("#scheduleForm")[0]);

            //mifaces
            $.callAjax(dataIn, action, $(this));

            scheduleForm();

        } else {

            if(data.msg){
                var msgs = "";


                if(data.alert) {
                    $.each(data.msg, function (i, msg) {
                        msgs += msg + " ";

                    });


                    alertify.error(msgs);
                }
            }

            $(".error").text("");

            $.each(data.msg, function(i, msg) {
                $("#"+i+"-error").text(msg);
            });

        }
    });

}


function init_fecha_server() {

    var e = $("#fecha");

    var action = $("#fecha").data("url");
    var date = $("#fecha").val();
    var dataIn	= new FormData();

    dataIn.append("date",date );

    //mifaces
    $.callAjax(dataIn, action, e);

}


/** Método para verificar si un elemento está dentro del Viewport **/

/*function checkVisible(elm) {
   var vpH = $(window).width(),
       x = $(elm).offset().left,
       elementWidth = $(elm).width();

   return (vpH >=  x + elementWidth);
}
*/

