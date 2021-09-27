<?php
$Nombre 			= $_REQUEST['nombre'];
$email 				= $_REQUEST['email'];
$mensaje 			= $_REQUEST['mensaje'];

$fileType 			= $_FILES["my_file"]["type"];
$fileName 			= $_FILES["my_file"]["name"];
$fileSource   		= $_FILES["my_file"]["tmp_name"];



$sPara 				='urian1213viera@gmail.com';
$sAsunto 			='Probando_'.date('Y-m-d');
$desde 				="Canal webdeveloper";

$sCabeceras 		= "From:".$desde."\n";
$sCabeceras 	   .= "MIME-version: 1.0\n";


foreach ($_FILES as $vAdjunto){

	$sCabeceras 	    .= "Content-type: multipart/mixed;";
	$sCabeceras 		.= "boundary=\"--_Separador-de-mensajes_--\"\n";

	$sCabeceraTexto 	 = "----_Separador-de-mensajes_--\n";
	$sCabeceraTexto 	.= "Content-type: text/plain;charset=iso-8859-1\n";
	$sCabeceraTexto     .= "Content-transfer-encoding: 7BIT\n";

	$sTexto = $sCabeceraTexto.$sTexto;

	$sAdjuntos 			.= "\n\n----_Separador-de-mensajes_--\n";
	$sAdjuntos 			.= "Content-type: ".$vAdjunto["type"].";name=\"".$vAdjunto["name"]."\"\n";;
	$sAdjuntos 			.= "Content-Transfer-Encoding: BASE64\n";
	$sAdjuntos 			.= "Content-disposition: attachment;filename=\"".$vAdjunto["name"]."\"\n\n";

	$oFichero 			= fopen($vAdjunto["tmp_name"], 'r');
	$sContenido 		= fread($oFichero, filesize($vAdjunto["tmp_name"]));
	$sAdjuntos 			.= chunk_split(base64_encode($sContenido));
	fclose($oFichero);

}

$sTexto .= $sAdjuntos."\n\n----_Separador-de-mensajes_----\n";

if(mail($sPara, $sAsunto, $sTexto, $sCabeceras)){
	echo 'El Correo fue enviado correctamente.';
}else{
	echo 'El correo no se pudo enviar.';
}

?>