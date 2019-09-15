$(document).ready(function() {

  //search view su smartphone
  var filter_content = $('.filter');

  if ($(window).width() < 767) {
    filter_content.addClass('hidden_filter');
    $('.get_filter_responsive').removeClass('hidden_filter');
    $('.appartamenti-filtrati').addClass('mt-5');

    //nascondo/mostro filtri
    $('.get_filter_responsive > i').click(function () {
      if ( $('.get_filter_responsive > i').hasClass('fa-chevron-down') ) {
        filter_content.removeClass('hidden_filter');
        $('.get_filter_responsive > i').removeClass('fa-chevron-down')
        $('.get_filter_responsive > i').addClass('fa-chevron-up')
      }else{
        filter_content.addClass('hidden_filter');
        $('.get_filter_responsive > i').removeClass('fa-chevron-up')
        $('.get_filter_responsive > i').addClass('fa-chevron-down')
      }
    });

  }

});
