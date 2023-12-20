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
    <a href="<?php print ('node/' . $item->nid); ?>">
      <div class="item-created"><?php print format_date($item->created, 'custom', 'l j. F Y', $item->timezone); ?></div>
    </a>
      <h3 class="node-title"><?php print l($item->title, 'node/' . $item->nid); ?></h3>
      <p class="item-details">
        <?php print l($item->teaser_lead, 'node/' . $item->nid); ?>
      </p> 
    </div>
  </div>
</div>
