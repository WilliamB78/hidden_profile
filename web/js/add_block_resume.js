$(function(){

     $(".add_block").click(function(e){
         e.preventDefault();

         $(".bloc_experience:last").clone()
                                   .find("input, textarea").val("").end()
                                   .appendTo(".add_exp");
     });

     $(".add_block2").click(function(ev){
         ev.preventDefault();

         $(".bloc_formation:last").clone()
                                 .find("input, textarea").val("").end()
                                 .appendTo(".add_forma");
     });

     $('.inner-header').next().hide();
    
     $('.inner-header').on('click',function(){
	if($(this).next().is(":hidden")){
		$('.inner-header').next('div:visible').slideToggle(400);
		$(this).next().slideToggle(400);

	}

     });
    
     $('.resume-form').on('click',function(evt){
		evt.stopPropagation();

     });
});

