;

/* My own scripts */
var epWindow = jQuery(window).load(function(){
   "use strict";
    // Things to take note of...
    var clientWidth = epWindow.width(),
        secNav = document.getElementById('sec-nav'),
        header = document.getElementById('header'),
        $header = jQuery(header),
        // jQuery objects
        $epTabs = jQuery('.ep-tabs'),
        $entry = jQuery('.entry'),
        $secNav = jQuery(secNav),
        $logo = jQuery('.logo'),
        // Other stuff
        triggerTop = $secNav.offset().top,
        openSubMenu = null,
        newScrollTop = epWindow.scrollTop(),
        oldScrollTop = newScrollTop,
        scrollRate = [],
        scrollTime,
        lastScrollTime = 0,
        scrollTimeDiff = 0,
        isTouch = false;
    
    // Start functions...
    
    // Superfish menu
    $secNav.find('li').superfish({
       popUpSelector : 'ul.sub-menu',
       delay: 200,
       speed: 200,
       onBeforeShow : function(){

           var  $this = jQuery(this),
                $parent = $this.parent().closest('ul.sub-menu');
        
           if($this.length === 1){
               $this.css('marginTop', 0);
                if(epWindow.width() > 700){
                    var width = $this.width() + ($parent.width() || 0) + $this.parent().offset().left,
                        wWidth = epWindow.width(),
                        length = $this.height() + $this.parent().offset().top,
                        wHeight = epWindow.height() + epWindow.scrollTop();
                    if(width > wWidth){
                        $this.css('margin-left', wWidth - width - 10);
                    }
                    if(length > wHeight && $parent.length === 1){
                        var top = wHeight - length - 22;
                        $this.css('margin-top', top);
                    }
                }

                if($parent.length === 0){
                    $this.topRef = $this.parent().height();
                    $this.lengthRef = $this.height() + $this.topRef;
                    openSubMenu = $this;
                    if(header.is_fixed && openSubMenu.lengthRef > epWindow.height()){
                        var diff = Math.min(1, triggerTop / newScrollTop),
                            dist = ((openSubMenu.topRef * diff) - openSubMenu.topRef) + ((10 * diff) - 10);
                        window.setTimeout(function(){
                            openSubMenu.animate({
                                marginTop : dist
                            });
                        }, 10);
                    }
                }
                
           }

       }
       
    });
    
    
    epWindow.on('touchmove touchend scroll', function(e){
        
        newScrollTop = epWindow.scrollTop();
        scrollTime = new Date().getTime();
        scrollTimeDiff = scrollTime - lastScrollTime;
       
        if(newScrollTop < triggerTop/2){
            scrollRate = [];
        }

        // Menu stick
        if(newScrollTop > triggerTop/2 && (newScrollTop + ((Math.abs(newScrollTop-oldScrollTop) + (scrollRate[0]||0) + (scrollRate[1]||0))/3)) >= triggerTop && clientWidth > 700){
            if(!header.is_fixed){

                if(isTouch && e.type === 'scroll')
                    $header.fadeOut(200, function(){
                        $header.toggleClass('stuck', !$header.hasClass('stuck')).fadeIn(400);
                    });
                else
                   $header.toggleClass('stuck', !$header.hasClass('stuck'));

                header.is_fixed = true;

            }
        }else if(header.is_fixed){
            if(isTouch && newScrollTop < triggerTop){ 
                $header.fadeOut(200, function(){
                    $header.removeClass('stuck').fadeIn(400);
                });
            }else{
                    $header.removeClass('stuck');
            }
            header.is_fixed = false;
            if(openSubMenu)
                openSubMenu.css('marginTop', 0);

        }

        lastScrollTime = scrollTime;
        
        if(openSubMenu && header.is_fixed && openSubMenu.lengthRef > epWindow.height()){
            var diff = Math.min(1, triggerTop / newScrollTop),
                dist = (((openSubMenu.topRef + 22) * diff) - openSubMenu.topRef) + ((10 * diff) - 10);
            openSubMenu.css('marginTop', dist);
        }
                
        scrollRate.unshift(Math.abs(newScrollTop - oldScrollTop));
        oldScrollTop = newScrollTop;
        
    }).on('touchstart', function(){
        isTouch = true;
        epWindow.trigger('scroll');
    });
    
    // Set up operations that rely on the resize event...
    epWindow.resize(function(){
               
        clientWidth = epWindow.width();
       
        // Check if mobile menu active
        if(clientWidth <= 700 && !$secNav.hasClass('mobile-menu')){

                $secNav.addClass('mobile-menu');

        }else if($secNav.hasClass('mobile-menu')){

                $secNav.removeClass('mobile-menu');

        }


        epWindow.trigger('scroll');
        
    });

    
    epWindow.trigger('resize');
    
    

        

});



