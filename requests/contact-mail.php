<?php
header("Content-type: text/javascript");

$username = $email = $subject = $message = "";

$json = array(
    "success" => false    
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = test_input($_POST["username"]);
  $email = test_input($_POST["email"]);
  $subject = test_input($_POST["subject"]);
  $message = test_input($_POST["message"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$to = "paracontas987@hotmail.com";

$finalmessage =
"<html>
    <head>
        <title>Perguntar Mail</title>
    </head>
    <body>
        <p> {$message} </p>
    </body>
</html>";

$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=utf-8";
$headers[] = "From: {$username} <{$email}>";
//$headers[] = "Bcc: {$username} <{$email}>";
//$headers[] = "Reply-To: Website Manager <{$to}>";
$headers[] = "Subject: {$subject}";
$headers[] = "X-Mailer: PHP/".phpversion();

mail($to,$subject,$finalmessage,implode("\r\n", $headers));

$json["success"] = true;
echo json_encode($json);
//echo "e-mail enviado com sucesso";
//header("Location:../index.php");
