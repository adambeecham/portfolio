<?php
/*
 * Custom image sizes
 * Should result in 5 image sizes per upload
 * Note this will increase with a webp conversion plugin
 * (1) Original upload file
 * (2) Crop size 'thumbnail' set within the admin
 * (3) Crop size 'medium' at 480px
 * (4) Crop size 'large' at 960px
 * (5) Crop size 'full' set by scaled threshold size 1920px
 */
function bgn_remove_default_image_crop_sizes( $sizes ) {
  unset( $sizes['large']);
  unset( $sizes['medium']);
  unset( $sizes['medium_large']);
  unset( $sizes['1536x1536']);
  unset( $sizes['2048x2048']);
  return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'bgn_remove_default_image_crop_sizes' );

add_image_size( 'medium', 480 );
add_image_size( 'large', 960 );

function bgn_big_image_size_threshold( $threshold, $imagesize, $file, $attachment_id ) {
  return 1920;
}
add_filter( 'big_image_size_threshold', 'bgn_big_image_size_threshold', 10, 4 );

/**
 * ACF Responsive Image Helper Function
 * get_acf_image_srcset( $id, 'full' );
 */
function get_acf_image_srcset($image_id, $image_size = 'full') {

  if ( isset($image_id) ) {

    if ( $image_size == 'full' ) {
      $max_width = '1920px';
    } else if ( $image_size == 'large' ) {
      $max_width = '960px';
    } else if ( $image_size == 'medium' ) {
      $max_width = '480px';
    }

    $image_src = wp_get_attachment_image_url( $image_id, $image_size );
    $image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );

    echo sprintf('<img srcset="%1$s" sizes="(max-width: %2$s) 100vw, %2$s" src="%3$s" alt="%4$s" />', $image_srcset, $max_width, $image_src, get_post_meta($image_id, '_wp_attachment_image_alt', true));
  }
}