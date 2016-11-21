$(document).on('ready', function() {


    $(document).on('click','.check-label',function(){

        if (!$(this).hasClass('active')) {
            toogleColumna($(this).data('col'));
            this.classList.remove('inverse');
            $(this).children('i').removeClass('glyphicon-minus-sign');
            $(this).children('i').addClass('glyphicon-plus-sign');

        } else {
            toogleColumna($(this).data('col'));
            this.classList.add('inverse');
            $(this).children('i').addClass('glyphicon-minus-sign');
            $(this).children('i').removeClass('glyphicon-plus-sign');
        }
        
    });

    $(document).on('click', "#btn-filtrar", function() {

        var action = $(this).data("url");
        var dataIn  = new FormData($("#form-filters")[0]);
        dataIn.append('page',1);
        $.callAjax(dataIn, action, $(this));

    });

    $(document).on('click', '.nav_paginacion', function(){
        var action = $(this).data("url");
        var dataIn  = new FormData(($("#form-filters")[0]));
        var page = $(this).data('page');

        dataIn.append('page',page);
        $.callAjax(dataIn, action, $(this));
    });

    $(document).on('click', "#btn-mostrar-columnas", function() {
        
    $('.check-label').trigger('click');

    });

    $(document).on('click', "#btn-ocultar-columnas", function() {

     $('.check-label').trigger('click');

    });

    $(document).on('click',"#btn-excel",function(){

        var url = $(this).data('url');
        var date_ini = $('#fecha-inicio').val();
        var date_end = $('#fecha-fin').val();

        $form = $("<form action='"+url+"' target='_blank' method='POST' ></form>");

        $form.append('<input type"text" name="date_ini" value="'+date_ini+'">');
        $form.append('<input type"text" name="date_end" value="'+date_end+'">');        

        $.each($('.check-label:not(.active)'),function(){ 

            var col = $(this).data('col'); 
            $form.append('<input type"text" name="headersSelected[]" value="'+col+'">');

        });

        $("#form-filters select").each(function(){  

            var val   = $(this).val();
            var name    = $(this).attr('name');

            $form.append('<input type"text" name="'+name+'" value="'+val+'">');
        });

        $form.submit();

    });





    
    //la función recibe como parámetros el numero de la columna a ocultar 
    function toogleColumna(num) 
    {    
        //aquí utilizamos el id de la tabla, en este caso es 'tabla'
        headers=document.getElementById('tabla-informe').getElementsByTagName('tr');

        headers = $('#tabla-informe tr th');
        rows    =  $('#tabla-informe tr');


        //mostramos u ocultamos la cabecera de la columna 
        if (headers[num].style.display=='none')
        {
            headers[num].style.display=''
        }
        else
        {
            headers[num].style.display='none'
        }
        //mostramos u ocultamos las celdas de la columna seleccionada
        for(i=1;i<rows.length;i++)
        {

            if(rows[i].id != 'paginacion'){

                if (rows[i].getElementsByTagName('td')[num].style.display=='none')
                {
                    rows[i].getElementsByTagName('td')[num].style.display='';  
                }      
                else
                {
                   rows[i].getElementsByTagName('td')[num].style.display='none'
               }         
           }
       }         

   }

});
