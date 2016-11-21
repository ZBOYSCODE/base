var getPesoStatus = "false";

$(document).ready(function(){

	
	var peso 		= null;
	var estatura 	= null;
	var pesoestatura= null;



	$(document).on('click', ".examen-menu-item2", function () {



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


	
	$(document).on('click', '#tab_peso', function(){
		cargar_peso();
	});

	$(document).on('click', '#tab_estatura', function(){
		cargar_estatura();
	});

	$(document).on('click', '#tab_peso_estatura', function(){
		cargar_pesoestatura();
	});


	$(document).on('click', '#btn-add-peso', function(e){

		e.preventDefault();

		var url 		= $("#url").val();

		var datos = {
			'mes' : $("#list_meses_peso").val(),
			'peso': $("#input_peso").val()
		}

		fun = $.xajax(datos, url+'/addPeso');

		fun.success(function (data)
		{
			peso = data;
			google.charts.setOnLoadCallback(drawChartPeso);

			$("#mes-"+$("#list_meses_peso").val()).text($("#input_peso").val()+" Kg");

			$("#mes-pe-peso-"+$("#list_meses_peso").val()).text($("#input_peso").val()+" Kg");

			document.getElementById("form-peso").reset();
		});
	});



	$(document).on('click', '#btn-add-estatura', function(e){

		e.preventDefault();

		var url 		= $("#url").val();

		var datos = {
			'mes' : $("#list_meses_estatura").val(),
			'estatura': $("#input_estatura").val()
		}

		fun = $.xajax(datos, url+'/addEstatura');

		fun.success(function (data)
		{
			estatura = data;
			google.charts.setOnLoadCallback(drawChartEstatura);

			$("#mes-estatura-"+$("#list_meses_estatura").val()).text($("#input_estatura").val()+" Cm");

			$("#mes-pe-estatura-"+$("#list_meses_estatura").val()).text($("#input_estatura").val()+" Cm");

			document.getElementById("form-estatura").reset();
		});
	});



	function cargar_peso() {

		var url 		= $("#url").val();

		fun = $.xajax({}, url+'/getPeso');

		fun.success(function (data)
		{
			peso = data;
			google.charts.setOnLoadCallback(drawChartPeso);

		});
	}

	function cargar_estatura() {

		var url 		= $("#url").val();

		fun = $.xajax({}, url+'/getEstatura');

		fun.success(function (data)
		{
			estatura = data;

			google.charts.setOnLoadCallback(drawChartEstatura);
		});

	}

	function cargar_pesoestatura(){

		var url 		= $("#url").val();

		fun = $.xajax({}, url+'/getPesoEstatura');

		fun.success(function (data)
		{
			pesoestatura = data;

			google.charts.setOnLoadCallback(drawChartPesoEstatura);
		});
	}

	google.charts.load('current', {'packages':['corechart']});

	function drawChartPeso(){

		var data = google.visualization.arrayToDataTable(peso);

		var options = {
		  title: 'Peso',
		  curveType: 'function',
		  legend: { position: 'bottom' }
		};

		var chart = new google.visualization.LineChart(document.getElementById('peso_chart'));

		chart.draw(data, options);
	}

	function drawChartEstatura(){

		var data = google.visualization.arrayToDataTable(estatura);

		var options = {
		  title: 'Estatura',
		  curveType: 'function',
		  legend: { position: 'bottom' }
		};

		var chart = new google.visualization.LineChart(document.getElementById('estatura_chart'));

		chart.draw(data, options);
	}

	function drawChartPesoEstatura() {

		var data = google.visualization.arrayToDataTable(pesoestatura);

		var options = {
		  title: 'Peso/Estatura',
		  curveType: 'function',
		  legend: { position: 'bottom' }
		};

		var chart = new google.visualization.LineChart(document.getElementById('peso_estatura_chart'));

		chart.draw(data, options);
	}

	
	/* Procedimientos Post Ajax Call */
	$(document).ajaxComplete(function(event,xhr,options) {

	    if (options.callName != null) {
	        

	        if(options.callName == "getform"){
	            window.App.init();

				if(getPesoStatus == "true"){
					getPesoStatus = "false";
					cargar_peso();
				}
	        }


	    }

	});


});




