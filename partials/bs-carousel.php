<?php
/**
 * Supported Data:
 * slides   :   String/Int/Array - Either an id/object or array of ids/objects of wp posts or attachments. If string then acf's get_field function will be used to try and 
 *              resolve the requested slides. If a post is used then it's featured image will be used as the slide's image if one is found.
 * active   :   The id of the initial slide to display. Defaults to either the first slide or the ID of the current post.
 * dots     :
 * arrows   : 
 */

static $instance = 0;

// Setup slides. If none passed then the current post in the loop will be used.
setup_slides($this->slides);

$active     = $this->active ?: get_slide()->ID;

$instance++;
?>

<div id="carousel-<?= $instance ?>" class="carousel slide" data-ride="carousel">
    
    <?php /* Indicators (Dots) */ if($this->dots && have_slides()) : $index = 0  ?>
    <ol class="carousel-indicators">
        <?php while( have_slides(true) ) 
            printf("<li data-target='#carousel-%d' data-slide-to='%d' %s></li>", $instance, $index++, get_the_ID() === $active ? "class='active'" : "");
        ?>
    </ol>
    <?php endif ?>

    <?php /* Wrapper for slides */ if( have_slides() ) : ?>
    <div class="carousel-inner" role="listbox">
      
        <?php while(have_slides()) : the_slide() ?>
        <div class="item <?= get_the_ID() === $active ? 'active' : '' ?>">
            
          <?php the_slide_image($this->size); ?>
          <div class="carousel-caption">
              <?php the_title("<h3>", "</h3>"); ?>
              <?php the_excerpt() ?>
          </div>
          
        </div>
        <?php endwhile ?>
  
    </div>
    <?php endif ?>

    <?php /* Controls (Arrows) */ if($this->arrows) : ?>
    <a class="left carousel-control" href="#carousel-<?= $instance ?>" role="button" data-slide="prev">
        <i class="icon-prev" aria-hidden="true"></i>
        <span class="sr-only"><?php _e('Previous') ?></span>
    </a>

    <a class="right carousel-control" href="#carousel-<?= $instance ?>" role="button" data-slide="next">
        <i class="icon-next" aria-hidden="true"></i>
        <span class="sr-only"><?php _e('Next') ?></span>
    </a>
    <?php endif ?>
  
</div>



