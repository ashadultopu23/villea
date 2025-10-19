/**
*
* --------------------------------------------------------------------
*
* Template : Villea - Forex & Stock Broker Review & Comparison Affiliate WordPress Theme

* --------------------------------------------------------------------
*
**/

(function ($) {
    "use strict";

    jQuery(function ($) {
        var $header = $('.menu-sticky'),
            $headerInner = $('.header-inner'),
            $breadcrumbs = $('.themephi-breadcrumbs'),
            $mainContain = $('.main-contain'),
            $breadcrumbsInner = $('.breadcrumbs-inner'),
            $win = $(window),
            lastScroll = 0,
            isScrolled = false;

        var isFixedHeader = $('#themephi-header').hasClass('fixed-header');

        if (isFixedHeader) {
            $win.on('scroll', function () {
                var scroll = $win.scrollTop();
                var headerInnerHeight = $headerInner.outerHeight();
                $header.toggleClass('sticky', scroll >= headerInnerHeight);
                $('.menu-area').toggleClass('sticky-menu', scroll >= headerInnerHeight);
                $headerInner.toggleClass('tp-sticky', scroll >= headerInnerHeight);
            });

            $headerInner.waypoint('sticky', { offset: 0 });
        } else {
            $win.on('scroll', function () {
                var currentScroll = $win.scrollTop(),
                    scrollUp = currentScroll < lastScroll;

                isScrolled = currentScroll > 200;
                $headerInner.toggleClass('header-active', isScrolled && scrollUp);
                lastScroll = currentScroll;
            });
        }

        // Hide empty menu links
        $(".widget_nav_menu li a").filter(function () {
            return $.trim($(this).html()) === '';
        }).hide();
    });


    // sidebar
    $(".sidebar_modern .tp_shop_top_portion_bar .sidebar_link").on("click", function () {
        $(".sidebar_modern").toggleClass("modern_sidebar_active");
    });

    $(".sidebar_default .tp_shop_top_portion_bar .sidebar_link").on("click", function () {
        $(".sidebar_default").toggleClass("sidebar_default_active");
    });

    // Close sidebar when clicking the cross bar
    $(".post_sidebar .cross_bar").on("click", function () {
        $(".sidebar_default").removeClass("sidebar_default_active");
    });

    // user-profile
    $(".sidebar_flyout .tp_shop_top_portion_bar .sidebar_link").on("click", function () {
        $(".sidebar_flyout").toggleClass("flyout_sidebar_active");
        $("body").toggleClass("flyout_sidebar_overlay");
    });
    $(document).on("click", function (event) {
        if (!$(event.target).closest('.sidebar_flyout').length && !$(event.target).is('.sidebar_flyout .tp_shop_top_portion_bar .sidebar_link')) {
            $(".sidebar_flyout.flyout_sidebar_active").removeClass('flyout_sidebar_active');
            $("body").removeClass('flyout_sidebar_overlay');
        }
    });
    // Close sidebar when clicking the cross bar
    $(".post_sidebar .cross_bar").on("click", function () {
        $(".sidebar_flyout").removeClass("flyout_sidebar_active");
        $("body").removeClass("flyout_sidebar_overlay");
    });


    // video 
    if ($('.player').length) {
        $(".player").YTPlayer();
    }

    $('.video-btn').magnificPopup({
        type: 'iframe',
        callbacks: {

        }
    });



    $(".menu-area .navbar ul > li.menu-item-has-children").on('mouseenter', function () {
        $(this).addClass('hover-minimize');
    }).on('mouseleave', function () {
        $(this).removeClass("hover-minimize");
    });

    $(".showcase-item").on('mouseenter mouseleave', function () {
        $(this).toggleClass("hover");
    });

    //Phone Number
    $('.phone_call').on('click', function (event) {
        $('.phone_num_call').slideToggle('show');
    });

    //search 
    $('.sticky_search').on('click', function (event) {
        $('.sticky_form').animate({ opacity: 'toggle' }, 500);
        $('.sticky_form input').focus();

        $('body').removeClass('search-active').removeClass('search-close');
        if ($(this).hasClass('close-full')) {
            $('body').addClass('search-close');
            $('.sticky_form').fadeOut('show');
        } else {
            $('body').addClass('search-active');
        }
        return false;
    });

    if ($('.themephi-newsletter').hasClass('themephi-newsletters')) {
        $('body').addClass('themephi-pages-btm-gap');
    }
    $('.sticky_form_search').on('click', function () {
        $('body, html').removeClass('themephi-search-active').removeClass('themephi-search-close');
        if ($(this).hasClass('close-search')) {
            $('body, html').addClass('themephi-search-close');

        }
        else {
            $('body, html').addClass('themephi-search-active');
        }
        return false;
    });

    if ($('#themephi-header').hasClass('fixed-menu')) {
        $('body').addClass('body-left-space');
    }

    $("#themephi-header ul > li.classic").on('mouseenter', function () {
        $('body').addClass('mega-classic');
    }).on('mouseleave', function () {
        $('body.mega-classic').removeClass("mega-classic");
    });

    var nav = $('#nav');
    if (nav.length) {
        $('#menu-single-menu').onePageNav();
    }
    new WOW().init();

    // Responsive Menu
    $(document).ready(function () {
        $(window).on("load resize", function () {
            var windowWidth = window.innerWidth;

            $(".menu-area").each(function () {
                var $menu = $(this);

                var isMobile = $menu.hasClass('mobile');
                var isTablet = $menu.hasClass('tablet');
                var isLaptopXL = $menu.hasClass('laptop_xl');
                var noResponsive = $menu.hasClass('none');
                var isDefaultHeader = $('body').hasClass('tps-default-header');
                var isFlyout = $menu.hasClass('flyout');

                var isMobileOrTabletOrLaptopXL = (isMobile && windowWidth <= 668) || (isTablet && windowWidth <= 1025) || (isLaptopXL && windowWidth <= 1200);

                // Mobile/Tablet View
                if (isMobileOrTabletOrLaptopXL) {
                    $menu.find(".horizontal_menu_icon").css("display", "flex");
                    $menu.find(".menu-responsive").css("display", "none");
                } else {
                    $menu.find(".horizontal_menu_icon").css("display", "none");
                    $menu.find(".menu-responsive").css("display", "flex");
                    $menu.find("li.menu-item-has-children").removeClass("active").find("ul.sub-menu").removeAttr("style");
                    $(".nav-toggle, .off-nav-layer, .menu-ofcn, .close-button, body").removeClass("off-open");
                }

                // Flyout overrides
                if (isFlyout) {
                    $menu.find(".flyout_wraper .menu-responsive").css("display", "none");
                }

                // Default header quote toggle
                if (isDefaultHeader && windowWidth <= 1025) {
                    $(".header-quote").css("display", "flex");
                    $menu.find(".menu-responsive").css("display", "none");
                } else {
                    $(".header-quote").css("display", "none");
                    if (!isFlyout) {
                        $menu.find(".flyout_wraper .menu-responsive").css("display", "flex");
                    }
                }

                // open
                $menu.find(".menu-button").off("click").on("click", function () {
                    $menu.parent().find(".nav-toggle, .off-nav-layer, .menu-ofcn, .close-button, body").toggleClass("off-open");
                });

                // close
                $menu.parent().find(".close-button").off("click").on("click", function () {
                    $menu.parent().find(".nav-toggle, .off-nav-layer, .menu-ofcn, .close-button, body").toggleClass("off-open");
                });

                // Submenu toggle
                $menu.parent().find("li.menu-item-has-children > a").off("click");

                if (isMobileOrTabletOrLaptopXL || isFlyout) {
                    $menu.parent().find("li.menu-item-has-children > a").on("click", function (event) {
                        event.preventDefault();
                        var parentLi = $(this).parent();
                        parentLi.toggleClass("active").siblings().removeClass("active").find("ul.sub-menu").slideUp();
                        $(this).next("ul.sub-menu").slideToggle();
                        console.log('clicked submenu');

                    });
                }
            });
        });
    });



    $('.tps-default-header.header-style-1 .menu-area .menu_one .col-cell.menu-responsive.primary-menu ul#primary-menu-main > li').slice(-4).addClass('menu-last');

    // Get a quote popup
    $('.popup-quote').magnificPopup({
        type: 'inline',
        preloader: false,
        focus: '#qname',
        removalDelay: 500,
        callbacks: {
            beforeOpen: function () {
                this.st.mainClass = this.st.el.attr('data-effect');
                if ($(window).width() < 700) {
                    this.st.focus = false;
                } else {
                    this.st.focus = '#qname';
                }
            }
        }
    });

    //Videos popup jQuery activation code
    $('.popup-videos').magnificPopup({
        disableOn: 10,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    $('.popup-images').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
        },
        removalDelay: 300,
        mainClass: 'mfp-fade',
    });



    $(function () {
        $("ul.children").addClass("sub-menu");
    });


    // collapse hidden
    $(function () {
        var navMain = $(".navbar-collapse");
        navMain.on("click", "a:not([data-toggle])", null, function () {
            navMain.collapse('hide');
        });
    });

    //Select box wrap css
    $(".menu-area .navbar ul > li.mega > ul.sub-menu").wrapInner("<div class='container flex-mega'></div>");
    $('.menu-area .navbar ul > li.mega > ul.sub-menu li').first().addClass('first-li-item');


    if ($('div').hasClass('openingfoot')) {
        $('body').addClass('openingfootwrap');
    }

    $(window).on('load', function () {
        //preloader
        $("#villea-load").delay(500).fadeOut(200);
        $(".villea-loader").delay(500).fadeOut(200);

        if ($(window).width() < 992) {
            $('.themephi-menu').css('height', '0');
            $('.themephi-menu').css('opacity', '0');
            $('.themephi-menu').css('z-index', '-1');
            $('.themephi-menu-toggle').on('click', function () {
                $('.themephi-menu').css('opacity', '1');
                $('.themephi-menu').css('z-index', '1');
            });
        }

        // JS for isotope Filter
        $('.grid').imagesLoaded(function () {
            $('.isotope-filter').on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });
            var $grid = $('.grid').isotope({
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                },

                itemSelector: '.grid-item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.grid-item',
                }
            });
        });
        $('.isotope-filter button').on('click', function (event) {
            $(this).siblings('.active').removeClass('active');
            $(this).addClass('active');
            event.preventDefault();
        });

    });

    // Counter Up  
    $('.rs-counter').counterUp({
        delay: 20,
        time: 1500
    });
    // scrollTop init
    var win = $(window);
    var totop = $('#top-to-bottom');
    win.on('scroll', function () {
        if (win.scrollTop() > 150) {
            totop.fadeIn();
        } else {
            totop.fadeOut();
        }
    });
    totop.on('click', function () {
        $("html,body").animate({
            scrollTop: 0
        }, 500)
    });

    $(function () {
        $("ul.children").addClass("sub-menu");
    });

    $(".comment-body, .comment-respond").wrap("<div class='comment-full'></div>");

    /*
*******************
Box Style Start
*******************
*/
    if (jQuery(".box-style").length > 0) {

        const targetBtn = document.querySelectorAll('.box-style')
        if (targetBtn) {
            targetBtn.forEach((element) => {
                element.addEventListener('mousemove', (e) => {
                    const x = e.offsetX + 'px';
                    const y = e.offsetY + 'px';
                    element.style.setProperty('--x', x);
                    element.style.setProperty('--y', y);
                })
            })
        }

    }


    if (jQuery(".tp-top-image-carousel ").length > 0) {

        var swiper = new Swiper(".tp-top-image-carousel ", {
            loop: true,
            spaceBetween: 24,
            effect: "creative",
            creativeEffect: {
                prev: {
                    shadow: true,
                    origin: "left center",
                    translate: ["-5%", 0, -80],
                    rotate: [0, 40, 0],
                },
                next: {
                    origin: "right center",
                    translate: ["5%", 0, -80],
                    rotate: [0, -40, 0],
                },
            },
            slidesPerView: 1,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: true,
            },
            navigation: {
                nextEl: ".portfolio-inner-next",
                prevEl: ".portfolio-inner-prev",
            },
        });

    }

    if (jQuery(".tp-top-gallery-carousel ").length > 0) {

        var swiper = new Swiper(".tp-top-gallery-carousel ", {
            loop: true,
            spaceBetween: 24,
            slidesPerView: 3,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: true,
            },
            navigation: {
                nextEl: ".portfolio-inner-next",
                prevEl: ".portfolio-inner-prev",
            },
        });

    }

    if (jQuery(".tp-top-carousel-center ").length > 0) {

        var swiper = new Swiper(".tp-top-carousel-center ", {
            loop: true,
            spaceBetween: 24,
            slidesPerView: 2,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: true,
            },
            navigation: {
                nextEl: ".portfolio-inner-next",
                prevEl: ".portfolio-inner-prev",
            },
        });

    }


    if (jQuery(".blog_post_gallery").length > 0) {
        new Swiper('.blog_post_gallery', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            slidesPerView: 1,
            spaceBetween: 10,
        });
    };

    // Open/close sidebar
    $('.sidebarToggleButton').on('click', function () {
        console.log('clicked');
        $('.commonSidebarWrapper').toggleClass('active');
    });

    // Close sidebar
    $('.sidebarCloseButton').on('click', function () {
        $('.commonSidebarWrapper').removeClass('active');
    });


})(jQuery);