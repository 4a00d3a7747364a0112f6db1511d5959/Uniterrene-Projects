jQuery(document).ready(function($){


  // cart page togle on click functions

  jQuery('#customCartForms #discount-coupon-form h2, .cart .giftcard h2').on('click', function (argument) {
    jQuery('#customCartForms .discount-form').slideToggle('fast');
    jQuery(this).find('i').toggleClass('fa-angle-down');
    jQuery(this).find('i').toggleClass('fa-angle-up');
    //jQuery(this).toggleClass('fa-angle-up'); 
  });
    jQuery('#customCartForms .shipping h2').on('click', function (argument) {
      jQuery('#customCartForms .shipping-form').slideToggle('fast');
      jQuery(this).find('i').toggleClass('fa-angle-down');
      jQuery(this).find('i').toggleClass('fa-angle-up');
      //jQuery(this).toggleClass('fa-angle-up'); #customCartForms .shipping h2
    });


    // product zoom

   





//fixed nav
  
    var headerHeight= $('header').height();
    var statWidth= 865 + 'px';
    var popLeftAlign=-231 + 'px';
    var stickyPopAlign= -0 + 'px';

    
    // window scroll
    $(window).scroll(function(){
     
       var winPos= $(window).scrollTop();
      // console.log(winPos);
      if(winPos>headerHeight){
      	$('.header-bottom.nav-ozmegamenu').addClass('fix-nav-ozmegamenu');
           $('#pt_custommenu .pt_menu').find('.popup').css({'left':stickyPopAlign});
      }else{
      	$('.header-bottom.nav-ozmegamenu').removeClass('fix-nav-ozmegamenu');

      }

      // page scroll button hide show

      if($(this).scrollTop()>300){
        $('#back_top').fadeIn(300);
      }else{
        $('#back_top').fadeOut(300);
      }

    });

  // Mega Menu

  
  //var navWidth= $('nav.nav-container').width();
  $('#pt_custommenu .pt_menu').find('.popup').width(statWidth);
    //alert(popLeftAlign)
  $('#pt_custommenu .pt_menu').find('.popup').css({'left':popLeftAlign});
 
 

  $('#pt_custommenu .pt_menu').on('mouseenter', function(){
  	//alert();
     $('#pt_custommenu .pt_menu').find('.popup').stop().slideUp(800);	
     $(this).find('.popup').stop().slideDown(800);
  });

  $('#pt_custommenu .pt_menu').on('mouseleave', function(){
  	//alert();
     $('#pt_custommenu .pt_menu').find('.popup').stop().slideUp(800);
     
  });

// Mobile menu open close

$('.mobile-bar-icon').on('click', function(){
   $(".mobile-bar-content").addClass("open");
});
  
 $('.mobile-bar-close').on('click', function(){
    $(".mobile-bar-content").removeClass("open");
 });
 

// Mobile menu tab

  $('.tabs-mobile li').on('click', function(){
     $(".tabs-mobile .item").removeClass("active");
  $(this).addClass("active");

  });                   





  $('.tabs-mobile li.item-menu').on('click', function(){
    $(".tabs-content-mobile").css("display", "none");
  $(".tabs-menu").css("display", "block");
  });
 
 $('.tabs-mobile li.item-setting').on('click', function(){
   $(".tabs-content-mobile").css("display", "none");
  $(".tabs-setting").css("display", "block");
 });

 // Mobile sub menu open close

 // $('.mobilemenu span.head a').on('click', function(){
 // $('.mobilemenu span.head a').parent().parent().removeClass('active');
 // $('.mobilemenu span.head a').parent().siblings('ul').slideUp(600);	
 //   $(this).parent().parent().toggleClass('active');
 //   $(this).parent().siblings('ul').slideToggle(600);
 // });
  
$('.mobilemenu span.head a').on('click', function(){
  var subNav= $(this).parent('span').parent('li');
  //console.log(subNav);
   $(this).parent().parent().siblings().removeClass('active').find('> ul').slideUp('fast');

   if($(subNav.hasClass('.have_sub'))){
       //alert();
       //$('.mobilemenu span.head a').parent().siblings('ul').slideUp('fast');
       subNav.toggleClass('active');
       //alert('class added');
       $(this).parent('span').siblings('ul').slideToggle('fast');
       
   }
});



//page scroll top

$('#back_top').on('click', function(){
 
 $('body, html').animate({
   scrollTop:0
 },800);
  
});


// shop page left panel accordion

   $('#narrow-by-list > li > a').on('click', function(){
         

      if($(this).siblings('div').is(':visible')){
         //alert('visible');
        $(this).removeClass('active');
        $(this).siblings().slideUp('fast');
        // colsole.log('if part');

      }else{
         $('#narrow-by-list > li > a').parent().children('div').slideUp('fast');
         $('#narrow-by-list > li > a').removeClass('active');
         $(this).toggleClass('active');
         $(this).siblings().slideDown('fast');
        // alert('elese part');
         
      }

   });

});
