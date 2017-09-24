<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php $count = 0; ?>

<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>

<?php foreach ($rows as $id => $row): ?>
  <?php
      $count++;
      $lastclass = '';
      if($count %2 == 0 || $count == count($rows)){
        if ( $count %2 == 0 ) $lastclass = ' l';
      }
  ?>
  <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] . $lastclass . '"';  } ?>>
    <?php print $row; ?>
  </div>

<?php endforeach; ?>
