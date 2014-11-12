
<?php

session_start();


include('storescripts/database_connect.php');

?>

<?php
 $gcRed="";
 $gcGreen="";
 $gcBlue="";
 $gctRed="";
 $gctGreen="";
 $gctBlue="";

$counter=2;

$temp="";

	//echo "value of temp	". $temp."<br>";

if (isset($_POST['gcRed'])&& isset($_POST['gcGreen']) && isset($_POST['gcBlue'])&& isset($_POST['gctRed'])&& isset($_POST['gctGreen']) && isset($_POST['gctBlue'])){
	
$gctRed=$_POST['gctRed'];
	
$gctGreen=$_POST['gctGreen'];

$gctBlue=$_POST['gctBlue'];

$gcRed=$_POST['gcRed'];

$gcGreen=$_POST['gcGreen'];

$gcBlue=$_POST['gcBlue'];

echo "rt is ".$gctRed."<br>";

echo "gt ".$gctGreen."<br>";

echo "bt is ".$gctBlue."<br>";

echo "r is ".$gcRed."<br>";

echo "g is ".$gcGreen."<br>";

echo "b is ".$gcBlue."<br>";




 
 print_r($_COOKIE);
 	
	
}
?>


<?php
////////////////////////////////////////////////////////////////
////////////// Section 1 establish cart
///////////////////////////////////////////////////////////////


