<?php
/**
 * @file
 * Display Suite Product teaser template.
 *
 * Available variables:
 *
 * Layout:
 * - $classes: String of classes that can be used to style this layout.
 * - $contextual_links: Renderable array of contextual links.
 * - $layout_wrapper: wrapper surrounding the layout.
 *
 * Regions:
 *
 * - $image_area: Rendered content for the "Image and description area" region.
 * - $image_area_classes: String of classes that can be used to style the "Image and description area" region.
 *
 * - $text_area: Rendered content for the "Bottom area" region.
 * - $text_area_classes: String of classes that can be used to style the "Bottom area" region.
 */
?>
<<?php print $layout_wrapper; print $layout_attributes; ?> class="<?php print $classes;?> clearfix">

  <?php if (isset($title_suffix['contextual_links'])): ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <div class="img-area">
    <?php print $image_area; ?>
    <div class="img-overlay"></div>
  </div>
  <div class="text-area">
    <?php print $text_area; ?>
  </div>



</<?php print $layout_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
