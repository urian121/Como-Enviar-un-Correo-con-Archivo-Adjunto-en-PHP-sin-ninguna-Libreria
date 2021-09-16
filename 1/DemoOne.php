<?php
$Nombre 		= $_REQUEST['Nombre'];
$email 			= $_REQUEST['email'];
$asunto 		= $_REQUEST['asunto'];
$mensaje 		= $_REQUEST['mensaje'];

$fileType 		= $_FILES["archivo1"]["type"];
$fileName 		= $_FILES["archivo1"]["name"];
$fileSource   	= $_FILES["archivo1"]["tmp_name"];

echo '<pre>';
	print_r($_POST);
echo '</pre>';

foreach ($_POST as $datos => $valores){
	$sTexto = $sTexto."\n".$datos." = ".$valores;	
}



$sPara 				 = $email;
$sAsunto 			 = $asunto;

$sCabeceras 	 	 = "From: Bienvenidos\r\n"; 
$sCabeceras     	.= "MIME-version: 1.0\n";
$sCabeceras 		.= "Content-type: multipart/mixed;";
//$headers  	    .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
//$headers  	    .= "Content-type: text/calendar;"; //.ics
$sCabeceras 		.= "boundary=\"--_Separador-de-mensajes_--\"\n";

$sCabeceraTexto 	 = "----_Separador-de-mensajes_--\n";
$sCabeceraTexto 	.= "Content-type: text/plain;charset=iso-8859-1\n";
$sCabeceraTexto 	.= "Content-transfer-encoding: 7BIT\n";

$sTexto 			= $sCabeceraTexto.$sTexto;

$sAdjuntos 			.= "\n\n----_Separador-de-mensajes_--\n";
$sAdjuntos 			.= "Content-type: ".$fileType.";name=\"".$fileName."\"\n";;
$sAdjuntos 			.= "Content-Transfer-Encoding: BASE64\n";
$sAdjuntos 			.= "Content-disposition: attachment;filename=\"".$fileName."\"\n\n";

$oFichero 			= fopen($fileSource, 'r');
$sContenido 		= fread($oFichero, filesize($fileSource));
$sAdjuntos 			.= chunk_split(base64_encode($sContenido));
fclose($oFichero);


$sTexto 			.= $sAdjuntos."\n\n----_Separador-de-mensajes_----\n";

if(mail($sPara, $sAsunto, $sTexto, $sCabeceras)){
	echo 'Correo enviado';
}else{
	echo 'error';
}

?>