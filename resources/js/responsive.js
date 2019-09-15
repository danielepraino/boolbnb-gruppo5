$(document).ready(function() {

  console.log($(window).scroll());

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

  if ($(window).width()< 834) {
    $('.scroll_top').removeClass('hidden')
    $('.scroll_top > i').click(function () {
      $('html').animate({scrollTop:0}, 'slow');//per IE e Mozilla
      $('body').animate({scrollTop:0}, 'slow');//per  Chrome
    })
  }

});
