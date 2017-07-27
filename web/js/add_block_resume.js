$(function(){
    
    let blocExperience = $('.bloc_experience').first().clone();

     $('body').on('click','.add_bloc_experience',function(e){
        e.preventDefault();
        
         blocExperience.clone()
            .find("input, textarea").val("").end()
            .attr('database_id', null)
            .insertBefore($(this));
     });
     
    let blocFormation = $('.bloc_formation').first().clone();

     $('body').on('click','.add_bloc_formation',function(e){
        e.preventDefault();
        
         blocFormation.clone()
            .find("input, textarea").val("").end()
            .attr('database_id', null)
            .insertBefore($(this));
     });

    let blocLangue = $('.bloc_langue').first().clone();

     $('body').on('click','.add_bloc_langue',function(e){
        e.preventDefault();
        
         blocLangue.clone()
            .find("input, textarea").val("").end()
            .attr('database_id', null)
            .insertBefore($(this));
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
     
     $('body').on('click','.button_remove_experience', function(){
        let divParent = $(this).closest('.bloc_experience');
            databaseId = divParent.attr('database_id');
            if (databaseId != undefined && databaseId != '') {
                
                let url = '../supprimer_experience/' + databaseId;

                $.post(url, function (response){
                   console.log(response);           
                });
            }
            
        divParent.fadeOut(100).remove();
     });
     
     $('body').on('click','.button_remove_formation', function(){
        let divParent = $(this).closest('.bloc_formation');
            databaseId = divParent.attr('database_id');
            if (databaseId != undefined && databaseId != '') {
                
                let url = '../supprimer_formation/' + databaseId;

                $.post(url, function (response){
                   console.log(response);           
                });
            }
            
        divParent.fadeOut(100).remove();
     });
     
     $('body').on('click','.button_remove_langue', function(){
        let divParent = $(this).closest('.bloc_langue');
            databaseId = divParent.attr('database_id');
            if (databaseId != undefined && databaseId != '') {
                
                let url = '../supprimer_langue/' + databaseId;

                $.post(url, function (response){
                   console.log(response);           
                });
            }
            
        divParent.fadeOut(100).remove();
     });
});

