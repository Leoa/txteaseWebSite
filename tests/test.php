<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors',1); 

if (isset($_POST['itemType'])){
	
$_SESSION['itemType']=$_POST['itemType'];
	
echo "item type is ". $_SESSION['itemType'];


$itemType=$_SESSION['itemType'];
echo" item type is ".$itemType;

}else{ echo "item is not set ";}

?>
