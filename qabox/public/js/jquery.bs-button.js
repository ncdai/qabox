(function ($) {
  $.fn.loadingState = function (options) {
    const settings = $.extend({
      text: 'Đang xử lí ...',
      disableButton: true
    }, options);

    return this.each(function () {
      const $element = $(this);

      const originalText = $element.text();
      const originalDisabled = $element.prop('disabled');

      $element.text(settings.text);

      if (settings.disableButton) {
        $element.prop('disabled', true);
      }
    });
  };
}(jQuery));
