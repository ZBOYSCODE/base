var history_type = "";
var medicalType = "";
var history_common = "";
var formData = {};
var formDataCommon = {};
var today = new Date();
var hDiff = parseInt($("#actualtime").data("hora")) - today.getHours();
if(hDiff < 0) {hDiff = 24 + hDiff;}
var mDiff = parseInt($("#actualtime").data("min"))- today.getMinutes();
var sDiff = parseInt($("#actualtime").data("seg"))- today.getSeconds();
var hh = parseInt($("#timerattention").data("hora"));

var t2 = parseInt($("#timerattention").data("seg")) + 60 *  parseInt($("#timerattention").data("min")) + 3600 * hh;

$(document).on('ready', function() {
    
    startTime();

    $(document).on('click', ".examen-menu-item", function () {



        var action = $(this).data("url");
        var type = $(this).data("type");
        var turn = $("#atencion-turn").val();


        var dataIn = new FormData();

        dataIn.append("form_type",  type);
        dataIn.append("turn",  turn);




        // seteamos la variable global de la vista
        history_type = type;

        //mifaces
        $.callAjax(dataIn, action, $(this));


    });
      
    var numHabitos = 0;

    $(document).on('click', "#agregar-Habito", function () {
        
        
        var habito = $('#habito').val();
        var rango = $('#rango').val();
        var tiempo = $('#tiempo').val();
        var fecha = $('#fecha-inicio').val();
        var HabitoDetalle;
       
        if($('#extra-habitos').val().trim().length == 0){
        	$('#extra-habitos').val("");
        	numHabitos = 1;      	
        }else{
        	numHabitos++;
        }
        
        if(typeof(fecha)  === "undefined" || fecha==""){
        	 
        	 HabitoDetalle = numHabitos+". "+habito+" / "+rango+" al "+tiempo+", Sin Fecha de Inicio.\n";    
        }else{

             HabitoDetalle = numHabitos+". "+habito+" / "+rango+" al "+tiempo+", desde "+fecha+".\n";
             
        }

        $('#extra-habitos').val($('#extra-habitos').val() + HabitoDetalle);
    });


    $(document).on('click', "#atentionFormSubmit", function () {

        
        var action = $(this).data("url");
        var type = history_type;
        var common = history_common;
        var turn = $("#atencion-turn").val();

        var dataIn = new FormData($("#atentionForm")[0]);

        dataIn.append("form_type",  type);
        dataIn.append("turn",turn);

        if($.isNumeric(history_common))
            dataIn.append("common", common);

        //mifaces
        $.callAjax(dataIn, action, $(this));


    });


    $(document).on('click', "#atentionFormCancel" ,function () {
        var turn = $("#atencion-turn").val();
        var url = $(this).data("url");

        window.location.href = url + turn;
    });


    $(document).on('click', ".timeline-btn-edit" ,function () {

        var action = $(this).data("url");
        var common = $(this).data("common");
        var type = $(this).data("type");

        var dataIn = new FormData();

        dataIn.append("common",  common);

        // seteamos la variable global de la vista
        history_type = type;        
        history_common = common;

        console.log(type);


        //mifaces
        $.callAjax(dataIn, action, $(this));
    });

    $(document).on('click', ".timeline-btn-delete" ,function () {

        var action = $(this).data("url");
        var common = $(this).data("common");

        var dataIn = new FormData();

        dataIn.append("common",  common);

        //mifaces
        $.callAjax(dataIn, action, $(this));
    });    

    $(document).on('click', "#btn-swal-delete" ,function () {

        var action = $(this).data("url");
        var common = $(this).data("common");

        var dataIn = new FormData();

        dataIn.append("common",  common);

        //mifaces
        $.callAjax(dataIn, action, $(this));
    });        

    $(document).on('click', "#btn-swal-finish-attention" ,function () {

        var action = $(this).data("url");
        var turn = $(this).data("turn");
        var timeElapsed = $("#timerattention").html();

        var dataIn = new FormData();

        dataIn.append("turn",  turn);
        dataIn.append("timeElapsed",  timeElapsed);

        //mifaces
        $.callAjax(dataIn, action, $(this));
    });        

    $(document).on('click', "#btn-finish-attention" ,function () {

        var action = $(this).data("url");
        var turn = $(this).data("turn");

        var dataIn = new FormData();

        dataIn.append("turn",  turn);

        //mifaces
        $.callAjax(dataIn, action, $(this));
    });      

    $(document).on('change', "#select-specialty" ,function () {

        var action = $(this).data("url");
        var turn = $(this).data("turn");
        var specialty = $(this).val();

        var dataIn = new FormData();

        dataIn.append("turn",  turn);
        dataIn.append("specialty",  specialty);

        //mifaces
        $.callAjax(dataIn, action, $(this));
    });    

    $(document).on('click', "#btn-print-history" ,function () {

        $("#formPrintComplete").submit();

    });

    $(document).on( 'change','.inputfile', function( e )
    {   
        var fileName = $('.inputfile')[0].files[0].name;
        $("#file-name").html( fileName );
        
    });

    $(document).on('click', ".timeline-btn-print" ,function () {

        var common = $(this).data('common');
        var url = $(this).data('url');

        $form = $("<form action='"+url+"' target='_blank' method='POST' ></form>");
        $form.append("<input name='common' type='hidden' value='"+common+"'>");

        $form.submit();

    });          


});



