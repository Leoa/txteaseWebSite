<?php



echo"pAGE LOADDED";

$temp='';

$gcRed="";
 
$gcGreen="";
 
$gcBlue="";
 
$gctRed="";
 
$gctGreen="";
 
$gctBlue="";
 
$itemType="";

$pid="";

$newitem_id='';

if (isset($_POST['gcRed'])&& isset($_POST['gcGreen']) 

&& isset($_POST['gcBlue'])&& isset($_POST['gctRed'])&& isset($_POST

['gctGreen']) && isset($_POST['gctBlue']) && isset($_POST['itemType'])){
	
	echo 'posting...';
	//  rember to sanitze vars here
$gctRed=$_POST['gctRed'];
	
$gctGreen=$_POST['gctGreen'];

$gctBlue=$_POST['gctBlue'];

$gcRed=$_POST['gcRed'];

$gcGreen=$_POST['gcGreen'];

$gcBlue=$_POST['gcBlue'];

$itemType=$_POST['itemType'];



$pid = $_POST['pid'];

$item_id=$pid;

$query5 = "SELECT * FROM products WHERE id='$item_id' LIMIT 1";



$results=mysql_query($query5);
			
	while ($row= mysql_fetch_array($results))	{
				
		$item_ix = $row['id'];
				
		$product_name=$row['product_name'];
				
		$price = $row['price'];
				
		$details= $row['details'];
		
		$category= $row['category'];
		
		$subcategory= $row['subcategory'];
				
	
	}
$query2 = "INSERT INTO customize 

(product_name,price,details,category,subcategory,tipRed,tipGreen,tipBlue,glov

eRed,gloveGreen,gloveBlue,itemType) VALUES

('$product_name','$price','$details','$category','$subcategory','$gctRed','$g

ctGreen','$gctBlue','$gcRed','$gcGreen','$gcBlue','$itemType')";


	
	
	$results2= mysql_query($query2);
	
	//while ($row= mysql_fetch_array($results2))	{
				
	//	$newitem_id = $row['id'];

	
	//}
	
	
	
$query3="SELECT @@IDENTITY AS 'Identity'";

		$results3=mysql_query($query3);		
		
		while ($row= mysql_fetch_array($results3))	{
				
		$newitem_id = $row['Identity'];

	$temp=$newitem_id;
	}
	
return $temp;


}
?>