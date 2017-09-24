<?php

// Plugin definition
$plugin = array(
  'title' => t("Two column stacked blog"),
  'category' => t("That's Why"),
  'icon' => 'twocol_stacked_blog.png',
  'theme' => 'panels_twocol_stacked_blog',
  'regions' => array(
    'top' => t('Top'),
    'left' => t('Left'),
    'right' => t('Right'),
    'bottom' => t('Bottom')
  ),
);
