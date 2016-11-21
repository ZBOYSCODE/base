/*$(document).on('ready', function() {

	        var clic=false;
            var xCoord,yCoord="";

            $(document).on('mousedown', "#can" ,function (e) {
                clic=true;
                cntx.save();
                xCoord=e.pageX-this.offsetLeft;
                yCoord=e.pageY-this.offsetTop;
            });

            $(document).on('mouseup',function(){

                clic=false;
            });

            $(document).on('click',function(){

                clic=false;
            });

            $(document).on('mousemove', "#can" ,function (e) {
                if (clic==true) {
                	cntx.strokeStyle="red";
		            cntx.lineWidth=7;
		            cntx.lineCap="round";
                    cntx.beginPath();
                    cntx.moveTo(e.pageX-this.offsetLeft,e.pageY-this.offsetTop);
                    cntx.lineTo(xCoord,yCoord);
                    cntx.stroke();
                    cntx.closePath();
                    xCoord=e.pageX-this.offsetLeft;
                    yCoord=e.pageY-this.offsetTop;
                }
            });

            $(document).on('click', "#clr > div" ,function(){
                cntx.strokeStyle=$(this).css("background-color");
            });
                        

            /*$("#limpiar").click(function(){
            	var canvas = $("#can")[0];
            	var cntx = canvas.getContext("2d");
            	cntx.strokeStyle="red";
            	cntx.lineWidth=7;
            	cntx.lineCap="round";
                cargarImagen(cntx);
            })

            $("#guardar").click(function(){
                var mycanvas = document.getElementById("can");
                var button = document.getElementById("guardar");
                var img = mycanvas.toDataURL("image/png;base64;");  
                img = img.replace("image/png", "image/octet-stream");
                document.location.href = img;
            })

});*/