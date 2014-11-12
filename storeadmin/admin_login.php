<?php


session_start();

include('../storescripts/database_connect.php');




require '../config/config_path.php';
$path =$conf['site_url'];




if (isset($_SESSION['manager']) || !empty($_SESSION['manager']) || $_SESSION['manager']!=NULL){
	
//	header('Location: http://localhost/phpTutorials/ecomsite/storeadmin/index.php');
	
//	exit();
}

// check sesson value in in the databas

	
if (isset($_POST['username']) && isset($_POST['password'])){
	
	
	$manager = ''.mysql_real_escape_string(htmlentities(preg_replace('#[^A-Za-z0-9]#i','', $_POST['username']))).'';

	
	// add md5 for password
	
	$password = ''.mysql_real_escape_string(htmlentities(preg_replace('#[^A-Za-z0-9]#i','', $_POST['password']))).'';  

	
	
	$sql = "SELECT id, username, password FROM admin WHERE password = '$password' AND username = '$manager'";

	
	
	$result = mysql_query($sql);
	
	$row_nums = mysql_num_rows($result);
	
	
	 
	  if (mysql_num_rows($result) == 1){
	
		while($row = mysql_fetch_array($result)){
		
		$id = $_SESSION['id'] = $row['id']; 
			
		
	
		$manager = $_SESSION['manager'] = $row['username'];
		
		
		
		$password = $_SESSION['password'] = $row['password'];
		
		
		
		
		header('Location: '.$conf['site_url'].'storeadmin/index.php');
		
		
	
		exit();
		
		}
	  }else{
	
	$id = $_SESSION['id'] = ''; 
			
	
	
		$manager = $_SESSION['manager'] = ''; 
		
		
		
		$password = $_SESSION['password'] = ''; 
		
	
	echo "Information is not correct. Please try again: <a href='admin_login.php'> Click here</a>";
	
	exit();
	
	}
	
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">
	
	<link rel="stylesheet" href="<?php echo $path; ?>style/ecom.css">
	
		<title> Admin Login Page</title>
	
</head>

<body>
	
	<div id="page_wraper">
		
		<?php include_once("../config/template_header.php")?>
		
			<section>
				
				<article>
					
					<h2>Please Login to Manage the store</h2>
					
					<form id="form1" name="form1" method="POST" action ="admin_login.php">
					
					<p> User Name <input type="text" name="username" id="username" size="40"></p>
					
					<p> Password <input type="password" name="password" id="password" size="40"></p>
					
					<p><input type="submit"  name="button" id="button" value="login"></p>
					
					</form>
					
				</article>
				
			</section>
			
		<?php include_once("../config/template_footer.php")?>
			
	</div>
	
</body>

</html>


