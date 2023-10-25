(function($) {
  'use strict';
  /**
   * Slide toggle footer menus
   */
  Drupal.behaviors.kulture_a11y = {
    attach: function(context, settings) {
      $('.a11y-trigger', context).click(function(event) {
        var $element = $(this);
        var $html = $('html');

        if ($element.hasClass('font-size-trigger')) {
          $html.toggleClass('a11y');
        }

        if ($element.hasClass('contrast-trigger')) {
          $html.toggleClass('a11y-contrast');
        }
        event.preventDefault();
      });
    }
  };
})(jQuery);
