jQuery(window).load(function() {

   // $("#flexiselDemo1").flexisel();

   jQuery('.cbp-hrmenu').bind('click',function(){

	  //alert("gdfgft"); 

	  jQuery('.menu-bar').slideToggle();

	   

	   

   });

			

});



jQuery(function () {

    jQuery('a[href="#search"]').on('click', function(event) {

        event.preventDefault();

        jQuery('#search').addClass('open');

        jQuery('#search > form > input[type="search"]').focus();

    });

    

    jQuery('#search, #search button.close').on('click keyup', function(event) {

        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {

            jQuery(this).removeClass('open');

        }

    });

    

    

});

/* ** home page  ** */

jQuery('#hot-happening-div .owl-carousel').owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  navText: [
    "<i class='fa fa-angle-left'></i>",
    "<i class='fa fa-angle-right'></i>"
  ],
  autoplay: false,
  autoplayHoverPause: true,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 3
    },
    1000: {
      items: 4
    }
  }
});

/* *** related products *** */

jQuery('#block-related.owl-carousel').owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  navText: [
    "<i class='fa fa-angle-left'></i>",
    "<i class='fa fa-angle-right'></i>"
  ],
  autoplay: false,
  autoplayHoverPause: true,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 3
    },
    1000: {
      items: 4
    }
  }
});

/* *** upsell products *** */

jQuery('#upsell-product-table.owl-carousel').owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  navText: [
    "<i class='fa fa-angle-left'></i>",
    "<i class='fa fa-angle-right'></i>"
  ],
  autoplay: false,
  autoplayHoverPause: true,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 3
    },
    1000: {
      items: 4
    }
  }
});






/* *** products thumbnail *** */

jQuery('.shop_imgbox_custom .owl-carousel').owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  navText: [
    "<i class='fa fa-angle-left'></i>",
    "<i class='fa fa-angle-right'></i>"
  ],
  autoplay: false,
  autoplayHoverPause: true,
  responsive: {
    0: {
      items: 3
    },
    600: {
      items: 6
    },
    1000: {
      items: 6
    }
  }
});

