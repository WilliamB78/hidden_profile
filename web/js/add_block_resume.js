$(function(){

     $(".add_bloc_experience").click(function(e){
         e.preventDefault();

         $(".bloc_experience:last").clone()
                                   .find("input, textarea").val("").end()
                                   .appendTo(".add_experience");
     });

     $(".add_bloc_formation").click(function(ev){
         ev.preventDefault();

         $(".bloc_formation:last").clone()
                                 .find("input, textarea").val("").end()
                                 .appendTo(".add_formation");
     });

     $(".add_bloc_langue").click(function(eve){
         eve.preventDefault();

         $(".bloc_langue:last").clone()
                                 .find("input, textarea").val("").end()
                                 .appendTo(".add_langue");
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

