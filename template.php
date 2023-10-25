<?php

/**
 * @file
 * Preprocessors.
 */

require_once __DIR__ . '/template.node.php';

/**
 * Implements hook_theme().
 */
function kulture_theme_theme($existing, $type, $theme, $path): array {
  return [
    'a11y' => [
      'variables' => [],
      'path' => $path . '/templates',
      'template' => 'a11y',
    ],
    'views_exposed_form_widgets_title' => array(
      'variables' => array(
        'element' => NULL,
      ),
      'template' => 'templates/views/views-exposed-form-widgets-title',
    ),
    'views_exposed_form_widgets_date_inputs' => array(
      'variables' => array(
        'element' => NULL,
      ),
      'template' => 'templates/views/views-exposed-form-widgets-date-inputs',
    ),
  ];
}

/**
 * Implements hook_preprocess_panels_pane().
 */
function kulture_theme_preprocess_panels_pane(&$vars) {
  // If using lazy pane caching method, and lazy pane is returning the rendered
  // content, set the lazy_pane_render variable, so the template can take action
  // accordingly.
  $vars['is_lazy_pane_render'] = !empty($vars['pane']->cache['method'])
    && $vars['pane']->cache['method'] === 'lazy'
    && !empty($vars['display']->skip_cache);
  if ($vars['is_lazy_pane_render']) {
    $vars['theme_hook_suggestions'][] = 'panels_pane__lazy_pane_render';
  }

  // Suggestions base on sub-type.
  $vars['theme_hook_suggestions'][] = 'panels_pane__' . str_replace('-', '__', $vars['pane']->subtype);
  $vars['theme_hook_suggestions'][] = 'panels_pane__' . $vars['pane']->panel . '__' . str_replace('-', '__', $vars['pane']->subtype);

  // Suggestions on panel pane.
  $vars['theme_hook_suggestions'][] = 'panels_pane__' . $vars['pane']->panel;

  // Suggestions on menus panes.
  if ($vars['pane']->subtype == 'og_menu-og_single_menu_block' || $vars['pane']->subtype == 'menu_block-3') {
    $vars['theme_hook_suggestions'][] = 'panels_pane__sub_menu';
    $vars['classes_array'][] = 'sub-menu-wrapper';

    // Change the theme wrapper for both menu-block and OG menu.
    if (isset($vars['content']['#content']) && is_array($vars['content']['#content'])) {
      // Menu-block.
      $vars['content']['#content']['#theme_wrappers'] = array('menu_tree__sub_menu');
    }
    elseif(is_array($vars['content'])) {
      // OG menu.
      $vars['content']['#theme_wrappers'] = array('menu_tree__sub_menu');
    }
  }
}

/**
 * Implements theme_menu_tree().
 */
function kulture_theme_menu_tree__menu_block__1($vars) {
  return '<ul class="main-menu navbar-nav mr-auto">' . $vars['tree'] . '</ul>';
}

/**
 * Implements hook_process_html().
 *
 * Process variables for html.tpl.php.
 */
function kulture_theme_process_html(&$vars) {

  // Hook into color.module.
  if (module_exists('color')) {
    _color_html_alter($vars);
  }
}

/**
 * Implements hook_preprocess_html().
 */
function kulture_theme_preprocess_html(&$vars) {
  if (!path_is_admin(current_path())) {
    $variables['a11y'] = theme('a11y');
  }

  // Include the libraries.
  libraries_load('slick');
}

/**
 * Implements hook_process_page().
 */
function kulture_theme_process_page(&$vars) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($vars);
  }
}

/**
 * Returns HTML for a date element formatted as a range.
 */
function kulture_theme_date_display_range($variables) {
  $date1 = $variables['date1'];
  $date2 = $variables['date2'];
  $timezone = $variables['timezone'];
  $attributes_start = $variables['attributes_start'];
  $attributes_end = $variables['attributes_end'];

  $start_date = '<span class="date-display-start"' . drupal_attributes($attributes_start) . '>' . $date1 . '</span>';
  $end_date = '<span class="date-display-end"' . drupal_attributes($attributes_end) . '>' . $date2 . $timezone . '</span>';

  // If microdata attributes for the start date property have been passed in,
  // add the microdata in meta tags.
  if (!empty($variables['add_microdata'])) {
    $start_date .= '<meta' . drupal_attributes($variables['microdata']['value']['#attributes']) . '/>';
    $end_date .= '<meta' . drupal_attributes($variables['microdata']['value2']['#attributes']) . '/>';
  }

  // Wrap the result with the attributes.
  return t('!start-date - !end-date', array(
    '!start-date' => $start_date,
    '!end-date' => $end_date,
  ));
}

