<?php

$errorMSG = "";
$error = false;
// NAME
if (empty($_POST["name"])) {
    $errorMSG = "Escribe tu nombre ";
    $error = true;
} else {
    $name = $_POST["name"];
}

// EMAIL

if (empty($_POST["email"])) {
    $errorMSG .= "Escribe tu email ";
    $error = true;
  } else {
    $email = $_POST["email"];
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMSG .= "Formato de email incorrecto";
        $error = true;
    }
  }


// MESSAGE
if (empty($_POST["message"])) {
    $errorMSG .= "Se requiere un mensaje ";
    $error = true;
} else {
    $message = $_POST["message"];
}

$EmailTo = "lemostro@gmail.com";
$Subject = "🟢 ".$name." ha dejado un mensaje en la pagina web";
$cabeceras = "From: website@faminsa.com.mx" . "\r\n" .
    'Reply-To: '. $email . "\r\n" .
    /*'Cc: karina.mnevarez@gmail.com' . "\r\n" .*/
    'Bcc: daniel@pixelemos.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();


// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Message: ";
$Body .= $message;
$Body .= "\n";

// send email
if(!$error){
    $success = mail($EmailTo, $Subject, $Body, "From:".$email);
}
// redirect to success page
if ($success && $errorMSG == ""){
   echo "success";
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG;
    }
}

?>