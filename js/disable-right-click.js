jQuery(document).ready(function(){
    jQuery(function() {
          jQuery(this).bind("contextmenu", function(event) {
              event.preventDefault();
              alert('Right click is disabled on this page');
          });
      });
  });