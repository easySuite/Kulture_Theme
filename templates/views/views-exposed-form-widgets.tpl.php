<?php

/**
 * @file
 * Views Exposed Form Widget template.
 */

$element_name = $element['#name'] . '[]';
$element_id = $element['#id'];
?>


<div class="views-exposed-form-widget accordion-wrapper" id="<?php print $element_id; ?>">
  <?php if (isset($title)): ?>
    <div class="accordion-filter-header">
      <a class="accordion-control" data-toggle="collapse" data-target="#<?php print $element_id; ?>-conteiner" aria-controls="<?php print $element_id; ?>-conteiner">
        <?php print $title; ?>
        <span class="arrow"></span>
      </a>
    </div>
  <?php else: ?>
    <div class="accordion-filter-header">
      <a class="accordion-control" data-toggle="collapse" data-target="#<?php print $element_id; ?>-conteiner" aria-controls="<?php print $element_id; ?>-conteiner">
        <?php print $element['#title']; ?>
        <span class="arrow"></span>
      </a>
    </div>  
  <?php endif; ?>
  <div id="<?php print $element_id; ?>-conteiner" class="collapse accordion-filter-body">
    <ul class="sub-menu">
      <?php foreach ($items as $key => $item): ?>
        <li>
          <input type="checkbox" id="<?php print $element_id . '-' . $key; ?>" name="<?php print $element_name; ?>" value="<?php print $key; ?>">
          <label for="<?php print $element_id . '-' . $key; ?>" class="menu-item"><?php print $item; ?></label>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>  
</div>
