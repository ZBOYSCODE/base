var result;

$(document).on('ready', function() {

    $(document).on('click', '.spinner .btn:first-of-type', function(){
        var btn = $(this);
        var input = btn.closest('.spinner').find('input');
        if ($.isNumeric(input.val())) {
            if (input.attr('max') == undefined || parseFloat(input.val()) < parseFloat(input.attr('max'))) {
                result = parseFloat(input.val(), 10) + 0.25;
                if (result > 0) {
                    input.val(''.concat(result.toString()));
                    input.change();
                }
                else {
                    input.val(result.toString());
                    input.change();
                }
            } else {
                btn.next('disabled', true);
            }
        }
        else {
            input.val('0.25');
        }
    });

    $(document).on('click', '.spinner .btn:last-of-type', function () {
        var btn = $(this);
        var input = btn.closest('.spinner').find('input');
        if ($.isNumeric(input.val())) {
            if (input.attr('min') == undefined || parseFloat(input.val()) > parseFloat(input.attr('min'))) {
                result = parseFloat(input.val(), 10) - 0.25;
                if (result > 0) {
                    input.val(''.concat(result.toString()));
                    input.change();
                }
                else {
                    input.val(result.toString());
                    input.change();
                }
            } else {
                btn.prev('disabled', true);
            }
        }
        else {
            input.val('-0.25');
        }
    });



    $(document).on('click', '#copyDownLejos',function () {
        $('#extra-rec_lejos_esf_od').val($('#extra-subjetiva_lejos_esf_od').val());
        $('#extra-rec_lejos_esf_od_hidden').val($('#extra-subjetiva_lejos_esf_od').val());
        $('#extra-rec_lejos_cil_od').val($('#extra-subjetiva_lejos_cil_od').val());
        $('#extra-rec_lejos_eje_od').val($('#extra-subjetiva_lejos_eje_od').val());
        $('#extra-rec_agudeza_od').val($('#extra-subjetiva_agudeza_od').val());
        $('#extra-rec_lejos_esf_oi').val($('#extra-subjetiva_lejos_esf_oi').val());
        $('#extra-rec_lejos_esf_oi_hidden').val($('#extra-subjetiva_lejos_esf_oi').val());
        $('#extra-rec_lejos_cil_oi').val($('#extra-subjetiva_lejos_cil_oi').val());
        $('#extra-rec_lejos_eje_oi').val($('#extra-subjetiva_lejos_eje_oi').val());
        $('#extra-rec_agudeza_oi').val($('#extra-subjetiva_agudeza_oi').val());

    });

    $(document).on('click', '#copyDownCerca',function () {
        $('#extra-rec_adicion_od').val($('#extra-subjetiva_adicion_od').val());
        $('#extra-rec_cerca_esf_od').val($('#extra-subjetiva_cerca_esf_od').val());
        $('#extra-rec_cerca_esf_od_hidden').val($('#extra-subjetiva_cerca_esf_od').val());
        $('#extra-rec_cerca_cil_od').val($('#extra-subjetiva_cerca_cil_od').val());
        $('#extra-rec_cerca_eje_od').val($('#extra-subjetiva_cerca_eje_od').val());
        $('#extra-rec_j_od').val($('#extra-subjetiva_j_od').val());

        $('#extra-rec_adicion_oi').val($('#extra-subjetiva_adicion_oi').val());
        $('#extra-rec_cerca_esf_oi').val($('#extra-subjetiva_cerca_esf_oi').val());
        $('#extra-rec_cerca_esf_oi_hidden').val($('#extra-subjetiva_cerca_esf_oi').val());
        $('#extra-rec_cerca_cil_oi').val($('#extra-subjetiva_cerca_cil_oi').val());
        $('#extra-rec_cerca_eje_oi').val($('#extra-subjetiva_cerca_eje_oi').val());
        $('#extra-rec_j_oi').val($('#extra-subjetiva_j_oi').val());

    });


    $(document).on('click', '#copyRightSubjetiva', function () {
        $('#extra-subjetiva_cerca_esf_od').val($('#extra-subjetiva_lejos_esf_od').val());
        $('#extra-subjetiva_cerca_esf_od_hidden').val($('#extra-subjetiva_lejos_esf_od').val());
        $('#extra-subjetiva_cerca_cil_od').val($('#extra-subjetiva_lejos_cil_od').val());
        $('#extra-subjetiva_cerca_eje_od').val($('#extra-subjetiva_lejos_eje_od').val());

        $('#extra-subjetiva_cerca_esf_oi').val($('#extra-subjetiva_lejos_esf_oi').val());
        $('#extra-subjetiva_cerca_esf_oi_hidden').val($('#extra-subjetiva_lejos_esf_oi').val());
        $('#extra-subjetiva_cerca_cil_oi').val($('#extra-subjetiva_lejos_cil_oi').val());
        $('#extra-subjetiva_cerca_eje_oi').val($('#extra-subjetiva_lejos_eje_oi').val());

    });

    $(document).on('click', '#copyRightReceta',function () {
        $('#extra-rec_cerca_esf_od').val($('#extra-rec_lejos_esf_od').val());
        $('#extra-rec_cerca_esf_od_hidden').val($('#extra-rec_lejos_esf_od').val());
        $('#extra-rec_cerca_cil_od').val($('#extra-rec_lejos_cil_od').val());
        $('#extra-rec_cerca_eje_od').val($('#extra-rec_lejos_eje_od').val());

        $('#extra-rec_cerca_esf_oi').val($('#extra-rec_lejos_esf_oi').val());
        $('#extra-rec_cerca_esf_oi_hidden').val($('#extra-rec_lejos_esf_oi').val());
        $('#extra-rec_cerca_cil_oi').val($('#extra-rec_lejos_cil_oi').val());
        $('#extra-rec_cerca_eje_oi').val($('#extra-rec_lejos_eje_oi').val());

    });


    $(document).on('click', '#copyRightAnterior',function () {
        $('#extra-anterior_cerca_esf_od').val($('#extra-anterior_lejos_esf_od').val());
        $('#extra-anterior_cerca_esf_od_hidden').val($('#extra-anterior_lejos_esf_od').val());
        $('#extra-anterior_cerca_cil_od').val($('#extra-anterior_lejos_cil_od').val());
        $('#extra-anterior_cerca_eje_od').val($('#extra-anterior_lejos_eje_od').val());

        $('#extra-anterior_cerca_esf_oi').val($('#extra-anterior_lejos_esf_oi').val());
        $('#extra-anterior_cerca_esf_oi_hidden').val($('#extra-anterior_lejos_esf_oi').val());
        $('#extra-anterior_cerca_cil_oi').val($('#extra-anterior_lejos_cil_oi').val());
        $('#extra-anterior_cerca_eje_oi').val($('#extra-anterior_lejos_eje_oi').val());

    });


    $(document).on('click', '.spinnerPlus',function () {
        if (parseFloat($(this).val()) > 0) {
            $(this).val('+'.concat($(this).val()));
        }
    });


    $(document).on('change keyup', '#extra-anterior_adicion_od', function () {
        if ($.isNumeric(parseFloat($(this).val()))) {
            var resultSuma = parseFloat($(this).val()) + parseFloat($('#extra-anterior_cerca_esf_od_hidden').val());
            if ($.isNumeric(resultSuma)) {
                if (resultSuma > 0) {
                    $('#extra-anterior_cerca_esf_od').val('+'.concat(resultSuma));
                }
                else {
                    $('#extra-anterior_cerca_esf_od').val(resultSuma);
                }
            }
            else {
                if ($.isNumeric($(this).val())) {
                    $('#extra-anterior_cerca_esf_od').val($(this).val());
                }
            }
        }
        else {
            $('#extra-anterior_cerca_esf_od').val($('#extra-anterior_cerca_esf_od_hidden').val());
        }
    });

    $(document).on('change keyup','#extra-anterior_adicion_oi', function () {
        if ($.isNumeric(parseFloat($(this).val()))) {
            var resultSuma = parseFloat($(this).val()) + parseFloat($('#extra-anterior_cerca_esf_oi_hidden').val());
            if ($.isNumeric(resultSuma)) {
                if (resultSuma > 0) {
                    $('#extra-anterior_cerca_esf_oi').val('+'.concat(resultSuma));
                }
                else {
                    $('#extra-anterior_cerca_esf_oi').val(resultSuma);
                }
            }
            else {
                if ($.isNumeric($(this).val())) {
                    $('#extra-anterior_cerca_esf_oi').val($(this).val());
                }
            }
        }
        else {
            $('#extra-anterior_cerca_esf_oi').val($('#extra-anterior_cerca_esf_oi_hidden').val());
        }

    });

    $(document).on('change keyup','#extra-subjetiva_adicion_od', function () {
        if ($.isNumeric(parseFloat($(this).val()))) {
            var resultSuma = parseFloat($(this).val()) + parseFloat($('#extra-subjetiva_cerca_esf_od_hidden').val());
            if ($.isNumeric(resultSuma)) {
                if (resultSuma > 0) {
                    $('#extra-subjetiva_cerca_esf_od').val('+'.concat(resultSuma));
                }
                else {
                    $('#extra-subjetiva_cerca_esf_od').val(resultSuma);
                }
            }
            else {
                if ($.isNumeric($(this).val())) {
                    $('#extra-subjetiva_cerca_esf_od').val($(this).val());
                }
            }
        }
        else {
            $('#extra-subjetiva_cerca_esf_od').val($('#extra-subjetiva_cerca_esf_od_hidden').val());
        }
    });

    $(document).on('change keyup','#extra-subjetiva_adicion_oi', function () {
        if ($.isNumeric(parseFloat($(this).val()))) {
            var resultSuma = parseFloat($(this).val()) + parseFloat($('#extra-subjetiva_cerca_esf_oi_hidden').val());
            if ($.isNumeric(resultSuma)) {
                if (resultSuma > 0) {
                    $('#extra-subjetiva_cerca_esf_oi').val('+'.concat(resultSuma));
                }
                else {
                    $('#extra-subjetiva_cerca_esf_oi').val(resultSuma);
                }
            }
            else {
                if ($.isNumeric($(this).val())) {
                    $('#extra-subjetiva_cerca_esf_oi').val($(this).val());
                }
            }
        }
        else {
            $('#extra-subjetiva_cerca_esf_oi').val($('#extra-subjetiva_cerca_esf_oi_hidden').val());
        }
    });

    $(document).on('change keyup','#extra-rec_adicion_od', function () {
        if ($.isNumeric(parseFloat($(this).val()))) {
            var resultSuma = parseFloat($(this).val()) + parseFloat($('#extra-rec_cerca_esf_od_hidden').val());
            if ($.isNumeric(resultSuma)) {
                if (resultSuma > 0) {
                    $('#extra-rec_cerca_esf_od').val('+'.concat(resultSuma));
                }
                else {
                    $('#extra-rec_cerca_esf_od').val(resultSuma);
                }
            }
            else {
                if ($.isNumeric($(this).val())) {
                    $('#extra-rec_cerca_esf_od').val($(this).val());
                }
            }
        }
        else {
            $('#extra-rec_cerca_esf_od').val($('#extra-rec_cerca_esf_od_hidden').val());
        }
    });

    $(document).on('change keyup','#extra-rec_adicion_oi', function () {
        if ($.isNumeric(parseFloat($(this).val()))) {
            var resultSuma = parseFloat($(this).val()) + parseFloat($('#extra-rec_cerca_esf_oi_hidden').val());
            if ($.isNumeric(resultSuma)) {
                if (resultSuma > 0) {
                    $('#extra-rec_cerca_esf_oi').val('+'.concat(resultSuma));
                }
                else {
                    $('#extra-rec_cerca_esf_oi').val(resultSuma);
                }
            }
            else {
                if ($.isNumeric($(this).val())) {
                    $('#extra-rec_cerca_esf_oi').val($(this).val());
                }
            }
        }
        else {
            $('#extra-rec_cerca_esf_oi').val($('#extra-rec_cerca_esf_oi_hidden').val());
        }
    });


    $(document).on('change keyup','#extra-anterior_cerca_esf_od', function () {
        if ($.isNumeric(parseFloat($(this).val()))) {
            var toCopy = parseFloat($(this).val());
            if (toCopy > 0) {
                $('#extra-anterior_cerca_esf_od_hidden').val('+'.concat(toCopy));
            }
            else {
                $('#extra-anterior_cerca_esf_od_hidden').val(toCopy);
            }
        }
        else {
            $('#extra-anterior_cerca_esf_od_hidden').val($('#extra-anterior_cerca_esf_od_hidden').val());
        }
    });

    $(document).on('change keyup','#extra-anterior_cerca_esf_oi', function () {
        if ($.isNumeric(parseFloat($(this).val()))) {
            var toCopy = parseFloat($(this).val());
            if (toCopy > 0) {
                $('#extra-anterior_cerca_esf_oi_hidden').val('+'.concat(toCopy));
            }
            else {
                $('#extra-anterior_cerca_esf_oi_hidden').val(toCopy);
            }
        }
        else {
            $('#extra-anterior_cerca_esf_oi_hidden').val($('#extra-anterior_cerca_esf_oi_hidden').val());
        }
    });

    $(document).on('change keyup','#extra-subjetiva_cerca_esf_od', function () {
        if ($.isNumeric(parseFloat($(this).val()))) {
            var toCopy = parseFloat($(this).val());
            if (toCopy > 0) {
                $('#extra-subjetiva_cerca_esf_od_hidden').val('+'.concat(toCopy));
            }
            else {
                $('#extra-subjetiva_cerca_esf_od_hidden').val(toCopy);
            }
        }
        else {
            $('#extra-subjetiva_cerca_esf_od_hidden').val($('#extra-subjetiva_cerca_esf_od_hidden').val());
        }
    });

    $(document).on('change keyup','#extra-subjetiva_cerca_esf_oi', function () {
        if ($.isNumeric(parseFloat($(this).val()))) {
            var toCopy = parseFloat($(this).val());
            if (toCopy > 0) {
                $('#extra-subjetiva_cerca_esf_oi_hidden').val('+'.concat(toCopy));
            }
            else {
                $('#extra-subjetiva_cerca_esf_oi_hidden').val(toCopy);
            }
        }
        else {
            $('#extra-subjetiva_cerca_esf_oi_hidden').val($('#extra-subjetiva_cerca_esf_oi_hidden').val());
        }
    });

    $(document).on('change keyup','#extra-rec_cerca_esf_od', function () {
        if ($.isNumeric(parseFloat($(this).val()))) {
            var toCopy = parseFloat($(this).val());
            if (toCopy > 0) {
                $('#extra-rec_cerca_esf_od_hidden').val('+'.concat(toCopy));
            }
            else {
                $('#extra-rec_cerca_esf_od_hidden').val(toCopy);
            }
        }
        else {
            $('#extra-rec_cerca_esf_od_hidden').val($('#extra-rec_cerca_esf_od_hidden').val());
        }
    });

    $(document).on('change keyup','#extra-rec_cerca_esf_oi',function () {
        if ($.isNumeric(parseFloat($(this).val()))) {
            var toCopy = parseFloat($(this).val());
            if (toCopy > 0) {
                $('#extra-rec_cerca_esf_oi_hidden').val('+'.concat(toCopy));
            }
            else {
                $('#extra-rec_cerca_esf_oi_hidden').val(toCopy);
            }
        }
        else {
            $('#extra-rec_cerca_esf_oi_hidden').val($('#extra-rec_cerca_esf_oi_hidden').val());
        }
    });

});