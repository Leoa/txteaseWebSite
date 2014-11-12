<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors',1); 

?>



<?php

include('database_connect.php');


if(isset($_POST['pid'])){
	
	$id = preg_replace('#[^0-9]#i', '', $_POST['pid']);
	
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
			
			$dynamicList='<td><b>'.$product_name.'</b> <br><a href="http://localhost/sugardefnery/storeadmin/inventory_images/'.$id.'.jpg" "><img src="http://localhost/phpTutorials/ecomsite/storeadmin/inventory_images/'.$id.'.jpg" width="100" height="100"></a>
			<br>$'.$price .'<br>'.$category.'<br>'.$subcategory.'<br>'.$details.'</td>';
			
		}
			
			echo "id's orgional value is ".$id;
			
			$new_id=100;
			
			$id=$new_id;
			
			echo "updated value of id".$id;
				

		
	}else{
		
		echo "Item does not exist";
	
	exit();
}
	
	
	
}else{
	
	echo "Data to render this page is missing";
	
	exit();
}


?>
