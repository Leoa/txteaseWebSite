<?php



?>
<title> ajax example</title>
<head>
	
	
	
 		<script src="http://localhost/sugardefynery/storescripts/jquery/jquery.js" ></script>
	
</head>
<body >
	<style type="text/css">
		
		.success {
    width: 298px;
    background: #a5e283;
    border: #337f09 1px solid;
    padding: 5px;
}

.error {
    width: 298px;
    background: #ea7e7e;
    border: #a71010 1px solid;
    padding: 5px;
}

	</style>

<script>


	
	$(document).ready(function(){
		
	$('#div1').click(function() {

		$.ajax({
			type : 'POST',
			url : 'sstestphp.php',
			dataType : 'json',
			data: {
				color : $('#color').val()
				
			},
			success : function(data){
				$('#feedback').text(data);
				$('#message').removeClass().addClass((data.error === true) ? 'error' : 'success')
					.text(data.msg).show(500);
				if (data.error === true)
					$('#demoForm').show(500);
			},
			error : function(XMLHttpRequest, textStatus, errorThrown) {
				$('#feedback').hide(500);
				$('#message').removeClass().addClass('error')
					.text('There was an error.').show(500);
				$('#demoForm').show(500);
			}
		});

		return false;
	});
	
	$('#div2').click(function() {

		$.ajax({
			type : 'POST',
			url : 'sstestphp.php',
			dataType : 'json',
			data: {
				
				itemType : $('#itemType').val()
			},
			success : function(data){
				$('#feedback').text(data);
				$('#message').removeClass().addClass((data.error === true) ? 'error' : 'success')
					.text(data.msg).show(500);
				if (data.error === true)
					$('#demoForm').show(500);
			},
			error : function(XMLHttpRequest, textStatus, errorThrown) {
				$('#feedback').hide(500);
				$('#message').removeClass().addClass('error')
					.text('There was an error.').show(500);
				$('#demoForm').show(500);
			}
		});

		return false;
	});
});
	
	
</script>

</form>
           						 	<br>  
<div id="div1" style="background-color:black;width:100px;height:100px" ></div>	

          						 	<br>  
<div id="div2" style="background-color:blue;width:100px;height:100px" ></div>	
 	
<form name="form3" id="form3" method = "post" action="" >
	<input type="text" name="itemType" id="itemType" value="hats"/>
	</form>
	
	<form name="form2" id="form2" method = "post" action="" >
<input type="text" name="color" id="color" value="cats"/>

<div id="feedback"></div>

<div id="message"> message</div>
<div id="demoForm">error</div>
</form>
         
 
</body>