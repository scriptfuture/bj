
// убираем бутерброд-меню
$(document).ready(function() {
  $("[data-toggle=collapse]").hide();
 
  $(window).resize(function(){
       $("[data-toggle=collapse]").hide();
  });
});