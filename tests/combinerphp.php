
<?php


session_start();
session_register('color');
session_register('itemType');

if (!isset($_POST['color'])&& $_POST['color']=="" && empty($_POST['color']) && isset($_POST['itemType']) ){
	
	$_SESSION['itemType'] = $_POST['itemType'];
	
	$return['msg'].= "  color is not set";
	
	header( "refresh:5;url=http://localhost/sugardefynery/storescripts/updateindexPage.php" );
}

if (isset($_POST['color'])&& !isset($_POST['itemType']) && $_POST['itemType']=="" && empty($_POST['itemType'])){
	
	$_SESSION['color'] = $_POST['color'];
	
	$return['msg'].= "  item is not set";
	header( "refresh:5;url=http://localhost/sugardefynery/storescripts/updateindexPage.php" );
	
	
}
if(isset($_SESSION['color']) && !empty($_SESSION['color'])&&  $_SESSION['color']!="" && isset($_SESSION['itemType'])&& !empty($_SESSION['itemType'])&&  $_SESSION['itemType']!="" ){
	
	
	///your code goes here
	
	$return['msg'].= " <br> "."value of color is ".$_SESSION['color']."value of type is ".$_SESSION['itemType'];

}
if( !isset($_SESSION['color']) && !isset($_SESSION['itemType']) ){
	
	$return['error'] = true;
	$return['msg'] .= 'sessions are empty.';
}
else {
	$var =13;
	$return['error'] = false;
	$return['msg'].= "<br> ".$var;
	}

echo json_encode($return);

 

?>