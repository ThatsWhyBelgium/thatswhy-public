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
 * - $content_bottom: Rendered content for the "Content bottom" region.
 * - $content_bottom_classes: String of classes that can be used to style the "Content bottom" region.
 */
?>
<<?php print $layout_wrapper; print $layout_attributes; ?> class="<?php print $classes;?> clearfix">

    <div class="float-container fop-header-wrapper">
      <<?php print $header_wrapper; ?> class="ds-header<?php print $header_classes; ?>">
        <?php print $header; ?>
        <div class="float-container fop-header-content-wrapper">
          <div class="narrowing fluid fop-header-content">
            <<?php print $header_content_wrapper; ?> class="ds-header-content<?php print $header_content_classes;?>">
              <?php print $header_content; ?>
            </<?php print $header_content_wrapper; ?>>
          </div>
        </div>
      </<?php print $header_wrapper; ?>>
    </div>

    <div class="float-container fop-content-wrapper">
      <div class="narrowing fluid fop-content">
        <<?php print $content_top_wrapper; ?> class="ds-content-top<?php print $content_top_classes; ?>">
          <?php print $content_top; ?>
        </<?php print $content_top_wrapper; ?>>

        <<?php print $content_bottom_wrapper; ?> class="ds-content-bottom<?php print $content_bottom_classes; ?>">
          <?php print $content_bottom; ?>
        </<?php print $content_bottom_wrapper; ?>>
      </div>
    </div>
</<?php print $layout_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
