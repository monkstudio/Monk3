<?php 

    get_header();

?>

<?php if(is_archive()) : ?>
<header class="page-header archive-header">
    <?php
    the_archive_title('<h1 class="heading heading-archive">', '</h1>');
    the_archive_description('<div class="archive-description"><p class="lead" >', '</p></div>');
    ?>
</header>
<?php endif ?>

<div class="container article-archive" >
    
    <?php function_exists('yoast_breadcrumb') && is_archive() && yoast_breadcrumb(); ?>
    
    <div class="row" >
    
    <?php if (have_posts()) :

    while (have_posts()) : the_post();

        get_partial( 'content', get_post_format() );

    endwhile;

    the_posts_pagination([
                'type' => 'list',
                'mid_size' => 3,
                'prev_text' => '<span aria-hidden="true">&laquo;</span>',
                'next_text' => '<span aria-hidden="true">&raquo;</span>',
            ]);

    else :
        get_partial('content', 'none');

    endif;

    ?>
    
    </div>
</div>

<?php

    get_sidebar();
    get_footer();