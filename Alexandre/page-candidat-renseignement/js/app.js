	$(function() {


	$('legend').next().hide();

	$('legend').on('mousedown', function() {
		if($(this).next().is('div:hidden')) {
			$('legend').next('div:visible').slideUp(900);
			$(this).next().slideDown(400);
		}
	});
	$('html').on('click', function() {
		$('legend').next().slideUp(400);
	});

//stop propagation

	$('form').on('click', function(e) {
		e.stopPropagation();
	});




});