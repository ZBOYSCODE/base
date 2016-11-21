$(document).ready(function() {

    $(document).on('click', '.turn', function () {

        var date_turn_initial = $("#surgery-date").val();
        var time_turn_initial = $("#surgery-time").val();

        var date_turn_clicked = $(this).data("fecha");
        var time_turn_clicked = $(this).data("hora");

        var duration_turn = $("#surgery-duration").val();


        // instanciamos dates para comparar cual hora es mayor, el dia da lo mismo
        var stt;
        var endt = new Date("November 1, 2000 " + time_turn_clicked);
        endt = endt.getTime();


        if ($(".active-turn").length == 0) {
            $("#surgery-date").val("");
            $("#surgery-time").val("");
            stt = 0;
            duration_turn = 30;
        }
        else {
            stt = new Date("November 1, 2000 " + time_turn_initial);
            stt = stt.getTime();

            if (date_turn_initial != date_turn_clicked) {
                //definimos la primera vez el bloque
                $("#surgery-time").val(time_turn_clicked);
                $("#surgery-date").val(date_turn_clicked);
            }
        }


        // verificamos que tenga la clase active
        if ($(this).hasClass("active-turn")) {

            $(this).toggleClass("active-turn");
            $("#selected-turns").val("");


            if ($(".active-turn").length == 0) {
                $("#surgery-date").val("");
                $("#surgery-time").val("");
                $("#surgery-duration").val("");
                return;
            }

            var value_turns_select = "";


            // iteramos todos los turnos que esten activos
            $('.active-turn').each(function (i) {
                var turno_iter = $(this).data("turns");
                value_turns_select = value_turns_select + turno_iter + ",";
            });

            //borramos la ultima coma
            value_turns_select = value_turns_select.slice(0, -1);


            //actualizamos el input con los turnos seleccionados
            $("#selected-turns").val(value_turns_select);


        }
        else {

            if ($(".active-turn").length == 0) {
                $(this).toggleClass("active-turn");
                $("#selected-turns").val("");

                var value_turns_select = "";


                // iteramos todos los turnos que esten activos
                $('.active-turn').each(function (i) {
                    var turno_iter = $(this).data("turns");
                    value_turns_select = value_turns_select + turno_iter + ",";
                });

                //borramos la ultima coma
                value_turns_select = value_turns_select.slice(0, -1);


                //actualizamos el input con los turnos seleccionados
                $("#selected-turns").val(value_turns_select);

                //definimos la primera vez el bloque
                $("#surgery-time").val(time_turn_clicked);
                $("#surgery-date").val(date_turn_clicked);
                $("#surgery-duration").val(30);

            }
            else {
                if (date_turn_initial == date_turn_clicked) {
                    var new_date = new Date(endt - duration_turn * 60 * 1000);
                    new_date = new_date.getTime();

                    if (stt < endt && new_date == stt) {
                        console.log("1");

                        $(this).toggleClass("active-turn");
                        $("#selected-turns").val("");

                        var value_turns_select = "";


                        // iteramos todos los turnos que esten activos
                        $('.active-turn').each(function (i) {
                            var turno_iter = $(this).data("turns");
                            value_turns_select = value_turns_select + turno_iter + ",";
                        });

                        //borramos la ultima coma
                        value_turns_select = value_turns_select.slice(0, -1);


                        //actualizamos el input con los turnos seleccionados
                        $("#selected-turns").val(value_turns_select);
                        $("#surgery-duration").val(Number(duration_turn) + 30);
                    }
                    else {

                        var new_date = new Date(endt + 30 * 60 * 1000);
                        new_date = new_date.getTime();

                        if (stt > endt && new_date == stt) {
                            console.log("2");

                            $(this).toggleClass("active-turn");
                            $("#selected-turns").val("");

                            var value_turns_select = "";


                            // iteramos todos los turnos que esten activos
                            $('.active-turn').each(function (i) {
                                var turno_iter = $(this).data("turns");
                                value_turns_select = value_turns_select + turno_iter + ",";
                            });

                            //borramos la ultima coma
                            value_turns_select = value_turns_select.slice(0, -1);

                            //definimos la primera vez el bloque
                            $("#surgery-time").val(time_turn_clicked);
                            $("#surgery-date").val(date_turn_clicked);

                            //actualizamos el input con los turnos seleccionados
                            $("#selected-turns").val(value_turns_select);
                            $("#surgery-duration").val(Number(duration_turn) + 30);
                        }
                        else {

                            alertify.warning("Debe seleccionar turnos consecutivos.");
                        }
                    }
                }
                else {

                    alertify.warning("Debe seleccionar turnos un mismo día.");
                }
            }

        }


    });

});