<?php

function thatswhy_seo_permission () {
  return array(
    'administer thatswhy_seo configuration' => array(
      'title' => t("Administer That's Why SEO Configuration") ,
      'description' => t("Gives access to the configuration panel of the That's Why SEO module") ,
    ) ,
    'skip thatswhy_seo checks' => array(
      'title' => t("Skip That's Why SEO Checks") ,
      'description' => t('Checks will be skipped completely for users with this permission') ,
    ) ,
    'allow thatswhy_seo check failures' => array(
      'title' => t("Allow That's Why Check failures") ,
      'description' => t("Lets publishers publish their content without a fully SEO-optimized version") ,
    ),
  );
}

function thatswhy_seo_settings () {
  $rules = module_invoke_all('register_seo_rules');

  $form = array();

  $form['general'] = array(
    '#type' => 'fieldset' ,
    '#title' => t('General settings.') ,
    '#collapsible' => TRUE ,
    '#collapsed' => TRUE ,
  );

  $form['general']['thatswhy_seo_allow_failures'] = array(
    '#type' => 'radios' ,
    '#title' => t('Check result display settings') ,
    '#default_value' => variable_get('thatswhy_seo_allow_failures', 'show-preview-only') ,
    '#options' => array(
      'show-preview-only' => t("Only show on node previews") ,
      'show-always' => t("Show on node previews and when nodes are saved") ,
    ) ,
  );

  $form['content_types'] = array(
    '#type' => 'fieldset' ,
    '#title' => t('SEO Checks per content type') ,
    '#collapsible' => FALSE ,
    '#description' => t("SEO settings for each content type of this website.") ,
  );

  foreach (_node_types_build()->types as $type) {
    $form['content_types']['thatswhy_seo_' . $type->type] = array(
      '#type' => 'checkbox' ,
      '#title' => t('Enable SEO check for @type', array('@type' => t($type->name))) ,
      '#default_value' => variable_get('thatswhy_seo_' . $type->type) ,
    );

    $form['content_types'][$type->type] = array(
      '#type' => 'fieldset' ,
      '#title' => t('@name settings', array('@name' => t($type->name))) ,
      '#collapsible' => TRUE ,
      '#collapsed' => (variable_get('thatswhy_seo_' . $type->type) == 0) ? TRUE : FALSE ,
    );

    $form['content_types'][$type->type]['link'] = array(
      '#type' => 'item' ,
      '#markup' => l(t('Edit SEO details @type', array('@type' => t($type->name))), 'admin/structure/types/manage/' . $type->type) ,
    );

    foreach ($rules as $rid => $rule) {
      $form['content_types'][$type->type]['thatswhy_seo_rule_' . $rid . '_' . $type->type] = array(
        '#type' => 'checkbox' ,
        '#title' => check_plain($rule['name']) ,
        '#description' => check_plain($rule['description']) ,
        '#default_value' => variable_get('thatswhy_seo_' . $type->type . '_rule_' . $rid, variable_get('thatswhy_seo_' . $type->type)) ,
      );
    }
  }

  return system_settings_form($form);
}
