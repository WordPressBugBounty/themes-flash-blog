window.addEventListener("load", function () {
    jQuery(document).ready(function ($) {
        "use strict";
        $("body").addClass("page-loaded");
        var myCursor = jQuery('.theme-custom-cursor');
        if (myCursor.length) {
            if ($('body')) {
                const e = document.querySelector('.theme-cursor-secondary'),
                    t = document.querySelector('.theme-cursor-primary');
                let n, i = 0,
                    o = !1;
                window.onmousemove = function (s) {
                    o || (t.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)"), e.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)", n = s.clientY, i = s.clientX
                }, $('body').on("mouseenter", "a, button, input[type=\"submit\"], .slick-arrow, .cursor-pointer", function () {
                    e.classList.add('cursor-hover'), t.classList.add('cursor-hover')
                }), $('body').on("mouseleave", "a, button, input[type=\"submit\"], .slick-arrow, .cursor-pointer", function () {
                    $(this).is("a") && $(this).closest(".cursor-pointer").length || (e.classList.remove('cursor-hover'), t.classList.remove('cursor-hover'))
                }), e.style.visibility = "visible", t.style.visibility = "visible"
            }
        }
    });
});
jQuery(document).ready(function ($) {
    "use strict";
    var rtled = false;
    if ($("body").hasClass("rtl")) {
        rtled = true;
    }
    $(function () {
        $("figure.wp-block-gallery.has-nested-images.columns-1, .wp-block-gallery.columns-1 ul.blocks-gallery-grid, .gallery-columns-1").each(function () {
            $(this).slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                dots: true,
                nextArrow: '<i class="nav icon-right"></i>',
                prevArrow: '<i class="nav icon-left"></i>',
                rtl: rtled
            });
        });
    });
    $(function () {
        $('.widget-area').theiaStickySidebar({
            additionalMarginTop: 30
        });
    });
    $(function () {
        var pageSection = $(".header-image");
        pageSection.each(function (indx) {
            if ($(this).attr("data-background")) {
                $(this).css("background-image", "url(" + $(this).data("background") + ")");
            }
        });
    });
    $(function () {
        $('.icon-search').on('click', function (event) {
            $('body').toggleClass('united-model');
            $('body').addClass('window-scroll-locked');
            setTimeout(function () {
                $('.model-search-wrapper .search-field').focus();
            }, 300);
        });
        $('.cross-exit').on('click', function (event) {
            $('body').removeClass('united-model');
            $('body').removeClass('window-scroll-locked');
            $('.icon-search').focus();
        });
        $(document).keyup(function (j) {
            if (j.key === "Escape") {
                $('body').removeClass('united-model');
                $('body').removeClass('window-scroll-locked');
                $('.icon-search').focus();
            }
        });
        $('.searchbar-skip-link').focus(function () {
            $('.model-search .search-submit').focus();
        });
        $('input, a, button').on('focus', function () {
            if ($('body').hasClass('united-model')) {
                if (!$(this).parents('.model-search').length) {
                    $('.cross-exit').focus();
                }
            }
        });
    });
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scroll-up').fadeIn();
        } else {
            $('.scroll-up').fadeOut();
        }
    });
    $('.scroll-up').on("click", function (e) {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });
    $(".gallery, .wp-block-gallery").each(function () {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function (item) {
                    return item.el.attr('title');
                }
            },
            gallery: {
                enabled: true
            }
        });
    });
    $('.zoom-gallery').each(function () {
        $(this).magnificPopup({
            delegate: 'button',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function (item) {
                    return item.el.attr('title');
                }
            }
        });
    });
});