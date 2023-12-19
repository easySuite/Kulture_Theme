<?php

/**
 * @file
 * Ding page image and text template.
 *
 * @var object $item
 */
?>
<div class="item">
  <?php if (!empty($item->image)): ?>
    <div class="event-image" style="background-image:url(<?php print $item->image; ?>);"></div>
  <?php endif; ?>
  <div class="article-info">
    <div class="node">
    <div class="item-created"><?php print format_date($item->created, 'custom', 'l j. F Y', $item->timezone); ?></div>
      <h3 class="node-title"><?php print l($item->title, 'node/' . $item->nid); ?></h3>
      <p class="item-details">
        <?php print $item->teaser_lead; ?>
      </p>
    </div>
  </div>
</div>
