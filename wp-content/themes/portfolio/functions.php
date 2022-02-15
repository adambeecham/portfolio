<?php
$includes = [
  'inc/admin-customise.php',
  'inc/admin-reset.php',
  'inc/branding.php',
  'inc/email-notification.php',
  'inc/enqueue-scripts.php',
  'inc/images.php',
  'inc/register-post.php',
  'inc/register-services.php',
  'inc/theme-wrapper.php',
];

foreach ($includes as $file) {

  if ( !$filepath = locate_template($file) ):
    trigger_error(sprintf(__('Error locating %s for inclusion', 'begin-2021'), $file), E_USER_ERROR);
  endif;

  require_once $filepath;

}

unset($file, $filepath);
