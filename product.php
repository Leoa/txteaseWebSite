<?php

require ('config/config_path.php');
$path =$conf['site_url'];

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

	<title ><?php echo $product_name;?></title>

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js'></script>

		<link rel="stylesheet" href="queryLoader/css/queryLoader.css" type="text/css" />

		<script type='text/javascript' src='queryLoader/js/queryLoader.js'></script>

</head>

<body >


<?php
include_once ('storescripts/productPagescript.php');


?>




	<div id="page_wraper">

		<?php include_once("config/template_header.php")?>

			<section>

				<article>

					    <section  style="overflow:auto">



        					<div style="margin:10px;float:left; height:300px;display:block; padding-right:10px">

            					

            						<?php echo $dynamicList;?>


            					</div>


        					<div   id="show" style="margin:10px;float:left; width:400px; height:450px; padding-right:10px">
        						<p> Please select your TXTease glove colors. Then add item to cart.</p>

<script type='text/javascript' src='storescripts/jquery/jquery.js'></script>

<script type='text/javascript' src='storescripts/jquery/colorpicker/jquery-packer.php'>/* jquery core */</script>

<script type='text/javascript' src='storescripts/jquery/colorpicker/sgbeal-colorpicker.jquery.js'>/* colorpicker code */</script>

<link rel="stylesheet" href="storescripts/jquery/colorpicker/demo-colorpicker.css" type="text/css"/>

<script type='text/javascript' id='DemoColorPickerSource1'>

var gloveTipColor='';
var gloveColor='';

red="";
green="";
blue="";

redt="";
greent="";
bluet="";

$(document).ready(function(){


	//$('#ColorSelectionTarget1')

	$('#MyDemoColorPicker1').empty().addColorPicker({

		clickCallback: function(c) {

			$('#ColorSelectionTarget1').css('background-color',c);

				var str=c;

				var rgb=str.substring(4,str.length-1);

				var xa = new Array();

				var splitRGB=rgb;

				var hexColors=splitRGB.split(',');

				for (var i=0;i<hexColors.length;i++){

					xa[i]=hexColors[i];

				}

			red =xa[0];

			green =xa[1];

			blue =xa[2];

			gloveColor=red+","+green+","+blue;

			$('#colorSend').css("background-color", "rgb("+xa[0] +", "+xa[1] +", "+xa[2] +")" );

			 $('#gcRed').val(red);

          	$('#gcGreen').val(green);

          	$('#gcBlue').val(blue);



			if ((gloveColor !='')&& (gloveTipColor !='')) {

          		 $('input[type=submit]').removeAttr('disabled');

          		}

		}//end callback

	});// end colorpicker1


	$('#MyDemoColorPicker2').empty().addColorPicker({

		clickCallback: function(c) {

			$('#ColorSelectionTarget2').css('background-color',c);

				var str=c;

				var rgb=str.substring(4,str.length-1);
				//alert(str.substring(,")"));

				var xb = new Array();

				var splitRGB=rgb;

				var hexColors=splitRGB.split(',');

				for (var i=0;i<hexColors.length;i++){
					//alert (hexColors[i]);

					xb[i]=hexColors[i];

			}


			var redt =xb[0];

			var greent =xb[1];

			var bluet =xb[2];

			gloveTipColor=redt+","+greent+","+bluet;


			$('#colortip').css("background-color", "rgb("+xb[0] +", "+xb[1] +", "+xb[2] +")" );

			$('#colortip2').css("background-color", "rgb("+xb[0] +", "+xb[1] +", "+xb[2] +")" );

          	$('#gctRed').val(redt);

          	$('#gctGreen').val(greent);

          	$('#gctBlue').val(bluet);




			}



	});

 $('input[type=submit]').attr('disabled', 'disabled');

 $('#show').hide();

 $('#feedback').hide();

 if (<?php echo $id;?>==13){

     $('#show').show();

   	 $('#xpid').val(13);

  $('#xpid').val();

 	 var it= $('#itemType').val();

   	$.get('storescripts/updateindexPage.php?itemType='+it,

    	function(data){

       		// alert(" data from functin 13 "+data);

       			$('#pid').val($.trim($('#pid').val(data)));

       				//alert ( "pid  is "+ variable);
    				//var variable = $.trim($('#pid').html(data));
    });


 }

if (<?php echo $id;?>==15){

     $('input[type=submit]').removeAttr('disabled');


 	   var it= $('#itemType').val()

   $.get('storescripts/updateindexPage.php?itemType='+it,
    		function(data){
       				// alert(" data from functin"+data);

       				     $('#pid').val(data);

       				//alert ( "pid  is "+ variable);
    				//var variable = $.trim($('#pid').html(data));


				});

 		}


 		if (<?php echo $id;?>==16){

     $('input[type=submit]').removeAttr('disabled');



 	   var it= $('#itemType').val();

   $.get('storescripts/updateindexPage.php?itemType='+it,
    		function(data){
       				// alert(" data from functin"+data);

       				     $('#pid').val(data);

       				//alert ( "pid  is "+ variable);
    				//var variable = $.trim($('#pid').html(data));


				});

 		}
 			$('#pid').hide();
          $('#itemType').hide();

         $('#form1').click( function (){

	$('#feedback').show();
	$('#feedback').html("Loading...").delay(500).fadeOut();

});


});

