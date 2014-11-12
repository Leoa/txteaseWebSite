<?php

include('database_connect.php');


/////////////////////////////////////////////////////////////////////////


session_start();

$pid="";

$image_id="";


if(isset($_GET['itemType']) && $_GET['itemType']=="scarf"){
	

	
	$itemType=$_SESSION_['itemType']=$_GET['itemType'];
	
	$xpid = $_SESSION['xpid']=15;
	
	$item_id=$xpid;
 
	$image_id=$item_id;
	
	$query1 = "SELECT * FROM products WHERE id='$item_id' LIMIT 1";

	$results1=mysql_query($query1);
			
		while ($row= mysql_fetch_array($results1))	{
				
			$item_id = $row['id'];
				
			$product_name=$row['product_name'];
				
			$price = $row['price'];
				
			$details= $row['details'];
		
			$category= $row['category'];
		
			$subcategory= $row['subcategory'];
			
		}

			$query2 = "INSERT INTO customize 
			(product_name,price,details,category,subcategory,itemType,image_id) 
			VALUES('$product_name','$price','$details','$category','$subcategory','$itemType','$image_id')";
			
			$results2= mysql_query($query2);
			
			$query3="SELECT @@IDENTITY AS 'Identity'";
			
			$results3=mysql_query($query3);		
		
			while ($row= mysql_fetch_array($results3))	{
				
			$newitem_id = $row['Identity'];

			$pid=$newitem_id;
			
		
			
			//$return["msg"].=$pid;
			
			echo $pid;
			
			//echo json_encode($return["msg"]);
		}
	
	if(isset($_SESSION['xpid'])){
	
			$id = preg_replace('#[^0-9]#i', '', $_SESSION['xpid']);
	
	// use this var to check to see if this ID exisit , if yes then get the product 
	// details, if no then exit this script and give a message
	
			$query4="SELECT * FROM products WHERE id='$id' LIMIT 1";
	
			$result4=mysql_query($query4);
	
				if (mysql_num_rows($result4)>0){
		
					while($row = mysql_fetch_array($result4))	{
				
						$product_name = $row['product_name'];
						$price=$row['price'];
						$category=$row['category'];
						$subcategory=$row['subcategory'];
						$details=$row['details'];
						$date_added = strftime("%b %d %Y", strtotime($row['date_added']));
			
						$dynamicList='<td><b>'.$product_name.'</b> <br><a href="http://localhost/sugardefnery/storeadmin/inventory_images/'.$id.'.jpg" "><img src="http://localhost/phpTutorials/ecomsite/storeadmin/inventory_images/'.$id.'.jpg" width="100" height="100"></a>
						<br>$'.$price .'<br>'.$category.'<br>'.$subcategory.'<br>'.$details.'</td>';
		
	
						//$return['msg'].= $pid;
				
						}
			
					
				}else{
		
			
	
				exit();
				}
	
	
	
			}else{
	
	
	
	exit();
	}
			
			mysql_close();
}


///////////////////////////////////////////////////





