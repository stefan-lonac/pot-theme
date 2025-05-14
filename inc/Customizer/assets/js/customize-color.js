(function ($) {
  wp.customize.controlConstructor['color'] = wp.customize.Control.extend({
    ready: function () {
      var control = this;

      var colorPickerButton = control.container.find('.pot-theme-color-picker-button');

      colorPickerButton.on('click', function (e) {
        e.preventDefault();

        console.log("Color picker button clicked");

        var popover = $("<div class='custom-popover'>");
        var colors = ["#ff0000", "#00ff00", "#0000ff", "#000000", "#ffffff"];
        var html = "<ul>";
        colors.forEach(function (color) {
          html += "<li><button style='background-color:" + color + "' data-color='" + color + "'></button></li>";
        });
        html += "</ul>";
        popover.html(html);

        $("body").append(popover);

        popover.find("button").on("click", function () {
          var selectedColor = $(this).data("color");
          control.setting.set(selectedColor);
          control.container.find(".wp-color-result").css("background-color", selectedColor);
          popover.remove();
        });

        var offset = colorPickerButton.offset();
        popover.css({
          top: offset.top + colorPickerButton.outerHeight(),
          left: offset.left
        });
      });
    }
  });
})(jQuery);
