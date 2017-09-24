<?php
/**
 * @file
 * Template for a 2 column panel layout.
 *
 * This template provides a two column panel display layout, with
 * additional areas for the top and the bottom.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['top']: Content in the top row.
 *   - $content['left']: Content in the left column.
 *   - $content['right']: Content in the right column.
 *   - $content['bottom']: Content in the bottom row.
 */
?>
<?php if ($content['top']): ?>
  <?php print $content['top']; ?>
<?php endif; ?>

<div class="nr fd content">
  <article class="main c8">
    <?php print $content['left']; ?>
  </article>
  <div class="sidebar c4 l">
    <?php print $content['right']; ?>
  </div>
</div>

<?php if ($content['bottom']): ?>
  <div class="bottom c12 c-r">
    <?php print $content['bottom']; ?>
  </div>
<?php endif; ?>

