<?php

/**
 * @file
 * Display Suite Product teaser configuration.
 */

function ds_header() {
  return array(
    'label' => t('Header'),
    'regions' => array(
      'header_content' => t('Content'),
    ),
    // Uncomment if you want to include a CSS file for this layout (product_teaser.css)
    // 'css' => TRUE,
    // Uncomment if you want to include a preview for this layout (product_teaser.png)
    'image' => FALSE,
  );
}
