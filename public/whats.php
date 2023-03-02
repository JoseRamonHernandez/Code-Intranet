<?php

 // Update the path below to your autoload.php,
    // see https://getcomposer.org/doc/01-basic-usage.md
    require_once 'twilio-php-main/src/Twilio/autoload.php';
    use Twilio\Rest\Client;

    $sid    = "AC985d98e463d374de50ba45d985f54233";
    $token  = "11f8244ffb6bc290d5bd4ff6182ef5f2";
    $twilio = new Client($sid, $token);

    $message = $twilio->messages
      ->create("whatsapp:+5212412470313", // to
        array(
          "from" => "whatsapp:+14155238886",
          "body" => "Welcome to Intranet Clerprem Project!!! (Message sent from Twilio)"
        )
      );

#print($message->sid);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="./admin/home.php">Home</a>
</body>
</html>