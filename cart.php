<?php

session_start(); // Start session first thing in script
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
// Connect to the MySQL database
include('storescripts/database_connect.php');
require 'config/config_path.php';
$path =$conf['site_url'];


sleep(3);
?>
<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 1 (if user attempts to add something to the cart from the product page)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
	$gctRed = $_POST['gctRed'];
	$gctGreen = $_POST['gctGreen'];
	$gctBlue = $_POST['gctBlue'];
	$itemType = $_POST['itemType'];
	$gcRed= $_POST['gcRed'];
	$gcGreen = $_POST['gcGreen'];
	$gcBlue = $_POST['gcBlue'];
	$xpid = $_POST['xpid'];

	$wasFound = false;
	$i = 0;
	// If the cart session variable is not set or cart array is empty
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
	    // RUN IF THE CART IS EMPTY OR NOT SET
		$_SESSION["cart_array"] = array(0 => array("item_id" => $pid, "quantity" => 1,"gcRed"=> $gcRed,"gcGreen"=> $gcGreen,"gcBlue"=> $gcBlue,"gctRed"=> $gctRed,"gctGreen"=> $gctGreen,"gctBlue"=> $gctBlue,"itemType"=> $itemType,"xpid"=> $xpid));


	} else {
		// RUN IF THE CART HAS AT LEAST ONE ITEM IN IT
		foreach ($_SESSION["cart_array"] as $each_item) {
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $pid) {
					  // That item is in cart already so let's adjust its quantity using array_splice()
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $pid, "quantity" => $each_item['quantity'] + 1,"gcRed"=> $gcRed,"gcGreen"=> $gcGreen,"gcBlue"=> $gcBlue,"gctRed"=> $gctRed,"gctGreen"=> $gctGreen,"gctBlue"=> $gctBlue,"itemType"=> $itemType,"xpid"=> $xpid)));

					  $wasFound = true;
				  } // close if condition
		      } // close while loop
	       } // close foreach loop
		   if ($wasFound == false) {
			   array_push($_SESSION["cart_array"], array("item_id" => $pid, "quantity" => 1,"gcRed"=> $gcRed,"gcGreen"=> $gcGreen,"gcBlue"=> $gcBlue,"gctRed"=> $gctRed,"gctGreen"=> $gctGreen,"gctBlue"=> $gctBlue,"itemType"=> $itemType,"xpid"=> $xpid));

		   }
	}
	header("location:cart.php");
    exit();
}
?>
<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 2 (if user chooses to empty their shopping cart)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
    unset($_SESSION["cart_array"]);
}
?>
<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 3 (if user chooses to adjust item quantity)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$errors=array();
$quantity='';
if (isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] != "" && $_POST['quantity']!="") {


		$gcRed =$_SESSION['gcRed'] =$_POST['gcRed'];
		$gcGreen = $_SESSION['gcGreen']=$_POST['gcGreen'];
		$gcBlue = $_SESSION['gcBlue']=$_POST['gcBlue'];
		$gctRed = $_SESSION['gctRed']=$_POST['gctRed'];
		$gctGreen = $_SESSION['gctGreen']=$_POST['gctGreen'];
		$gctBlue =$_SESSION['gctBlue'] =$_POST['gctBlue'];
		$xpid = $_SESSION['xpid']=$_POST['xpid'];
		$itemType = $_SESSION['itemType']=$_POST['itemType'];



	$item_to_adjust = "id of item to change ".$_POST['item_to_adjust'];
	$item_to_adjust = $_POST['item_to_adjust'];
	$quantity = $_POST['quantity'];
	$quantity = preg_replace('#[^0-9]#i', '', $quantity); // filter everything but numbers
	if ($quantity >= 100) { $quantity = 99; }
	if ($quantity < 1) { $quantity = 1; }
	if ($quantity == "") { $quantity = 1; }
	$i = 0;
	foreach ($_SESSION["cart_array"] as $each_item) {
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $item_to_adjust) {
					  // That item is in cart already so let's adjust its quantity using array_splice()
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $item_to_adjust, "quantity" => $quantity,"gcRed"=> $gcRed,"gcGreen"=> $gcGreen,"gcBlue"=> $gcBlue,"gctRed"=> $gctRed,"gctGreen"=> $gctGreen,"gctBlue"=> $gctBlue,"itemType"=> $itemType,"xpid"=> $xpid)));
				  } // close if condition
		      } // close while loop
	} // close foreach loop
}
?>


