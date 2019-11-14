<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
// var_dump($options['type']); die;
?>
<?php print $wrapper_prefix; ?>
  <?php if (!empty($title)) : ?>
    <h3><?php print $title; ?></h3>
  <?php endif; ?>
  <ul class="row <?php print $class; ?>">
    <?php foreach ($rows as $id => $row): ?>
      <li class="col-lg-12 <?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
    <?php endforeach; ?>
    </ul>
  <?php print $list_type_suffix; ?>
<?php print $wrapper_suffix; ?>
