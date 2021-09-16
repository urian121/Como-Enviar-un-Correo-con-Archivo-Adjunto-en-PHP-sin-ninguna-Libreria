 

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ejemplo</title>
    <link rel="stylesheet" href="">
</head>
<body>

<!---
Como-Enviar-un-Email-con-Archivo-Adjunto-en-PHP-sin-ninguna-Libreria
Enviar un email con adjuntos utilizando jQuery, Ajax y PHP sin refrescar la página
Enviar Email Con Archivo Adjunto Con PHP
Enviar un email con adjuntos en PHP
Cómo enviar un email con adjuntos
Enviar un correo con archivo adjunto usando PHP mail()
http://www.federicoperichon.com.ar/enviar-un-correo-con-archivo-adjunto-usando-php-mail
-->
<?php 
if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
     $nombre = ($_POST["nombre"]);
     $email = ($_POST["email"]);

    $directorio = "fotos/";
    if (!file_exists($directorio)) {
        mkdir($directorio, 0777, true);
    }
    $dir = opendir($directorio);

    $filename = $_FILES["file"]["name"];
    $source   = $_FILES["file"]["tmp_name"];

    $target_path = $directorio.'/'.$filename;
    if(move_uploaded_file($source, $target_path)) {
        echo 'se envio correctamente <br>';
     }else {
            echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
        }


$destinatarioCriador = $email;
$asuntoCriador       = "Bienvenido DEMO";
$cuerpoCriador = '
<table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
    <tr>
        <td style="padding: 0">
            <img style="padding: 0; display: block; width:100%; margin:0 auto;" src="https://catmanshopper.com/images/banner-princpial.png">
        </td>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </tr>
    <tr>
        <td style="padding: 0; margin:0 auto; text-align: center;">
                <p>&nbsp;</p>
             <h2 style="text-align: center; color: ##555555; margin:0 auto;">¡Gracias por registrarte!</h2>
        </td>
    </tr>

    <tr>
        <td style="background-color: #ffffff; padding: 0; margin:0 auto; text-align: center;"">
            <div style="color: #34495e; margin: 4% 10% 2%; text-align: center;font-family: sans-serif">
                <p style="margin: 0; font-size: 18px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin-top: 0; margin-bottom: 0;">
                Felicitaciones <strong style="color:#555;">'.$nombre.'</strong>, 
                en este correo tienes adjunto archivo .ICS  el cuál podrás abrir en tu calendario para poder reservar el espacio, en unos días te estaremos enviando el enlace para poder acceder a nuestro streaming.</p>
            </div>
            <p>&nbsp;</p>
            <p style="text-align: center; color: ##555555; margin:0 auto;">
                <a  href="https://catmanshopper.com/evento_retailers_y_fabricantes.ics" download="evento_retailers_y_fabricantes">Descargar Evento</a>
            </p>
            <p>&nbsp;</p>
        </td>
    </tr>

    <tr>
        <td style="padding: 0">
        <img style="padding: 0; display: block; width:100%; margin:0 auto;" src="https://catmanshopper.com/images/footer.png">
        </td>
        <p>&nbsp;</p>
    </tr>
</table>
'; 

$headersCriador  = "MIME-Version: 1.0\r\n"; 
$headersCriador .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headersCriador .= "From: Catman Shopper <noresponder@groomersacademy.com.co>\r\n"; 
$headersCriador .= "Reply-To: "; 
$headersCriador .= "Return-path:"; 
$headersCriador .= "Cc:"; 
$headersCriador .= "Bcc:"; 
$EnvioCriador    = mail($destinatarioCriador,$asuntoCriador,$cuerpoCriador,$headersCriador);

   
}
?> 

<h2>Formulario:</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
    Nombre:
    <input type="text" name="nombre" maxlength="50"><br>
    Email:
    <input type="email" name="email"><br>
    Archivo:
    <input type="file" name="file"><br>

    <input type="submit" name="submit" value="Enviar">
</form>

<br><br>
<form name='formulario' id='formulario' method='post' action='enviar.php' target='_self' enctype="multipart/form-data">
<p>Nombre <input type='text' name='Nombre' id='Nombre'></p>
<p>E-mail
<input type='text' name='email' id='email'>
</p>
<p>Asunto
<input type='text' name='asunto' id='asunto' />
</p>
<p>Mensaje
<textarea name="mensaje" cols="50" rows="10" id="mensaje"></textarea>
</p>
<p>Adjuntar archivo: <input type='file' name='archivo1' id='archivo1'></p>
<p>
<input type='submit' value='Enviar'>
</p>
</form>


</body>
</html>