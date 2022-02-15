<?php
$socials = get_option('wpseo_social');
?>
<ul class="social-media-icons">
  <?php if ($socials['facebook_site']): ?>
    <li class="item">
      <a href="<?= $socials['facebook_site']; ?>" class="link facebook" target="_blank">
        <span class="label"><?php _e('Find us on Facebook', 'bgn'); ?></span>
      </a>
    </li>
  <?php endif; ?>
  <?php if ($socials['instagram_url']): ?>
    <li class="item">
      <a href="<?= $socials['instagram_url']; ?>" class="link instagram" target="_blank">
        <span class="label"><?php _e('Find us on Instagram', 'bgn'); ?></span>
      </a>
    </li>
  <?php endif; ?>
  <?php if ($socials['linkedin_url']): ?>
    <li class="item">
      <a href="<?= $socials['linkedin_url']; ?>" class="link twitter" target="_blank">
        <span class="label"><?php _e('Follow us on Twitter', 'bgn'); ?></span>
      </a>
    </li>
  <?php endif; ?>
  <?php if ($socials['twitter_site']): ?>
    <li class="item">
      <a href="<?= $socials['twitter_site']; ?>" class="link twitter" target="_blank">
        <span class="label"><?php _e('Follow us on Twitter', 'bgn'); ?></span>
      </a>
    </li>
  <?php endif; ?>
  <?php if ($socials['youtube_url']): ?>
    <li class="item">
      <a href="<?= $socials['youtube_url']; ?>" class="link youtube" target="_blank">
        <span class="label"><?php _e('Find us on YouTube', 'bgn'); ?></span>
      </a>
    </li>
  <?php endif; ?>
</ul>