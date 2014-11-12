(function ($){
	
	$.fn.targetBlank = function (){
		
		//alert("working");
		var targetArray =['_blank', '_self','_parent','_top'];
		
		var target = $.trim($(this).attr('target'));
		
	if(target== undefined || target =='' || jQuery.inArray(target, targetArray)==false){
		
		$(this).attr('target', '_blank');
		}
		
	}
	
})(jQuery);
