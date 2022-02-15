<?php

/**
 * Remove Welcome Panel
 */
remove_action('welcome_panel', 'wp_welcome_panel');

/**
 * Remove default widgets from dashboard
 */
function bgn_remove_dashboard_widgets() {

  global $wp_meta_boxes;

  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
}
add_action('wp_dashboard_setup', 'bgn_remove_dashboard_widgets' );

/**
 * Remove unwanted admin bar items
 */
function bgn_remove_admin_bar() {
  global $wp_admin_bar;

  $wp_admin_bar->remove_menu('wp-logo');
  // $wp_admin_bar->remove_menu('dashboard');
  $wp_admin_bar->remove_menu('widgets');
  $wp_admin_bar->remove_menu('menus');
  //$wp_admin_bar->remove_menu('site-name');
  $wp_admin_bar->remove_menu('wpseo-menu');

  $wp_admin_bar->remove_menu('comments');
  // $wp_admin_bar->remove_menu('edit');
  $wp_admin_bar->remove_menu('themes');
  $wp_admin_bar->remove_menu('customize');
  $wp_admin_bar->remove_node('search');

  $wp_admin_bar->remove_menu('new-content');
  $wp_admin_bar->remove_menu('new-page');
  $wp_admin_bar->remove_menu('new-post');
  $wp_admin_bar->remove_menu('new-link');
  $wp_admin_bar->remove_menu('new-media');
  $wp_admin_bar->remove_menu('new-user');
  $wp_admin_bar->remove_menu('new-form');
  $wp_admin_bar->remove_menu('wpseo-menu');

  //$wp_admin_bar->remove_menu('edit-profile');
}
add_action('wp_before_admin_bar_render', 'bgn_remove_admin_bar');

/**
 * Disable Gutenberg
 * Posts and Post_types
 */
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);

/**
 * Remove Gutenberg block library styles
 */
function bgn_remove_block_library_css() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
}
add_action( 'wp_enqueue_scripts', 'bgn_remove_block_library_css', 100 );

/**
 * Remove unwanted WP items
 */
function bgn_theme_reset() {

  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'feed_links_extra');
  remove_action('wp_head', 'feed_links');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'index_rel_link');
  remove_action('wp_head', 'parent_post_rel_link');
  remove_action('wp_head', 'start_post_rel_link');
  remove_action('wp_head', 'wp_shortlink_wp_head');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
  remove_action('wp_head', 'wp_generator');
  remove_action('admin_print_styles', 'print_emoji_styles' );
  remove_action('wp_head', 'print_emoji_detection_script', 7 );
  remove_action('admin_print_scripts', 'print_emoji_detection_script' );
  remove_action('wp_print_styles', 'print_emoji_styles' );
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter('the_content_feed', 'wp_staticize_emoji' );
  remove_filter('comment_text_rss', 'wp_staticize_emoji' );

  add_filter('emoji_svg_url', '__return_false' );

  // Stop WP auto linking media images
  update_option('image_default_link_type', 'none');

  wp_deregister_script( 'wp-embed' );
}

add_action('init', 'bgn_theme_reset');

/**
 * Change My Account admin bar message
 */
function bgn_account_message( $wp_admin_bar ) {
  $my_account = $wp_admin_bar->get_node('my-account');
  $newtext = str_replace( 'Hi,', 'Logged in as', $my_account->title );
  $wp_admin_bar->add_node( array(
    'id' => 'my-account',
    'title' => $newtext,
  ) );
}
add_filter( 'admin_bar_menu', 'bgn_account_message', 25 );

/**
 * Remove comments
 */
function bgn_remove_admin_menus() {

  remove_menu_page( 'edit-comments.php' );
}

add_action('admin_menu', 'bgn_remove_admin_menus' );

function bgn_remove_comment_support() {

  remove_post_type_support( 'post', 'comments' );
  remove_post_type_support( 'page', 'comments' );
}

add_action('init', 'bgn_remove_comment_support', 100);

function bgn_admin_bar_render() {

  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
}

add_action('wp_before_admin_bar_render', 'bgn_admin_bar_render' );

/**
 * Force Yoast to Bottom
 */
add_filter( 'wpseo_metabox_prio', function() { return 'low'; } );