<?php

/**
 * @file
 * Ding event image and text template.
 *
 * @var object $item
 */
$category = field_view_field('node', $item, 'field_ding_event_category', 'default');
$library = field_view_field('node', $item, 'og_group_ref', 'default');
?>
<div class="item">
  <?php if (!empty($item->image)): ?>
    <div class="event-image" style="background-image:url(<?php print $item->image; ?>);"></div>
  <?php endif; ?>
  <div class="article-info">
    <div class="label"><?php print drupal_render($category);?></div>
    <div class="node">
    <div class="item-date"><?php print format_date($item->timestamp, 'custom', 'l j. F Y', $item->timezone); ?> <span>(<?php print $item->hours; ?>)</span></div>
      <h3 class="node-title"><?php print l($item->title, 'node/' . $item->nid); ?></h3>
      <p class="item-details">
        <?php print $item->teaser_lead; ?>
      </p>
      <div class="event-info">
      <span class="library"><?php print $library[0]['#markup']; ?></span>
    <div class="date-time"><?php print $item->hours; ?></div>
    <span class="item-price"><?php print $item->price; ?></span>
      </div>
    </div>
  </div>
</div>
