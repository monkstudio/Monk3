<?php
/**
 * Accepted data:
 * style        :   class name/s to be prepended to the banner.
 * slides       :   String/Int/Array - Either an id/object or array of ids/objects of wp posts or attachments. If string then acf's get_field function will be used to try and 
 *                  resolve the requested slides. If a post is used then it's featured image will be used as the slide's image if one is found.
 * toggle       :   
 * bs_carousel  :   
 */

// Add a list of classes here to be used.
$classes = ["banner", $this->style ?: "center"];

// Setup slides to be inserted into the banner. If no slides were passed, the current post in the loop will be used.
setup_slides($this->slides);

?>
<div class="<?= implode(' ', $classes) ?>" role="banner" data-slider="<?= $this->slider ?>" >
        
    <?php 
    /**
     * Example of using the Slide loop to create a group of embedded banners nested inside another banner.
     * Note: This operates the same way as WP's standard loop, as in template tags like the_title & the_content may be used.
     */
    if(!$this->bs_carousel && have_slides()) : while(have_slides()) : the_slide(); the_slide_css() ?>

        <div class="<?php the_slide_selector() ?> banner bottom" >
        
            <div class="wrapper" >

                <div class="col-sm-8 col-sm-offset-2" >

                    <?php the_title("<h3>","</h3>") ?>

                </div>

            </div>
        
        </div>

    <?php endwhile ?>
        
    <?php 
    /* BS Carousels can also be dropped into a banner as the slider. Make sure you pass on the slides data. */
    elseif( $this->bs_carousel ) : 
        get_partial('bs-carousel', get_template_parts(), ['slides' => $this->slides, 'dots' => true, 'arrows' => true]); 
    
    endif;
    ?>
    
    <?php /* Minimal markup needed for banners */ ?>
    <div class="wrapper" >
        
        <div class="col-sm-6 col-sm-offset-3" >
            
            <?php the_title("<h2>", "</h2>") ?>
            
        </div>
        
    </div>

</div>