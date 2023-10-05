<?php
/**
 * @file
 *
 * Template for theming "from" and "to" Event list filters exposed form.
 *
 * @var $element
 */

$from = $element['from'];
$to = $element['to'];
?>
<div class="filter-dates-wrapper">
  <div class="dates-filter-from">
    <label for="<?php print $from['field']['#id']?>">
      <?php print $from['label'] ?>
    </label>
    <?php print render($from['field']) ?>
  </div>

  <div class="dates-filter-to">
    <label for="<?php print $to['field']['#id']?>">
      <?php print $to['label'] ?>
    </label>
    <?php print render($to['field']) ?>
  </div>
</div>
