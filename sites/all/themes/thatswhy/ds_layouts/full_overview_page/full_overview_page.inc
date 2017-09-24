<?php

/**
 * @file
 * Display Suite Full Overview Page configuration.
 */

function ds_full_overview_page() {
  return array(
    'label' => t('Full Overview Page'),
    'regions' => array(
      'header' => t('Header'),
      'header_content' => t('Header content'),
      'content_top' => t('Content top'),
      'content_bottom' => t('Content bottom'),
    ),
    'image' => TRUE,
  );
}