if (isset($_POST['pid'])&& !empty($_POST['pid'])){
	
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
				//while loop access to all key value pairs in cart_array
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
	//header("location:cart.php");
	//exit();
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
	
	echo "key to remove".$_POST['temp']."<br>";
	
	if ($temp ==13||$temp ==18||$temp ==19){
		
	$counter=$counter+1;
		
		echo "key to remove inside if".$temp;
		
		if ($temp ==13){

			
			setcookie ("gcRed_13", "", time() - 3600); 
			setcookie ("gcBlue_13", "", time() - 3600); 
			setcookie ("gcGreen_13", "", time() - 3600); 
			setcookie ("gctRed_13", "", time() - 3600); 
			setcookie ("gctBlue_13", "", time() - 3600); 
			setcookie ("gctGreen_13", "", time() - 3600); 
			
			echo" <br> cookies reste";
		}
	}
	
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
$product_id_array="";




if(!isset($_SESSION['cart_array']) || count($_SESSION['cart_array'] )<1){
	
	$cartOutput ="<h2 align='center> Your Shopping Cart is empty</h2>";
	
}else{

	$pp_checkout_btn.='<form action ="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="business" value="webmaster@leobee.com">';
	
	$product_id_array.=$item_id."-".$each_item['quantity'].";";
	// product id - price 
	
	$i =0;
	
	foreach($_SESSION['cart_array'] as $each_item){
		
			$item_id=$each_item['item_id'];
	
			$query = "SELECT * FROM products WHERE id=$item_id LIMIT 1";
	
			$resutls=mysql_query($query);
			
			$product_name="";
			
			$price="";
			
			while ($row= mysql_fetch_array($resutls))	{
				
				$item_id = $row['id'];
				
				$product_name=$row['product_name'];
				
				$price = $row['price'];
				
				$details= $row['details'];
				
				
			}
			
			
				echo "<br><br><br><br>item id is :".$item_id;
				
				$temp_item=0;
				
				$temp_item=$item_id;
				
				echo "<br> value of temp item :".$temp_item;
				
				$thtn=13;
				
				if($temp_item == 13){
					
					echo "<br> value of temp_item  in condition :".$temp_item;
					
					echo " <br>update server becasue id is 13";
					
					$temp_item=0;
					
					 echo "<br> value of temp_item  has been set to zero :".$temp_item;
					 
						/* var end with 13 reg exp.
					
					//$temp=$item_id;
						
						////////////// colors for display
					$gctRed13="gctRed".$temp;
					
					$gctGreen13="gctGreen".$temp;
					
					$gctBlue13="gctBlue".$temp;
					
					$gcRed13="gcRed".$temp;
					
					$gcGreen13="gcGreen".$temp;
					
					$gcBlue13="gcBlue".$temp;
					//////////////////////////
					
					
					
					$gtr="gctRed_".$temp;

					$gtg="gctGreen_".$temp;

					$gtb="gctBlue_".$temp;

					$gr="gcRed_".$temp;

					$gg="gcGreen_".$temp;

					$gb="gcBlue_".$temp;


 					setcookie($gtr, $gctRed,time() + 3600);
 
 					setcookie($gtg, $gctGreen, time() + 3600);
 
 					setcookie($gtb, $gctBlue,time() + 3600);
 
 					setcookie($gr, $gcRed,time() + 3600);
 
 					setcookie($gg, $gcGreen,time() + 3600);
 
 					setcookie($gb, $gcBlue,time() + 3600);
					*/
					
					
				
					$glove='<br> <br>Finger Tip Color:<br><div style="background-color:rgb('.$gctRed13.', '.$gctGreen13. ', '.$gctBlue13.'); width:50px; height:50px;"></div> <br> Glove Color:<br><div style="background-color:rgb('.$gcRed13.', '.$gcGreen13. ', '.$gcBlue13.'); width:50px; height:50px;"></div><br><a href="product.php?id=18">Create up to '.$counter.' more styles Click here </a>';
			
				}
				else{ echo"<br> do not update server item is not equeal to 13";}
					 if($item_id == 18){
					
					$gctRed18="gctRed".$pid;
					$gctGreen18="gctGreen".$pid;
					$gctBlue18="gctBlue".$pid;
					$gcRed18="gcRed".$pid;
					$gcGreen18="gcGreen".$pid;
					$gcBlue18="gcBlue".$pid;
					
					
					$counter=$counter-1;
					$glove='<br> <br>Finger Tip Color:<br><div style="background-color:rgb('.$gctRed18.', '.$gctGreen18. ', '.$gctBlue18.'); width:50px; height:50px;"></div> <br> Glove Color:<br><div style="background-color:rgb('.$gcRed18.', '.$gcGreen18. ', '.$gcBlue18.'); width:50px; height:50px;"></div><br><a href="product.php?id=19">Create up to'.$counter.' more styles Click here </a>';
			$temp=$item_id;
					
				}
				else{}
if($item_id ==19){
					
					$gctRed19="gctRed".$pid;
					$gctGreen19="gctGreen".$pid;
					$gctBlue19="gctBlue".$pid;
					$gcRed19="gcRed".$pid;
					$gcGreen19="gcGreen".$pid;
					$gcBlue19="gcBlue".$pid;
					
					
					
					$counter=$counter-1;
					$glove='<br> <br>Finger Tip Color:<br><div style="background-color:rgb('.$gctRed19.', '.$gctGreen19. ', '.$gctBlue19.'); width:50px; height:50px;"></div> <br> Glove Color:<br><div style="background-color:rgb('.$gcRed19.', '.$gcGreen19. ', '.$gcBlue19.'); width:50px; height:50px;"></div><br>';
			$temp=$item_id;
				}else{
						
						$glove="";
					
				}
				
			
				echo "value of temp outside of if statement	". $temp."<br>";
			$priceTotal= $price * $each_item['quantity'];
		
			$cartTotal = $priceTotal + $cartTotal;
		
			$x=$i+1;
			
			$pp_checkout_btn.='
<input type="hidden" name="item_name_'.$x.'" value="'. $product_name.'">
<input type="hidden" name="amount_'.$x.'" value="'.$price.'">
<input type="hidden" name="quantity_'.$x.'" value="'.$each_item['quantity'].'">';

//query database to update amount of product in inventory.( may need to use hidden value in usein inventory var name)
			
			$cartOutput.= '<tr valign="top">';
			$cartOutput.= '<td> '. $product_name.'<a href="product.php?id='.$item_id.'"> <br/> <img src="http://localhost/sugardefynery/storeadmin/inventory_images/'.$item_id.'.jpg"></a></td>';
			$cartOutput.= '<td>'.$details.' '.$glove.' </td>';
			$cartOutput.= '<td> $'.$price.' </td>';
			
			$cartOutput.='<td><br><form method="post" action="cart.php"><input type ="text" size="1" maxlength="2" name="quantity" value="'. $each_item['quantity'].'"/><input name="changeBtn"'.$item_id.'" type="submit" value="Change"/><input name="index_to_change" type="hidden" value="'.$item_id.'"></form> </td>';
			
			$cartOutput.= '<td>'.$each_item['quantity'].' </td>';
			$cartOutput.= '<td> $'.$priceTotal.' </td>';
			
			
			$cartOutput.='<td><br><form method="post" action="cart.php"><input name="deleteBtn"'.$item_id.'" type="submit" value="X"/> <input name="index_to_remove" type="hidden" value="'.$i.'"><input name="temp" type="hidden" value="'.$temp.'"></form> </td>';
			$cartOutput.= '</tr>';
			
				$i++;
			
		}
//https://p8.secure.hostingprod.com/@leobee.com/ssl/index.php
	$pp_checkout_btn.='<input type="hidden" name="custom" value="'.$product_id_array.'">
	<input type="hidden" name="notify_url" value="http://localhost/sugardefynery/storescripts/my_ipn.php">
<input type="hidden" name="return" value="http://localhost/sugardefynery/storescripts/checkout_complete.php">
<input type="hidden" name="rm" value="2">
<input type="hidden" name="cbt" value="Return to Store">
<input type="hidden" name="cancel_return" value="http://localhost/sugardefynery/storescripts/paypal_cancel.php">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="currency_code" value="XXXXX">
<input type="image" name="submit"  src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" alt="Make payment with PayPal">
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
		
		<?php include_once("config/template_header_2.php")?>
		
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
					  				<td> Items</td>
					  				<td> Total</td>
					  				<td> Remove</td>
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
?>

<?php
 $gcRed="";
 $gcGreen="";
 $gcBlue="";
 $gctRed="";
 $gctGreen="";
 $gctBlue="";
$temp='';
$counter=2;

	//echo "value of temp	". $temp."<br>";

if (isset($_POST['gcRed'])&& isset($_POST['gcGreen']) && isset($_POST['gcBlue'])&& isset($_POST['gctRed'])&& isset($_POST['gctGreen']) && isset($_POST['gctBlue'])){
	
$gctRed=$_POST['gctRed'];
	
$gctGreen=$_POST['gctGreen'];

$gctBlue=$_POST['gctBlue'];

$gcRed=$_POST['gcRed'];

$gcGreen=$_POST['gcGreen'];

$gcBlue=$_POST['gcBlue'];

 setcookie("gctRed".$pid, $gctRed);
 
 setcookie("gctGreen".$pid, $gctGreen);
 
 setcookie("gctBlue".$pid, $gctBlue);
 
 setcookie("gcRed".$pid, $gcRed);
 
 setcookie("gcGreen".$pid, $gcGreen);
 
 setcookie("gcBlue".$pid, $gcBlue);
 
 	if(isset($_COOKIE["gctRed".$pid]))
 	{ 
 		$last = $_COOKIE["gctRed".$pid];
		 
 		echo var_name ($last);
		
 		} 
	
 	else 
		
 	{
 		 
 		echo "cookie not set"; 
		
 	} 
	
}
?>


<?php
////////////////////////////////////////////////////////////////
////////////// Section 1 establish cart
///////////////////////////////////////////////////////////////


if (isset($_POST['pid'])&& !empty($_POST['pid'])){
	
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
				//while loop access to all key value pairs in cart_array
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
	//header("location:cart.php");
	//exit();
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
	
	echo "key to remove".$_POST['temp']."<br>";
	
	if ($temp ==13||$temp ==18||$temp ==19){
		
	$counter=$counter+1;
		
		echo "key to remove inside if".$temp;
		
		if ($temp ==13){
			
			unset($_COOKIE[$gctRed13]);
			
			unset($_COOKIE[$gctGreen13]);
			
			unset($_COOKIE[$gctBlue13]);
			
			unset($_COOKIE[$gcRed13]);
			
			unset($_COOKIE[$gcGreen13]);
			
			unset($_COOKIE[$gcBlue13]);
			
		}
	}
	
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
$product_id_array="";




if(!isset($_SESSION['cart_array']) || count($_SESSION['cart_array'] )<1){
	
	$cartOutput ="<h2 align='center> Your Shopping Cart is empty</h2>";
	
}else{

	$pp_checkout_btn.='<form action ="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="business" value="webmaster@leobee.com">';
	
	$product_id_array.=$item_id."-".$each_item['quantity'].";";
	// product id - price 
	
	$i =0;
	
	foreach($_SESSION['cart_array'] as $each_item){
		
			$item_id=$each_item['item_id'];
	
			$query = "SELECT * FROM products WHERE id=$item_id LIMIT 1";
	
			$resutls=mysql_query($query);
			
			$product_name="";
			
			$price="";
			
			while ($row= mysql_fetch_array($resutls))	{
				
				$item_id = $row['id'];
				
				$product_name=$row['product_name'];
				
				$price = $row['price'];
				
				$details= $row['details'];
				
				/*
				 $gctRed=$row['gctRed'];
				 
 				$gctGreen=$row['gctGreen'];
				
 				$gctBlue=$row['gctBlue'];
				
 				$gcRed=$row['gcRed'];
				
 				$gcGreen=$row['gcGreen'];
				
 				$gcBlue=$row['gcBlue'];
				*/
				
			}
			
			
				
				
				
				if($item_id == 13){
						// var end with 13 reg exp.
						
						//if (var end with 13)
						
						
					$gctRed13="gctRed".$pid;
					$gctGreen13="gctGreen".$pid;
					$gctBlue13="gctBlue".$pid;
					$gcRed13="gcRed".$pid;
					$gcGreen13="gcGreen".$pid;
					$gcBlue13="gcBlue".$pid;
					
					
					$temp=$item_id;
					echo "value of temp	 insside if". $temp."<br>";
				
					$glove='<br> <br>Finger Tip Color:<br><div style="background-color:rgb('.$gctRed13.', '.$gctGreen13. ', '.$gctBlue13.'); width:50px; height:50px;"></div> <br> Glove Color:<br><div style="background-color:rgb('.$gcRed13.', '.$gcGreen13. ', '.$gcBlue13.'); width:50px; height:50px;"></div><br><a href="product.php?id=18">Create up to '.$counter.' more styles Click here </a>';
			
				}
				else if($item_id == 18 && "gctRed".$pid==18){
					
					$gctRed18="gctRed".$pid;
					$gctGreen18="gctGreen".$pid;
					$gctBlue18="gctBlue".$pid;
					$gcRed18="gcRed".$pid;
					$gcGreen18="gcGreen".$pid;
					$gcBlue18="gcBlue".$pid;
					
					
					$counter=$counter-1;
					$glove='<br> <br>Finger Tip Color:<br><div style="background-color:rgb('.$gctRed18.', '.$gctGreen18. ', '.$gctBlue18.'); width:50px; height:50px;"></div> <br> Glove Color:<br><div style="background-color:rgb('.$gcRed18.', '.$gcGreen18. ', '.$gcBlue18.'); width:50px; height:50px;"></div><br><a href="product.php?id=19">Create up to'.$counter.' more styles Click here </a>';
			$temp=$item_id;
					
				}
				else if($item_id ==19  && "gctRed".$pid==19){
					
					$gctRed19="gctRed".$pid;
					$gctGreen19="gctGreen".$pid;
					$gctBlue19="gctBlue".$pid;
					$gcRed19="gcRed".$pid;
					$gcGreen19="gcGreen".$pid;
					$gcBlue19="gcBlue".$pid;
					
					
					
					$counter=$counter-1;
					$glove='<br> <br>Finger Tip Color:<br><div style="background-color:rgb('.$gctRed19.', '.$gctGreen19. ', '.$gctBlue19.'); width:50px; height:50px;"></div> <br> Glove Color:<br><div style="background-color:rgb('.$gcRed19.', '.$gcGreen19. ', '.$gcBlue19.'); width:50px; height:50px;"></div><br>';
			$temp=$item_id;
				}else{
						
						$glove="";
					
				}
				
			
				echo "value of temp outside of if statement	". $temp."<br>";
			$priceTotal= $price * $each_item['quantity'];
		
			$cartTotal = $priceTotal + $cartTotal;
		
			$x=$i+1;
			
			$pp_checkout_btn.='
<input type="hidden" name="item_name_'.$x.'" value="'. $product_name.'">
<input type="hidden" name="amount_'.$x.'" value="'.$price.'">
<input type="hidden" name="quantity_'.$x.'" value="'.$each_item['quantity'].'">';

//query database to update amount of product in inventory.( may need to use hidden value in usein inventory var name)
			
			$cartOutput.= '<tr valign="top">';
			$cartOutput.= '<td> '. $product_name.'<a href="product.php?id='.$item_id.'"> <br/> <img src="http://localhost/sugardefynery/storeadmin/inventory_images/'.$item_id.'.jpg"></a></td>';
			$cartOutput.= '<td>'.$details.' '.$glove.' </td>';
			$cartOutput.= '<td> $'.$price.' </td>';
			
			$cartOutput.='<td><br><form method="post" action="cart.php"><input type ="text" size="1" maxlength="2" name="quantity" value="'. $each_item['quantity'].'"/><input name="changeBtn"'.$item_id.'" type="submit" value="Change"/><input name="index_to_change" type="hidden" value="'.$item_id.'"></form> </td>';
			
			$cartOutput.= '<td>'.$each_item['quantity'].' </td>';
			$cartOutput.= '<td> $'.$priceTotal.' </td>';
			
			
			$cartOutput.='<td><br><form method="post" action="cart.php"><input name="deleteBtn"'.$item_id.'" type="submit" value="X"/> <input name="index_to_remove" type="hidden" value="'.$i.'"><input name="temp" type="hidden" value="'.$temp.'"></form> </td>';
			$cartOutput.= '</tr>';
			
				$i++;
			
		}
//https://p8.secure.hostingprod.com/@leobee.com/ssl/index.php
	$pp_checkout_btn.='<input type="hidden" name="custom" value="'.$product_id_array.'">
	<input type="hidden" name="notify_url" value="http://localhost/sugardefynery/storescripts/my_ipn.php">
<input type="hidden" name="return" value="http://localhost/sugardefynery/storescripts/checkout_complete.php">
<input type="hidden" name="rm" value="2">
<input type="hidden" name="cbt" value="Return to Store">
<input type="hidden" name="cancel_return" value="http://localhost/sugardefynery/storescripts/paypal_cancel.php">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="currency_code" value="XXXXX">
<input type="image" name="submit"  src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" alt="Make payment with PayPal">
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
		
		<?php include_once("config/template_header_2.php")?>
		
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
					  				<td> Items</td>
					  				<td> Total</td>
					  				<td> Remove</td>
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