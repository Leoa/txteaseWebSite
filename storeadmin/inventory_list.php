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

<?php

// this block grabs the whole list ofr vewing

error_reporting(E_ALL);
ini_set('display_errors','1');

echo "this is running <br>";

?>


<?php

if (isset($_GET['deleteid'])){
	
	echo "do you want to delete the product with id of ".$_GET['deleteid']." and name of ".$_GET['product_name']."?<a href='inventory_list.php?yesdelete=".$_GET['deleteid']."'>YES</a> | <a href='inventory_list.php'>NO</a>";
	exit();
	
}

if(isset($_GET['yesdelete'])){
		
	//remove item form systrem
	
	$id_to_delete = $_GET['yesdelete'];
	
	$sql2="DELETE FROM products WHERE id = '$id_to_delete' LIMIT 1";
	
	$result4= mysql_query($sql2) or die (mysql_error());
	
	$pic_to_delete = "inventory_images\\".$id_to_delete.".jpg";
	
	if(file_exists($pic_to_delete)){
		
		unlink($pic_to_delete);
		
	}
	header('location: inventory_list.php');
	exit();
}

?>

<?php
// Parse from and add data to the database


echo "this is running too <br>";

if (isset($_POST['product_name']) && !empty($_POST['product_name'])){
	
	
	$product_name = ''. mysql_real_escape_string(htmlentities($_POST['product_name'])).'';
	
	$error[]= " product name: ".$product_name;
	
	$price = ''. mysql_real_escape_string(htmlentities($_POST['price'])).'';
	
	$error[]= " price: ".$price;
	
	$category = ''. mysql_real_escape_string(htmlentities($_POST['category'])).'';
	
	$error[]= " category: ".$category;
	
	$subcategory = ''. mysql_real_escape_string(htmlentities($_POST['subcategory'])).'';
	
	$error[]= " subcategory: ".$subcategory;
	
	$details = ''. mysql_real_escape_string(htmlentities($_POST['details'])).'';
	
	$error[]= " details: ".$details;
	
	$query2 = "SELECT id FROM products WHERE product_name = '$product_name' LIMIT 1";
	
	$error[]= " query 2: ".$query2;
	
	$result2 = mysql_query($query2);
	
	if (mysql_num_rows($result2) > 0){
		
		echo " sorry you tried to duplicate a 'Product Name' into the system.<a href='inventory_list.php'>click here </a>";	
		exit();
	}
	
	$date = date("Y-m-d"); 	
	
	$query3="INSERT INTO products (id ,product_name, price, details, category, subcategory, date_added) VALUES ('','$product_name','$price','$details','$category','$subcategory','$date')";

	$error[]= " query 3: ".$query3;

	$result3=mysql_query($query3) or die(mysql_error());
	
	$pid= mysql_insert_id();
	
	$newname=$pid.'.jpg';
	
	$error[]= " image name: ".$newname;
	// curl
	foreach ($error as $errors){ echo $errors. "<br>";}
	
	$upload_directory=dirname(__FILE__).'\\inventory_images\\';
	
//check if form submitted
	if (isset($_POST['submit'])) {  
	    if (!empty($_FILES['my_file'])) { 
				//check for image submitted
	    		if ($_FILES['my_file']['error'] > 0) { 
				// check for error re file
	            echo "Error: " . $_FILES["my_file"]["error"] ;
	        } else {
				//move temp file to our server            
				move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_directory . $newname);	
				echo 'Uploaded File.';
				header("location: inventory_list.php");
				exit();
	        }
	    } else {
		        die('File not uploaded.'); 
				// exit script
	    }
	}
	
}

?>

<?php

$product_list="";

$query = "SELECT * FROM products ORDER BY date_added ASC";

$result = mysql_query($query);

$productCount = mysql_num_rows($result);

if (mysql_num_rows($result) > 0){
	  	while($row = mysql_fetch_array($result))	{
	  		
			$id = $row['id'];
			$product_name = $row['product_name'];
			$date_added = strftime("%b %d %Y", strtotime($row['date_added']));
			$product_list .= $date_added .'-'.$id .'-'.$product_name.' &nbsp;&nbsp;&nbsp; <a href="inventory_edit.php?pid='.$id.'">Edit</a> &bull; <a href="inventory_list.php?deleteid='.$id.'&product_name='.$product_name.'"> Delete</a></br>';
	  	}
	
	echo 'products...';
	
}else{
	
	$product_list="You have no items in your store ";
}
?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">
	
	<link rel="stylesheet" href="../style/ecom.css">
	
	<title> Inventory List</title>
	
</head>

<body>
	
	<div id="page_wraper">
		
		<?php include_once("../config/template_header.php")?>
		
			<section>
				<article>
					
					<h2>Add new item</h2>
					
					<a href="inventory_list.php#inventoryForm">+ Add New Inventory Item </a>
					
				</article>
				
				
				<article>
					
					<h2>Inventory List</h2>
					
					<?php echo $product_list; ?>
					
				</article>
				</section>
				<section>
				<article>
					<a name="newitems" id="inventoryForm" ></a>
					<h2>Add new item</h2>
					
					<form action="inventory_list.php" method="post" enctype="multipart/form-data" name="myForm" id="myForm">
					<table >
						
						<tr >
							<td>Product Name</td><td><input type="text" size="50" name="product_name"/></td>
							
						</tr>
					<tr >
							<td>Price</td><td>$<input type="text" size="5" name="price"/></td>
							
						</tr>
						<tr >
							<td>Category</td><td>	<label>
									<select name="category" id="category">
										<option value"" selected=""></option>
										<option value"blocks">Blocks</option>
										<option value"stars">Stars</option>
									</select>
								</label> </td>
							
						</tr>
						<tr>
							<td>Sub Category</td><td>
								<label>
									<select name="subcategory" id="subcategory">
										<option value"" selected=""></option>
										<option value"black">black</option>
										<option value"white">white</option>
										<option value"red">red</option>
										<option value"blue">blue</option>
										<option value"pink">pink</option>
										<option value"green">green</option>
									</select>
								</label>
								
								
							</td>
							
						</tr>
						
						<tr>
							<td>Product Details</td><td><textarea cols="40" rows="6" name="details"></textarea></td>
							
						</tr>
						
						<tr>
							<td>Product Image</td><td><input type="file" name="my_file" ></td>
							
						</tr>
						<tr>
							<td><input type="submit" name="submit" value="Add This Item"</td>
							
						</tr>
					</table>
					</form>
				</article>
			</section>
			
		<?php include_once("../config/template_footer.php")?>
			
	</div>
	
</body>

</html>