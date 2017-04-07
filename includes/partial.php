<?php

namespace Monk;


class Partial {
    
    public $data    = [];
    public $slug    = null;
    public $names   = [];
            
    
    function __construct($slug, $names = array(), $data = array()) {
        
        $this->slug     = (string)trim($slug);
        $this->names    = array_reverse((array)$names);
        $this->data     = $data;
                    
    }
    
    
    function render(){
        
        remove_action('get_partial', [$this, 'render']);
        
        $templates = ["$this->slug.php", "partials/$this->slug.php"];

        foreach($this->names as $name)
            $name = trim ($name)
                && empty ($name) || array_unshift ($templates, "$this->slug-$name.php", "partials/$this->slug-$name.php");
        
        empty($this->data) || is_array($this->data)
            && extract($this->data);
                
        if( $partial = locate_template($templates, false, false) )

            include apply_filters('monk\partial', $partial, $templates, $this);
                
    }
    
    
    function __invoke($section = false) {
        
        add_action('get_partial', [$this, 'render']);
                
        $section && printf ("<section%s>", is_string($section) && " id='$section' ");
        
        do_action('get_partial', $this);
                        
        $section && print ("</section>");
                
        return $this;
                
    }
    
    
    function __get($name) {
        
        if( is_array($this->data) && isset($this->data[$name]))
            return $this->data[$name];
        
        else return null;
        
    }
    
}
