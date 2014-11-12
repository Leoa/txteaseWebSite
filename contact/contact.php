
<?php

require ('../config/config_path.php');
$path =$conf['site_url'];

?>
<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">
	
	<link rel="stylesheet" href="<?php echo $path; ?>style/ecom.css">
	<script type="text/javascript">
if (document.images) {
    img1 = new Image();
    img1.src = "../images/IMG.jpg";
}
</script>
</head>

<body>
	<img src="../images/IMG.jpg" id="bg" alt="">
	<div id="page_wraper">
		
		<?php include_once("../config/template_header_2.php")?>
		
			<section>
				
				<article>
					
					    <section id="main" class="flexbox">
					    	
       						 <div id="box-1" class="flexbox">
       						 	
          						 <h1>Contact</h1> 
          						For sales and inquiries email leo@sugardefynery.com. <br>
          						 
          						 <a href="mailto:leo@sugardefynery.com">Email TXTease Customer Service</a>
          						 
        					</div>
        					
        					
       						 
   						 </section>
   						 
				</article>
		
			</section>
			
		<?php include_once("../config/template_footer.php")?>
			
	</div>
	<script type="text/javascript" src="../storescripts/jquery/background.js"></script>
</body>

</html>