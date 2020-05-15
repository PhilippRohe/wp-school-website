// Load all functions after window is ready

jQuery(document).ready(function($) {

    $(document).ready(function($) {
        custom_function();
        mobile_menu();
        active_search_box();
        to_top_arrow(300);
        slider_modal_image();
        init_slick_slider();
        init_single_view_slick();
        console.log('%cLoaded and initialized JavaScript file', 'background: black; color: lightgreen; font-size: 24px; padding: 5px;', 'main.js');
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

    let active_search_box = function() {
        $('.search-logo').on('click', function() {
            $('.js--search-box').addClass('active');
            $('.js--search-box').find('.logo').toggleClass('active');
        });
        $('.close-logo').on('click', function() {
            $('.js--search-box').removeClass('active');
            $('.js--search-box').find('.logo').toggleClass('active');
        });
    }

    let to_top_arrow = function(value) {
        $( '.top-arrow-container' ).css("display", "none");
        $(window).scroll(function() {
            if ($(this).scrollTop() >= value) {
                $( '.top-arrow-container' ).fadeIn(200);
            } else {
                $( '.top-arrow-container' ).fadeOut(200);
            }
        });
        
        $( '.top-arrow-container' ).click(function() {
            $('body,html').stop().animate({
                scrollTop : 0,
            }, 900, 'swing');
        });
    }

    let slider_modal_image = function() {
        $('.js--image-title').on('click', function() {
            let new_source = $(this).parent().siblings().attr('src');
            let new_alt = $(this).attr('alt');
            $('.js--modal-image').attr('src', new_source);
            $('.js--modal-image').attr('alt', new_alt);
            $('.js--modal').toggleClass('opened');
        });

        $('.js--modal').on('click', function() {
            $(this).toggleClass('opened');
        });
    }

    let init_slick_slider = function() {
        $('.js--image-slider').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: true,
            arrows: true,
            centerMode: true,
            responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                  }
                },
                {
                    breakpoint: 575,
                    settings: {
                        centerMode: false,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                  },
              ]
        });
    }

    let init_single_view_slick = function() {
        $('.js--my-single-view-slider').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            arrows: false,
            centerMode: true,
        });
    }
    
}); 