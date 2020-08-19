$(document).ready(function($) {
    // icon burger
    $('.navbar-toggler').on('click', function () {
        $('.animated-icon1').toggleClass('open');
    });

    $('#fullpage').fullpage({
        licenseKey: 'D757EA5E-F80D4484-A4FD8A33-2CA6577B',
        slideSelector: '.fullslide',
        autoScrolling: true,
        navigation: true,
	    navigationPosition: 'right',
        scrollHorizontally: false,
        controlArrows: false,
        scrollOverflow: true,
        paddingTop: '5em'        
    });
    
    // if ($(window).width() < 991 ) {
    //     $('.section').addClass('fp-auto-height');
        
    // }


    // window.onscroll = function() {myFunction()};

    // function myFunction() {
    //   var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    //   var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    //   var scrolled = (winScroll / height) * 100;
    //   document.getElementById("myBar").style.width = scrolled + "%";
    // }


//     var sections = $('section');

//     $(window).on('scroll', function(e){
//       $(sections).each( function(){
//         console.log($(sections).offset().top);
//       })
// });

});
        

    // $(window).on("load", function(){
    //     var fenetre = $(window).height();
    //     var section1=$("#section01").offset().top;
    //     var section2=$("#section02").offset().top;
    //     var section3=$("#section03").offset().top;
    //     var section4=$("#section04").offset().top;
    //     var section5=$("#section05").offset().top;
    //     var section=$('.section').offset().top;

    //     $(window).scroll(function(){
    //         $('.section').each(function(){
    //             if ($(document).scrollTop() >= section ) {
    //                 $('html, body').animate({scrollTop: $('#section02').offset().top }, 'slow');  
    //             }
    //         });
    //     });



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









