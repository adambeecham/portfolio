<?php
/**
 * Replace WP login logo with clients
 */
function bgn_branding() {
  ?>

  <style type="text/css">
    .login h1 a {
      background-image: url('<?php echo get_template_directory_uri() . '/dist/svg/bgn.svg' ?>');
      background-size: 120px 39px;
      height: 39px;
      max-width: 100%;
      width: 100%;
    }
    .login form {
      border: 0;
      box-shadow: none;
    }
  </style>

  <?php
}
add_action( 'login_head', 'bgn_branding' );

/**
 * WP Login Logo Link URL
 */
function bgn_login_logo_url( $url ) {
  return get_bloginfo( 'url' ) . '/';
}
add_filter( 'login_headerurl', 'bgn_login_logo_url' );

/**
 * Custom credit added to admin footer
 */
function bgn_add_credit_to_admin_footer() {
  echo '<strong>' . get_bloginfo( 'name' ) . ' –</strong> A website by <a href="https://bgn.agency" target="_blank">BGN</a>.';
}
add_filter( 'admin_footer_text', 'bgn_add_credit_to_admin_footer' );

/**
 * Custom credit added to admin footer
 */
function bgn_version_removal() {
  return '';
}
add_filter( 'the_generator', 'bgn_version_removal' );