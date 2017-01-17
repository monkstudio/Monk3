<?php 

get_header();

if ( have_posts() ) : ?>

    <header class="page-header header-search">
        
        <h1 class="heading heading-search"><?php printf( __( 'Search Results for: %s' ), '<q>' . esc_html( get_search_query() ) . '</q>' ); ?></h1>
        
    </header>

    <?php
    // Start the loop.
    while ( have_posts() ) : the_post();
        Monk\get_partial('content', get_post_format());
        
    endwhile;

    // Previous/next page navigation.
    the_posts_pagination();

// If no content, include the "No posts found" template.
else :
    Monk\get_partial('content', 'none');

endif;

get_sidebar();
get_footer();