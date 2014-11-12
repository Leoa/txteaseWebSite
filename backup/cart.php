<?php

session_start();

error_reporting(E_ALL);

ini_set('display_errors','1');

include('storescripts/database_connect.php');

?>


<?php
////////////////////////////////////////////////////////////////
////////////// Section 1 establish cart
///////////////////////////////////////////////////////////////


if (isset($_POST['pid'])){
	
	$pid = $_POST['pid'];
	
	$i=0;
	
	$wasFound = false;
	
	// if not set, or cart array is empty 
	
	if (!isset($_SESSION['cart_array']) || count($_SESSION['cart_array'])<1){
		
		$_SESSION['cart_array'] = array( 0 => array('item_id'=>$pid, 'quantity'=> 1));
		
		
	}else{
		// at least one item was found in the cart
		foreach($_SESSION ['cart_array'] as $each_item){
			
			$i++;// hold value of which associative array  with in mulitdeminalt array is pasing thru loop
			
			while(list($key,$value) = each($each_item)){
				//while loop access to al key value pairs in cart_array
				//list() Like array(), this is not really a function, but a language construct. list() is used to assign a list of variables in one operation. 
				//each()Return the current key and value pair from an array and advance the array cursor. 
			
				
				if($key == "item_id" && $value ==$pid){
					
					// that item is in cart already so lets adjust it quanity using araay_splice();
					// add one to that item
					///array_splice remove portion of array and replace it with someting else
					
					//input, offset, index, replacemnt
					array_splice($_SESSION['cart_array'], $i-1, 1, array(array("item_id" =>$pid, "quantity"=> $each_item['quantity'] +1)));
					
					$wasFound =true;
				}
				
			}
		
		}
		
		if($wasFound == false){
			
			array_push($_SESSION['cart_array'], array('item_id'=>$pid, 'quantity'=> 1));
			print_r($_SESSION['cart_array']);
			
			
		}
		
	}
	header("location:cart.php");
	exit();
}

?>


<?php

////////////////////////////////////////////////////////////////
////////////// Section 2 (if user choose to empty their Shopping cart)
///////////////////////////////////////////////////////////////

if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart"){
	
	unset($_SESSION['cart_array']);
}


?>






<?php



////////////////////////////////////////////////////////////////
////////////// Section 4 remove items from cart
///////////////////////////////////////////////////////////////

if(isset($_POST['index_to_remove']) && $_POST['index_to_remove']!=""){
	
	//access the array and run code to remove that array index
	
	$key_to_remove=''.mysql_real_escape_string(htmlentities($_POST['index_to_remove'])).'';
	
	echo 'index : '.$key_to_remove.': Count- <br>';
	
	if(count($_SESSION['cart_array'])<=1){
		
		
		unset($_SESSION['cart_array']);
		
		
		
	}else{
		
		unset($_SESSION['cart_array'][$key_to_remove]);
		
		sort($_SESSION['cart_array']);
		
		echo count ($_SESSION['cart_array']);
		
	}
	
}


?>

<?php


echo "index to change is running";

if (isset($_POST['index_to_change']) && $_POST['index_to_change'] != ""){
	echo $_POST['index_to_change'];
	
	 $index_to_change = $_POST['index_to_change'];
	
	$quantity = preg_replace('#[^0-9]#i','',$_POST['quantity'] );
	
	if($quantity >= 100){
		
		$quantity=99;
	}
	
	
	if($quantity <1){
		
		$quantity=1;
	}
	$i=0;
	
	foreach($_SESSION ['cart_array'] as $each_item){
			
			$i++;// hold value of which associative array  with in mulitdeminalt array is pasing thru loop
			
			while(list($key,$value) = each($each_item)){
				//while loop access to al key value pairs in cart_array
				//list() Like array(), this is not really a function, but a language construct. list() is used to assign a list of variables in one operation. 
				//each()Return the current key and value pair from an array and advance the array cursor. 
			if($key == "item_id" && $value ==$index_to_change){
					
					// that item is in cart already so lets adjust it quanity using araay_splice();
					// add one to that item
					///array_splice remove portion of array and replace it with someting else
					
					//input, offset, index, replacemnt
					array_splice($_SESSION['cart_array'], $i-1, 1, array(array("item_id" =>$index_to_change, "quantity"=> $quantity)));
					
					
				}
			
			}
	}
	
}


?>


<?php

////////////////////////////////////////////////////////////////
////////////// Section 5 render the cart to view
///////////////////////////////////////////////////////////////

$cartOutput="";
$cartTotal ="";
$priceTotal="";
$pp_checkout_btn="";


