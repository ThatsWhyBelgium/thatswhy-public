<?php

function thatswhy_seo_register_seo_rules () {
  $rules['img_alt'] = array(
    'name' => t('Alt attributes in <img> - tags') ,
    'description' => t('Checks if all img elements have an alt attribute') ,
    'callback' => 'thatswhy_seo_rules_img_alt' ,
    'default value' => '[node:body]' ,
    'keywords' => FALSE ,
  );

  $rules['img_title'] = array(
    'name' => t('Title attributes in <img> - tags') ,
    'description' => t('Checks if all img elements have a title attribute') ,
    'callback' => 'thatswhy_seo_rules_img_title' ,
    'default value' => '[node:body]' ,
    'keywords' => FALSE ,
  );

  $rules['a_title'] = array(
    'name' => t('Title attributes in <a> - tags') ,
    'description' => t('Checks if all a elements have a title attribute') ,
    'callback' => 'thatswhy_seo_rules_a_title' ,
    'default value' => '[node:body]' ,
    'keywords' => FALSE ,
  );

  $rules['page_title'] = array(
    'name' => t('Title check') ,
    'description' => t('Checks length and keyword usage in the title.') ,
    'callback' => 'thatswhy_seo_rules_title' ,
    'default value' => '[node:metatag:title]' ,
    'keywords' => TRUE ,
  );

  $rules['page_description'] = array(
    'name' => t('Description check') ,
    'description' => t('Checks length and keyword usage in the description.') ,
    'callback' => 'thatswhy_seo_rules_description' ,
    'default value' => '[node:metatag:description]' ,
    'keywords' => TRUE ,
  );

  $rules['page_headings'] = array(
    'name' => t('Headings check') ,
    'description' => t('Checks if the headings are correctly structured, and looking for the keywords within those headings (&lt;h1&gt;,&lt;h2&gt;,...)') ,
    'callback' => 'thatswhy_seo_rules_headings' ,
    'default value' => '[node:body]' ,
    'keywords' => TRUE ,
  );

  $rules['keyword_density'] = array(
    'name' => t('Content keyword density check') ,
    'description' => t('Checks keyword density of the provided data.') ,
    'callback' => 'thatswhy_seo_rules_density' ,
    'default value' => '[node:body]' ,
    'keywords' => TRUE ,
  );

  return $rules;
}

function thatswhy_seo_rules_img_alt ($value) {
  $result = array(
    'img_alt' => array(
      'data' => array(
        'name' => '' ,
        'result' => TRUE ,
        'message' => '' ,
      ) ,
    ) ,
  );

  if (!isset($value)) {
    // No body field on this node.
    _set_result_error($result['img_alt'], t('No value found...'));
    return $result;
  }

  if (!preg_match_all('/<img[^>]+>/i', $value, $matches)) {
    _set_result_error($result['img_alt'], t('No images where found'), TRUE);
    return $result;
  }

  $total = 0;
  $successful = 0;
  foreach ($matches[0] as $image_tag) {
    if (preg_match('/alt=(\S{3,})/i', $image_tag)) {
      $successful++;
    }
    $total++;
  }

  if($successful < $total ) {
    _set_result_error($result['img_alt'], t('Only @success of @total images have a title tag.', array(
      '@success' => $successful ,
      '@total' => $total ,
    )));
  }

  return $result;
}

function thatswhy_seo_rules_img_title ($value) {
  $result = array(
    'img_title' => array(
      'data' => array(
        'name' => '' ,
        'result' => TRUE ,
        'message' => '' ,
      ) ,
    ) ,
  );

  if (!isset($value)) {
    // No body field on this node.
    _set_result_error($result['img_title'], t('No value found...'));
    return $result;
  }

  if (!preg_match_all('/<img[^>]+>/i', $value, $matches)) {
    _set_result_error($result['img_title'], t('No images where found'), TRUE);
    return $result;
  }

  $total = 0;
  $successful = 0;
  foreach ($matches[0] as $ahref_tag) {
    if (preg_match('/title=(\S{3,})/i', $ahref_tag)) {
      $successful++;
    }
    $total++;
  }

  if($successful < $total ) {
    _set_result_error($result['img_title'], t('Only @success of @total images have a title tag.', array(
      '@success' => $successful ,
      '@total' => $total ,
    )));
  }

  return $result;
}

function thatswhy_seo_rules_a_title ($value) {
  $result = array(
    'a_title' => array(
      'data' => array(
        'name' => '' ,
        'result' => TRUE ,
        'message' => '' ,
      ) ,
    ) ,
  );

  if (!isset($value)) {
    // No body field on this node.
    _set_result_error($result['a_title'], t('No value found...'));
    return $result;
  }

  if (!preg_match_all('/<a[^>]+href[^>]*>/i', $value, $matches)) {
    _set_result_error($result['a_title'], t('No links where found'), TRUE);
    return $result;
  }

  $total = 0;
  $successful = 0;
  foreach ($matches[0] as $ahref_tag) {
    if (preg_match('/title=(\S{3,})/i', $ahref_tag)) {
      $successful++;
    }
    $total++;
  }
  _set_result_error($result['a_title'], t('Only @success of @total images have a title tag.', array(
    '@success' => $successful ,
    '@total' => $total ,
  )));

  return $result;
}

