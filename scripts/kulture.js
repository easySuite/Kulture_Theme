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

  function tranformLibraryToAccordion(pageElemRef) {
    var libraryAccordion = pageElemRef.find('.layout-wrapper .primary-content .pane-weekly-opening-hours');

    libraryAccordion.find('h2.pane-title').replaceWith(function() {
      return $("<a/>", {html: $(this).html()});
    });

    libraryAccordion.find('.panel-pane-inner').attr("class", "accordion-wrapper");

    var link = libraryAccordion.find('.accordion-wrapper > a');
    link.attr("class", "accordion-control collapsed");
    link.attr("data-toggle", "collapse");
    link.attr("role", "button");
    link.attr("data-target", "#library-details-accordion");
    link.attr("aria-controls", "#library-details-accordion");

    var accordionBody = libraryAccordion.find('.accordion-wrapper > .pane-content');
    accordionBody.attr("id", "library-details-accordion");
    accordionBody.attr("class", "collapse");
  }

  function addCollapseToList(listContainerRef) {
    listContainerRef.find('.panel-pane-inner').addClass("accordion-wrapper");

    listContainerRef.find('.panel-pane-inner > h2.pane-title').replaceWith(function() {
      return $("<a/>", {html: $(this).html()});
    });

    var link = listContainerRef.find('.panel-pane-inner > a');
    link.attr("class", "accordion-control collapsed");
    link.attr("data-toggle", "collapse");
    link.attr("role", "button");
    link.attr("data-target", "#category-filter-accordion");
    link.attr("aria-controls", "#category-filter-accordion");

    link.append('<span class="arrow"></span>');

    var accordionBody = listContainerRef.find('.accordion-wrapper > .pane-content');
    accordionBody.attr("id", "category-filter-accordion");
    accordionBody.attr("class", "accordion-filter-body collapse");
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

    if ($('#ding-library-front').length) {
        tranformLibraryToAccordion($('#ding-library-front'));
    }

    var list = $('.page-bibliotek .content-wrapper .layout-wrapper .pane-taxonomy-menu');
    if (list.length) {
      addCollapseToList(list);
    }
  });

})(jQuery);
  