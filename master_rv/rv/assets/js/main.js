/*------------------------------------------------------------------
Theme Name: LOCALL - Responsive Bootstrap Directory Theme
Version: 1.0
Author: codenpixel.com  
Contact: info@codenpixel.com
-------------------------------------------------------------------*/
/* Table of Content
*****************************************************

   
    01. Loading animation
    02. Add image via data 
    03. Anchor Smooth Scroll
	04. Slick carousel
	05. Stellar seetings
	

********************************************************************/
$(document).ready(function() {
    "use strict";
    // Loading animation seetings
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 800,
        outDuration: 800,
        linkElement: '.animsition-link', // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
        loading: true,
        loadingParentElement: 'body', //animsition wrapper element
        loadingClass: 'animsition-loading',
        loadingInner: '', // e.g '<img src="loading.svg" />'
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: ['animation-duration', '-webkit-animation-duration'], // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
        // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
        overlay: false,
        overlayClass: 'animsition-overlay-slide',
        overlayParentElement: 'body',
        transition: function(url) {
            window.location.href = url;
        }
    });
    // Add image via data attr 
    $(".bg-image").css('background', function() {
        var bg = ('url(' + $(this).data("image-src") + ') no-repeat center center');
        return bg;
    });
    // Anchor Smooth Scroll
    $('body').on('click', '.page-scroll', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 80)
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
    
    // Slick slider seetings.Used for home page carousel
    $('#cc-slider').slick({
        infinite: true,
        adaptiveHeight: true,
        dots: true,
        autoplay: true,
        speed: 700,
        autoplaySpeed: 2500,
        arrows: false,
        centerMode: true,
        slidesToShow: 3,
        slidesToScroll: 2,
        responsive: [{
            breakpoint: 1170,
            settings: {
                arrows: false,
                slidesToShow: 2
            }
        }, {
            breakpoint: 978,
            settings: {
                arrows: false,
                slidesToShow: 2
            }
        }, {
            breakpoint: 768,
            settings: {
                arrows: false,
                slidesToShow: 2
            }
        }, {
            breakpoint: 668,
            settings: {
                arrows: false,
                slidesToShow: 1
            }
        }, {
            breakpoint: 480,
            settings: {
                arrows: false,
                slidesToShow: 1
            }
        }]
    });
    // Carousel seetings used for profile page
    $('.profile_carousel').slick({
        dots: false,
        arrows: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    dots: false
                }
            }, {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            }
        ]
    });
    $(".bt-tabs a").on(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
    $('a[href="#"]').on(function(e) {
        e.preventDefault ? e.preventDefault() : e.returnValue = false;
    });
     $(".bg-image").css("background-size", "cover");
    // Change text on button after clikc.Used for coupons code example in profile page
    $(".btn-swipe").on("click", function() {
        var el = $(this);
        if (el.text() == el.data("text-swap")) {
            el.text(el.data("text-original"));
        } else {
            el.data("text-original", el.text());
            el.text(el.data("text-swap"));
        };
        event.preventDefault();
    });
    // Parallax global seetings
    $.stellar({
        horizontalOffset: 50,
        verticalOffset: 50,
        responsive: true
    });
});