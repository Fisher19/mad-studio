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

});









