 <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
 <script type="text/javascript"  >
      $(function(){
            setInterval(function() {
				$.post('envio_desgravamen.php',{nombre:'Pepe'},function(respuesta){
					var aleatorio = Math.random();
					$.post('envio_facultativo_aprobados.php',{nombre:'Pepe'},function(respuesta){
						var aleatorio = Math.random();
						// ajax que genera archivo desgravamen
							$.post('envio_facultativo_pendientes.php',{nombre:'Pepe'},function(respuesta){
								var aleatorio = Math.random();
								$.post('envio_facultativo_ap.php',{nombre:'Pepe'},function(respuesta){
									var aleatorio = Math.random();
									$.post('envio_facultativo_rechazados.php',{nombre:'Pepe'},function(respuesta){
										var aleatorio = Math.random();
										enviando_correo_email(aleatorio);
										//alert('archivo generado'); //Mostramos un alert del resultado devuelto por el php
																
									});
															
								});
							});
								
					});
				});
				
			}, 10000);	  // 10 segundos
//			}, 30000);	  // 30 segundos
//			}, 86400000); // 24 horas
//			}, 50400000); // 14 horas
/*			function enviando_correo_email(variable){
			   // ajax que genera archivo desgravamen
			   $.post('generar_correo_au.php',{nombre:'Pepe'},function(respuesta){
					//alert('generado1');
					$.post('generar_correo_de.php',{nombre:'Pepe'},function(respuesta){
						alert('generado2');
						$.post('generar_correo_tr.php',{nombre:'Pepe'},function(respuesta){
							//alert('generado3');
							//	var aleatorio = Math.random();
								//enviando_correo_email(aleatorio);
								//alert('archivo generado'); //Mostramos un alert del resultado devuelto por el php				
										//alert('archivos creados y enviados');
					   });
				   });
			   });
			}*/
/*			function enviando_correo_email(variable){
			   // ajax que genera archivo desgravamen
			   $.post('generar_correo.php',{nombre:'Pepe'},function(respuesta){
					//	var aleatorio = Math.random();
						//enviando_correo_email(aleatorio);
						//alert('archivo generado'); //Mostramos un alert del resultado devuelto por el php				
								//alert('archivos creados y enviados');
				});
			}*/
	  });
  </script>


<?php
/*
require("class.phpmailer.php");

$date=date("d-m-Y");

$mail = new PHPMailer();
	$mail->Host = "Ecofuturo";
	$mail->From = "Ecofuturo";
	$mail->FromName = "Ecofuturo";
	$mail->Subject = "Reportes de Certificados Fecha_".$date;
	//$mail->AddAddress("emontano@sudseguros.com","Prueba");//A QUIEN SE ENVIARA
	$mail->AddAddress("juanpa14_2@hotmail.com","Prueba");//A QUIEN SE ENVIARA  
	$body  = "Los archivos se abren con Microsoft Word o Excel, o su equivalente en cualquier plataforma.<br>";
	$mail->Body = $body;
	$mail->AltBody = "Reporte de Certificados";
	$archivoa = "archivo/Automotores_".$date.".xls";
	$nombrea = "Automotores";
	$archivot = "archivo/Todoriesgo_".$date.".xls";
	$nombres = "Todo Riesgo";
	$archivod = "archivo/Desgravamen_".$date.".xls";
	$nombred = "Desgravamen";
	$mail->AddAttachment($archivoa, $nombrea);
	$mail->AddAttachment($archivot, $nombres);
	$mail->AddAttachment($archivod, $nombred);
	$mail->Send();
	return true;
*/
?>
