(function( $ ){
  $.fn.circling = function(options) {
    var defaults = {
      under: false,
      innerradius: 200,
      letterspacing: 0,
      wordspacing: 80
    };
    var o = $.extend(defaults, options);
   // alert(o);
    return this.each(function() {
      $this = $(this);
      var fullrotate = 0;
      $this.lettering();
      var $letters = $('span', this);
      // add initial styling
      $this.css({'padding': '1em', 'width': o.innerradius*4, 'height': o.innerradius*4, 'position': 'relative'});
      $letters.css({'display': 'inline-block', 'position': 'absolute', 'left': '50%'});
      if (o.under) {
        $letters.css({'padding-top': o.innerradius+'px', 'transform-origin': '50% 0%', 'top': '50%'});
      } else {
        $letters.css({'padding-bottom': o.innerradius+'px', 'transform-origin': '50% 100%', 'bottom': '50%'});
      }
      $letters.each(function() {
        var $this = $(this);
        var width = $this.outerWidth()+o.letterspacing;
        if (width == o.letterspacing) width = o.wordspacing;
        var rotate = 360*Math.asin(width/(2*o.innerradius))/Math.PI;
          $this.css('margin-left', width/2*-1+'px');
        $this.data('loffset', width/2*-1);
        fullrotate += rotate;
        $this.data('rotate', rotate);
        $this.data('full-rotate', fullrotate);
      });
      var changeratio = 1;
      var wordspacearc = 360*Math.asin(o.wordspacing/o.innerradius)/Math.PI;
      if (fullrotate > 360-wordspacearc) {
        changeratio = fullrotate/(360-wordspacearc);
        o.innerradius = o.innerradius*changeratio;
        fullrotate = 360-wordspacearc;
        $this.css({'width': o.innerradius*2, 'height': o.innerradius*2});
        if (o.under) {
          $letters.css({'padding-top': o.innerradius+'px'});
        } else {
          $letters.css({'padding-bottom': o.innerradius+'px'});
        }
      }
      $letters.each(function() {
        var $this = $(this);
        if (o.under) {
          $this.css('transform', 'rotate('+-(-fullrotate/2+(($this.data('full-rotate')-$this.data('rotate')/2)/changeratio))+'deg)');
        } else {
          $this.css('transform', 'rotate('+-(fullrotate/2-(($this.data('full-rotate')-$this.data('rotate')/2)/changeratio))+'deg)');
        }
      });
    });
  };
})(jQuery);


$('.around').circling({'innerradius': 50, 'letterspacing': 1, 'wordspacing': 10});

$('.circle').circling({'under': true, 'innerradius': 270, 'letterspacing': 1, 'wordspacing': 3});

$(".char1,.char2,.char3,.char4,.char5,.char6,.char7,.char8,.char9,.char10").wrapAll("<a href='#'></a>");
$(".char12,.char13,.char14,.char15,.char16,.char17,.char18,.char19").wrapAll("<a href='#'></a>");