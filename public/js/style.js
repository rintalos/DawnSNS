$(function () {

   $('.menu').on('click', function () {
      $('.menu-list').slideToggle();
      $('.menu').toggleClass('open');
   });

   // $('.follows-btn').on('click', function () {
   //    // $('.menu-list').slideToggle();
   //    $('.follows-btn').toggleClass('active');
   // });




   $(function () {

      $('.edit-icon').each(function () {
         $(this).on('click', function () {
            var target = $(this).data('target');
            var modal = document.getElementById(target);
            console.log(modal);
            $(modal).fadeIn();
            return false;
         });

      });
      // $('.post-btn').on('click', function () {
      //    $('.edit-modal-wrapper').fadeOut();
      //    return false;
      // });
   });
});
