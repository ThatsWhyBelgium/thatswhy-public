<?php $count = 0; ?>
<?php foreach ($rows as $id => $row): ?>
  <?php
      $count++;
      $addrowEnd = '';
      $addrowStart = '';
      $lclass = '';
      if($count %2 == 0 || $count == count($rows)){
        if ( $count %2 == 0 ) $lclass = ' l';
        if ( $count %2 == 1 ) {
          $addrowStart = '<div class="c-r">';
        }
        $addrowEnd = '</div>';
      } elseif ($count %2 == 1) {
        $addrowStart = '<div class="c-r">';
      }
  ?>

  <?php print $addrowStart; ?>
    <?php print $row; ?>
  <?php print $addrowEnd; ?>

<?php endforeach; ?>