if(isset($_GET['itemType']) && $_GET['itemType']=="hats"){
	
	$itemType=$_SESSION_['itemType']=$_GET['itemType'];
	
	$xpid = $_SESSION['xpid']=16;
	
	$item_id=$xpid;
 
	$image_id=$item_id;
	
	$query1 = "SELECT * FROM products WHERE id='$item_id' LIMIT 1";

	$results1=mysql_query($query1);
			
		while ($row= mysql_fetch_array($results1))	{
				
			$item_id = $row['id'];
				
			$product_name=$row['product_name'];
				
			$price = $row['price'];
				
			$details= $row['details'];
		
			$category= $row['category'];
		
			$subcategory= $row['subcategory'];
			
		}

			$query2 = "INSERT INTO customize 
			(product_name,price,details,category,subcategory,itemType,image_id) 
			VALUES('$product_name','$price','$details','$category','$subcategory','$itemType','$image_id')";
			
			$results2= mysql_query($query2);
			
			$query3="SELECT @@IDENTITY AS 'Identity'";
			
			$results3=mysql_query($query3);		
		
			while ($row= mysql_fetch_array($results3))	{
				
			$newitem_id = $row['Identity'];

			$pid=$newitem_id;
			
		
			
			//$return["msg"].=$pid;
			
			echo $pid;
			
			//echo json_encode($return["msg"]);
		}
	
	if(isset($_SESSION['xpid'])){
	
			$id = preg_replace('#[^0-9]#i', '', $_SESSION['xpid']);
	
	// use this var to check to see if this ID exisit , if yes then get the product 
	// details, if no then exit this script and give a message
	
			$query4="SELECT * FROM products WHERE id='$id' LIMIT 1";
	
			$result4=mysql_query($query4);
	
				if (mysql_num_rows($result4)>0){
		
					while($row = mysql_fetch_array($result4))	{
				
						$product_name = $row['product_name'];
						$price=$row['price'];
						$category=$row['category'];
						$subcategory=$row['subcategory'];
						$details=$row['details'];
						$date_added = strftime("%b %d %Y", strtotime($row['date_added']));
			
						$dynamicList='<td><b>'.$product_name.'</b> <br><a href="http://localhost/sugardefnery/storeadmin/inventory_images/'.$id.'.jpg" "><img src="http://localhost/phpTutorials/ecomsite/storeadmin/inventory_images/'.$id.'.jpg" width="100" height="100"></a>
						<br>$'.$price .'<br>'.$category.'<br>'.$subcategory.'<br>'.$details.'</td>';
		
	
						//$return['msg'].= $pid;
				
						}
			
					
				}else{
		
			
	
				exit();
				}
	
	
	
			}else{
	
	
	
	exit();
	}
			
			mysql_close();
}

if(isset($_GET['itemType']) && $_GET['itemType']=="gloves"){
	
	$itemType=$_SESSION_['itemType']=$_GET['itemType'];
	
	$xpid = $_SESSION['xpid']=13;
	
	$item_id=$xpid;
 
	$image_id=$item_id;
	
	$query1 = "SELECT * FROM products WHERE id='$item_id' LIMIT 1";

	$results1=mysql_query($query1);
			
		while ($row= mysql_fetch_array($results1))	{
				
			$item_id = $row['id'];
				
			$product_name=$row['product_name'];
				
			$price = $row['price'];
				
			$details= $row['details'];
		
			$category= $row['category'];
		
			$subcategory= $row['subcategory'];
			
		}

			$query2 = "INSERT INTO customize 
			(product_name,price,details,category,subcategory,itemType,image_id) 
			VALUES('$product_name','$price','$details','$category','$subcategory','$itemType','$image_id')";
			
			$results2= mysql_query($query2);
			
			$query3="SELECT @@IDENTITY AS 'Identity'";
			
			$results3=mysql_query($query3);		
		
			while ($row= mysql_fetch_array($results3))	{
				
			$newitem_id = $row['Identity'];

			$pid=$newitem_id;
			
		
			
			//$return["msg"].=$pid;
			
			echo $pid;
			
			//echo json_encode($return["msg"]);
		}
	
	if(isset($_SESSION['xpid'])){
	
			$id = preg_replace('#[^0-9]#i', '', $_SESSION['xpid']);
	
	// use this var to check to see if this ID exisit , if yes then get the product 
	// details, if no then exit this script and give a message
	
			$query4="SELECT * FROM products WHERE id='$id' LIMIT 1";
	
			$result4=mysql_query($query4);
	
				if (mysql_num_rows($result4)>0){
		
					while($row = mysql_fetch_array($result4))	{
				
						$product_name = $row['product_name'];
						$price=$row['price'];
						$category=$row['category'];
						$subcategory=$row['subcategory'];
						$details=$row['details'];
						$date_added = strftime("%b %d %Y", strtotime($row['date_added']));
			
						$dynamicList='<td><b>'.$product_name.'</b> <br><a href="http://localhost/sugardefnery/storeadmin/inventory_images/'.$id.'.jpg" "><img src="http://localhost/phpTutorials/ecomsite/storeadmin/inventory_images/'.$id.'.jpg" width="100" height="100"></a>
						<br>$'.$price .'<br>'.$category.'<br>'.$subcategory.'<br>'.$details.'</td>';
		
	
						//$return['msg'].= $pid;
				
						}
			
					
				}else{
		
			
	
				exit();
				}
	
	
	
			}else{
	
	
	
	exit();
	}
			
			mysql_close();
}
