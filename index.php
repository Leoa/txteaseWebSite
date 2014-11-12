<?php

//include_once 'product_list.php';
require 'config/config_path.php';
$path = $conf['site_url'];
?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">

		<title>TXTease Gloves | Fashionable gloves for easy winter time texting. </title>
		<link rel="stylesheet" type="text/css" href="style/bg.css"></link>
		<script type="text/javascript" src="<?php echo $path; ?>storescripts/jquery/jquery.js"></script>

		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js'></script>

		<link rel="stylesheet" href="queryLoader/css/queryLoader.css" type="text/css" />

		<script type='text/javascript' src='queryLoader/js/queryLoader.js'></script>
		


	</head>

	<body>
		
		<?php

include_once 'product_list.php';

?>


		<img src="images/IMG.jpg" id="bg" alt="">

		<div id="page-wrap">

			<section id="middle">

				<div id="container">

					<div id="content">

						<img src="images/txtLogo.png">

						<br>
						Gloves For Easy Winter Time Texting.

					</div><!-- #content-->

				</div><!-- #container-->

				<aside id="sideRight">

					<img src="images/new.png">
					<br>
					<div id="pair">
						Customize a Pair
					</div>

					<br>
					<div id="gloveBox">
						<?php echo $dynamicList; ?>
					</div>
					<br>
					<div id="price">
						$8.00 a pair thru 12/31/2012
					</div>
					<br>

					<div id="socialBox">

						<div id="connect">
							Connect with Us!
						</div>
						<div id="fb-root"></div>
						<script>
							( function(d, s, id) {
									var js, fjs = d.getElementsByTagName(s)[0];
									if(d.getElementById(id))
										return;
									js = d.createElement(s);
									js.id = id;
									js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
									fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));
						</script>
						<div class="fb-like" data-href="<?php echo $path; ?>" data-send="true" data-layout="box_count" data-width="100" data-show-faces="false" data-font="arial" ></div>
						<br>
						<br>
						<script language=JavaScript>
							document.write('<a href="');
							document.write('http://www.stumbleupon.com/submit?url=' + document.URL + '&title=' + document.title.replace(/ /g, '+') + '">');
							document.write('<img border=0 src=images/stumbleupon.gif></a>');
						</script>
						<br>
						<br>
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $path; ?>" data-text="Sweet Fashion refined for tech-lovin' l" data-hashtags="<?php echo $path; ?>">Tweet</a>
						<script>
							! function(d, s, id) {
								var js, fjs = d.getElementsByTagName(s)[0];
								if(!d.getElementById(id)) {
									js = d.createElement(s);
									js.id = id;
									js.src = "//platform.twitter.com/widgets.js";
									fjs.parentNode.insertBefore(js, fjs);
								}
							}(document, "script", "twitter-wjs");
						</script>
					</div>
				</aside><!-- #sideRight -->

			</section><!-- #middle-->
			<footer id="footerspace"></footer><!-- #footerspacer -->

			<footer id="footer">

				<div id="col1">
					TXTease Gloves
					<br>
					Product and website create by Sugar Defynery.
					<br>
					&#9400; <img src="images/logomini.png" style="vertical-align:middle"> 2012-2013
				</div>
				<div id="col2">
					<br>
					<a href="about/about.php">About</a>
					<br>
					<a href="contact/contact.php">Contact</a>
					<br>
					<a href="<?php echo $conf['site_url']; ?>storeadmin/admin_login.php">Admin Page</a>

				</div>
				<div id="col3">

				</div>

			</footer><!-- #footer -->
		</div><!-- #wrapper -->
		<script type="text/javascript" src="storescripts/jquery/ background.js"></script>

				<script>
			QueryLoader.selectorPreload = "body";
			QueryLoader.init();
		</script>

	</body>

</html>