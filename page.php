<?php
global $post;

$templates = [$post->post_name];

get_header();

// Start the loop.
while ( have_posts() ) : the_post();

        /**
         * Include the page content template.
         * 
         * The following function should search for partials in the following order:
         * 'page slug' -> 'template name' -> 'template' -> Finally load content.php if no other template is present.
         * 
         * Get template parts is a handy function to use in conjunction with get_partial as it provides a list of names that can be used to determine the correct
         * partial to include. Alternatively get_template_slug can be used if only the slug is required when locating partials.
         */
        get_partial('content', array_merge($templates, get_template_parts()));

endwhile; // End of the loop.

get_footer();