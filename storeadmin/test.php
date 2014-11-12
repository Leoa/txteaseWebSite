<?php

include('../storescripts/database_connect.php');

	$query = mysql_query("SELECT username FROM admin");
echo "<br>";
echo $query;
	//$existCount = mysql_num_rows($sql);

while ($row = mysql_fetch_assoc($query)){
	
		echo $row['username']."<br>";
	
	echo $row['password'];
		}
	

?>