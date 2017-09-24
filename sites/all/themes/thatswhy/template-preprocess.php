<?php

function thatswhy_preprocess_html (&$vars) {
  $vars['social_addthis'] = FALSE;
  if($node = menu_get_object()) {
    // dpm($node);

    // Social buttons
    $social_addthis = array('blog');
    if(in_array($node->type, $social_addthis)) {
      $vars['social_addthis'] = TRUE;
    }

    // Add schema.org attributes to the body
    if(module_exists('schemaorg')) {
      $vars['attributes_array']['itemprop'] = array();
      $vars['attributes_array']['itemScope'] = $node->rdf_mapping['rdftype'];
    }

  }

  if(module_exists('schemaorg') && in_array('page-blog', $vars['classes_array'])) {
    $vars['attributes_array']['itemprop'] = array();
    $vars['attributes_array']['itemScope'] = $node->rdf_mapping['rdftype'];
  }

  // Add webmasters verification
  $g_site_verification = array(
    '#tag' => 'meta' ,
    '#attributes' => array(
      'name' => 'google-site-verification' ,
      'content' => 'm8T5oBUwDTsQ_ocquDGNSRSqIpWY29je97zITmIQzTg' ,
    ) ,
  );

  drupal_add_html_head($g_site_verification, 'google_site_verification');
}

function thatswhy_preprocess_page (&$vars) {
  // dpm($vars['node']);
  // Toevoegen van logica vr titel bij bepaalde producten (bv. blogitem)
  $vars['needs_title'] = !$vars['is_front'];
  // Toevoegen van logica vr nr fd klasses -> bv blog full page
  $vars['needs_wrapper'] = !$vars['is_front'];
  $vars['map'] = FALSE;

  $vars['logo_svg'] = str_replace('logo.png', 'img/assets/logo.svg', $vars['logo']);

  $vars['logo_mob'] = str_replace('logo.png', 'img/assets/logo_mob.png', $vars['logo']);
  $vars['logo_mob_svg'] = str_replace('logo_mob.png', 'logo_mob.svg', $vars['logo_mob']);

  // Verbergen van taxonomy inhoud + taxonomy "Geen inhoud gevonden"
  $term_content = $vars['page']['content']['system_main'];
  if (isset($term_content['term_heading'])) {
    $vars['needs_title'] = FALSE;

    if(isset($term_content['no_content'])) {
      unset($vars['page']['content']['system_main']['no_content']);
    }
    if(isset($term_content['nodes']) && !empty($term_content['nodes'])) {
      unset($vars['page']['content']['system_main']['nodes']);
    }
    if (isset($term_content['pager'])) {
      unset($vars['page']['content']['system_main']['pager']);
    }

  }

  if(isset($vars['node'])) {
    $no_title_arr = array('overview_page', 'blog', 'basic_page');
    $no_wrap_arr = array('blog');
    if(in_array($vars['node']->type, $no_title_arr)) {
      $vars['needs_title'] = FALSE;
    }

    if(in_array($vars['node']->type, $no_wrap_arr)) {
      $vars['needs_wrapper'] = FALSE;
    }

    if(in_array('page__node__edit', $vars['theme_hook_suggestions']) || in_array('page__node_delete', $vars['theme_hook_suggestions']) || in_array('page__node_preview', $vars['theme_hook_suggestions'])) {
      $vars['needs_wrapper'] = TRUE;
    }

    if($vars['node']->nid == '2') {
      $vars['map'] = TRUE;
      drupal_add_js('https://api.tiles.mapbox.com/mapbox.js/v2.1.0/mapbox.js', 'external');
      drupal_add_css('https://api.tiles.mapbox.com/mapbox.js/v2.1.0/mapbox.css', array('type' => 'external'));
    }
  }

  // Toevoegen van schema.org microdata


  // FP slick!
  if($vars['is_front']) {
    // drupal_add_js(drupal_get_path('theme', 'thatswhy') . '/js/jquery.carouFredSel-6.2.1-packed.js');
    drupal_add_js(drupal_get_path('theme', 'thatswhy') . '/js/slick/slick/slick.min.js');
  }

  // Add typekit js
  drupal_add_js(
    '(function(d) {
      var config = {
        kitId: "ixr4paj",
        scriptTimeout: 3000
      },
      h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src="//use.typekit.net/"+config.kitId+".js";tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
    })(document);',
    array(
      'type' => 'inline' ,
      'scope' => 'footer' ,
    )
  );
  // dpm('Test!');
}

