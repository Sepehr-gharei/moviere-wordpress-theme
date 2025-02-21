jQuery(document).ready(function () {
  jQuery(function preloaderLoad() {
    if (jQuery(".preloader").length) {
      jQuery(".preloader").delay(200).fadeOut(300);
    }
    jQuery(".preloader_disabler").on("click", function () {
      jQuery("#preloader").hide();
    });
  });
  
});
