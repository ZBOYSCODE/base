
function refreshRow(turn_id,html){


	var turn = $('#'+turn_id);

	if(turn.size()){

		turn.replaceWith(html);

	}

}

function socketAlert(msg){

	alert(msg);

}