function thatswhy_preprocess_views_view(&$vars) {
  $vars['classes_array'] = array();
  $vars['classes_array'][] = 'view';
  $vars['classes_array'][] = drupal_clean_css_identifier($vars['name']);
  $vars['classes_array'][] = 'id-' . $vars['display_id'];

  $css_class = $vars['view']->display_handler->get_option('css_class');
  if (!empty($css_class)) {
    $vars['css_class'] = preg_replace('/[^a-zA-Z0-9- ]/', '-', $css_class);
    $vars['classes_array'][] = $vars['css_class'];
  }
}

function thatswhy_preprocess_panels_pane (&$vars) {
  $vars['classes_array'] = array();
  $vars['needs_wr'] = FALSE;
  $vars['title_attributes_array'] = array();

  if($vars['pane']->type == 'panels_mini') {
    $vars['needs_wr'] = TRUE;
    $vars['classes_array'][] = 'fl-c';
    $vars['classes_array'][] = $vars['pane']->subtype;

    if($vars['title_heading'] == 'h1') {
      $vars['title_prefix'] = '<span>';
      $vars['title_suffix'] = '</span>';
    }
  }

  if($vars['pane']->panel == 'right' && $vars['pane']->type != 'node') {
    $vars['theme_hook_suggestions'][] = 'panels_pane__sidebar';

    $vars['needs_wr'] = TRUE;
    $vars['classes_array'][] = 'block';
  }
}

function thatswhy_preprocess_entity (&$vars) {
  if($vars['entity_type'] == 'paragraphs_item') {
    $vars['classes_array'] = array(
      $vars['paragraphs_item']->bundle
    );
  }
}

function thatswhy_preprocess_link (&$vars) {
  if(!isset($vars['options']['attributes']['title'])) {
    if(isset($vars['options']['entity_type'])) {
      $title = '';
      if($vars['options']['entity_type'] == 'node') {
        $title = $vars['options']['entity']->title;
      } elseif ($vars['options']['entity_type'] == 'taxonomy_term') {
        $title = $vars['options']['entity']->name;
      }

      if(!empty($title)) {
        $vars['options']['attributes']['title'] = $title;
      }
    }
  }
}

function thatswhy_preprocess_field (&$vars) {
  $element = $vars['element'];
  if($element['#entity_type'] == 'taxonomy_term' && $element['#bundle'] == 'diensten' && $element['#view_mode'] == 'teaser' && $element['#field_name'] == 'title') {
    // Add id to field
    module_load_include('inc', 'pathauto', 'pathauto');
    $vars['ds-config']['fi-at'] .= ' data-cl="' . pathauto_cleanstring($element['#object']->name) . '"'; // data-clicklocation
  }
}

/**
 * Process variables for paragraphs-items.tpl.php
 */
function thatswhy_preprocess_paragraphs_items(&$vars, $hook) {
  $vars['classes_array'] = array();

  $vars['attributes_array']['id'] = 'sections';
}

function thatswhy_form_mailchimp_signup_subscribe_block_nieuwsbrief_form_alter(&$form_state, &$form, $form_id) {
  global $language;
  $form_state['mergevars']['LANGUAGE']['#default_value'] = $language->native;
  $form_state['mergevars']['EMAIL']['#title'] = t('Email Address');
  $form_state['mergevars']['FNAME']['#title'] = t('First name');
  $form_state['mergevars']['LNAME']['#title'] = t('Last name');
  $form_state['mailchimp_lists']['mailchimp_64865']['subscribe']['#default_value'] = TRUE;
}
