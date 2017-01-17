<?php 

get_header();

while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <nav id="image-navigation" class="navigation image-navigation">
                    <div class="nav-links">
                            <div class="nav-previous"><?php previous_image_link( false, __( 'Previous Image' ) ); ?></div>
                            <div class="nav-next"><?php next_image_link( false, __( 'Next Image' ) ); ?></div>
                    </div><!-- .nav-links -->
            </nav><!-- .image-navigation -->

            <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <div class="entry-content">

                    <div class="entry-attachment">
                            <?php

                                echo wp_get_attachment_image( get_the_ID(), 'large' );
                            ?>

                    </div><!-- .entry-attachment -->

                    <?php
                            the_content();
                            wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                                'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
                                'separator'   => '<span class="screen-reader-text">, </span>',
                            ) );
                    ?>
            </div><!-- .entry-content -->

            <footer class="entry-footer">
                <?php
                        // Retrieve attachment metadata.
                        $metadata = wp_get_attachment_metadata();
                        if ( $metadata ) {
                                printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
                                        esc_html_x( 'Full size', 'Used before full size attachment link.' ),
                                        esc_url( wp_get_attachment_url() ),
                                        absint( $metadata['width'] ),
                                        absint( $metadata['height'] )
                                );
                        }
                ?>
            </footer><!-- .entry-footer -->
    </article><!-- #post-## -->

    <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }

            // Parent post navigation.
            the_post_navigation( array(
                    'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link' ),
            ) );
    // End the loop.

endwhile;

get_sidebar();
get_footer();