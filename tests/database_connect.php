

<?php

$connect = mysql_connect('localhost','root');

$db_selected= mysql_select_db('ecom_store');

if(!$connect){
	
	die("Failed to connect: ".mysql_error());

}
if(!$db_selected){
	
	die("Failed to select database: ".mysql_error());
}else{//echo 'database connected <br>';
}

?>
