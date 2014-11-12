<?php

require('storescripts/database_connect.php');

$dynamicList="";

$query = "SELECT * FROM products ORDER BY date_added ASC LIMIT 1";

$result = mysql_query($query);

$productCount = mysql_num_rows($result);

echo '';
if (mysql_num_rows($result) > 0){

	  	while($row = mysql_fetch_array($result))	{
	  		$id=$row['id'];
			$product_name = $row['product_name'];
			$price=$row['price'];
			$category=$row['category'];
			$subcategory=$row['subcategory'];
			$details=$row['details'];
			$date_added = strftime("%b %d %Y", strtotime($row['date_added']));
			$itemType=$row['itemType'];
			$dynamicList .= '<td><a href="product.php?itemType='.$itemType.'&id='.$id.'">
			<img src="storeadmin/inventory_images/'.$id.'.jpg" width="125" height="125">
			</a><br>Name:<a href="product.php?itemType='.$itemType.'&id='.$id.'">'.$product_name.'<br/></a>
            						Price: $'.$price.'<br/>
            						Category: '.$category.'<br/>
            						</td>';

		}



}else{

	$dynamicList="You have no items in your store ";
}

echo '';
mysql_close();
?>
