(function ($) {
    "use strict";
  
    function detectMapsLinkPosition(pageElemRef) {
        pageElemRef.find('.library-item-wrapper').each(function(index) {
            var expectedElem = $(this).find('.maps-link');
            var titleHeight = $(this).find('.library-title').outerHeight();
            var adressHeight = $(this).find('.field-type-addressfield').outerHeight();

            const finalPosition = adressHeight ?  (titleHeight + (adressHeight / 2)) : ((titleHeight / 2) - expectedElem.outerHeight() / 2);
            expectedElem.css({top: finalPosition + 'px'});
        });
    }
  
    $(document).ready(function () {
      
        if ($('#edit-date-wrapper').length) {
            $('#edit-date-wrapper').after($('.panel-pane.pane-quick-buttons'));
        }

        if ($('#ding-library-page').length) {
            detectMapsLinkPosition($('#ding-library-page'));
        }

        if ($('.page-taxonomy.page-taxonomy-term').length) {
            detectMapsLinkPosition($('.page-taxonomy.page-taxonomy-term'));
        }
    });
  
  
  })(jQuery);
  
  