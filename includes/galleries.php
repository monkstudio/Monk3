<?php

namespace EP\Gallery;

/**
 * Gleaned from Root\'s Sage theme
 * https://roots.io/starter-theme
 * 
 * Clean up gallery_shortcode()
 *
 * Re-create the [gallery] shortcode and use thumbnails styling from Bootstrap
 * The number of columns must be a factor of 12.
 *
 * @link http://getbootstrap.com/components/#thumbnails
 */
function bootstrap_gallery($output, $attr, $instance){

    if(!empty($output))
        return $output;
    
    $post = get_post();
    
    extract($atts = shortcode_atts( array(
            'order'      => 'ASC',
            'orderby'    => 'menu_order ID',
            'id'         => $post ? $post->ID : 0,
            'itemtag'    => '',
            'icontag'    => '',
            'captiontag' => '',
            'columns'    => 3,
            'size'       => 'thumbnail',
            'include'    => '',
            'exclude'    => '',
            'link'       => ''
    ), $attr, 'gallery' ));
    
    $id = intval($id);
    $columns = (12 % $columns == 0) ? $columns : 3;
    $grid = sprintf('col-xs-6 col-sm-%1$s', 12 / $columns);

    if ($order === 'RAND') 
        $orderby = 'none';

    if (!empty($include)) {
        
        $_attachments = get_posts(['include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby]);

        $attachments = [];
        foreach ($_attachments as $key => $val) 
            $attachments[$val->ID] = $_attachments[$key];
        
    } elseif (!empty($exclude))
        
        $attachments = get_children(['post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby]);
    
    else 
        
        $attachments = get_children(['post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby]);

    if ( empty( $attachments ) ) 
            return $output;

    if (is_feed()) {
        
        $output = "\n";
        foreach ($attachments as $att_id => $attachment)
            
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        
        return $output;
        
    }
    
    //$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    //$output = '<div class="gallery gallery-bootstrap gallery-' . $id . '-' . $unique . '">';
    
    $unique = (get_query_var('page')) ? $instance . '-p' . get_query_var('page') : $instance;
    
    $output = "<div id='gallery-{$instance}' class='gallery gallery-bootstrap gallery-$id-$unique' >";

    $i = 0;
    foreach ($attachments as $id => $attachment) {
        
      switch($link) {
        case 'file':
          $image = wp_get_attachment_link($id, $size, false, false);
          break;
        case 'none':
          $image = wp_get_attachment_image($id, $size, false, ['class' => 'thumbnail img-thumbnail']);
          break;
        default:
          $image = wp_get_attachment_link($id, $size, true, false);
          break;
      }
      
      $output .= ($i % $columns == 0) ? '<div class="row gallery-row">' : '';
      
      $output .= '<div class="' . $grid .'"><div class="thumbnail" >' . $image;

      if ($caption = trim($attachment->post_excerpt)) {
        $output .= '<div class="caption text-center"><em>' . wptexturize($caption) . '</em></div>';
      }

      $output .= '</div></div>';
      $i++;
      $output .= ($i % $columns == 0) ? '</div>' : '';
    }

    $output .= ($i % $columns != 0 ) ? '</div>' : '';
    $output .= '</div>';

    return $output;    
    
}

/**
 * Add class="thumbnail-img" to attachment items
 */
function attachment_link_class($html) {
  $html = str_replace('<a', '<a class="thumbnail"', $html);
  return $html;
}

if (current_theme_supports('bootstrap-gallery')) {
    add_filter('post_gallery', __NAMESPACE__ . '\\bootstrap_gallery', 10, 3);
    //add_filter('wp_get_attachment_link', __NAMESPACE__ . '\\attachment_link_class', 10, 1);
}


