/**
* Theme javascript functions file.
*
*/
( function( a ) {
    "use strict";

    var  
    body 	= a("body"),
    d    	= a(".widget-area"),
    e 	 	= body.find(d),
    f 	 	= e.find(".alignnone"),
    g 	 	= a(d).find(".post-thumbnail"),
    h 	 	= a(".site-hero--image"),
    q 		= e.find("blockquote"),
    n 		= e.find(".widget--is-fullscreen"),
    o       	= a(".parallax-window"),
    p       	= a(".widget .photoswipe-gallery figure"),
    q       	= e.find(".widget--split-screen"),
    loaded 	= ("js--loaded"),
    enter   	= ("js--enter"),
    active 	= ("js--active"),
    open 	= ("js--searchopen"),
    opening 	= ("js--searchopening"),
    hiding 	= ("js--searchhiding"),
    animating   = ("js--animating"),
    dur  	= 500;

    /**
     * Test if inline SVGs are supported.
     * @link https://github.com/Modernizr/Modernizr/
     */
    function supportsInlineSVG() {
        var div = document.createElement( 'div' );
        div.innerHTML = '<svg/>';
        return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
    }

    /* Fullscreen page elements */
    function i() {
        if( body.hasClass('admin-bar') ) {
            a('.google-maps-builder').css({ "height": a(window).height() - 32 + 'px' });
            a('.parallax-window').css({ "height": a(window).height() - 32 + 'px' });
            a('.error-404--wrap').css({ "height": a(window).height() - 32 + 'px' });
        } else {
            a('.google-maps-builder').css({ "height": a(window).height() + 'px' });
            a('.parallax-window').css({ "height": a(window).height() + 'px' });
            a('.error-404--wrap').css({ "height": a(window).height()  + 'px' });
        }
    }

    /* Position the .main-navigation */
    function fullscreen_hero() {
        var e, t, n, i, o, j, k, l, header, r;
        r = 0, 
        n = a(window), 
        t = a("#site-hero"), 
        header = a("#masthead .main-navigation"),
        e = a("#site-navigation");

        j = function() {
            var e, i, o;
            o = n.width(), e = n.height(), r !== o && (i = "0.6", o > 500 && (i = "0.5", o > 768 ? (i = "0.6", 900 > e && (i = "0.8")) : 380 > e && (i = "0.9")), 
                a("#site-navigation").css({
                    "top": e * i,
                }),

                t.css({
                    height: e * i,
                    "max-height": e,
                    "min-height": "200px"
                }), r = o)
        }, 

        k = function() {
            var e, i, t, o;
        };

        if( body.is('.single, .blog, .post-type-archive-product') ) {
            e.css({ "top": t.outerHeight() + 'px' });
        } else {
            j(), k();
        }

        if( body.hasClass('fixed-navigation') ) {
            if( body.hasClass('page-template-template-home-php') ) {
                a(window).on("scroll", function() {
                    var height_1 = t.outerHeight() + 200;
                    var height_2 = t.outerHeight() + 400;
                    var height = t.outerHeight() + 900;
                    var fromTop = body.scrollTop();
                    header.toggleClass("js--opacity", (fromTop > height_1 ));
                    header.toggleClass("js--opacity-2", (fromTop > height_2 ));
                    header.toggleClass("js--fixed", (fromTop > height ));
                });
            }
        }
    }

    /* Fullscreen for home template widgets */ 
    function fullscreen_widgets() {
        n.each(function() {
            var n = a(this);
            if( body.hasClass('admin-bar') ) {
                n.css({ "height": a(window).height() - 32 + 'px' });
            } else {
                n.css({ "height": a(window).height() + 'px' });
            }
        })
    }

    function home_quarter_widgets() {
        
        var $window = a(window);

        q.each(function() {
            var n = a(this);
            if($window.width() > 900) {
                var width = $window.width()/2;
                a('.split-screen__item').css('height', width);
            } else {
              var width = $window.width();
              a('.split-screen__item').css('height', 'auto');
            }
        })
    }

    function contact_blocks() {
        
        var $window = a(window);

        if($window.width() > 900) {
          var width = $window.width()/2;
          a('.contact-block').css('height', width);
        } else {
          var width = $window.width();
          a('.contact-block').css('height', 'auto');
        }
    }

    /* Dropdowns */
    function dropdowns() {
        var $window = a(window);

        if($window.width() > 768 ) {
            a('#site-navigation ul.menu').superfish({
                animation: { opacity:'show', height:'show' },
                cssArrows: false,
                disableHI: true
            });
        } 
    }

    function mobileDropdown() {
        var navigationHolder = a('.main-navigation');
        var dropdownOpener = a('.main-navigation .mobile-navigation--arrow, .main-navigation h6, .main-navigation a.plate-mobile-no-link');
        var animationSpeed = 200;

        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                a(this).on('tap click', function(e) {
                    var dropdownToOpen = a(this).nextAll('ul').first();

                    if(dropdownToOpen.length) {
                        e.preventDefault();
                        e.stopPropagation();

                        var openerParent = a(this).parent('li');
                        if(dropdownToOpen.is(':visible')) {
                            dropdownToOpen.slideUp(animationSpeed);
                            openerParent.removeClass('plate-opened');
                        } else {
                            dropdownToOpen.slideDown(animationSpeed);
                            openerParent.addClass('plate-opened');
                        }
                    }

                });
            });
        }
    }

    /* FitVids */
    a("body article").fitVids();

    /* Masonry */
    var container = a('.masonry-feed');
    container.imagesLoaded(function(){
        container.masonry({
            itemSelector: '.masonry-feed .post',
            transitionDuration:"0.2s",
        });
    });

    /* Infinite Scrolling */
    function masonry_infinite() {

        var container = a('.masonry-feed');

        container.infinitescroll({
            navSelector  : '#page_nav',
            nextSelector : '#page_nav a',
            itemSelector : '.post',
            loading: {
                loadingText: 'Loading',
                finishedMsg: 'Done Loading',
                img: ''
            }
        },
        function( newElements ) {
            var newElems = a( newElements ).css({ opacity: 0 });
            newElems.imagesLoaded(function(){
                // show elems now they're ready
                newElems.animate({ opacity: 1 });
                newElems.addClass('loaded');
                container.masonry( 'appended', newElems, true );
                a('.format-video').fitVids(newElems);  
            });
        });
    }

    /* Parallax.JS */
    if (navigator.userAgent.match(/(iPod|iPhone|iPad|Android)/)) {
        o.height( a(window).height() * 0.5 | 0 );
    } else {
        a(window).resize(function(){
            var parallaxHeight = Math.max(a(window).height() * 0.7, 200) | 0;
            o.height(parallaxHeight);
        }).trigger('resize');
    }

    function isScrolledIntoView(elem) {
        var docViewTop = a(window).scrollTop();
        var docViewBottom = docViewTop + a(window).height();
        var elemTop = a(elem).offset().top;
        var elemBottom = elemTop + a(elem).height();
        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }

    a(window).scroll(function(){
        a('.parallax--item').each(function () {
            if (isScrolledIntoView(this) === true) {
                a(this).addClass(enter);
            }
        });
    });

    /* Document Ready */
    a(document).ready(function() {
        i(); 
        contact_blocks();
        fullscreen_hero();
        fullscreen_widgets();
        dropdowns();
        mobileDropdown();
        masonry_infinite();
        home_quarter_widgets();
        supportsInlineSVG();

        if ( true === supportsInlineSVG() ) {
            document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
        }
        
        a(".site").animsition({
            inClass: 'fade-in',
            outClass: 'fade-out',
            inDuration: 200,
            outDuration: 500,
            linkElement: 'a:not([target="_blank"]):not([href^="#"]):not([href^="mailto"]):not([href^="tel"]):not(.lightbox-link):not(.input-control submit)',
            loading: false,
            unSupportCss: [
            'animation-duration',
            '-webkit-animation-duration',
            '-o-animation-duration'
            ],
        });
        
        /* Enable menu toggle for small screens */ 
        a( '.mobile-menu-toggle' ).on( 'click', function() {
            body.toggleClass( 'open-nav' );

            if( body.hasClass( animating ) ) {
                setTimeout(function() {
                    body.removeClass( animating );
                }, 400);
            } else {
                body.addClass( animating );
            }
        } );

        if( !body.hasClass('page-template-template-home-php') ) {
            if( body.hasClass( 'parallax-fade' ) ) {
                if ( a(".hero-content-area").length ) {
                    var c = a(".hero-content-area"),
                    d = c.outerHeight(),
                    e = a(".hero-content-area .entry-header"),
                    f = a(".site-hero--image");

                    a(window).on("scroll", function() {
                        var b = 1 - a(window).scrollTop() / d * 1;
                        var g = 1 - a(window).scrollTop() / d * -8;

                        0 >= b && (b = 0), e.css({
                           // transform: "translate(0, " + 100 * g + "px)",
                            bottom: 1 * g + "%",
                            // opacity: b
                        }),
                        f.css({
                            opacity: b
                        }),
                        h.css({
                            opacity: b
                        })
                    });
                }
            }
        }
    });

    /* Resize functions */ 
    a(window).resize(function(){
        i();
        contact_blocks();
        dropdowns();
        mobileDropdown();
        home_quarter_widgets();
        fullscreen_widgets();

        if( body.is('.single, .blog, .archive, .search') ) {
            a('#site-navigation').css({ "top": a('#site-hero').outerHeight() + 'px' });
        }
    });

} )( jQuery );