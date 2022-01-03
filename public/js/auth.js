/**
 * To set value true or false in rememberMe checkbox
 * 
 * @return  
 */
$(function() {
  $("#rememberMe").attr('value', 'false');

  $("#rememberMe").on('change', function() {
    if ($("#rememberMe").is(':checked')) {
      $("#rememberMe").attr('value', 'true');
    } else {
      $("#rememberMe").attr('value', 'false');
    }
  });
});