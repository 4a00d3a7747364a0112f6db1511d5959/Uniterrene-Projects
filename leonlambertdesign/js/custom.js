$(document).ready(function(){

   $('nav ul li a').on('click', function(){
       var ids=$(this).attr('href');
       //alert(Ids)
       if($(ids).length){
       var secOffset= $(ids).offset().top;
       // console.log(secOffset);
   }
       $('body,html').animate({
             
        scrollTop:(secOffset + 'px')
       },800);
   });


  
});