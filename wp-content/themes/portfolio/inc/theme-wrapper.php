<?php
/**
 * Include Theme Wrapper
 * Based on wrapper by Scribu
 * @link http://scribu.net/wordpress/theme-wrappers.html
 */

function root_template_path() {
  return root_Wrapping::$main_template;
}

function root_template_base() {
  return root_Wrapping::$base;
}

class root_Wrapping {

  /**
   * Stores the full path to the main template file
   */
  static $main_template;

  /**
   * Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
   */
  static $base;

  static function wrap( $template ) {
    self::$main_template = $template;

    self::$base = substr( basename( self::$main_template ), 0, -4 );

    if ( 'index' == self::$base )
      self::$base = false;

    $templates = array( 'root.php' );

    if ( self::$base )
      array_unshift( $templates, sprintf( 'root-%s.php', self::$base ) );

    return locate_template( $templates );
  }
}

add_filter( 'template_include', array( 'root_Wrapping', 'wrap' ), 99 );
