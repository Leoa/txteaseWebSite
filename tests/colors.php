<?php
session_start();


$red = $_POST['name'];
$redg = $_POST['time'];

$colorsession=$_SESSION[]=$red;

 if (isset($colorsession)&&!empty($colorsession))
 {
echo 'I am '.$red;
 }




?>

