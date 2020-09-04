$(document).ready(function($) {
    // icon burger
    $('.navbar-toggler').on('click', function () {
        $('.animated-burger').toggleClass('open');
    });

    $('#fullpage').fullpage({
        licenseKey: 'D757EA5E-F80D4484-A4FD8A33-2CA6577B',
        slideSelector: '.fullslide',
        autoScrolling: true,
        navigation: true,
	    navigationPosition: 'right',
        scrollHorizontally: false,
        keyboardScrolling: true,
        controlArrows: false,
        scrollOverflow: true,
        responsiveWidth: 990,
    });    

});











