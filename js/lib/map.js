
;window.monkStartMap = (function($, undefined){
    
    var maps    = [],
        $map, m, center, infowindow;
    
    return function(){
        
        $map    = $("[data-map]");
        center  = false;
        
        $map.each(function(i){
           
            var data = $(this).data('map');
            
            maps[data.id] = {
                map     : new google.maps.Map(this, {
                            center              : new google.maps.LatLng(0,0),
                            scrollwheel         : false,
                            styles              : $.parseJSON(data.styles),
                            streetViewControl   : false,
                            zoom                : data.zoom || 14,
                            mapTypeControl      : false
                         }),
                markers : [],
                bounds  : new google.maps.LatLngBounds()
            };
                                
                        
            for(m in data.markers){
                                
                maps[data.id].markers[m] = new google.maps.Marker({
                    position        : new google.maps.LatLng(data.markers[m].lat, data.markers[m].lng),
                    title           : data.markers[m].title,
                    icon            : data.markers[m].icon || data.icon,
                    map             : maps[data.id].map
                });
                
                infowindow = data.markers[m].infowindow;
                
                if(infowindow){
                    
                    if(/^\$\(.+\)$/i.test(infowindow))
                        infowindow = document.querySelector(infowindow.slice(2,-1));
                    
                    maps[data.id].markers[m].infoWindow = new google.maps.InfoWindow({
                        content     : infowindow
                    });
                    
                    maps[data.id].markers[m].addListener('click', function(){

                        this.infoWindow.open(this.map, this);

                    });
                    
                }
                
                maps[data.id].bounds.extend(maps[data.id].markers[m].getPosition());
                
                if(data.markers[m].center)
                    center = m;
                
                
            }
            
            if(center)
                maps[data.id].map.setCenter(maps[data.id].markers[center].getPosition());
            
            else
                maps[data.id].map.fitBounds(maps[data.id].bounds);
            

            
        });
        
    }
    
})(jQuery);