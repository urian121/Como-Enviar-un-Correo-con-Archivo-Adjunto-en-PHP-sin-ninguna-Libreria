<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta content="initial-scale=1, shrink-to-fit=no, width=device-width" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i|Roboto+Mono:300,400,700|Roboto+Slab:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/material.min.css" rel="stylesheet">
    <title>Cómo enviar Archivo Adjunto a un correo electronico con PHP</title>
  </head>
  <body>
      <nav class="navbar navbar-light bg-light " style="color: #fff !important; background-color: #563d7c !important;">
          <a class="navbar-brand" href="https://blogangular-c7858.web.app/"> 
              Canal WebDeveloper 
          </a>
          <h5 class="form-inline">Urian Viera</h5>
      </nav>


<?php
if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST"){

   $para    = $_REQUEST['emailCliente']; //correo al cual le llegara el msjs con archivos adjuntos.
   $subject = "Archivos adjuntos";

   //Obtengo el nombre y email del cliente que se regisytra
   $from = stripslashes($_POST['nombrecompleto'])."<".stripslashes($_POST['emailCliente']).">";

   //generando una cadena aleatoria que se utilizará como marcador de límites 
   $mime_boundary="==Multipart_Boundary_x".md5(mt_Rand())."x";

   //construiremos los encabezados de los mensajes 
   $headers = "From: $from\r\n" .
   "MIME-Version: 1.0\r\n" .
      "Content-Type: multipart/mixed;\r\n" .
      " boundary=\"{$mime_boundary}\"";

   //comenzaremos el cuerpo del mensaje.
   $message="Hola ha recibido un correo de: ";
   $message .= "Nombre: ".$_POST["nombrecompleto"]." Mensaje :".$_POST["mensaje"];

   //crearemos la parte invisible del cuerpo del mensaje,
   //tenga en cuenta que insertamos dos guiones delante del límite MIME
   $message = "Este es un mensaje de varias partes en formato MIME .\n\n" .
      "--{$mime_boundary}\n" .
      "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
      "Content-Transfer-Encoding: 7bit\n\n" .
   $message . "\n\n";



//procesando los archivo que hemos adjuntado
foreach($_FILES['archivo']['tmp_name'] as $key => $tmp_name){
      //almacenar la información del archivo en variables para facilitar el acceso 
      $tmp_name   = $_FILES['archivo']['tmp_name'][$key];
      $type       = $_FILES['archivo']['type'][$key];
      $name       = $_FILES['archivo']['name'][$key];
      $size       = $_FILES['archivo']['size'][$key];

      //verifico si la carga se realizó correctamente
      if (file_exists($tmp_name)){
         if(is_uploaded_file($tmp_name)){
            
            $file = fopen($tmp_name,'rb'); //abro el archivo para una lectura binaria 
            $data = fread($file,filesize($tmp_name)); //leer el contenido del archivo en una variable 
            fclose($file); //cierro el archivo

            //Ahora la codificamos y la dividimos en líneas de longitud aceptables
            $data = chunk_split(base64_encode($data));
         }

         
         $message .= "--{$mime_boundary}\n" .
            "Content-Type: {$type};\n" .
            " name=\"{$name}\"\n" .
            "Content-Disposition: attachment;\n" .
            " filename=\"{$fileatt_name}\"\n" .
            "Content-Transfer-Encoding: base64\n\n" .
         $data . "\n\n";
      }
   }

   $message.="--{$mime_boundary}--\n";
   
   //enviamos el correo
   if (mail($para, $subject, $message, $headers)){
      echo "<br><center>El Correo electronico fue enviado correctamente.</center>";
   }else{
      echo "No se pudo enviar el correo.";
   }
}
?>


  <div class="container mt-5">
    <h3 class="text-center mb-5" style="color:#555 ; font-weight: 800;">
        Cómo enviar Archivo Adjunto a un correo electronico con PHP <span style="color: orange;"> Fácil</span>
      <hr>
    </h3>


    <form name="formEmail" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="form-group">
                    <label for="nombrecompleto">Nombre Completo</label>
                    <input type="text" name="nombrecompleto"  placeholder="Escriba su Nombre"  class="form-control" required="true">
                </div>
            </div>
             <div class="col-6">
                <div class="form-group">
                    <label for="emailCliente">Email</label>
                    <input type="email" name="emailCliente" placeholder="Su email"  class="form-control">
                </div>
            </div>
         </div>
         <div class="row justify-content-center">
            <div class="col-6">
                <div class="form-group">
                    <label for="mensaje">Escriba su Mensaje</label>
                    <textarea name="mensaje"  placeholder="Mensaje"  class="form-control" required="true" rows="3"></textarea>
                </div>
            </div>
            <div class="col-6">
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Archivo</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" id="archivo[]" name="archivo[]" class="custom-file-input" multiple="true">
                    <label class="custom-file-label" for="inputGroupFile01">Hacer click aqui..!</label>
                  </div>
               </div>
            </div>
        </div>


      <div class="col-12 text-center mt-5 mb-5">
         <button type="submit" name="submit" class="btn btn-primary">Enviar Archivo Adjunto</button>
      </div>


</div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="js/material.min.js"></script>
</body>
</html>
