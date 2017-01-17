<?php

get_header();

if ( have_posts() ) : 

    // Start the loop.
    while ( have_posts() ) : the_post();
        get_partial('content', get_post_format() );

    // End the loop.
    endwhile;

    // Previous/next page navigation.
    the_posts_pagination();

// If no content, include the "No posts found" template.
else :
    get_partial('content', 'none');

endif;

get_sidebar();
get_footer();