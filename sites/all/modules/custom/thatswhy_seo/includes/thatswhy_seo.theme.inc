<?php

function thatswhy_seo_element_info() {
  $type['seo_thatswhy_results'] = array(
    '#results' => array() ,
    '#theme' => 'seo_thatswhy_results' ,
  );

  return $type;
}

function thatswhy_seo_theme ($existing, $type, $theme, $path) {
  return array(
    'seo_thatswhy_results' => array(
      'render element' => 'element' ,
    ) ,
  );
}

function theme_seo_thatswhy_results ($element) {
  $element = $element['element'];
  $output = '<div class="thatswhy-seo-results">';
  $output .= '<h2>' . t("SEO Results") . ':</h2>';
  foreach ($element['#results'] as $rid => $rule_result) {
    $output .= '<div class="seo-result">';
    $output .= '<h3>' . check_plain($rule_result['rule']['name']) . '</h3>';
    $output .= theme(
      'table',
      array(
        'header' => array(t('Rule'), t('Passed'), t('Message'),) ,
        'rows' => $rule_result['results'] ,
      )
    );
    $output .= '</div>';
  }
  return $output;
}