function thatswhy_seo_rules_title ($value, $keywords) {
  $result = array(
    'length' => array(
      'data' => array(
        'name' => t('Title length') ,
        'result' => TRUE ,
        'message' => '' ,
      ) ,
    ) ,
    'wcount' => array(
      'data' => array(
        'name' => t('Title word count') ,
        'result' => TRUE ,
        'message' => '' ,
      ) ,
    ) ,
    'keyword_presence' => array(
      'data' => array(
        'name' => t('Title keyword presence') ,
        'result' => TRUE ,
        'message' => '' ,
      ) ,

    ) ,
    'keyword_position' => array(
      'data' => array(
        'name' => t('Title first keyword position') ,
        'result' => TRUE ,
        'message' => '' ,
      ) ,
    ) ,
  );

  // 1. Check if title length is OK
  $length = strlen($value);

  if ($length < 50 || $length > 57) {
    _set_result_error($result['length'], t("The title of this page doesn't have the right length (@length), please make sure it has between 50 and 57 characters.", array('@length' => $length)));
  } else {
    $result['length']['data']['message'] = t("The title has a lenght of @length characters, perfect!", array('@length' => $length ,));
  }

  // 2. Check title word count
  $wcount = str_word_count($value);

  if ($wcount <= 5) {
    _set_result_error($result['wcount'], t("The word count of the title is to low (@wcount), please make sure it's over 5 words long.", array('@wcount' => $wcount)));
  } else {
    $result['wcount']['data']['message'] = t('Your title has @wcount words in it, perfect!', array('@wcount' => $wcount ,));
  }

  // 3. Keyword presence
  $best_keyword = NULL;
  $best_score = 1000;
  $word_pos = round($wcount / 3);
  $word = explode(' ', $value);
  $word = $word[$word_pos];

  foreach ($keywords as $keyword) {
    if (($score = thatswhy_seo_wordipos($value, $keyword)) !== FALSE && $score < $best_score) {
      $best_score = $score;
      $best_keyword = $keyword;
    }
  }

  if(is_null($best_keyword)) {
    _set_result_error($result['keyword_presence'], t("We couldn't find any of the keywords (@keywords) in the description.", array('@keywords' => implode(', ', $keywords))));
    _set_result_error($result['keyword_position'], t("No keyword presence means no keyword position."));
  } else {
    $result['keyword_presence']['data']['message'] = t('Your keyword (@keyword) is present in the description!', array('@keyword' => $best_keyword));

    // 4. Keyword position
    if($best_score > $word_pos) {
      _set_result_error($result['keyword_position'], t("Your keyword (@keyword) is situated to far in the text, please try to position it earlier than word number @wordpos (@word) to get best SEO results.", array('@keyword' => $best_keyword ,
        '@wordpos' => round($wcount / 3) ,
        '@word' => $word ,)));
    } else {
      $result['keyword_position']['data']['message'] = t("Your keyword (@keyword) is perfectly situated! It should be at least before \"@word\" and that's just perfect!", array('@keyword' => $best_keyword , '@word' => $word ,));
    }
  }

  return $result;
}

