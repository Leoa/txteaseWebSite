

// <?php
// 
// $connect = mysql_connect('txteasedatabase.db.9962360.hostedresource.com','txteasedatabase','Txtgo!11');
// 
// $db_selected= mysql_select_db('txteasedatabase');
// 
// if(!$connect){
// 	
	// die("Failed to connect: ".mysql_error());
// 
// }
// if(!$db_selected){
// 	
	// die("Failed to select database: ".mysql_error());
// }else{//echo 'database connected <br>';
// }
// 
// ?>


<?php

$connection = mysql_connect('mysql', 'yroot', '11aa11');
if ($connection){ $g=0; }
if(! $connection) die("could't connect ".mysql_error());

$db_selected= mysql_select_db('ecom_store');

if(!$connection){

	die("Failed to connect: ".mysql_error());

}
if(!$db_selected){

	die("Failed to select database: ".mysql_error());
}else{//echo 'database connected <br>';
}

?>
