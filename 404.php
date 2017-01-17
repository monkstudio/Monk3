<?php

get_header();

?>
<section id="404" >
    
    <header class="page-header header-404">
        <h1 class="heading"><?php _e( 'Oops! That page can&rsquo;t be found.' ); ?></h1>
    </header>

    <div class="page-content">
        
        <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?' ); ?></p>

        <?php get_search_form(); ?>
        
    </div>
    
</section>

<?php

get_sidebar();
get_footer();