<?php

$to = "yliasfranckgadie@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "zokoupol5@gmail.com" . "\r\n" .
"CC: somebodyelse@example.com";

mail($to,$subject,$txt,$headers);

?>