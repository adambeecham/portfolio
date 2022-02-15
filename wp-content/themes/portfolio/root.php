<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php wp_title(); ?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/dist/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/dist/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/dist/images/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/dist/images/site.webmanifest">
    <?php wp_head(); ?>
  </head>
  <?php
  $bodyClasses = 'bgn';
  if ( is_user_logged_in() ) $bodyClasses .= ' admin-bar';
  ?>
  <body class="<?php echo $bodyClasses; ?>" data-barba="wrapper" data-scroll-wrap>
    <div data-scroll-container class="scroll-container">
      <?php
      get_header( root_template_base() );
      $containerClasses = 'container';
      if ( is_single() ) $containerClasses .= ' single';
      ?>
      <div class="<?php echo $containerClasses; ?>" data-barba="container" data-barba-namespace="<?php echo is_front_page() ? 'homepage' : 'internal-page'; ?>">
        <div role="main">
          <?php include root_template_path(); ?>
        </div>
        <?php get_footer( root_template_base() ); ?>
      </div>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>