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
 * - $image_and_description_area: Rendered content for the "Image and description area" region.
 * - $image_and_description_area_classes: String of classes that can be used to style the "Image and description area" region.
 *
 * - $bottom_area: Rendered content for the "Bottom area" region.
 * - $bottom_area_classes: String of classes that can be used to style the "Bottom area" region.
 */
?>
<<?php print $layout_wrapper; print $layout_attributes; ?> class="<?php print $classes;?> clearfix">

  <?php if (isset($title_suffix['contextual_links'])): ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

    <<?php print $image_and_description_area_wrapper; ?> class="ds-image-and-description-area<?php print $image_and_description_area_classes; ?>">
      <?php print $image_and_description_area; ?>
    </<?php print $image_and_description_area_wrapper; ?>>

    <?php print $bottom_area; ?>

</<?php print $layout_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
