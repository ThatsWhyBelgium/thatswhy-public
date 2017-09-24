<?php

/**
 * @file
 * Display Suite 1 column template.
 */
?>
<a <?php print $layout_attributes; ?> class="node node-webform view-mode-teaser">
  <?php if (isset($title_suffix['contextual_links'])): ?>
  <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <?php print $ds_content; ?>
</a>
