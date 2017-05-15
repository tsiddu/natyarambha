// Responsive Project Pages

$(document).ready(function(){

var teaser = $('.teaser-img'),
    revtext = $('.rev-text'),
    arttext = $('.art-text'),
    whitebox = $('.white-box'),
    play = $('.play');



(function($,sr){

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null;
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 10);
      };
  }
  // smartresize
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');


// usage:
$(window).smartresize(function(){
  var width=$(window).width();

  if (width <= 800) {
  	teaser.insertBefore('.boxes');
  	whitebox.removeClass('fixed-h');
    play.attr("target","_blank");
  }

  else {
  	teaser.insertAfter('.teaser-text');
  	whitebox.addClass('fixed-h');
    play.removeAttr("target","_blank");
  }

  if (width <= 568) {
    revtext.insertAfter('.rev');
    arttext.insertAfter('.eye');
  }

  else {
    revtext.insertBefore('.dew-text');
    arttext.insertBefore('.caz-text');
  }

});


$(window).load(function(){
	var width=$(window).width();
	if (width <= 800) {
  	teaser.insertBefore('.boxes');
  	// quot.insertBefore('.lft');
  	$('div').removeClass('slide-able');
    whitebox.removeClass('fixed-h');
    play.attr("target","_blank");
  }

  if (width <= 568) {
    revtext.insertAfter('.rev');
    arttext.insertAfter('.eye');
  }
});




});
