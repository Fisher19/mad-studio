$(document).ready(function() {
    // icon burger
    $('.navbar-toggler').on('click', function () {  
        $('.animated-icon1').toggleClass('open');
    });

    // opacity bg header au scroll
    // $(window).scroll(function () {
    //     if ($('.animated-icon1').toggleClass('open') && $(document).scrollTop() > 0) {
    //         $('.navbar').removeClass("navScroll");
    //         $('.navbar-collapse').slideUp();
    //     } 
    // });
//     $(window).scroll(function () {
//         if ($(document).scrollTop() == 0) {
//               $(".navbar").addClass("navScroll").removeClass("navTop");
//         } else {
//               $(".navbar").addClass("navTop").removeClass("navScroll");
//         }
//   });

//     $(document).mouseup(function(e) 
// {
//     var container = $("#contact");

//     // if the target of the click isn't the container nor a descendant of the container
//     if (!container.is(e.target) && container.has(e.target).length === 0) 
//     {
//         container.hide();
//     }
// });


    // // dotnav
    // var parPosition = [];
    // $('.par').each(function () {
    //     parPosition.push($(this).offset().top);
    // });

    // $('a').click(function () {
    //     $('html, body').animate({
    //         scrollTop: $($.attr('data-target')).offset().top
    //     }, 500);
    //     return false;
    // });

    // $('.vNav ul li a').click(function () {
    //     $('.vNav ul li a').removeClass('active');
    //     $(this).addClass('active');
    // });

    // $('.vNav a').hover(function () {
    //     $(this).find('.label').show();
    // }, function () {
    //     $(this).find('.label').hide();
    // });

    // $(document).scroll(function () {
    //     var position = $(document).scrollTop(),
    //         index;
    //     for (var i = 0; i < parPosition.length; i++) {
    //         if (position <= parPosition[i]) {
    //             index = i;
    //             break;
    //         }
    //     }
    //     $('.vNav ul li a').removeClass('active');
    //     $('.vNav ul li a:eq(' + index + ')').addClass('active');
    // }).scroll();

    // $('.vNav ul li a').click(function () {
    //     $('.vNav ul li a').removeClass('active');
    //     $(this).addClass('active');
    // });

});




