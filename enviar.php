<?php   
    //Capturo los datos enviados por POST 
    $from_email     = ($_POST["email"]); 
    $sender_name    = ($_POST["nombre"]);
    $reply_to_email = ($_POST["email"]); 
   
    //Armo el cuerpo del mensaje    
    $message = "Nombre: " . $sender_name . "\n";
    $message = $message . "Email: " . $from_email . "\n";
   
    //Obtener datos del archivo subido 
    $file_tmp_name    = $_FILES['my_file']['tmp_name'];
    $file_name        = $_FILES['my_file']['name'];
    $file_size        = $_FILES['my_file']['size'];
    $file_type        = $_FILES['my_file']['type'];

       
    //Leer el archivo y codificar el contenido para armar el cuerpo del email
    $handle         = fopen($file_tmp_name, "r");
    $content        = fread($handle, $file_size);
    fclose($handle);
    $encoded_content = chunk_split(base64_encode($content));
   
    $boundary        = md5("pera");
  
    //Encabezados
    $headers         = "MIME-Version: 1.0\r\n"; 
    $headers        .= "From:".$from_email."\r\n"; 
    $headers        .= "Reply-To: ".$reply_to_email."" . "\r\n";
    $headers        .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 
           
    //Texto plano
    $body            = "--$boundary\r\n";
    $body           .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
    $body           .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
    $body           .= chunk_split(base64_encode($message)); 
           
    //Adjunto
    $body           .= "--$boundary\r\n";
    $body           .="Content-Type: $file_type; name=".$file_name."\r\n";
    $body           .="Content-Disposition: attachment; filename=".$file_name."\r\n";
    $body           .="Content-Transfer-Encoding: base64\r\n";
    $body           .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
    $body           .= $encoded_content; 
       
    $subject         = "Asunto del mensaje.";
    //Enviar el mail
    $sentMail = mail($from_email, $subject, $body, $headers);
   
    if($sentMail){       
        echo"<h2>Formulario enviado, revisar el Email.</h2>";
    }else{
        echo "<h2>Se produjo un error y su pedido no pudo ser enviado</h2>";
    }  
?>