<?php

session_start();

include('../storescripts/database_connect.php');

if (!isset($_SESSION['manager']) || empty($_SESSION['manager']) || $_SESSION['manager']===NULL){
	
	// not loged in
	header("Location: admin_login.php");
	
	exit();
	
}else{
 
$error =  Array();

$error[]= "session: ".$_SESSION['manager'];

$managerID =''. mysql_real_escape_string(htmlentities(preg_replace('#[^0-9]#i','', $_SESSION['id']))).'';

$error[]= " manager id session : ".$managerID;

$manager = ''.mysql_real_escape_string(htmlentities(preg_replace('#[^A-Za-z0-9]#i','', $_SESSION['manager']))).'';

$error[]= "manager name session: ". $manager;

// add md5 for password
$password = ''.mysql_real_escape_string(htmlentities(preg_replace('#[^A-Za-z0-9]#i','', $_SESSION['password']))).'';  

$error[]= " password for session: ".$password;

// check sesson value is in the database

$sql ="SELECT * FROM admin WHERE username = '$manager' AND password = '$password' LIMIT 1";

$error[]= "sql statment: ".$sql;
	
	$result = mysql_query($sql);
	
	$row_nums = mysql_num_rows($result);
	
	$error []= " row nums are: ".$row_nums;
	 
	  if (mysql_num_rows($result) == 0){
	  	
	  		header("Location: ../index.php");
	
	echo 'no user';
	
	exit();
}

foreach ($error as $errors){ echo $errors. "<br>";}

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">
	
	<link rel="stylesheet" href="../style/ecom.css">
	
		<title> Admin Page</title>
	
</head>

<body>
	
	<div id="page_wraper">
		
		<?php include_once("../config/template_header.php")?>
		
			<section>
				
				<article>
					
					<h2>Manage Database</h2>
					
					<p> <a href="inventory_list.php">Manage inventory</a></p>
					
					<p> <a href="#">Manage Blachy</a></p>
					
				</article>
				
			</section>
			
		<?php include_once("../config/template_footer.php")?>
			
	</div>
	
</body>

</html>