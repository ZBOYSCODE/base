/**
 * Created by jasilva on 22/09/2016.
 */
$(document).on('ready', function() {

    /* interaccion con widget doctores */
    $(document).on('click', "#type-femenino", function () {
        $(this).removeClass("active").addClass("active");
        $("#type-masculino").removeClass("active");

    });

    $(document).on('click', "#type-masculino", function () {
        $(this).removeClass("active").addClass("active");
        $("#type-femenino").removeClass("active");

    });

    $(document).on('click', "#type-sms", function () {
        $(this).removeClass("active").addClass("active");

        $("#type-phone").removeClass("active");
        $("#type-email").removeClass("active");

    });

    $(document).on('click', "#type-phone", function () {
        $(this).removeClass("active").addClass("active");

        $("#type-email").removeClass("active");
        $("#type-sms").removeClass("active");

    });

    $(document).on('click', "#type-email", function () {
        $(this).removeClass("active").addClass("active");

        $("#type-phone").removeClass("active");
        $("#type-phone").removeClass("active");

    });


    $(document).on('click', "#siguiente", function () {

        var siguiente = $(this).data("target");

        $(".section").removeClass("hidden").addClass("hidden");
        $(siguiente).removeClass("hidden");

    });


});