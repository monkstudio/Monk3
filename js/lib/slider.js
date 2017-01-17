

(function($, undefined) {
        
    var defaults    = {
            items       : '> .banner',
            autoplay    : true,
            fade        : true,
            pause       : 5000,
            next        : null
        },
        api         = {
            active      : -1,
            options     : {},
            show        : function(){

                var cb = typeof this.options.next === 'function' ? this.options.next.bind(this) : this.options.autoplay ? this.next.bind(this) : false;
                
                if(this.$items.length){
                    
                    this.active++;
                    
                    if(this.active === this.$items.length)
                        this.active = 0;
                    
                    this.activate(this.$items.eq(this.active), this.$container, cb);
                        
                }
                
            },
            next        : function(){   
                    
                window.setTimeout(this.show.bind(this), this.options.pause);
                    
            }
            
        },     
        Slider      = function($element, options){
            
            this.$container = $element;
            this.options    = $.extend({}, defaults, options);
            this.$items     = $(this.options.items, this.$container);
            
            if(this.options.fade)
                this.$items.addClass('fade');

        };
        
        Slider.prototype = $.extend({}, $.fn.tab.Constructor.prototype, api);
        
    
    function Plugin(options){
        
        var _args       = [].slice.call(arguments, 1),
            _options    = typeof options === 'object' ? options : {},
            _action     = typeof options === 'string'? options : 'show';
            
        return this.each(function(i){
            
            var $this   = $(this),
                data    = $this.data('monk.slider');
            
            data || $this.data('monk.slider', data = new Slider($this, _options));
            
            data[_action].apply(data, _args);
            
        });
        
    }
    
    $.fn.slider     = Plugin;

})(jQuery);