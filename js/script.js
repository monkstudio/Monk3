
;(function($, $window, $document, undefined){
    "use strict";
    
    // Site wide variables
    var $html, $body, $page, $header, $main, $footer, $banners, 
        resize = 0, 
        scroll = 0, 
        breakpoints = { xs : null, sm : null, md : null, lg : null };
    
    $document.ready(function(){
               
        /* Uncomment what you need */
        $html       = $('html').removeClass('no-js').addClass('domready');
        $body       = $('body');
        //$page   = $('#page');
        //$header = $("#masthead");
        //$main   = $("main");
        //$footer = $("#colophon");
        $banners    = $('.banner:has(>.banner)');
        
        
        // Smooth Scrolling support
        $body.on('click', 'a[href*="#"]:not([href="#"])', function(e) {
            
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                
                var $target = $(this.hash);
                
                $target = $target.length ? $target : $('[name=' + this.hash.slice(1) +']');
                
                if ($target.length) {
                    e.preventDefault();
                    
                    /* Set anchor handlers here */
                    
                    $('html, body').animate({
                        scrollTop: Math.max($target.offset().top - 20, 0)
                    }, 500);
                                        
                }
                
            }
        }).on('show.bs.dropdown show.bs.collapse', function(e){
            
            $(e.relatedTarget).addClass('is-active');
            $body.addClass('menu-open');
            
        }).on('hide.bs.dropdown hide.bs.collapse', function(e){
            
            $(e.relatedTarget).removeClass('is-active');
            $body.removeClass('menu-open');
            
        });
        
        
        // Enable Superfish on nav menus
        $.fn.superfish && $('.navbar-nav').superfish({
            speed: 200
        });
        
        
        // Enable tooltips for menu items with descriptions
        if ($.fn.tooltip) {

            $(".navbar-nav a[data-description]").tooltip({
                placement: 'bottom',
                title: function () {

                    return $(this).data('description');

                }
            });

        }
        
        
        // Auto open modals        
        if ($.fn.modal) {
            var $modal = $("#modal");

            $modal.prev('[data-toggle="modal"]').length || $modal.modal({
                backdrop: true /* or 'static' */
            }).on('shown.bs.modal', function () {

                $modal.find('input:first').focus();

            });

        }
        
        
        // Handle Banners with nested banners
        if ($banners.length) {
            
            var slider;

            $banners.each(function () {

                slider = $banners.data('slider');

                if (slider) switch (slider) {

                    case 'slick': // Slick support for banner components. As much as possible it adopts styles from BS' carousel component
                        
                        $banners.slick({
                            //adaptiveHeight: false,
                            //arrows: true,
                            //asNavFor: null,
                            prevArrow: '<a class="left carousel-control" role="button" data-slide="prev"><i class="icon-prev" aria-hidden="true"></i><span class="sr-only">Previous</span></a>',
                            nextArrow: '<a class="right carousel-control" role="button" data-slide="next"><i class="icon-next" aria-hidden="true"></i><span class="sr-only">Next</span></a>',
                            //autoplay: false,
                            //autoplaySpeed: 3000,
                            //centerMode: false,
                            //centerPadding: '50px',
                            //cssEase: 'ease',
                            dots: true, // True for now for testing purposes
                            dotsClass: 'carousel-indicators slick-dots',
                            //fade: true,
                            //focusOnSelect: false,
                            //initialSlide: 0,
                            //lazyLoad: 'ondemand',
                            mobileFirst: true,
                            //pauseOnHover: true,
                            //pauseOnFocus: true,
                            //pauseOnDotsHover: false,
                            //respondTo: 'window',
                            //responsive: {},
                            //rows: 1,
                            slide: '.banner',
                            //slidesPerRow: 1,
                            //slidesToShow: 1,
                            //slidesToScroll: 1,
                            //speed: 500,
                            swipeToSlide: true,
                            //variableWidth: false,
                            //vertical: false,
                            //verticalSwiping: false,
                            zIndex: 1000
                        }).addClass('carousel').children('.slick-list').addClass('banner-group');
                        
                        break;

                    default:
                        $banners[slider]();

                } else $.fn.slider && $banners.slider();

            });

        }
        
        
        $window.trigger('resize', [true]);

        
    });
    
    $window.ready(function(){
        
        $('html').removeClass('loading').addClass('loaded');
        
    }).resize(function(e, init) {
        
        if(!resize){
            
            $body.addClass('resizing');
            
            resize = window.setTimeout(function(){
                
                var width   = $window.width(),
                    height  = $window.height();
                                
                // Breakpoints (determined as the client's min width)
                breakpoints = {
                    xs  : width >= 480  ? true : false,
                    sm  : width >= 768  ? true : false,
                    md  : width >= 992  ? true : false,
                    lg  : width >= 1200 ? true : false
                };
                
                /* Place resize handlers here */

                
                $window.trigger('resize.monk', [{ width: width, height: height }, init]);
                $body.removeClass('resizing');
                resize = 0;
                
            }, 100);
            
        }
        
    }).scroll(function(e) {
        
        var scrollTop = $window.scrollTop();
        
        window.clearTimeout(scroll);
        
        scroll = window.setTimeout(function() {
            
            /* Set scroll handlers here */
            
            
            $window.trigger('scroll.monk', [scrollTop]);
            scroll = 0;
            
        }, 200);
        
    });
        
    
})(jQuery, jQuery(window), jQuery(document));