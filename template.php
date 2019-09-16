<?php
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
 * Implements hook_process_page().
 */
function kulture_theme_process_page(&$vars) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($vars);
  }
}
