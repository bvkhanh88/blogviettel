jQuery(document).ready(function ($) {
    "use strict";

    /*==============================
     Mobile check
     ==============================*/
    function mobilecheck() {
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            return false;
        }
        return true;
    }

    var ww = $(window).width();

    //set same height
    //$('.recent-item .post-box-title a').setSameHeight();

    //Config tooltip
    // $('.recent-item[data-toggle="tooltip"]').each(function () {
    //     var data_html = $(this).find('.post-tooltip').html();
    //     $(this).attr('title', data_html);
    // });
    // $('[data-toggle="tooltip"]').tooltip();

    //custom html menu with js
    //$('#kbw-navigation').find('ul.menu').find('li').last().append('<span class="phone-wave"></span>');

    //Fast Order JS
    $('.add-cart .buy-now').on('click', function () {
        var pos_id = $(this).data('id'),
            post_price = $(this).data('price'),
            qty = $(this).data('qty'),
            post_title = $(this).data('title');
        $(this).parent().find('input[name="post_id"]').val(pos_id);
        $(this).parent().find('input[name="post_price"]').val(post_price);
        $(this).parent().find('input[name="qty"]').val(qty);
        $(this).parent().find('input[name="post_title"]').val(post_title);
        $(this).parent().find('form').submit();
    });

    // Verticle Menu
    if ($(window).width() >= 768) {
        var num = 11;
        jQuery('.widget_nav_menu ul.menu')
            .find(' > li:gt(' + num + ') ')
            .hide()
            .end()
            .each(function () {
                if ($(this).children('li').length > num) {
                    $(this).append(
                        $('<li><a class="open-more-cat">Show more <i class="fa fa-angle-double-down"></i></a></li>')
                            .addClass('showMore')
                            .on('click', function () {
                                if ($(this).siblings(':hidden').length > 0) {
                                    $(this).html('<a class="close-more-cat">Close Menu <i class="fa fa-angle-double-up"></i></a>').siblings(':hidden').show(400);
                                } else {
                                    $(this).html('<a class="open-more-cat">Show more <i class="fa fa-angle-double-down"></i></a>').show().siblings('li:gt(' + num + ')').hide(400);
                                }
                            })
                    );
                }
            });
    }

    /* Slide toogle menu vertical */
    $(".category-bt").on('click', function () {
        $(this).parents('.kbw-menu-category').find('.category-list').slideToggle("fast");
    });


    //Initiate the wowjs animation library
    new WOW().init();

    // Fixed when scroll
    if ($(window).width() > 991) {
        var elm_fixed = $('#site-header');
        if (elm_fixed.length > 0) {
            var topFix = elm_fixed.offset().top;
            $(window).scroll(function () {
                if ($(window).scrollTop() > topFix) elm_fixed.addClass("sticky");
                else elm_fixed.removeClass("sticky");
            });
        }
    }

    // Service slider
    $('.services .wpb_wrapper').slick({
        centerMode: true,
        centerPadding: '90px',
        slidesToShow: 2,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            }
        ]
    });
    $('.row-service').on('click touch', '.kbw-button-control.prev button', function () {
        //$('.row-service .slick-prev').trigger('click');
        $('.services .wpb_wrapper').slick('slickPrev');
    }).on('click touch', '.kbw-button-control.next button', function () {
        //$('.row-service .slick-next').trigger('click');
        $('.services .wpb_wrapper').slick('slickNext');
    });
    //$('.kbw-box.style3.slick-current').prev('.kbw-box.style3').addClass('highlight');


    $('.row-testimonial').each(function () {
        var slider_selector = $(this).find('.kbwCarousel:not(.manual):not(.owl-loaded)');

        $(this).find('.kbw-button-control.prev button').on('click', function () {
            slider_selector.trigger('prev.owl.carousel');
        });

        $(this).find('.kbw-button-control.next button').on('click', function () {
            slider_selector.trigger('next.owl.carousel');
        });
    });

    $('.listing-featured').each(function () {
        var slider_selector = $(this).find('.kbwCarousel:not(.manual):not(.owl-loaded)');

        $(this).find('.kbw-button-control.prev button').on('click', function () {
            slider_selector.trigger('prev.owl.carousel');
        });

        $(this).find('.kbw-button-control.next button').on('click', function () {
            slider_selector.trigger('next.owl.carousel');
        });
    });
});

// jQuery(window).load(function () {
//     if (kbwchild.is_home) {
//         setTimeout(function () {
//             jQuery('#subscribe-modal').modal('show');
//         }, 1000);
//     }
// });
