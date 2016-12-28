/**
 * @file
 * Description.
 */

(function ($, Drupal) {

  Drupal.behaviors.fontawesomeIconpicker = {
    attach: function (context, settings) {
      $(context).find('.fontawesome-iconpicker-element').once('jsFontawesomeIconpicker').each(function () {
        $(this).iconpicker();
      });
    }
  }

})(jQuery, Drupal);