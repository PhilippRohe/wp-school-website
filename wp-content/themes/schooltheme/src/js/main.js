// Load all functions after window is ready

jQuery(document).ready(function($) {

    $(document).ready(function($) {
        console.log('%cLoad and initialize JavaScript file', 'background: black; color: lightgreen; font-size: 24px; padding: 5px;', 'main.js');
        custom_function();
        mobile_menu();
    });


    let custom_function = function() {
    }
    
    /* Handle the mobile hamburger menu */
    let mobile_menu = function() {
        $('.js--mobile-menu').on('click', function() {
            $('.js--mobile-menu .menu--toggle').toggleClass('open');
            $('.small-navigation').toggleClass('show');
        });
        $('.menu-item-has-children').on('click', function() {
            $(this).toggleClass('open');
        });
    }
    
}); 