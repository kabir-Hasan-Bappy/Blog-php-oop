<?php
//the subject
$sub = "Your subject";
//the message
$msg = "Your message";
//recipient email here
$to = "kabir.softwindtech@gmail.com";
//send email
$result = mail($to,$sub,$msg);
var_dump($result);
?>

