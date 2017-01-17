<?php

get_header();

// Start the loop.
while (have_posts()) : the_post();

    // Include the single post content template.
    get_partial('content', get_post_format());

    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) {
        comments_template();
    }

    // Next/Previous post navigation
    if (is_singular('attachment')) // Parent post navigation.
        the_post_navigation([
            'prev_text' =>  '<span class="meta-nav">' . __('Published in') . '</span><span class="post-title">%title</span>',
        ]);

    elseif (is_singular('post')) // Previous/next post navigation.
        the_post_navigation([
            'next_text' =>  '<span class="meta-nav" aria-hidden="true">' . __('Next') . '</span> ' .
                            '<span class="sr-only">' . __('Next post:') . '</span> ' .
                            '<span class="post-title">%title</span>',
            'prev_text' =>  '<span class="meta-nav" aria-hidden="true">' . __('Previous') . '</span> ' .
                            '<span class="sr-only">' . __('Previous post:') . '</span> ' .
                            '<span class="post-title">%title</span>',
        ]);

endwhile;

get_sidebar();
get_footer();