</script>



<body >

<div id='ColorSelectionTarget1'>
<img src="http://www.txtease.com/images/hands2.gif"  width="200"  height="300" style="position:absolute;z-index:500;">
<div id="colortip" style="width:75px;height:75px;position:absolute; z-index:200;"></div>
<div id="colortip2" style="width:50px;height:165px;position:absolute; z-index:199;"></div>

</div>

<div id="colorSend" style="width:200px;height:300px;"></div>


<div id='ColorSelectionTarget2'></div>


<p>Choose Fingertip Color:</p>
<div id='MyDemoColorPicker2' >
If you have JavaScript enabled, this paragraph "should" be replaced once the JS code loads.

</div>


<p>Choose Glove Color:</p>
<div id='MyDemoColorPicker1' >
If you have JavaScript enabled, this paragraph "should" be replaced once the JS code loads.
</div>





        					</div>


        					<br>
        					<div class="rightCol">




           		       		<div class="addToCart">
								<h1>ADD TO CART</h1><br>
 									<form name="form1" id="form1" method = "post" action="cart.php" >

 									<input type="text" name="itemType" id="itemType" value="<?php echo $itemType;?>"/>

 									<input type="text" name="pid" id="pid" value="xxxx"/>

 									<input type="hidden" name="xpid" id="xpid" value="<?php echo $id;?>"/>

 									<input type="hidden" name="gc" id="gc" value="gc"/>

           						 	<input type="hidden" name="itemType" id="itemType" value="<?php echo $itemType;?>"/>

           						 	<input type="hidden" name="gcRed" id="gcRed" value="orange0k"/>

          							<input type="hidden" name="gcGreen" id="gcGreen" value="orange0k"/>

          							<input type="hidden" name="gcBlue" id="gcBlue" value="orange0k"/>

 									<input type="hidden" name="gct" id="gct" value="gct"/>

           							<input type="hidden" name="gctRed" id="gctRed" value="orange0k"/>

          							<input type="hidden" name="gctGreen" id="gctGreen" value="orange0k"/>

          							<input type="hidden" name="gctBlue" id="gctBlue" value="orange0k"/>

           						 		<input type="submit" name="submit" id="submit" value="Add to Shopping Cart">
 										<div id="feedback"> feedback</div>
 									</form>
 									</div>
       						 </div>

   						 </section>

				</article>

			</section>


				<script type="text/javascript">



				</script>
<div id="thefooter">
	<?php include_once("config/template_footer.php")?>
	
	
</div>
		



	</div>
		<img src="images/IMG.jpg" id="bg" alt="">
	<script type="text/javascript" src="storescripts/jquery/ background.js"></script>
	
	<script>
			QueryLoader.selectorPreload = "body";
			QueryLoader.init();
		</script>

</body>

</html>

