/*
$(document).ready(function() {
    $(".select-complex").hide();
    $(".addto-paly").click(function() {
        $(".select-complex").toggle();
    });
});
$(document).ready(function() {

    $(".addto-workout").click(function() {
        //alert($(this).parent.attr('id'));
        $(this).parent().parent().addClass("liOpacity");
        //$("#all-vid>ul>li").addClass("liOpacity"); 
    });


});   */
//video


//menu
var nav = 1;
$(document).ready(function() {
    $('#menu_btn').click(function() {
        if (nav == 1) {
            nav = 0;
            $('#menu_btn').html("<span class='glyphicon glyphicon-remove' aria-hidden='true' style='color:#FFF !important;'></span>");
        } else {
            nav = 1;
            $('#menu_btn').html("<span class='icon-bar' style=''></span>    <span class='icon-bar'></span>    <span class='icon-bar'></span>");
        }
    });
});



// jQuery to collapse the navbar on scroll
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});

//toggle video and content

$(".learnMore").click(function() {

     $(".toggl-video").hide();
    $(".vid-det-cont").show();
    $("#small_player").show();



    // $(".toggl-video").animate({opacity:'0'}	);	
    //$(".sm-thumb-vid, .content-video").show();	
    //$(".big-vid > li > a").css("display","none");
});


$(".watchVid").click(function() {
     $(".toggl-video").show();
    $(".vid-det-cont").hide();
    $("#small_player").hide();
});

$(".strip-video").mouseenter(function() {
    $(".nexPrebtn").fadeIn();
});
$(".strip-video").mouseleave(function() {
    $(".nexPrebtn").fadeOut();
});

//gallery
$(document).ready(function() {
    $('#media').carousel({
        pause: true,
        interval: false,
    });
});


// Create a clone of the menu, right next to original.
$('.menu').addClass('original').clone().insertAfter('.menu').addClass('cloned').css('position', 'fixed').css('top', '0').css('margin-top', '50px').css('z-index', '500').removeClass('original').hide();



// Script for selection a video