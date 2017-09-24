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
 *
 * ** Added a downwards link for blog purposes **
 */
?>
<header<?php print $layout_attributes; ?> class="header">
  <?php if (isset($title_suffix['contextual_links'])): ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <?php print $header_content; ?>
</header>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
