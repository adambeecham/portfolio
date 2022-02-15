<?php
/*
 * Register Scripts
 */
function bgn_register_load_scripts() {

  wp_register_script( 'mainScript', bgn_version( 'main.js' ), array(), '', true );

  wp_localize_script( 'mainScript', 'WP', array(
    // 'ajax'            => admin_url('admin-ajax.php'),     // WP.ajax
    // 'nonce'           => wp_create_nonce('ajax-nonce'),   // WP.nonce
    // 'directory_uri'   => get_template_directory_uri()     // WP.directory_uri
  ));

  wp_enqueue_script('mainScript');
}

add_action( 'wp_enqueue_scripts', 'bgn_register_load_scripts'  );

/**
 * Register Stylesheet
 */
function bgn_register_load_stylesheets() {

  wp_register_style( 'styles', bgn_version( 'main.css' ), '', '', 'screen', false );
  wp_enqueue_style( 'styles' );
}

add_action( 'wp_enqueue_scripts', 'bgn_register_load_stylesheets'  );

function bgn_register_load_admin_style() {

  wp_register_style( 'adminstyles', bgn_version( 'admin.css' ), '', '', 'screen', false );
  wp_enqueue_style( 'adminstyles' );

}

add_action( 'admin_enqueue_scripts', 'bgn_register_load_admin_style'  );

/**
 * Add async to wp_enqueue_script
 * https://matthewhorne.me/defer-async-wordpress-scripts/
 */
function bgn_add_async_attribute($tag, $handle) {

  // add script handles to the array below
  $scripts_to_async = array('scripts');

  foreach($scripts_to_async as $async_script) {
    if ($async_script === $handle) {
      return str_replace(' src', ' async="async" src', $tag);
    }
  }

  return $tag;
}

add_filter('script_loader_tag', 'bgn_add_async_attribute', 10, 2);

/**
 * Gets the path to a versioned Mix file in a theme.
 *
 * Use this function if you want to load theme dependencies. This function will cache the contents
 * of the manifest file for you. This also means that you can’t work with different mix locations.
 * For that, you’d need to use `mix_any()`.
 *
 * Inspired by <https://www.sitepoint.com/use-laravel-mix-non-laravel-projects/>.
 *
 * @since 1.0.0
 *
 * @param string $path The relative path to the file.
 * @param string $manifest_directory Optional. Custom path to manifest directory. Default 'build'.
 *
 * @return string The versioned file URL.
 */

function bgn_version( $path, $manifest_directory = 'dist' ) {
  static $manifest;
  static $manifest_path;

  if ( ! $manifest_path ) {
    $manifest_path = get_theme_file_path( $manifest_directory . '/mix-manifest.json' );
  }

  // Bailout if manifest couldn’t be found
  if ( ! file_exists( $manifest_path ) ) {
    return get_theme_file_uri( $path );
  }

  if ( ! $manifest ) {
    // @codingStandardsIgnoreLine
    $manifest = json_decode( file_get_contents( $manifest_path ), true );
  }

  // Remove manifest directory from path
  $path = str_replace( $manifest_directory, '', $path );
  // Make sure there’s a leading slash
  $path = '/' . ltrim( $path, '/' );

  // Bailout with default theme path if file could not be found in manifest
  if ( ! array_key_exists( $path, $manifest ) ) {
    return get_theme_file_uri( $path );
  }

  // Get file URL from manifest file
  $path = $manifest[ $path ];
  // Make sure there’s no leading slash
  $path = ltrim( $path, '/' );

  return get_theme_file_uri( trailingslashit( $manifest_directory ) . $path );
}