jQuery(document).ready(function(){
    jQuery(".nav_button a").click(function(){
        jQuery(".overlay").fadeToggle(200);
       jQuery(this).toggleClass('btn-open').toggleClass('btn-close');
    });
});
jQuery('.overlay').on('click', function(){
    jQuery(".overlay").fadeToggle(200);   
    jQuery(".nav_button a").toggleClass('btn-open').toggleClass('btn-close');
    open = false;
});
