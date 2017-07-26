$(function(){
    
    let blocExperience = $('.bloc_experience').first().clone();

     $(".add_bloc_experience").click(function(e){
         e.preventDefault();

         blocExperience
                                   .find("input, textarea").val("").end()
                                   .attr('database_id', null)
                                   .insertBefore(".add_experience");

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
     
     $('body').on('click','.button_remove', function(){
         
        let divParent = $(this).parent();
        if (divParent.hasClass('bloc_experience') === true){
            databaseId = divParent.attr('database_id');
            let url = '../supprimer_experience/' + databaseId;
//            $.post(url, function (response){
//               console.log(response);           
//            });
            
        }
        console.log(blocExperience);
        divParent.fadeOut(100);

     });
});

