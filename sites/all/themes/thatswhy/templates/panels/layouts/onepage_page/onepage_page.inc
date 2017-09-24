<?php

/**
 * implementation of hook_panels_layouts()
 */
// Plugin definition
$plugin = array(
  'title' => t('Page'),
  'category' => t("That's Why"),
  'icon' => 'onecol.png',
  'theme' => 'panels_onepage_page',
  'css' => false,
  'regions' => array(
    'content' => t('Content')
  ),
);