/**
 * Implements hook_preprocess_views_exposed_form().
 */
function kulture_theme_preprocess_views_exposed_form(&$variables) {
  if (arg(0) == 'arrangementer') {
    $form = $variables['form'];

    if ($form['#info']['filter-combine']) {
      $widget = $form['#info']['filter-combine']['value'];
      $item = $form[$widget];
      $render = theme('views_exposed_form_widgets_title', [
          'element' => [
            'label' => $variables['widgets']['filter-combine']->label,
            'field' => $item,
          ],
        ]
      );
      unset($variables['widgets']['filter-combine']->label);
      $variables['widgets']['filter-combine']->widget = $render;
    }

    if ($form['#info']['filter-field_ding_event_date_value'] && $form['#info']['filter-field_ding_event_date_value2']) {
      $widget_from = $form['#info']['filter-field_ding_event_date_value']['value'];
      $widget_to = $form['#info']['filter-field_ding_event_date_value2']['value'];

      $item_from = $form[$widget_from];
      $item_to = $form[$widget_to];

      $return = [
        'from' => [
          'label' => $variables['widgets']['filter-field_ding_event_date_value']->label,
          'field' => $item_from,
        ],
        'to' => [
          'label' => $variables['widgets']['filter-field_ding_event_date_value2']->label,
          'field' => $item_to,
        ],
      ];

      $render = theme('views_exposed_form_widgets_date_inputs', [
          'element' => $return,
        ]
      );

      unset($variables['widgets']['filter-field_ding_event_date_value']->label);
      $variables['widgets']['filter-field_ding_event_date_value']->widget = $render;
      unset($variables['widgets']['filter-field_ding_event_date_value2']);
    }
  }
}

/**
 * Implements hook_form_views_exposed_form_alter().
 */
function kulture_theme_form_views_exposed_form_alter(&$form, &$form_state): void
{
  if ($form_state['view']->name == 'ding_event' && $form_state['view']->current_display == 'ding_event_list') {
    if (!empty($form['#info']['filter-term_node_tid_depth'])) {
      $label = $form['#info']['filter-term_node_tid_depth']['label'];
      unset($form['#info']['filter-term_node_tid_depth']['label']);
      $form['event_category_term_node_tid_depth']['#title'] = '<h2 class="list-title sub-menu-title">' . $label . '</h2>';
    }

    if (!empty($form['#info']['filter-og_group_ref_target_id_entityreference_filter'])) {
      $label = $form['#info']['filter-og_group_ref_target_id_entityreference_filter']['label'];
      unset($form['#info']['filter-og_group_ref_target_id_entityreference_filter']['label']);
      $form['og_group_ref_target_id_entityreference_filter']['#title'] = '<h2 class="list-title sub-menu-title">' . $label . '</h2>';
    }

    if (!empty($form['#info']['filter-field_ding_event_target_tid'])) {
      $label = $form['#info']['filter-field_ding_event_target_tid']['label'];
      unset($form['#info']['filter-field_ding_event_target_tid']['label']);
      $form['field_ding_event_target_tid']['#title'] = '<h2 class="list-title sub-menu-title">' . $label . '</h2>';
    }
  }
}

/**
 * Implements hook_preprocess_HOOK().
 *
 * Create a11y controls.
 */
function kulture_theme_preprocess_a11y(&$variables) {
  $variables['size'] = l('<i class="fa fa-font"></i>', '#', [
    'attributes' => [
      'class' => [
        'a11y-trigger',
        'font-size-trigger',
      ],
      'title' => t('Toggle font size'),
    ],
    'html' => TRUE,
  ]);

  $variables['contrast'] = l('<i class="fa fa-adjust"></i>', '#', [
    'attributes' => [
      'class' => [
        'a11y-trigger',
        'contrast-trigger',
      ],
      'title' => t('Toggle high contrast'),
    ],
    'html' => TRUE,
  ]);

  drupal_add_js(drupal_get_path('theme', 'kulture_theme') . '/scripts/a11y.js');
}
