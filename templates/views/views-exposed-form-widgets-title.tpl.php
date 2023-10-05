<?php
/**
 * @file
 *
 * Template for theming search field on Events list filters exposed form.
 *
 * @var $element
 */
?>
<label for="<?php print $element['field']['#id']; ?>">
  <?php print render($element['label']); ?>
</label>
<?php print render($element['field']); ?>
