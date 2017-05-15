<?php








?>

var request = $.ajax({
  url: "ajax.php",
  type: "POST",
  data: { username : "" },
  dataType: "html"
});
 
request.done(function( msg ) {
  $( "#log" ).html( msg );
});
 
request.fail(function( jqXHR, textStatus ) {
  alert( "Request failed: " + textStatus );
});