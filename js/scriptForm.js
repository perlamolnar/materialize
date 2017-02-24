$(document).ready(function() {
				var debug=true;
				$('select').material_select();
				$("#addEmpresa").submit(function(event){
									
					event.preventDefault();	//Evita el refresh automático que se produce al enviar el form
					if(debug) console.log("Se va a enviar el form"); //se muestra por consola este mensaje para verificar que se produce el evento de submit.
					
					//ESTOS SON TESTS para el desarrollo:
					var serializado = $("#addEmpresa").serialize();
					if(debug) console.log("Formulario serializado:"+serializado); //

					var serializadoArray=$("#addEmpresa").serializeArray();
					if(debug) console.log("Formulario serializado en array:");
					if(debug) console.log(serializadoArray);


				//ESTO es la forma de obtener datos del formulario y convertirlo en formato JSON
				var jsonData = JSON.stringify($("#addEmpresa").serializeArray());
				if(debug) console.log("Datos en Json:");
				if(debug) console.log(jsonData);
				$.ajax({
					url:'php/recibeJson.php',
					type: 'POST',
					dataType: 'json',
					data: jsonData,
					success : function(result){
						if(debug) console.log (result.campos);
						if(debug) console.log (result.valores);
						if(debug) console.log (result.sql);
					},
					error : function(result){
						alert("errorrrrrrr!!!");
					}
				})
					
				});
			});