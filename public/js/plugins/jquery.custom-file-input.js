

$(document).on('ready', function() {

		$(document).on( 'change','.inputfile', function( e )
		{   
			var fileName = $('.inputfile')[0].files[0].name;
			$("#file-name").html( fileName );
			
		});
});