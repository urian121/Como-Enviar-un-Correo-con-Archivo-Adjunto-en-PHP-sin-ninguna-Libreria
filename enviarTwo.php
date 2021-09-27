<?php
$Nombre 		= $_REQUEST['Nombre'];
$email 			= $_REQUEST['email'];
$mensaje 		= $_REQUEST['mensaje'];

$fileType 		= $_FILES["my_file"]["type"];
$fileName 		= $_FILES["my_file"]["name"];
$fileSource   	= $_FILES["my_file"]["tmp_name"];



foreach ($_POST as $datos => $valores){
	$cuerpo = $cuerpo."\n".$datos." = ".$valores;	
}



$Para 				 = $email;
$Asunto 			 = "Bienvenidos amigos";

$Cabeceras 	 	    = "From: Bienvenidos\r\n"; 
$Cabeceras     	    .= "MIME-version: 1.0\n";
$Cabeceras 		    .= "Content-type: multipart/mixed;"; //para enviar archivo adjunto al correo electronico
$Cabeceras 		    .= "boundary=\"--_Separador-de-mensajes_--\"\n";

$CabeceraTexto 	 	= "----_Separador-de-mensajes_--\n";
$CabeceraTexto 		.= "Content-type: text/plain;charset=iso-8859-1\n";
$CabeceraTexto 		.= "Content-transfer-encoding: 7BIT\n";

$cuerpo 			= $CabeceraTexto.$cuerpo;

$cuerpoArchivoAdjuntos 			.= "\n\n----_Separador-de-mensajes_--\n";
$cuerpoArchivoAdjuntos 			.= "Content-type: ".$fileType.";name=\"".$fileName."\"\n";;
$cuerpoArchivoAdjuntos 			.= "Content-Transfer-Encoding: BASE64\n";
$cuerpoArchivoAdjuntos 			.= "Content-disposition: attachment;filename=\"".$fileName."\"\n\n";

$oFichero 			= fopen($fileSource, 'r');
$sContenido 		= fread($oFichero, filesize($fileSource));
$cuerpoArchivoAdjuntos 			.= chunk_split(base64_encode($sContenido));
fclose($oFichero);


$cuerpo 			.= $cuerpoArchivoAdjuntos."\n\n----_Separador-de-mensajes_----\n";

if(mail($Para, $Asunto, $cuerpo, $Cabeceras)){
	echo 'El Correo fue enviado.';
}else{
	echo 'No se pudo enviar el correo.';
}

?>