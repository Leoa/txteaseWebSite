
<script type='text/javascript' src='storescripts/jquery/colorpicker/jquery-packer.php'>/* jquery core */</script>

<script type='text/javascript' src='storescripts/jquery/colorpicker/jquery-packer.php'>/* colorpicker code */</script>

<link rel="stylesheet" href="storescripts/jquery/colorpicker/demo-colorpicker.css" type="text/css"/>

<script type='text/javascript' id='DemoColorPickerSource1'>


$(document).ready(function(){
	
	$('#MyDemoColorPicker1').empty().addColorPicker({
		
		clickCallback: function(c) {
			
			$('#ColorSelectionTarget1').css('background-color',c);
			
			//ajax post these values 
			 postColor=c;
			
			
			 //if ie set directly to color else do this:
			  if ( $.browser.msie ) { 
			  	
			  	  $('#colorSend').css("background-color", c );
			  	  
			} 
			else {
			 
			
				var str=c;
			
				var rgb=str.substring(4,str.length-1);
			
				//alert(str.substring(,")"));
				var xa = new Array();
			
				var splitRGB=rgb;
			
				var hexColors=splitRGB.split(',');
			
				for (var i=0;i<hexColors.length;i++){
					
					//alert (hexColors[i]);
			
					xa[i]=hexColors[i];
				
				
				}
			
			//ajax post these values 
			var red =xa[0];
			
			var green =xa[1];
			
			var blue =xa[2];
			
			 postColor=red+","+green+","+blue;
			 
			//alert(postColor);
			
			//alert ("spot "+spot);
			//$('#colorSend').css('background-color:rgb',(255,0,255));
			$('#colorSend').css("background-color", "rgb("+xa[0] +", "+xa[1] +", "+xa[2] +")" );
			
		}
		
		}
		
	});
		//Function to convert hex format to a rgb color
		
		$('#MyDemoColorPicker2').empty().addColorPicker({
			
		clickCallback: function(c) {
			
			$('#ColorSelectionTarget2').css('background-color',c);
			
			if ( $.browser.msie ) { 
				
			  	  $('#colortip').css("background-color", c );
			  	
			  	    $('#colortip2').css("background-color", c );
			  	  
			  	   postColorTip=c;
			  	   
			} 
			
			else {
				
			var str=c;
			
			var rgb=str.substring(4,str.length-1);
			//alert(str.substring(,")"));
			
			var xa = new Array();
			
			var splitRGB=rgb;
			
			var hexColors=splitRGB.split(',');
			
			for (var i=0;i<hexColors.length;i++)
			{
				//alert (hexColors[i]);
			
				xa[i]=hexColors[i];
				
				
			}
			

		
			//ajax post these values 
			var red =xa[0];
			
			var green =xa[1];
			
			var blue =xa[2];
			
			 postColorTip=red+","+green+","+blue;
			 
			//alert(postColorTip);
			
			//$('#colorSend').css('background-color:rgb',(255,0,255));
			$('#colortip').css("background-color", "rgb("+xa[0] +", "+xa[1] +", "+xa[2] +")" );
			$('#colortip2').css("background-color", "rgb("+xa[0] +", "+xa[1] +", "+xa[2] +")" );
			
		}
		
		}
		
	});

});
</script>







<div id='ColorSelectionTarget1 '>
<img src="http://localhost/sugardefynery/images/hands2.gif"  width="300" style="position:absolute;z-index:500;">
<div id="colortip" style="width:50px;height:125px;position:absolute; z-index:200"></div>
<div id="colortip2" style="width:60px;height:50px;position:absolute; z-index:199;left:100px;"></div>

</div>



<div id="colorSend" style="width:300px;height:334px;"></div>


<div id='ColorSelectionTarget2'></div>


<p>Choose Fingertip Color:</p>
<div id='MyDemoColorPicker2' >
If you have JavaScript enabled, this paragraph "should" be replaced once the JS code loads.

</div>


<p>Choose Glove Color:</p>
<div id='MyDemoColorPicker1' >
If you have JavaScript enabled, this paragraph "should" be replaced once the JS code loads.
</div>


