<?php

/**
 * @file
 * Display Suite Node with header configuration.
 */

function ds_node_with_header_page() {
  return array(
    'label' => t('Node with header Page'),
    'regions' => array(
      'header' => t('Header'),
      'content_top' => t('Content top'),
      'content_left' => t('Content left'),
      'content_right' => t('Content right'),
    ),
    'image' => TRUE,
  );
}
