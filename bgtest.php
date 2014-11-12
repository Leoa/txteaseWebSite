
<?php

//include_once 'product_list.php';
require 'config/config_path.php';
$path =$conf['site_url'];


?>




<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	
	<title>Full Page Background Image | jQuery</title>
	<link rel="stylesheet" type="text/css" href="style/bg.css"></link>
<script type="text/javascript" src="<?php echo $path; ?>storescripts/jquery/jquery.js"></script>
	
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js'></script>
	
	<link rel="stylesheet" href="queryLoader/css/queryLoader.css" type="text/css" />
	
	<script type='text/javascript' src='queryLoader/js/queryLoader.js'></script>
	

</head>

<body>

	<img src="images/IMG.jpg" id="bg" alt="">
	
	<div id="page-wrap">
	
		
	<section id="middle">

		<div id="container">
			<div id="content">
				<strong>Content:</strong> Sed placerat accumsan ligula. Aliquam felis magna, congue quis, tempus eu, aliquam vitae, ante. Cras neque justo, ultrices at, rhoncus a, facilisis eget, nisl. Quisque vitae pede. Nam et augue. Sed a elit. Ut vel massa. Suspendisse nibh pede, ultrices vitae, ultrices nec, mollis non, nibh. In sit amet pede quis leo vulputate hendrerit. Cras laoreet leo et justo auctor condimentum. Integer id enim. Suspendisse egestas, dui ac egestas mollis, libero orci hendrerit lacus, et malesuada lorem neque ac libero. Morbi tempor pulvinar pede. Donec vel elit.
			
				
			</div><!-- #content-->
		</div><!-- #container-->

		<aside id="sideRight">
			<strong>Right Sidebar:</strong> Integer velit. Vestibulum nisi nunc, accumsan ut, vehicula sit amet, porta a, mi. Nam nisl tellus, placerat eget, posuere eget, egestas eget, dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In elementum urna a eros. Integer iaculis. Maecenas vel elit.
		<?php echo $dynamicList;?>
		
		</aside><!-- #sideRight -->
		

	</section><!-- #middle-->

	<footer id="footer">
		<strong>Footer:</strong> Mus elit Morbi mus enim lacus at quis Nam eget morbi. Et semper urna urna non at cursus dolor vestibulum neque enim. Tellus interdum at laoreet laoreet lacinia lacinia sed Quisque justo quis. Hendrerit scelerisque lorem elit orci tempor tincidunt enim Phasellus dignissim tincidunt. Nunc vel et Sed nisl Vestibulum odio montes Aliquam volutpat pellentesque. Ut pede sagittis et quis nunc gravida porttitor ligula.
	</footer><!-- #footer -->
</div><!-- #wrapper -->

	<script type="text/javascript" src="storescripts/jquery/ background.js"></script>
	
	<script>
		QueryLoader.selectorPreload = "body";
		QueryLoader.init();
	</script>
	
</body>

</html>