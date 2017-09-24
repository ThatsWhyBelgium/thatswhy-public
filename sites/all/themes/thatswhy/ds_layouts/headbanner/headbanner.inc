<?php

/**
 * @file
 * Display Suite Product teaser configuration.
 */

function ds_headbanner() {
  return array(
    'label' => t('Headbanner'),
    'regions' => array(
      'image_area' => t('Image area'),
      'text_area' => t('Text area'),
    ),
    // Uncomment if you want to include a CSS file for this layout (product_teaser.css)
    // 'css' => TRUE,
    // Uncomment if you want to include a preview for this layout (product_teaser.png)
    'image' => FALSE,
  );
}
