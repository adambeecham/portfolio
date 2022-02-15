<?php
/**
 * Archive Template
 */
?>

<?php if ( have_posts() ): ?>

  <h1><?php single_cat_title(); ?></h1>

  <?php while ( have_posts() ): the_post(); ?>

  <?php endwhile; ?>

<?php else: ?>

<?php endif; ?>