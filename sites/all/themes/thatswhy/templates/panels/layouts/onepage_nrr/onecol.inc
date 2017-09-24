<?php

/**
 * implementation of hook_panels_layouts()
 */
// Plugin definition
$plugin = array(
  'title' => t('Page narrowing'),
  'category' => t("That's Why"),
  'icon' => 'onecol.png',
  'theme' => 'panels_onepage_nrr',
  'css' => false,
  'regions' => array(
    'content' => t('Content')
  ),
);