/* Procedimientos Post Ajax Call */
$(document).ajaxComplete(function(event,xhr,options) {

    if (options.callName != null) {
        if (options.callName == "atentionFormSubmit") {
            window.App.stopAnimation("saveBtn");
        }

        if (options.callName == "timelineBtnEdit") {
            loadFormDataEdit();
        }

        if(options.callName == "getform"){
            loadDataJs();
            window.App.init();
        }

    }

});


/*functions*/


function startTime() {
    var t1 = new Date();
    t1.setSeconds(t1.getSeconds() + sDiff + mDiff*60 + hDiff*3600);
    var comp = (t1.getHours()*3600 + t1.getMinutes()*60 + t1.getSeconds()) - t2;
    if(comp < 0) {
        comp = (t1.getHours()*3600 + t1.getMinutes()*60 + t1.getSeconds() + 24*3600) - t2;
    }
    var s = 0;
    (comp<60)? s= comp:s =comp % 60;

    var m = 0;
    comp = Math.floor(comp/60);
    (comp < 60)?m=comp:m=comp%60;

    var h = 0;
    comp = Math.floor(comp/60);

    h = comp;
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('timerattention').innerHTML =
        h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 1000);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

function loadFormDataEdit(){

    $('#description').text(formDataCommon.description);

    $.each(formData, function(index, val) {

        element = $('[name="extra-'+val.field_name+'"]');
        if(element.length == 0){
            result = val.field_name.match(/(.*)(-\d+)/);
            element = $('[name="extra-'+result[1]+'[]"]');
        }
        typeElement = element.get(0).tagName;
        if(typeElement == "SELECT"){
            element.val(val.field_value);
        } else if(typeElement == "INPUT"){
            if(element.attr('type') == "radio"){
                element.filter('[value="'+val.field_value+'"]').closest('.btn').button('toggle'); 
            } else if(element.attr('type') == "checkbox"){
                element.filter('[value="'+val.field_value+'"]').closest('.btn').button('toggle');
            } else if(element.attr('type') == "text"){
                element.val(val.field_value);
            }
        } else if(typeElement == "TEXTAREA"){
            element.text(val.field_value);
        }
    });
}

function loadCanvasImage(){
      e = document.getElementById("can");
      cntx = e.getContext("2d");

    cntx.strokeStyle="red";
    cntx.lineWidth=7;
    cntx.lineCap="round";
      var imagen = new Image();
      imagen.src = "/new-zmed/img/pelo.jpg";
      imagen.onload = function() {
        cntx.drawImage(this,0,0);
      }
}

function loadDataJs(){

    var turn = $("#atencion-turn").val();
    var action = $("#loadDataForm").attr('action');

    var dataIn = new FormData();

    dataIn.append("turn",  turn);
    dataIn.append("medicalType", medicalType)

    //mifaces

    if(medicalType == 3){
        $.callAjax(dataIn, action, $('.examen-menu-item').filter('[data-type^="'+medicalType+'"]'));    
    }

}