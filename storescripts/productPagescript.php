<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors',1); 
include('database_connect.php');




if(isset($_GET['id'])&& isset($_GET['itemType'])){
	
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']);
	
	$itemType =$_GET['itemType'];

	// use this var to check to see if this ID exisit , if yes then get the product 
	// details, if no then exit this script and give a message
	
	$query1="SELECT * FROM products WHERE id='$id' LIMIT 1";
	
	$result1=mysql_query($query1);
	
	if (mysql_num_rows($result1)>0){
		
			while($row = mysql_fetch_array($result1))	{
				
			$product_name = $row['product_name'];
			$price=$row['price'];
			$category=$row['category'];
			$subcategory=$row['subcategory'];
			$details=$row['details'];
			$date_added = strftime("%b %d %Y", strtotime($row['date_added']));
			//$itemType=$row['itemType'];
			
			$dynamicList='<td><b>'.$product_name.'</b> <br><a href="http://www.txtease.com/storeadmin/inventory_images/'.$id.'.jpg" "><img src="http://www.txtease.com/storeadmin/inventory_images/'.$id.'.jpg" width="100" height="100"></a>
			<br> Price: $'.$price .'<br>Item: '.$category.'<br>'.$details.'<br></td>';
		
				
		}
			
		
	}else{
		
		echo "Item does not exist";
	
	exit();
}
	
	
	
}else{
	
	echo "Data to render this page is missing";
	
	exit();
}

mysql_close();
?>
