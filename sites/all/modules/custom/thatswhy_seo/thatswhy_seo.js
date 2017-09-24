(function($) {
  Drupal.theme.prototype.hello = function(text) {
    return '<h2>' + text + '</h2>';
  }

  $().ready(function() {
    $('#hello-world').html(Drupal.theme('hello', 'Hello world!'));
  });
}) (jQuery);
