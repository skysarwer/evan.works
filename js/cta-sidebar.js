document.querySelector("#work-with-me").addEventListener('show', function() {
	setTimeout(function() {
		document.querySelector('#first-focus').focus();
	}, 510);
});

var $header = document.querySelector('.site-header'),
  $hOffset = $header.offsetTop,
  $hHeight = $header.clientHeight,
  $winH = window.innerHeight,
  $scrollY;

  window.addEventListener('scroll', function() {
	$scrollY = window.scrollY;
	if ($scrollY > ($hOffset + $hHeight)) {
		document.querySelector('.cta.ribbon').classList.add('active');
	} else {
		document.querySelector('.cta.ribbon').classList.remove('active');	
	}
  });