<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 4 (if user wants to remove an item from cart)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "") {
    // Access the array and run code to remove that array index
 	$key_to_remove = $_POST['index_to_remove'];
	if (count($_SESSION["cart_array"]) <= 1) {
		unset($_SESSION["cart_array"]);
	} else {
		unset($_SESSION["cart_array"]["$key_to_remove"]);
		sort($_SESSION["cart_array"]);
	}
}
?>
<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 5  (render the cart for the user to view on the page)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$cartOutput = "";
$cartTotal = "";
$pp_checkout_btn = '';
$product_id_array = '';

$gloveCustomized="";


if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    $cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
} else {
	// Start PayPal Checkout Button
	$pp_checkout_btn .= '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="business" value="webmaster@leobee.com">';
	// Start the For Each loop
	$i = 0;
    foreach ($_SESSION["cart_array"] as $each_item) {
		$item_id = $each_item['item_id'];
		$gcRed = $_SESSION['gcRed'] =$each_item['gcRed'];
		$gcGreen = $_SESSION['gcGreen']=$each_item['gcGreen'];
		$gcBlue = $_SESSION['gcBlue']=$each_item['gcBlue'];
		$gctRed = $_SESSION['gctRed']=$each_item['gctRed'];
		$gctGreen = $_SESSION['gctGreen']=$each_item['gctGreen'];
		$gctBlue =$_SESSION['gctBlue'] =$each_item['gctBlue'];
		$xpid = $_SESSION['xpid']=$each_item['xpid'];
		$itemType = $_SESSION['itemType']=$each_item['itemType'];


		$sql = mysql_query("SELECT * FROM customize WHERE id='$item_id' LIMIT 1");
		while ($row = mysql_fetch_array($sql)) {
			$product_name = $row["product_name"];
			$price = $row["price"];
			$details = $row["details"];


		}


if($each_item['itemType'] == 'gloves'){



					$glove='<br> <br><div style="float:left;padding-right:10px;">Finger Tip Color:<br><div style="background-color:rgb('.$gctRed.', '.$gctGreen. ', '.$gctBlue.'); width:50px; height:50px;"></div></div> <div style="float:left">  Glove Color:<br><div style="background-color:rgb('.$gcRed.', '.$gcGreen. ', '.$gcBlue.'); width:50px; height:50px;"></div><div>';
			$gloveCustomized=" [Glove:".$each_item['gcRed']."".$each_item['gcGreen']."".$each_item['gcBlue'].""." FingerTip:".$gctRed."".$gctGreen."".$gctBlue."]";
				}else{$glove="";
				 $gloveCustomized="";
				}



		$pricetotal = $price * $each_item['quantity'];
		$cartTotal = $pricetotal + $cartTotal;

		// Dynamic Checkout Btn Assembly
		$x = $i + 1;
		$pp_checkout_btn .= '<input type="hidden" name="item_name_' . $x . '" value="' . $product_name . $gloveCustomized . '">
        <input type="hidden" name="amount_' . $x . '" value="' . $price . '">

        <input type="hidden" name="quantity_' . $x . '" value="' . $each_item['quantity'] . '">  ';
		// Create the product array variable
		$product_id_array .= "$item_id-".$each_item['quantity'].",";
		// Dynamic table row assembly
		$cartOutput .= "<tr>";
		$cartOutput .= '<td valign="top">' . $product_name . '<br /><img src="storeadmin/inventory_images/'. $xpid .'.jpg" alt="' . $product_name. '" border="1" /></td>';
		$cartOutput .= '<td  valign="top">' . $details .$glove. '</td>';
		$cartOutput .= '<td valign="top" >$' . $price . '</td>';
		$cartOutput .= '<td valign="top" >

		<form action="cart.php" method="post">
		<input name="quantity" type="text" value="' . $each_item['quantity'] . '" size="1" maxlength="2" />
		<input name="adjustBtn' . $item_id . '" type="submit" value="change" />
		<input name="gctRed" type="hidden" value="' . $_SESSION['gctRed'] . '" />
		<input name="gctGreen" type="hidden" value="' . $gctGreen . '" />
		<input name="gctBlue" type="hidden" value="' . $each_item['gctBlue'] . '" />
		<input name="itemType" type="hidden" value="' . $itemType. '" />
		<input name="gcRed" type="hidden" value="' . $each_item['gcRed']. '" />
		<input name="gcGreen" type="hidden" value="' . $each_item['gcGreen']. '" />
		<input name="gcBlue" type="hidden" value="' . $each_item['gcBlue'] . '" />
		<input name="xpid" type="hidden" value="' . $each_item['xpid']. '" />
		<input name="item_to_adjust" type="hidden" value="' . $each_item['item_id'] . '" />
		</form></td>';
		//$cartOutput .= '<td valign="top"> Shipping:' . $each_item['quantity'] . '</td>';
		$cartOutput .= '<td valign="top">$' . $pricetotal . '</td>';
		$cartOutput .= '<td valign="top"><form action="cart.php" method="post"><input name="deleteBtn' . $item_id . '" type="submit" value="X" /><input name="index_to_remove" type="hidden" value="' . $i . '" /></form></td>';
		$cartOutput .= '</tr>';
		$i++;
    }

	$cartTotal = "<div style='font-size:18px; margin-top:12px;' align='right'>Cart Total : $".$cartTotal." USD</div>";
    // Finish the Paypal Checkout Btn
	$pp_checkout_btn .= '<input type="hidden" name="custom" value="' . $product_id_array . '">
	<input type="hidden" name="notify_url" value="https://www.leobee.com/storescripts/my_ipn.php">
	<input type="hidden" name="return" value="https://www.leobee.com/checkout_complete.php">
	<input type="hidden" name="rm" value="2">
	<input type="hidden" name="cbt" value="Return to The Store">
	<input type="hidden" name="cancel_return" value="https://www.yoursite.com/paypal_cancel.php">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="currency_code" value="USD">
	<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - its fast, free and secure!">
	</form>';
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
	<script type="text/javascript">
if (document.images) {
    img1 = new Image();
    img1.src = "images/IMG.jpg";
}
</script>
	<meta charset="utf-8">

	<link rel="stylesheet" href="style/ecom.css">

</head>

<body>
	
	<img src="images/IMG.jpg" id="bg" alt="">

	<div id="page_wraper">

		<?php include_once("config/template_header.php")?>

			<section>

				<article>

					    <section id="main" class="flexbox">
					  <div id="pageContent">
					  	<div style="margin:8px; text-align:left;">


					  		<table>
      <tr>
        <td   width="14%" bgcolor=""><strong>Product</strong></td>
        <td   width="25%" bgcolor=""><strong>Product Description</strong></td>
        <td   width="10%" bgcolor=""><strong>Unit Price</strong></td>
        <td   width="15%" bgcolor=""><strong>Quantity</strong></td>
        <td  width="9%" bgcolor=""><strong>Total</strong></td>
        <td   width="9%" bgcolor=""><strong>Remove</strong></td>
      </tr>
   	</tr>



					  				<?php echo $cartOutput;?>
					  		</table>
					  	<div align="right">	<?php echo $cartTotal?></div><br>
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
<script type="text/javascript" src="storescripts/jquery/background.js"></script>
</body>

</html>