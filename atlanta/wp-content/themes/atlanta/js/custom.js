var flkty = new Flickity( '.main-gallery', {
  cellAlign: 'left',
  contain: true,
  wrapAround: true,
  prevNextButtons: true,
  autoPlay: 1500
});

jQuery('.galleryFilerPart a').bind('click', function($){
	$(this).addClass('active').parent().siblings().find('a').removeClass('active');
});