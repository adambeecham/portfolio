<?php
/**
 * Search Page Template
 */
?>

<?php if ( have_posts() ): ?>

  <h1><?php echo sprintf( 'Search results for: %s', get_search_query() ); ?></h1>

  <?php while ( have_posts() ): the_post(); ?>

  <?php endwhile; ?>
        
<?php else: ?> 

  <?php get_search_form(); ?>

<?php endif;
