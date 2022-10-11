const prvs = new Parvus({
  gallerySelector: '.event-gallery',
  captionsSelector: '.gallery-caption',
});

prvs.on('open', function() {
  document.querySelector("body").classList.add("overflow-hidden");
});

prvs.on('close', function() {
  document.querySelector("body").classList.remove("overflow-hidden");
})

jQuery(function( $ ) {

  const expandSVG = '<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1" viewBox="0 0 24 24" xmlns:xlink="http://www.w3.org/1999/xlink"><path stroke-linejoin="round" fill="none" d="M3.000 20.916l1.024 -5.883m7.385 -2.389l-8.409 8.272 5.831 -1.279"/><path stroke-linejoin="round" fill="none" d="M12.705 11.317l8.408 -8.272 -1.024 5.883m-4.807 -4.604l5.831 -1.279"/></svg>';

  const condenseSVG = '<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1" viewBox="0 0 24 24" xmlns:xlink="http://www.w3.org/1999/xlink"><path stroke-linejoin="round" fill="none" d="M11.409 12.644l-1.024 5.883m-7.384 2.389l8.408 -8.272 -5.831 1.279"/><path stroke-linejoin="round" fill="none" d="M21.113 3.045l-8.408 8.272 1.024 -5.884m4.807 4.604l-5.831 1.280"/></svg>';

  const expandBtn = '<button class="parvus__btn parvus__btn--expand" type="button" aria-pressed="false" aria-label="Expand gallery to fullscreen">' + expandSVG + '</button>';

  $('.parvus__btn.parvus__btn--close').before(expandBtn);

  $('.parvus__btn.parvus__btn--expand').click(function() {
    if ($(this).attr('aria-pressed') === "false") {
      $(this).attr('aria-pressed', "true");
      $(this).attr('aria-label', 'Minimize fullscreen gallery');
      $(this).html(condenseSVG);
      $('.parvus').addClass('expanded');
    } else {
      $(this).attr('aria-pressed', "false");
      $(this).attr('aria-label', 'Expand gallery to fullscreen');
      $(this).html(expandSVG);
      $('.parvus').removeClass('expanded');
    }
  });

})(jQuery);