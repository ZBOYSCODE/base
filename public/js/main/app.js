
window.App = (function($, win, doc, undefined) {


    //seteamos el valor de los inputs con id fecha
    var fecha_servidor =  $("#fecha").val();

    //si no esta seteado sacamos la fecha de hoy del cliente.
    if(typeof fecha_servidor === "undefined")
        fecha_servidor = new Date();

    uiInit = function () {
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: ' <Atrás',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié;', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'yy-mm-dd',
            setDate: fecha_servidor,
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };

        
 
        $('.chosen-select').chosen({width: "100%"});

        $.datepicker.setDefaults($.datepicker.regional['es']);


        $('.datepicker').datepicker({
            startDate: '-3d',
            minDate: 0,
            onSelect: function (dateText, inst) {
                $(this).prev('input').val(dateText);
                $(this).change();
            }
        });


        $('.datepicker-free').datepicker({
            startDate: '-3d',
            changeYear: true,
            changeMonth: true,
            yearRange: '1940:'+(new Date).getFullYear(),
        onSelect: function (dateText, inst) {
                $(this).prev('input').val(dateText);
                $(this).change();
            }
        });








        $('#since').datepicker();
        $('#until').datepicker();

        $('.timepicker-init').timepicker();

        $('[data-toggle="tooltip"]').tooltip();

        $('.wizard .nav-tabs > li a[title]').tooltip();


        // === WIZARD =====
        var percentage_tab_wizard = Math.floor(100/$('.tab-pane').length);
        if(isFinite(percentage_tab_wizard)) {
            $('.wizard .nav-tabs > li ').css("width", percentage_tab_wizard+"%" );
        }

        $('.wizard .nav-tabs li').not('.active').addClass('disabled');
        $('.wizard .nav li').not('.active').find('a').removeAttr("data-toggle");


        //Initialize tooltips
        $('.wizard .nav-tabs > li a[title]').tooltip();

        // === FIN WIZARD ===
        $(document).on('click change', ".validate", function () {
            var name = $(this).attr('name');
            $('#'+name+'-error').html("");
        });


        //aside animations

        $(document).on('click', ".header-item", function () {
            $(".sidebar-left").toggleClass("sidebar-left-hidden");
            $(".sidebar-content-right-section").toggleClass("sidebar-content-right-section-hidden");
        });

    };

    animations = function () {

        $(document).on('click', ".saveBtn", function () {

            $(this).html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Cargando..')
                .attr('disabled', 'disabled');
        });
    };


    stopAnimation = function (animation_name) {
        switch(animation_name) {
            case "saveBtn":
                $(".saveBtn").html('<i class="fa fa-floppy-o"></i> Guardar')
                    .prop("disabled", false);
                break;
            default:
                return;

        }

    };


    viewBussiness = function () {
        $(document).on("click", ".dp-option", function(){

            //vars
            var branch = $(this).attr('id');
            $('#branchOfficeSelected').val(branch);

            $('#formSucursal').submit();

        });
    };


    return {
        init: function() {
            uiInit();
            animations();
            viewBussiness();
        },
        stopAnimation: function(e) {
            stopAnimation(e);
        }
    };
}(jQuery, this, document));


$(window.App.init);



