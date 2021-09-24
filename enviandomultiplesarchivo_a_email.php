<?php
$Nombre 	= $_REQUEST['Nombre'];
$email 		= $_REQUEST['email'];
$asunto 	= $_REQUEST['asunto'];
$mensaje 	= $_REQUEST['mensaje'];

$fileType 	= $_FILES["archivo1"]["type"];
$fileName 	= $_FILES["archivo1"]["name"];
$fileSource   	= $_FILES["archivo1"]["tmp_name"];



$sPara 			= 'urian1213viera@gmail.com';
$sAsunto 		= 'Probando_'.date('Y-m-d');
//$sTexto  		='Hello';
$desde 			="webdeveloper.com";

$sCabeceras 	= "From:".$desde."\n";
$sCabeceras 	.= "MIME-version: 1.0\n";

/*foreach ($_POST as $sNombre => $sValor)
$sTexto = $sTexto."\n".$sNombre." = ".$sValor;
*/

foreach ($_FILES as $vAdjunto)
{


$sCabeceras .= "Content-type: multipart/mixed;";
$sCabeceras .= "boundary=\"--_Separador-de-mensajes_--\"\n";

$sCabeceraTexto = "----_Separador-de-mensajes_--\n";
$sCabeceraTexto .= "Content-type: text/plain;charset=iso-8859-1\n";
$sCabeceraTexto .= "Content-transfer-encoding: 7BIT\n";

$sTexto = $sCabeceraTexto.$sTexto;

$sAdjuntos .= "\n\n----_Separador-de-mensajes_--\n";
$sAdjuntos .= "Content-type: ".$vAdjunto["type"].";name=\"".$vAdjunto["name"]."\"\n";;
$sAdjuntos .= "Content-Transfer-Encoding: BASE64\n";
$sAdjuntos .= "Content-disposition: attachment;filename=\"".$vAdjunto["name"]."\"\n\n";

$oFichero = fopen($vAdjunto["tmp_name"], 'r');
$sContenido = fread($oFichero, filesize($vAdjunto["tmp_name"]));
$sAdjuntos .= chunk_split(base64_encode($sContenido));
fclose($oFichero);

}

$sTexto .= $sAdjuntos."\n\n----_Separador-de-mensajes_----\n";
if(mail($sPara, $sAsunto, $sTexto, $sCabeceras)){
	echo 'Correo enviado';
}else{
	echo 'error';
}

?>