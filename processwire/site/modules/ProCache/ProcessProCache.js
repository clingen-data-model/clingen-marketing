$(document).ready(function() {
	if($('#ProcessProCache').length == 0) return;
	
	$('#ProcessProCache').WireTabs({
		items: $(".Inputfields li.WireTab")
	});
	$(".notes").find('br').each(function() {
		if($(this).closest('#wrap_Inputfield__clearMin').length) return;
		var $hr = $("<div />").css('margin', '9px 0 9px 0');
		$(this).after($hr);
	});
	
	$("#wrap_Inputfield_cacheTemplates").find("em").each(function() {
		$(this).css('font-style', 'normal').addClass('detail');	
	});
	
});
