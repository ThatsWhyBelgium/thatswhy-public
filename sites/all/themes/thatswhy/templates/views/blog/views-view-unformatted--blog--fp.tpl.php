<?php
  $count = 0;

  foreach ($rows as $id => $row):
    $count++;
    $lclass = '';
    if($count %3 == 0 || $count == count($rows)){
      if ( $count %3 == 0 ) $lclass = ' l';
    }

  ?>
  <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] . $lclass . '"';  } ?>>
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
