<?php
$permalink = urlencode( get_the_permalink() );
$title = get_the_title();
?>
<ul class="social-media-icons">
  <li class="item">
    <a href="<?php echo sprintf('https://twitter.com/intent/tweet?url=%s&text=%s', $permalink, $title); ?>" class="link twitter" target="_blank">
      <span class="label"><?php _e('Share on Twitter', 'bgn'); ?></span>
    </a>
  </li>
  <li class="item">
    <a href="<?php echo sprintf('https://www.facebook.com/sharer/sharer.php?u=%s', $permalink); ?>" class="link facebook" target="_blank">
      <span class="label"><?php _e('Share on Facebook', 'bgn'); ?></span>
    </a>
  </li>
</ul>