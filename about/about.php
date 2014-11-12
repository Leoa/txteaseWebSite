
<!DOCTYPE html>

<html lang="en">

	<head>

		<meta charset="utf-8">

		<link rel="stylesheet" href="<?php echo $path; ?>style/ecom.css">

		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js'></script>

		<link rel="stylesheet" href="http://www.txtease.com/about/queryLoader/css/queryLoader.css" type="text/css" />

		<script type='text/javascript' src='http://www.txtease.com/about/queryLoader/js/queryLoader.js'></script>

	</head>

	<body>
		
		<?php

require ('../config/config_path.php');
$path = $conf['site_url'];
?>

		<img src="../images/IMG.jpg" id="bg" alt="">
		<div id="page_wraper">

			<?php include_once("../config/template_header_2.php")
			?>

			<section>

				<article>

					<section id="main" class="flexbox">

						<div id="box-1" class="flexbox">

							<h1>About TXTease</h1>

							<P>

								TXTease Gloves was created to resolve a winter time fashion dilemma.  Touch screen phones are hard to use  when your hands are covered. You lose important calls by fumbling around with traditional gloves. Current solutions on the market  cover all your fingers like a mitten,  and you lose dexterity. Or all your fingers are exposed to the cold weather. Above all of that, those gloves are bulky and  ugly!  TXTease Gloves use stretch fibers to adjust the exposure of fingers for use with touch screen phones. Plus they are super cute! Customize your pair today.

							</P>

						</div>

						<div id="box-2" class="flexbox">
							<h1>About Sugar Defynery</h1>

							TXTease Gloves is a product of the Sugar Defynery, a think tank established by Leondria Barbee.

						</div>

						<div id="box-3" class="flexbox">

						</div>

					</section>

				</article>

			</section>

			<?php include_once("../config/template_footer.php")
			?>
		</div>
		<script type="text/javascript" src="../storescripts/jquery/background.js"></script>

		<script>
			QueryLoader.selectorPreload = "body";
			QueryLoader.init();
		</script>

	</body>

</html>