<?php

/**
 * @file
 * Display Suite Product teaser configuration.
 */

function ds_product_teaser() {
  return array(
    'label' => t('Product teaser'),
    'regions' => array(
      'image_and_description_area' => t('Image and description area'),
      'bottom_area' => t('Bottom area'),
    ),
    // Uncomment if you want to include a CSS file for this layout (product_teaser.css)
    // 'css' => TRUE,
    // Uncomment if you want to include a preview for this layout (product_teaser.png)
    'image' => FALSE,
  );
}
