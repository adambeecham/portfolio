<?php

/**
 * Register Menus
 */
function bgn_register_menu() {

  register_nav_menu('Navigation Menu',__( 'Navigation Menu' ));
  register_nav_menu('Footer Menu',__( 'Footer Menu' ));
}
add_action( 'init', 'bgn_register_menu' );

/**
 * ACF Global Options
 */
function bgn_acf_options_pages() {

  if ( function_exists('acf_add_options_sub_page') ) {

    $parent = acf_add_options_page(array(
      'menu_title'  => __('Global'),
      'redirect'    => true,
    ));
    $child = acf_add_options_sub_page(array(
      'page_title'  => __('Business Details'),
      'menu_title'  => __('Business Details'),
      'parent_slug' => $parent['menu_slug'],
    ));
    $child = acf_add_options_sub_page(array(
      'page_title'  => __('Legals'),
      'menu_title'  => __('Legals'),
      'parent_slug' => $parent['menu_slug'],
    ));
  }
}
add_action('acf/init', 'bgn_acf_options_pages');

function bgn_options_page_menu_icon() {
  echo '<style type="text/css">
    #adminmenu #toplevel_page_acf-options-business-details div.wp-menu-image:before { content: "\f319"; }
  </style>';
}
add_action('admin_head', 'bgn_options_page_menu_icon');

/**
 * Add custom support widget to admin dashboard
 */
function bgn_custom_dashboard_widgets() {
  global $wp_meta_boxes;
  wp_add_dashboard_widget('custom_help_widget', 'BGN Support', 'bgn_custom_dashboard_help');
}
add_action('wp_dashboard_setup', 'bgn_custom_dashboard_widgets');

function bgn_custom_dashboard_help() {
  ?>
    <p>If you need assistance with your website please contact us:</p>
    <p><strong>Client services:</strong> <a href="mailto:paul@bgn.agency">paul@bgn.agency</a>.
    <br/>
    <strong>Support:</strong> <a href="mailto:info@bgn.agency">info@bgn.agency</a>.</p>
  <?php
}

/**
 * Admin Menu Order
 */
function bgn_menu_order($menu_order) {
  if (!$menu_order) return true;
  return array(
    'index.php',                       // Dashboard
    'separator1',                      // First separator
    'edit.php?post_type=page',         // Pages
    'edit.php?post_type=services',     // Services
    'edit.php',                        // Posts
    'separator2',                      // Second separator
    'acf-options-business-details',    // Global
    'upload.php',                      // Media
    'separator-last',                  // Last separator
    'themes.php',                      // Appearance
    'link-manager.php',                // Links
    'edit-comments.php',               // Comments
    'plugins.php',                     // Plugins
    'users.php',                       // Users
    'tools.php',                       // Tools
    'options-general.php',             // Settings
  );
}
add_filter('custom_menu_order', 'bgn_menu_order');
add_filter('menu_order', 'bgn_menu_order');

/**
 * Custom TinyMCE Toolbars
 */
function bgn_tinymce_toolbars($toolbars) {
  $toolbars = [];
  // $toolbars['Everything'][1] = array('formatselect', 'bold', 'italic', 'bullist', 'numlist', 'blockquote', 'alignleft', 'aligncenter', 'alignright', 'link', 'wp_more', 'spellchecker', 'fullscreen', 'wp_adv', 'strikethrough', 'hr', 'forecolor', 'pastetext', 'removeformat', 'charmap', 'outdent', 'indent', 'undo', 'redo', 'wp_help');
  $toolbars['Headers, Bold, Bullet Points, Hyperlinks, Text Align'][1] = array('formatselect', 'bold', 'bullist', 'alignleft', 'aligncenter', 'link', 'unlink', 'pastetext', 'removeformat', 'undo', 'redo');
  $toolbars['Headers, Bullet Points and Hyperlinks'][1] = array('formatselect', 'bullist', 'numlist', 'link', 'unlink', 'pastetext', 'pasteword', 'removeformat' );
  $toolbars['Headers and Hyperlinks'][1] = array('formatselect', 'link', 'unlink', 'pastetext', 'pasteword', 'removeformat', 'undo', 'redo' );
  $toolbars['Bullet Points and Hyperlinks'][1] = array('bullist', 'numlist', 'link', 'unlink', 'pastetext', 'pasteword', 'removeformat', 'undo', 'redo' );
  $toolbars['Hyperlinks Only'][1] = array('link', 'unlink','pastetext', 'pasteword', 'removeformat', 'undo', 'redo' );
  $toolbars['Headers Only'][1] = array('formatselect', 'pastetext', 'pasteword', 'removeformat', 'undo', 'redo' );
  $toolbars['None'][1] = array('pastetext', 'pasteword', 'removeformat', 'undo', 'redo' );
  return $toolbars;
}
add_filter('acf/fields/wysiwyg/toolbars' , 'bgn_tinymce_toolbars');

function bgn_tinymce_headers($formats) {
  $formats['block_formats'] = 'Header=h2;Subheader=h3;Paragraph=p';
  return $formats;
}
add_filter('tiny_mce_before_init', 'bgn_tinymce_headers');

/**
 * Change 'Default template' name
 */
add_filter('default_page_template_title', function() {
  return __('Standard Page', 'bgn');
});