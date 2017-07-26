// NAV TOGGLE ONHOVER WITH SLIDE
$(document).ready(function(){
   //alert('ok');
    $(".hoverSlide ul").hide();
    $(".hoverSlide").click(function(){

        $(this).children("ul").stop(true,true).slideToggle("fast"),
        $(this).toggleClass("dropdown-active");
    });
});
    