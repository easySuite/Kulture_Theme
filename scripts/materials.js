(function ($) {
  "use strict";

  Drupal.behaviors.ding_ting_materials = {
    attach: function (context, settings) {

      console.log($('.field-type-ting-reference > .field-items', context),'---')

      $('.field-type-ting-reference > .field-items', context).slick({
        infinite: false,
        slidesToShow: 5,
        slidesToScroll: 2,
        nextArrow: '<i class="fa fa-next"></i>',
        prevArrow: '<i class="fa fa-prev"></i>',
        responsive: [
          {
            breakpoint: 1252,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 2,
              infinite: false,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 2,
              infinite: false,
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              infinite: false
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      });
    }
  }
})(jQuery);
