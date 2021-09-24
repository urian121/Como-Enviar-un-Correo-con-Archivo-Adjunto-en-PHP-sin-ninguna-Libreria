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

<br><br>
<form name='formulario' id='formulario' method='post' action='DemoOne.php' target='_self' enctype="multipart/form-data">
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