if(!isset($_SESSION['cart_array']) || count($_SESSION['cart_array'] )<1){
	
	$cartOutput ="<h2 align='center> Your Shopping Cart is empty</h2>";
	
}else{
	
	$pp_checkout_btn.='<form action ="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="business" value="webmaster@leobee.com">';
	
	$i =0;
	
	foreach($_SESSION['cart_array'] as $each_item){
		
			$item_id=$each_item['item_id'];
	
			$query = "SELECT * FROM products WHERE id=$item_id LIMIT 1";
			
			echo $query ."<br>";
	
			$resutls=mysql_query($query);
			
			$product_name="";
			$price="";
			
			while ($row= mysql_fetch_array($resutls))	{
				$item_id = $row['id'];
				
				$product_name=$row['product_name'];
				
				$price = $row['price'];
				
				$details= $row['details'];
				
				
			}
			$cartTotal = $priceTotal + $cartTotal;
			$priceTotal= $price * $each_item['quantity'];
			$x=$i+1;
			$pp_checkout_btn.='
<input type="hidden" name="item_name_'.$x.'" value="'. $product_name.'">
<input type="hidden" name="amount_'.$x.'" value="'.$price.'">
<input type="hidden" name="quantity_'.$x.'" value="'.$each_item['quantity'].'">';

//query database to remove amount from inventory.
			
			$cartOutput.= '<tr valign="top">';
			$cartOutput.= '<td> '. $product_name.'<a href="product.php?id='.$item_id.'"> <br/> <img src="http://localhost/phpTutorials/ecomsite/storeadmin/inventory_images/'.$item_id.'.jpg"></a></td>';
			$cartOutput.= '<td>'.$details.' </td>';
			$cartOutput.= '<td> $'.$price.' </td>';
			
			$cartOutput.='<td><br><form method="post" action="cart.php"><input type ="text" size="1" maxlength="2" name="quantity" value="'. $each_item['quantity'].'"/><input name="changeBtn"'.$item_id.'" type="submit" value="Change"/><input name="index_to_change" type="hidden" value="'.$item_id.'"></form> </td>';
			
			$cartOutput.= '<td>'.$each_item['quantity'].' </td>';
			$cartOutput.= '<td>'.$priceTotal.' </td>';
			
			
			$cartOutput.='<td><br><form method="post" action="cart.php"><input name="deleteBtn"'.$item_id.'" type="submit" value="X"/> <input name="index_to_remove" type="hidden" value="'.$i.'"></form> </td>';
			$cartOutput.= '</tr>';
			
				$i++;
				
		}

	$pp_checkout_btn.='<input type="hidden" name="notify_url" value="https://localhost/phpTutorials/ecomsite/storescripts/my_ipn.php">
<input type="hidden" name="return" value="https://localhost/phpTutorials/ecomsite/storescripts/complete.php">
<input type="hidden" name="rm" value="2">
<input type="hidden" name="cbt" value="Return to Store">
<input type="hidden" name="cancel_return" value="https://localhost/phpTutorials/ecomsite/storescripts/checkout_complete.php">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="currency_code" value="XXXXX">
<input type="image" name="submit"  src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" alt="Make payment with PayPal-it is free safe and secury">
</form>';
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">
	
	<link rel="stylesheet" href="style/ecom.css">
	
</head>

<body>
	
	<div id="page_wraper">
		
		<?php include_once("config/template_header.php")?>
		
			<section>
				
				<article>
					
					    <section id="main" class="flexbox">
					  <div id="pageContent">
					  	<div style="margin:24px; text-align:left;">
					  	
					  		<br/><a href="index.php"> continue shopping</a><br/>
					  		<table border="1" background-color="white" cellpadding="6" cellspacing="6">
					  			
					  			<tr>
					  				<td> Product</td>
					  				<td> Product Description</td>
					  				<td> Unit Price</td>
					  				<td> Quanity</td>
					  				<td> Total</td>
					  				<td>Remove</td>
					  			</tr>
					  			
					  		
					  			
					  				<?php echo $cartOutput;?>
					  		</table>
					  	<div align="right">	<?php echo "Cart Total: $".$cartTotal." USD "?></div><br>
					  	<div align="right">	<?php echo "Purchase:".$pp_checkout_btn?></div><br>
					  		<a href="cart.php?cmd=emptycart">Click here to empty your cart</a>
					  	</div>
					  	<br/>
					  </div>
   						 </section>
   						 
				</article>
		
			</section>
			
		<?php include_once("config/template_footer.php")?>
			
	</div>
	
</body>

</html>