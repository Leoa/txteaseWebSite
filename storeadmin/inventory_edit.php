<?php

session_start();

include('../storescripts/database_connect.php');

if (!isset($_SESSION['manager']) || empty($_SESSION['manager']) || $_SESSION['manager']===NULL){
	
	// not loged in
	header("Location: admin_login.php");
	
	exit();
	
}
 
$error =  Array();

$error[]= "session: ".$_SESSION['manager'];

$managerID =''. mysql_real_escape_string(htmlentities(preg_replace('#[^0-9]#i','', $_SESSION['id']))).'';

$error[]= " manager id session : ".$managerID;

$manager = ''.mysql_real_escape_string(htmlentities(preg_replace('#[^A-Za-z0-9]#i','', $_SESSION['manager']))).'';

$error[]= "manager name session: ".$manager;

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



?>

<?php

// this block grabs the whole list ofr vewing

error_reporting(E_ALL);
ini_set('display_errors','1');

echo "this is running <br>";

?>




<?php
// Parse from and add data to the database

$error= Array();
echo "Gathering info....<br>";

 //$var=$_GET['thisID'];
 //$var2 =$_POST['thisID'];
 //$error[]= " post this id : ".$var2;
 //$error[]= " get this id : ".$var;
if (isset($_POST['product_name']) && !empty($_POST['product_name'])){
	
	$product_name = ''. mysql_real_escape_string(htmlentities($_POST['product_name'])).'';
	
	
	$id = ''. mysql_real_escape_string(htmlentities($_POST['thisID'])).'';
	
	$error[]= " pid filter 1: ".$id;
	
	$price = ''. mysql_real_escape_string(htmlentities($_POST['price'])).'';
	
	$error[]= " price: ".$price;
	
	$category = ''. mysql_real_escape_string(htmlentities($_POST['category'])).'';
	
	$error[]= " category: ".$category;
	
	$subcategory = ''. mysql_real_escape_string(htmlentities($_POST['subcategory'])).'';
	
	$error[]= " subcategory: ".$subcategory;
	
	$details = ''. mysql_real_escape_string(htmlentities($_POST['details'])).'';
	
	$error[]= " details: ".$details;
	
	$query2 = "UPDATE products SET product_name='$product_name', price='$price', details='$details',category='$category', subcategory ='$subcategory' WHERE id=$id";
	
	$error[]= " query 2: ".$query2;
	
	mysql_query($query2);
	
	$newname=$id.'.jpg';
	
	$error[]= " image name: ".$newname;
	// curl
	foreach ($error as $errors){ echo $errors. "<br>";}
	
	$upload_directory=dirname(__FILE__).'\\inventory_images\\';
	//$newimageLocation='';
	
//check if form submitted
	if (isset($_POST['submit'])) {  
	    if (!empty($_FILES['my_file']) && $_FILES['my_file']['tmp_name']!='' ){ 
				//check for image submitted
	    		if ($_FILES['my_file']['error'] > 0) { 
				// check for error re file
	            echo "Error: " . $_FILES["my_file"]["error"] ;
	        } else {
				//move temp file to our server            
				move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_directory . $newname);	
				echo 'Uploaded File.';
				//$newimageLocation = $upload_directory . $newname;
				//header("location: inventory_list.php");
				//exit();
	        }
	    } else {
	    	//header("location: inventory_list.php");
				//exit();
		       //
				// exit script
	    }
	}
	
	
}

?>
<?php

$error =  Array();

$product_list="";



if(isset($_GET['pid'])){
		
			
		$error[]= " get pid: ".$_GET['pid'];
		
	$filtered_pid = $_GET['pid'];
		
		$error[]= " filtered pid: ".$filtered_pid;
	


	$query5 = "SELECT * FROM products WHERE id='$filtered_pid' LIMIT 1";

		$error[]= " query5: ".$query5;
	
	$result = mysql_query($query5);

		$error[]= " result5 : ".$result;
		
	$productCount = mysql_num_rows($result);

	if (mysql_num_rows($result) > 0){
	  	while($row = mysql_fetch_array($result))	{
	  		
			//$id = $row['id'];
			$product_name = $row['product_name'];
			$price=$row['price'];
			$category=$row['category'];
			$subcategory=$row['subcategory'];
			$details=$row['details'];
			$date_added = strftime("%b %d %Y", strtotime($row['date_added']));
			
		}
	
	}else{
	
	$product_list="Product does not exist <a href='inventory_list.php'>Click here</a> ";
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
					
					<?php echo $product_list;?>
					
				</article>
				</section>
				<section>
				<article>
					<a name="newitems" id="inventoryForm" ></a>
					<h2>Add new item</h2>
					
					<form action="inventory_edit.php" method="post" enctype="multipart/form-data" name="myForm" id="myForm">
					<table >
						
						<tr >
							<td>Product Name</td><td><input type="text" size="50" name="product_name" value="<?php echo $product_name; ?>"/></td>
							
						</tr>
					<tr >
							<td>Price</td><td>$<input type="text" size="5" name="price" value="<?php echo $price; ?>"/></td>
							
						</tr>
						<tr >
							<td>Category</td><td>	<label>
									<select name="category" id="category">
										<option value="<?php echo $category; ?>"> <?php echo $category; ?></option>
										<option value="blocks">Blocks</option>
										<option value="stars">Stars</option>
									</select>
								</label> </td>
							
						</tr>
						<tr>
							<td>Sub Category</td><td>
								<label>
									<select name="subcategory" id="subcategory">
										<option value="<?php echo $subcategory; ?>" > <?php echo $subcategory; ?></option>
										<option value="black">black</option>
										<option value="white">white</option>
										<option value="red">red</option>
										<option value="blue">blue</option>
										<option value="pink">pink</option>
										<option value="green">green</option>
									</select>
								</label>
								
								
							</td>
							
						</tr>
						
						<tr>
							<td>Product Details</td><td><textarea cols="40" rows="6" name="details" > <?php echo $details; ?></textarea></td>
							
						</tr>
						
						<tr>
							<td>Product Image</td><td><input type="file" name="my_file" ></td>
							
						</tr>
						<tr>
							<td><input type="hidden" name="thisID" value="<?php echo $filtered_pid; ?>"></td>
							<td><input type="submit" name="submit" value="Make Changes" ></td>
							
						</tr>
					</table>
					</form>
				</article>
			</section>
			
		<?php include_once("../config/template_footer.php")?>
			
	</div>
	
</body>

</html>