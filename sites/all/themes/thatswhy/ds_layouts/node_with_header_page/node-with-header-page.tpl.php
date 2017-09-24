<?php
/**
 * @file
 * Display Suite Full Overview Page template.
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
 * - $header: Rendered content for the "Header" region.
 * - $header_classes: String of classes that can be used to style the "Header" region.
 *
 * - $content_top: Rendered content for the "Content top" region.
 * - $content_top_classes: String of classes that can be used to style the "Content top" region.
 *
 * - $content_left: Rendered content for the "Content left" region.
 * - $content_left_classes: String of classes that can be used to style the "Content left" region.
 *
 * - $content_right: Rendered content for the "Content right" region.
 * - $content_right_classes: String of classes that can be used to style the "Content right" region.
 */
?>
<<?php print $layout_wrapper; print $layout_attributes; ?> class="<?php print $classes;?> clearfix">

  <div class="float-container full-overview-page-header-wrapper">
    <<?php print $header_wrapper; ?> class="ds-header<?php print $header_classes; ?>">
      <?php print $header; ?>
    </<?php print $header_wrapper; ?>>
  </div>

  <div class="float-container full-overview-page-content-wrapper">
    <div class="narrowing fluid full-overview-page-content">
      <<?php print $content_top_wrapper; ?> class="ds-content-top<?php print $content_top_classes; ?>">
        <?php print $content_top; ?>
      </<?php print $content_top_wrapper; ?>>

      <<?php print $content_left_wrapper; ?> class="ds-content-left<?php print $content_left_classes; ?>">
        <?php print $content_left; ?>
      </<?php print $content_left_wrapper; ?>>

      <<?php print $content_right_wrapper; ?> class="ds-content-right<?php print $content_right_classes; ?>">
        <?php print $content_right; ?>
      </<?php print $content_right_wrapper; ?>>
    </div>
  </div>


</<?php print $layout_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
