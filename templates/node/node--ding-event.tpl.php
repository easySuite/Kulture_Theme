<?php

/**
 * @file
 * DDBasic's theme implementation to display event nodes.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $date (NOTE: modified for
 *   ddbasic during ddbasic_preprocess_node in templates.php)
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * ddbasic specific variables:
 * - $ddbasic_updated: Information about latest update on the node created from
 *   $date during
 *   ddbasic_preprocess_node().
 * - $ddbasic_event_location: String containing adress info for either
 *   field_address or group_audience,
 *   as relevant for the event node
 * - $event_date: Event date or period
 * - $event_time: Event time or time-span
 * - $event_price: Event price with 'kr.' suffix -
 *    if no price is set $event_price equals 'Free'
 * - $book_button: Link to event-signup or event-tickets
 * - $share_button: Share links for Facebook, Twitter and email
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
unset($content['field_ding_event_ticket_link']);
 ?>
<article class="event-details-wrapper <?php print $classes; ?>"<?php print $attributes; ?>>
  <div class="container inner">
    <div class="row">
      <div class="left col-lg-5">
        <?php print $event_title_image; ?>
      </div>
      <div class="right col-lg-7">
        <div class="info-top">
          <i class="tag-icon"></i>
          <?php print render($content['field_ding_event_category']); ?>
        </div>
        <h1><?php print $title; ?></h1>
        <div class="event-date"><?php print render($content['group_right']['field_ding_event_date']);?></div>
        <?php print render($share_button); ?>
        <div class="event-description"><?php print render($content['group_right']);?></div>
        <?php if (isset($group_contact)) : ?>
          <h2><?php print t('Contact person'); ?></h2>
          <div><?php print $group_contact['rcp']; ?></div>
          <div>
            <?php print t('Email'); ?>:
              <a href="mailto:<?php print $group_contact['email']; ?>"><?php print $group_contact['email']; ?></a>
          </div>
          <div><?php print t('Phone'); ?>:
            <a href="tel:<?php print $group_contact['phone']; ?>"><?php print $group_contact['phone']; ?></a>
          </div>
        <?php endif; ?>
        <h2><?php print t('Information about the event'); ?></h2>
        <div><?php print render($content['group_organization']);?></div>
        <div class="event-info">
          <div class="info-item"><?php print $location_address; ?></div>

          <!-- insert time-field markup -->
          <?php if ($event_time): ?>
            <div class="field-item even info-item"><?php print $event_time; ?></div>
          <?php endif; ?>
          <div class="info-item">
            <?php if (!empty($campaigns)): ?>
              <?php print drupal_render($campaigns); ?>
            <?php endif; ?>
          </div>

          <!-- insert price-field markup -->
          <div class="field-item even info-item price"><?php print $event_price; ?></div>
          <div class="info-item-group">
            <?php print render($content['group_left']['field_ding_event_target']); ?>
          </div>
        </div>
        <div class="info-item">
            <?php
              if (!empty($book_button)):
                print render($book_button);
              endif;
            ?>
          </div>
      </div>
      <!-- Render MKWS results set. -->
      <?php if (!empty($content['field_mkws_node_widget'])) : ?>
        <?php print render($content['field_mkws_node_widget']); ?>
      <?php endif; ?>
    </div>
    <div>
     <?php print render($content['field_culture_lists_control']); ?>
    </div>
  </div>
</article>
