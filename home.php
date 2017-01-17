<?php
global $post;

get_header();

$page = get_queried_object();

if($page->post_type === 'page')
    get_partial('content', 'page', ['post' => $page]);

get_partial('archive');

get_sidebar();
get_footer();