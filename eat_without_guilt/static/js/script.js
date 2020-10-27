
function display_message_lead(message) {
    $('.message').text(message);
    $('.alert_lead').fadeIn('slow').animate({opacity: 1.0}, 1500).fadeOut('slow');
}

!function (e) {
    "use strict";
    function t() {
        e(".main-header").length && (e(window).scrollTop() >= 200 ? (e(".main-header").addClass("fixed-header"), e(".scroll-to-top").fadeIn(300)) : (e(".main-header").removeClass("fixed-header"), e(".scroll-to-top").fadeOut(300)))
    }

    $(document).ready(function () {
        $('.pincode').select2();
    });
    $('.cat').click(function () {
        var obj = $(this)
        var type = 0
        if (obj.hasClass('a')) {
            type = 0;
        }
        else if (obj.hasClass('b')) {
            type = 1;
        }
        else if (obj.hasClass('v')) {
            type = 2;
        }
        else if (obj.hasClass('r')) {
            type = 3;
        }
        $("#b_cat").val(type)
        $("#change_cat").submit();


    });

    var frm = $('.contactForm1');


    $('.contactForm1').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        var form_data = form.serialize();
        var gender =$(".gender_val").val();
        if (form.serializeArray()[2].value === '0'){
            display_message_lead("PLEASE SELECT COUNTRY !");
            return;
        }
        if(gender === 'Gender*'){
            display_message_lead("PLEASE SELECT GENDER !");
            return;
        }

        $("#overlay").show();
        $.ajax({
            type: 'post',
            url: '/clients/send_lead/',
            data: form_data,
            success: function (r) {
                $("#overlay").hide();
                if (r.status === '1') {
                    form.trigger("reset");
                    display_message_lead("THANK YOU FOR CONTACTING !");

                } else {
                    display_message_lead(r.message);
                }
            }
        });


    });
    $('.select_country').select2({
        minimumInputLength: 2,
        tags: false,
        width: '100%',
        ajax: {
            url: "/utility/phonecode/",
            cache: true,
            data: function (params) {
                var q = {
                    search: params.term,
                };
                // Query parameters will be ?search=[term]&type=public
                return q;
            },
            processResults: function (data) {
                return {
                    results: data.results
                };
            }
        }
    });

    $('.select_country_modal').select2({
        minimumInputLength: 2,
        tags: false,
        dropdownParent: $('#exampleModalLong .modal-content'),
        ajax: {
            url: "/utility/phonecode/",
            cache: true,
            data: function (params) {
                var q = {
                    search: params.term,
                };
                // Query parameters will be ?search=[term]&type=public
                return q;
            },
            processResults: function (data) {
                return {
                    results: data.results
                };
            }
        }
    });

    // $(function () {
    //     $('#datetimepicker12').datetimepicker({
    //         inline: true,
    //         sideBySide: true,
    //         format: 'DD-MM-YYYY'
    //     });
    // });

    var a;
    if (t(), e(".main-header li.dropdown ul").length && (e(".main-header li.dropdown").append('<div class="dropdown-btn"></div>'), e(".main-header li.dropdown .dropdown-btn").on("click", function () {
            e(this).prev("ul").slideToggle(500)
        }), e(".navigation li.dropdown > a").on("click", function (e) {
            e.preventDefault()
        })), (a = e(".hidden-bar .side-menu")).find(".dropdown").children("a").append(function () {
            return '<button type="button" class="btn expander"><i class="icon fa fa-angle-down"></i></button>'
        }), a.find(".dropdown").children("ul").hide(), a.find(".btn.expander").each(function () {
            e(this).on("click", function () {
                return e(this).parent().parent().children("ul").slideToggle(), e(this).parent().toggleClass("current"), e(this).find("i").toggleClass("fa-angle-up fa-angle-down"), !1
            })
        }), e(".hidden-bar-wrapper").length && e(".hidden-bar-wrapper").mCustomScrollbar(), e(".hidden-bar-closer").length && e(".hidden-bar-closer").on("click", function () {
            e(".hidden-bar").removeClass("visible-sidebar")
        }), e(".hidden-bar-opener").length && e(".hidden-bar-opener").on("click", function () {
            e(".hidden-bar").addClass("visible-sidebar")
        }), e(".main-slider .tp-banner").length && e(".main-slider .tp-banner").show().revolution({
            dottedOverlay: "yes",
            delay: 1e4,
            startwidth: 1200,
            startheight: 910,
            hideThumbs: 600,
            thumbWidth: 80,
            thumbHeight: 50,
            thumbAmount: 5,
            navigationType: "bullet",
            navigationArrows: "0",
            navigationStyle: "preview3",
            touchenabled: "on",
            onHoverStop: "off",
            swipe_velocity: .7,
            swipe_min_touches: 1,
            swipe_max_touches: 1,
            drag_block_vertical: !1,
            parallax: "mouse",
            parallaxBgFreeze: "on",
            parallaxLevels: [7, 4, 3, 2, 5, 4, 3, 2, 1, 0],
            keyboardNavigation: "off",
            navigationHAlign: "center",
            navigationVAlign: "bottom",
            navigationHOffset: 0,
            navigationVOffset: 0,
            soloArrowLeftHalign: "left",
            soloArrowLeftValign: "center",
            soloArrowLeftHOffset: 20,
            soloArrowLeftVOffset: 0,
            soloArrowRightHalign: "right",
            soloArrowRightValign: "center",
            soloArrowRightHOffset: 20,
            soloArrowRightVOffset: 0,
            shadow: 0,
            fullWidth: "on",
            fullScreen: "off",
            spinner: "spinner4",
            stopLoop: "off",
            stopAfterLoops: -1,
            stopAtSlide: -1,
            shuffle: "off",
            autoHeight: "off",
            forceFullWidth: "on",
            hideThumbsOnMobile: "on",
            hideNavDelayOnMobile: 1500,
            hideBulletsOnMobile: "on",
            hideArrowsOnMobile: "on",
            hideThumbsUnderResolution: 0,
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            startWithSlide: 0,
            videoJsPath: "",
            fullScreenOffsetContainer: ""
        }), e(".accordion-box").length && e(".accordion-box").on("click", ".acc-btn", function () {
            var t = e(this).parents(".accordion-box"), a = e(this).parents(".accordion");
            if (!0 !== e(this).hasClass("active") && e(".accordion .acc-btn").removeClass("active"), e(this).next(".acc-content").is(":visible"))return !1;
            e(this).addClass("active"), e(t).children(".accordion").removeClass("active-block"), e(t).children(".accordion").children(".acc-content").slideUp(300), a.addClass("active-block"), e(this).next(".acc-content").slideDown(300)
        }), e(".tabs-box").length && e(".tabs-box .tab-buttons .tab-btn").on("click", function (t) {
            t.preventDefault();
            var a = e(e(this).attr("data-tab"));
            a.parents(".tabs-box").find(".tab-buttons").find(".tab-btn").removeClass("active-btn"), e(this).addClass("active-btn"), a.parents(".tabs-box").find(".tabs-content").find(".tab").fadeOut(0), a.parents(".tabs-box").find(".tabs-content").find(".tab").removeClass("active-tab"), e(a).fadeIn(300), e(a).addClass("active-tab")
        }), e(".testimonials-carousel").length && e(".testimonials-carousel").owlCarousel({
            loop: !0,
            margin: 20,
            nav: !0,
            smartSpeed: 700,
            autoplay: 5e3,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {0: {items: 1}, 600: {items: 1}, 800: {items: 2}, 1024: {items: 2}, 1200: {items: 2}}
        }), e(".certificates-carousel").length && e(".certificates-carousel").owlCarousel({
            loop: !0,
            margin: 30,
            nav: !0,
            smartSpeed: 700,
            autoplay: 5e3,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {0: {items: 1}, 600: {items: 2}, 800: {items: 3}, 1024: {items: 3}, 1200: {items: 4}}
        }), e(".team-data-carousel").length && e(".team-thumbs-carousel").length) {
        var n = e(".team-data-carousel"), o = e(".team-thumbs-carousel"), i = !1, s = 500;
        n.owlCarousel({
            loop: !1,
            items: 1,
            margin: 0,
            nav: !1,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            dots: !1,
            autoplay: !0,
            autoplayTimeout: 5e3
        }).on("changed.owl.carousel", function (e) {
            i || (i = !1, o.trigger("to.owl.carousel", [e.item.index, s, !0]), i = !1)
        }), o.owlCarousel({
            loop: !1,
            margin: 20,
            items: 1,
            nav: !0,
            navText: ['<span class="icon fa fa-long-arrow-left"></span>', '<span class="icon fa fa-long-arrow-right"></span>'],
            dots: !1,
            center: !1,
            autoplay: !0,
            autoplayTimeout: 5e3,
            responsive: {
                0: {items: 1, autoWidth: !1},
                400: {items: 2, autoWidth: !1},
                600: {items: 3, autoWidth: !1},
                800: {items: 4, autoWidth: !1},
                1000: {items: 3, autoWidth: !1},
                1200: {items: 4, autoWidth: !1}
            }
        }).on("click", ".owl-item", function () {
            n.trigger("to.owl.carousel", [e(this).index(), s, !0])
        }).on("changed.owl.carousel", function (e) {
            i || (i = !0, n.trigger("to.owl.carousel", [e.item.index, s, !0]), i = !1)
        })
    }
    if (e(".single-item-carousel").length && e(".single-item-carousel").owlCarousel({
            loop: !0,
            margin: 0,
            nav: !0,
            smartSpeed: 700,
            autoplay: 5e3,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {0: {items: 1}, 1024: {items: 1}, 1200: {items: 1}}
        }), e(".related-gallery-carousel").length && e(".related-gallery-carousel").owlCarousel({
            loop: !0,
            margin: 30,
            nav: !0,
            smartSpeed: 700,
            autoplay: 5e3,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {0: {items: 1}, 600: {items: 2}, 1024: {items: 2}, 1200: {items: 3}}
        }), e(".prod-image-carousel").length && e(".prod-thumbs-carousel").length) {
        var l = e(".prod-image-carousel"), r = e(".prod-thumbs-carousel");
        i = !1, s = 500;
        l.owlCarousel({
            loop: !1,
            items: 1,
            margin: 0,
            nav: !1,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            dots: !1,
            autoplay: !0,
            autoplayTimeout: 5e3
        }).on("changed.owl.carousel", function (e) {
            i || (i = !1, r.trigger("to.owl.carousel", [e.item.index, s, !0]), i = !1)
        }), r.owlCarousel({
            loop: !1,
            margin: 10,
            items: 1,
            nav: !1,
            navText: ['<span class="icon fa fa-long-arrow-left"></span>', '<span class="icon fa fa-long-arrow-right"></span>'],
            dots: !1,
            center: !1,
            autoplay: !0,
            autoplayTimeout: 5e3,
            responsive: {
                0: {items: 1, autoWidth: !1},
                400: {items: 2, autoWidth: !1},
                600: {items: 3, autoWidth: !1},
                1000: {items: 4, autoWidth: !1},
                1200: {items: 3, autoWidth: !1}
            }
        }).on("click", ".owl-item", function () {
            l.trigger("to.owl.carousel", [e(this).index(), s, !0])
        }).on("changed.owl.carousel", function (e) {
            i || (i = !0, l.trigger("to.owl.carousel", [e.item.index, s, !0]), i = !1)
        })
    }
    if (e(".related-products-carousel").length && e(".related-products-carousel").owlCarousel({
            loop: !0,
            margin: 30,
            nav: !0,
            smartSpeed: 700,
            autoplay: 5e3,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {
                0: {items: 1},
                600: {items: 1},
                800: {items: 2},
                1024: {items: 3},
                1100: {items: 2},
                1200: {items: 3}
            }
        }), e(".lightbox-image").length && e(".lightbox-image").fancybox({
            openEffect: "fade",
            closeEffect: "fade",
            helpers: {media: {}}
        }), e(".filter-list").length && e(".filter-list").mixItUp({}), e(".quantity-spinner").length && e("input.quantity-spinner").TouchSpin({verticalbuttons: !0}), e(".range-slider-price").length) {
        var d = document.getElementById("range-slider-price");
        noUiSlider.create(d, {
            start: [30, 300],
            limit: 1e3,
            behaviour: "drag",
            connect: !0,
            range: {min: 10, max: 500}
        });
        var c = document.getElementById("min-value-rangeslider"), u = document.getElementById("max-value-rangeslider");
        d.noUiSlider.on("update", function (e, t) {
            (t ? u : c).value = e[t]
        })
    }
    (e(".prod-tabs .tab-btn").length && e(".prod-tabs .tab-btn").on("click", function (t) {
        t.preventDefault();
        var a = e(e(this).attr("href"));
        e(".prod-tabs .tab-btn").removeClass("active-btn"), e(this).addClass("active-btn"), e(".prod-tabs .tab").fadeOut(0), e(".prod-tabs .tab").removeClass("active-tab"), e(a).fadeIn(500), e(a).addClass("active-tab")
    }), e("#contact-form").length && e("#contact-form").validate({
        rules: {
            username: {required: !0},
            email: {required: !0, email: !0},
            phone: {required: !0},
            subject: {required: !0},
            message: {required: !0}
        }
    }), e(".scroll-to-target").length && e(".scroll-to-target").on("click", function () {
        var t = e(this).attr("data-target");
        e("html, body").animate({scrollTop: e(t).offset().top}, 1e3)
    }), e(".wow").length) && new WOW({
        boxClass: "wow",
        animateClass: "animated",
        offset: 0,
        mobile: !0,
        live: !0
    }).init();
    e(window).on("scroll", function () {
        t(), e(".fact-counter").length && e(".fact-counter .counter-column.animated").each(function () {
            var t = e(this), a = t.find(".count-text").attr("data-stop"),
                n = parseInt(t.find(".count-text").attr("data-speed"), 10);
            t.hasClass("counted") || (t.addClass("counted"), e({countNum: t.find(".count-text").text()}).animate({countNum: a}, {
                duration: n,
                easing: "linear",
                step: function () {
                    t.find(".count-text").text(Math.floor(this.countNum))
                },
                complete: function () {
                    t.find(".count-text").text(this.countNum)
                }
            }))
        })
    }), e(window).on("load", function () {
        e(".preloader").length && e(".preloader").delay(200).fadeOut(500)
    })
}(window.jQuery);