function thatswhy_seo_rules_description ($value, $keywords) {
  $value = strip_tags($value);

  $result = array(
    'length' => array(
      'data' => array(
        'name' => t('Description length') ,
        'result' => TRUE ,
        'message' => '' ,
      ) ,
    ) ,
    'wcount' => array(
      'data' => array(
        'name' => t('Description word count') ,
        'result' => TRUE ,
        'message' => '' ,
      ) ,
    ) ,
    'keyword_presence' => array(
      'data' => array(
        'name' => t('Description keyword presence') ,
        'result' => TRUE ,
        'message' => '' ,
      ) ,

    ) ,
    'keyword_position' => array(
      'data' => array(
        'name' => t('Description first keyword position') ,
        'result' => TRUE ,
        'message' => '' ,
      ) ,
    ) ,
  );

  // 1. Check if description length is ok
  $length = strlen($value);

  if($length < 130 || $length > 160) {
    _set_result_error($result['length'], t("The description of this page doesn't have the right length (@length), please make sure it has between 130 and 160 characters.", array('@length' => $length ,)));
  } else {
    $result['length']['data']['message'] = t("The description has a length of @length characters, perfect!", array('@length' => $length ,));
  }

  // 2. Check description word count
  $wcount = str_word_count($value);
  if ($wcount <= 15) {
    _set_result_error($result['wcount'], t("The description word count is to low (@wcount), please have at least 16 words in your description.", array('@wcount' => $wcount ,)));
  } else {
    if($wcount > 30) {
      _set_result_error($result['wcount'], t("The description word count is to high (@wcount), please have at max 30 words in your description.", array('@wcount' => $wcount ,)));
    } else {
      $result['wcount']['data']['message'] = t("Your description has @wcount words in it, perfect!", array('@wcount' => $wcount ,));
    }
  }

  // 3. Keyword presence
  $best_keyword = NULL;
  $best_score = 1000;
  $word_pos = round($wcount / 4);
  $word = explode(' ', $value);
  $word = $word[$word_pos];

  foreach ($keywords as $keyword) {
    if (($score = thatswhy_seo_wordipos($value, $keyword)) !== FALSE && $score < $best_score) {
      $best_score = $score;
      $best_keyword = $keyword;
    }
  }

  if(is_null($best_keyword)) {
    _set_result_error($result['keyword_presence'], t("We couldn't find any of the keywords (@keywords) in the description.", array('@keywords' => implode(', ', $keywords))));
    _set_result_error($result['keyword_position'], t("No keyword presence means no keyword position."));
  } else {
    $result['keyword_presence']['data']['message'] = t('Your keyword (@keyword) is present in the description!', array('@keyword' => $best_keyword));

    // 4. Keyword position
    if($best_score > $word_pos) {
      _set_result_error($result['keyword_position'], t("Your keyword (@keyword) is situated to far in the text, please try to position it earlier than word number @wordpos (@word) to get best SEO results.", array('@keyword' => $best_keyword ,
        '@wordpos' => round($wcount / 4) ,
        '@word' => $word ,)));
    } else {
      $result['keyword_position']['data']['message'] = t("Your keyword (@keyword) is perfectly situated! It should be at least before \"@word\" and that's just perfect!", array('@keyword' => $best_keyword , '@word' => $word ,));
    }
  }


  return $result;
}

function thatswhy_seo_rules_headings ($value, $keywords) {
  $result = array(
    'h2-count' => array(
      'data' => array(
        'name' => t('Heading h2-tags') ,
        'result' => TRUE ,
        'message' => '' ,
      ) ,
    ) ,
    'h3-count' => array(
      'data' => array(
        'name' => t('Heading h3-tags') ,
        'result' => TRUE ,
        'message' => '' ,
      ) ,
    ) ,
  );

  $wcount = str_word_count(strip_tags($value));

  // 1. H-count
  $h2matches = find_heading_tags('h2', $value);

  // 1. check word count. If > 400, allow 2 h2 tags
  $h2mcount = count($h2matches);
  $h2max_items = round(($wcount - 100) / 200, 0, PHP_ROUND_HALF_DOWN);

  if($h2mcount > $h2max_items) {
    _set_result_error($result['h2-count'], t("Please do not use to many h2 elements. At this moment you have @h2matches. Your text is now @wcount characters long, so use at max @h2tags \"h2\" elements", array(
        '@h2matches' => $h2mcount ,
        '@wcount' => $wcount ,
        '@h2tags' => $h2max_items ,
      )));
  } else {
    $result['h2-count']['data']['message'] = t("You are using the proper amount of h2-tags. You are using @h2matches, you can use max @h2tags.", array(
        '@h2matches' => $h2mcount ,
        '@h2tags' => $h2max_items ,
    ));
  }

  // 1.2 h3 count
  $h3matches = find_heading_tags('h3', $value);

  // 1. check word count. If > 400, allow 2 h2 tags
  $h3mcount = count($h3matches);
  $h3max_items = round($wcount / 100, 0, PHP_ROUND_HALF_DOWN);

  if($h3mcount > $h3max_items) {
    _set_result_error($result['h3-count'], t("Please do not use to many h3 elements. At this moment you have @h3matches. Your text is now @wcount characters long, so use at max @h3tags \"h3\" elements", array(
        '@h3matches' => $h3mcount ,
        '@wcount' => $wcount ,
        '@h3tags' => $h3max_items ,
      )));
  } else {
    $result['h3-count']['data']['message'] = t("You are using the proper amount of h3-tags. You are using @h3matches, you can use max @h3tags.", array(
        '@h3matches' => $h3mcount ,
        '@h3tags' => $h3max_items ,
    ));
  }

  return $result;
}

function thatswhy_seo_rules_density ($value, $keywords) {
  $value = strip_tags($value);

  $result = array(
    'keyword_density' => array(
      'data' => array(
        'name' => t('Keyword density') ,
        'result' => TRUE ,
        'message' => '' ,
      ) ,
    ) ,
  );

  $density = round(thatswhy_seo_density($value, $keywords), 2);

  if($density >= 2 && $density <= 4) {
    $result['keyword_density']['data']['message'] = t("Your content has the right keyword density (@density%), it should be between 2% and 4%", array('@density' => $density));
  } else {
    _set_result_error($result['keyword_density'], t("Your content keyword density is not good. Please make sure it is between 2% and 4%. Now you have a density of @density%", array('@density' => $density)));
  }

  return $result;
}

function _set_result_error(&$vars, $message, $fatal_error = FALSE) {
  $vars['data']['result'] = $fatal_error;
  $vars['data']['message'] = $message;
}
