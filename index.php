<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>


<meta property="fb:app_id" content="1570270806522989" />
<meta property="og:url" content="http://natyarambha.com" />
<meta property="og:title" content="Natyarambha" />
<meta property="og:type" content="website" />
<meta property="og:image" content="http://natyarambha.com/img/vidBG.gif" />

<meta property="og:description" content="Natyarambha is a first of its kind portal for Bharatanatyam, an arts education initiative of Shankarananda Kalakshetra." />





<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>N&#257;ty&#257;rambha</title>
<link rel="shortcut icon" href="natya.ico"/>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/custom.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/jasny-bootstrap.min.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	

	
<script>
// when .modal-wide opened, set content-body height based on browser height; 200 is appx height of modal padding, modal title and button bar

$(".modal-wide").on("show.bs.modal", function() {
  var height = $(window).height() - 200;
  $(this).find(".modal-body").css("max-height", height);
});



</script>



	<style>
	

	
	
	.wV{ font-size:2em; color:#fff; padding:0.3em; border:solid 5px #fff; opacity:0.7; border-radius:180px; }
	.intro {
    position: absolute;
    background: none;
    top: 45%;
}

.modal-dialog, .modal-content, .modal-body{height:96%;} 
.modal.modal-wide .modal-dialog {
  width: 90%;
 
 
}
.modal-wide .modal-body {
  overflow-y: auto;
}

#tallModal .modal-body p { margin-bottom: 900px }
.modal-backdrop
{
    opacity:1 !important;
}

	@media only screen and (min-width : 420px) and (max-width : 767px) {
/* Styles */

.intro {
    
    top: 0%;
}

}

@media only screen and (min-width : 320px) and (max-width : 420px) {
/* Styles */

.intro {
    
    top: -25%;
}

}
	</style>
</head>

<body >


<div id="tallModal" class="modal modal-wide fade videoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<div class="clearfix"></div>
       
      </div>
      <div class="modal-body">
        
		
		<iframe class="embed-responsive-item"  type="text/html" width="100%" height="98.5%" src="https://www.youtube.com/embed/OQJgE4PeiSs?&loop=1&rel=0&showinfo=0&color=white&iv_load_policy=3&playlist=OQJgE4PeiSs"
      frameborder="0" allowfullscreen></iframe>
		
		
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="canvas" > 
  <!-- Navigation -->
  
   <!-- Navigation -->
  <?php include 'nav.php'; ?>
 
<div style="position:relative; margin-bottom:0px !important; margin-top:50px;">
 
 <video autoplay="" loop="" poster="http://natyarambha.com/img/vidBG.gif" id="bgvid"> 
    <!-- WCAG general accessibility recommendation is that media such as background video play through only once. Loop turned on for the purposes of illustration; if removed, the end of the video will fade in the same way created by pressing the "Pause" button 
  <source src="//demosthenes.info/assets/videos/polina.webm" type="video/webm">
   -->
   
	<!--<source src="http://demosthenes.info/assets/videos/polina.webm" type="video/webm">-->
	 <source src="http://natyarambha.com/Videos/Natyarambha_muted_vlc.mp4" type="video/mp4">
  </video>
  
 
  
  
  
  
  
  <!-- Intro Header -->
 <header class="intro" > 
      <a href="#" data-toggle="modal" data-target="#tallModal" class="wV" > Watch Video</a> 
  </header>
  
  
  </div>
  
  <!-- About Section -->
  <section id="about" class="abt-nat content-section text-left" style=" margin-top:-20px;" >
    <br/>
      <div class=" container">
	  
	<div>  
        <h3>About N&#257;ty&#257;rambha</h3>
		
		
		<p>Practice, has been a constant companion in my life as an Indian classical

dancer. ‘Practice!’ is also the one word I use most, as a teacher of

Bharatanatyam; for both the young student in training and the established

performer.</p>

<p>Eager to facilitate an engaging and exciting practice at home option and bridge

the gap between classroom training and home rehearsals, we conceived

N&#257;ty&#257;rambha, a first of its kind Bharatanatyam practice app, that is interactive

and comes with detailed guidance, and a choice of practice options.</p>

<p>Heading Project N&#257;ty&#257;rambha is Sneha Magapu, who has enabled a traditional

dance form ride the technology wave, by synergising her unique skill set of a

software professional and a Bharatanatyam dancer.</p>

<p>Inspired by Make in India, N&#257;ty&#257;rambha, that intersects at the crossroads of

tradition and technology, is our offering to the world of Bharatanatyam

dancers, to help hone their talent, skill and training into excellence and

perfection.<p>

<p>We hope with N&#257;ty&#257;rambha you will be able to practice like never before!</p>
<p><span class="pull-right tex-right"><img src="img/sig.png"/></span></p>
<div class="clearfix"></div>
<p></p>

</div>

<br/>     
	 </div>
    
  </section>
  <section  class="container  text-center">
    <div>
      <br/>
        <h3>Why N&#257;ty&#257;rambha</h3>
        <span class="greyline-btm3"></span> <br>
        <br>
        <br>
        <br>
        <div class="col-md-3 col-xs-12"> <img src="img/all-skill.png" border="0" />
          <h4 class="text-center">FOR ALL SKILL LEVELS</h4>
          <p class="text-left">N&#257;ty&#257;rambha is easy for beginners, yet powerful for pros. While it is an easy tool for beginners to learn and practice, N&#257;ty&#257;rambha is also an aid for pros to perfect and take their skills to the next level.</p>
        </div>
        <div class="col-md-3 col-xs-12"> <img src="img/personalize.png" border="0" />
          <h4 class="text-center">PERSONALIZED ROUTINE</h4>
          <p class="text-left">While N&#257;ty&#257;rambha 
            bootstraps you with you a wide range of handpicked routines tailored to all levels, it also allows you to create your own routine for that perfect personalized practice session.</p>
        </div>
        <div class="col-md-3 col-xs-12"> <img src="img/sharing.png" border="0" />
          <h4 class="text-center">EASY SHARING</h4>
          <p class="text-left">Whether you are a student or a teacher, N&#257;ty&#257;rambha lets you share the personal routines you created with others.</p>
        </div>
        <div class="col-md-3 col-xs-12"> <img src="img/anytine.png" border="0" />
          <h4 class="text-center">ANYTIME, ANYWHERE</h4>
          <p class="text-left">All that it takes is your 
            favourite device and a little bit of space to stretch your limbs. N&#257;ty&#257;rambha on and practice on. No excuses please!</p>
        </div>
      
    </div>
  </section>
  <br>
  <section  class=" text-center pricing">
    <div class="container">
      <div class="row">
      
          <br>
          <h3>Pricing</h3>
          <span class="greyline-btm3"></span> <br>
          <br>
          <br>
         
          <div class="col-md-4 col-lg-3 box-pri col-xs-12 col-md-offset-1 col-lg-offset-2">
            <div class="row">
              <h3>FREE<br/>
                <span class="greyline-btm2"></span></h3>
            </div>
            <br/>
            <p class="para1"><strong>Limited access</strong></p>
            <p class="para2">Provides access to 3 <br>
              chapters of adavus, 3<br>
              N&#257;ty&#257;rambha practice routines and one <br>
              personalized practice routine. <br/>
              <span class="greyline-btm"></span> </p>
            <br>
            <br>
            <p class="latline">Suitable for trial</p>
            <div>
              <button class="btn btn-primary btn-default"><a href="http://natyarambha.com/signup.php" class="btnColo">Start Trial</a></button>
            </div>
            <br>
          </div>
          <div class="col-md-4  col-lg-3 box-pri col-xs-12 col-md-offset-2" style="height:440px">
            <div class="row">
              <h3>PREMIUM<br/>
                <span class="greyline-btm2"></span></h3>
            </div>
            <br/>
            <p class="para1"><strong>No restrictions here!</strong></p>
            <p class="para2">Provides access to everything N&#257;ty&#257;rambha has to offer - all adavus, <br>
              all N&#257;ty&#257;rambha practice routines and an unlimited number of personalized practice routines.<br/>
              <span class="greyline-btm"></span> </p>
            <div>
            <br/>
              <p  class="latline">Rs. 2500 - One time</p>
            </div>
            <div>
              <button class="btn btn-primary btn-default"><a href="http://natyarambha.com/payment.php" class="btnColo">subscribe now</a></button>
            </div>
            <br>
          </div>
          <div class="clearfix"></div>
        
      </div>
    </div>
    <br>
    <br>
  </section>
  <section class="container  text-center">
    <div class="row">
      <div><br>
        <br>
        <h3>What are people saying about N&#257;ty&#257;rambha?</h3>
        <span class="greyline-btm3"></span> <br>
        <br>
     
        <div class="bs-example test" >
		
		
		<div class="media">
            <div class="media-left"> <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="/img/vpd.jpg" data-holder-rendered="true" style="width: 120px; height: 120px;"> </a> </div>
            <div class="media-body"><p>Smt. ANANDA SHANKAR JAYANT one of the prominent alumni of the KALAKSHETRA has come out with a unique, innovative, and imaginative web system titled NAATYAARAMBHA.  
			Unlike a web class, this will enable every practitioner of Bharatanaatyam, irrespective of their style differences to practice, remember and improve their total standard of dancing.  The application is very easy for both teachers and students to practice with inspiring musical accompaniments.<br/>
			I recommend every Bharatanaatyam artiste to subscribe to this new innovative and  meticulously crafted web system by a stalwart.
			</p>
            <p class="text-muted"> <b>Naatyaachaarya V.P.Dhananjayan</b>, Naatyacharya,  performer, choreographer and Padmabhushan awardee</p>
            </div>
          </div>
          <br>
		  
		  
		   <div class="media">
            <div class="media-left"> <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="/img/cv.jpg" data-holder-rendered="true" style="width: 120px; height: 120px;"> </a> </div>
            <div class="media-body"><p> This is the age of the app. And the app is what all youngsters gravitate towards. In addition, it is a fast life that they lead with numerous pressures and preoccupations, finding very little time to practice with the Acharya on a daily basis, as did our generation. Geographical restrictions too, sometimes augment this problem. Given this scenario, natyarambha offers a readymade tool for students of natyam to keep essential practice going. Keeping in sync with times, Dr. Ananda Shankar Jayant has shown farsightedness in developing this app.</p>
            <p class="text-muted"> <b>Chitra Visweswaran</b>, Performer, guru,  choreographer and Padmashri awardee</p>
            </div>
          </div>
          <br>
		
		
          <div class="media">
            <div class="media-left"> <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="/img/AnitaRatnam.jpg" data-holder-rendered="true" style="width: 120px; height: 120px;"> </a> </div>
            <div class="media-body"><p> With Bharatanatyam now a global form, it is timely for technology to link with art for a larger purpose. From Baku to Barcelona, dancers of all shapes, sizes, nationalities and faiths have embraced Bharatanatyam for its splendour and irresistible charm. N&#257;ty&#257;rambha creates the platform to synergise practice, knowledge, rehearsal and a sense of community on a global cyber dance class. 
			Congratulations to ANANDA SHANKAR JAYANT, a fearless dreamer, who has conceived this software to unite us all through time and space into remembering that our bodies in constant practice is how we acknowledge this international sororiety we call DANCE.</p>
		    <p class="text-muted"><b> Dr Anita R Ratnam</b>, Performer-Scholar, writer and cultural activist</p>
            </div>
          </div>
          <br>
          
          
          
        </div>
      </div>
    </div>
    
    
    
    
    
    
    
    
  </section>
  
  <!-- Tiles Section -->
  
  <div class="clearfix"></div>

  
  <!-- Footer --> 
  <br>
  <br>
  <div class="text-center pricing" style="background:#B5E0F1;">
    <div class="container"> <br>
    
    
    
     <h2>About Us</h2>
      <span class="greyline-btm3"></span> <br>
    
    
      <br>
      <div class="bs-example test" >
        <div class="media">
          <div class="media-left"> <img class="media-object" src="/img/asj-2.jpg" width="120" height="120" alt="ASJ">  </div>
          <div class="media-body">
         <p >  <b>Shankarananda Kalakshetra</b>, a renowned center for excellence in Bharatanatyam, established in 1979, has forged a reputation for   producing outstanding dancers, dedicated teachers,committed scholars and an ensemble that has performed across five continents to critical acclaim. Shankarananda Kalakshetra’s, immersive engagement   with   the arts, spans   creative choreography, traditional and contemporary dance productions, signature national festivals, academic dance conferences, in depth publications and arts education. N&#257;ty&#257;rambha is Shankarananda Kalakshetra’s latest arts education initiative.</p>



<p><b>Dr Ananda Shankar Jayant</b>, the Artistic Director of <b>Shankarananda Kalakshetra</b>, is celebrated as one of India’s most eminent and renowned classical dancer, choreographer and dance scholar. With an impeccable training in Bharatanatyam from Kalakshetra, Ananda a much loved Guru, brings   to N&#257;ty&#257;rambha, four   decades of experience, of teaching Bharatanatyam to young aspirants at Shankarananda Kalakshetra. For her contribution to the field of classical art, she was conferred the &quot;<b>Padma Shri</b>&quot; (India’s 4 th  highest civilian award) and the <b>Sangeet Natak Akademi Puraskar</b> for Bharatanatyam. <b>Ananda</b> inhabits the worlds of administration, academics, technology and the arts; straddling them with equal ease.</p>

<p>N&#257;ty&#257;rambha, is Ananda’s offering to the world of Bharatanatyam dancers, to help hone their talent, skill and training into excellence and perfection.</p>

<p>Heading   Project  N&#257;ty&#257;rambha is <b>Sneha Magapu</b>, bringing  a unique  combination of art and technology, treading  the two tracks of being a Bharatanatyam dancer and a product manager at a leading software company. On the lookout for ways to make her two worlds meet, and synergising her entrepreneurial spirit, technical background and love for the art form, Sneha, spearheads the N&#257;ty&#257;rambha project, and is    excited   about the immense possibilities and opportunities, that technology can now enable    for the many performing arts of India.</p>


</p> </div>
        </div>
        <br>
        <br>
      </div>
    </div>
  </div>
  <div class="text-center pricing"> <br>
    <div class="container">
      <h3>So what are you waiting for?</h3>
      <span class="greyline-btm3"></span> <br>
      <br>
      <br>
      <button class="btn btn-lg btn-primary btn-default lst-btn"><a href="http://natyarambha.com/signup.php" class="btnColo">Try it now - It's free</a></button>
      <br>
      <br>
      <br>
    </div>
  </div>
   <footer>

 <?php include 'footer.php' ?>
 </footer>
</div>
<!-- jQuery --> 
<script src="js/jquery.js"></script> 

<!-- Bootstrap Core JavaScript --> 
<script src="js/bootstrap.min.js"></script> 

<!-- Plugin JavaScript
<script src="js/jquery.easing.min.js"></script>  --> 

<!-- Custom Theme JavaScript 
<script src="js/grayscale.js"></script> --> 

<!-- Menubar JS--> 
<script src="js/jasny-bootstrap.min.js"></script> 

<!-- Custome JS--> 
<script src="js/custom.js"></script> 

<!-- Home full video JS--> 
<!--<script src="http://pupunzi.com/mb.components/mb.YTPlayer/demo/inc/jquery.mb.YTPlayer.js"></script>-->
<script>
$('.videoModal').on('hide.bs.modal', function(e) {    
    var $if = $(e.delegateTarget).find('iframe');
    var src = $if.attr("src");
    $if.attr("src", '/empty.html');
    $if.attr("src", src);
});
</script>
<script>
var vid = document.getElementById("bgvid");
var pauseButton = document.querySelector("#polina button");

function vidFade() {
  vid.classList.add("stopfade");
}

vid.addEventListener('ended', function()
{
// only functional if "loop" is removed 
vid.pause();
// to capture IE10
vidFade();
}); 


pauseButton.addEventListener("click", function() {
  vid.classList.toggle("stopfade");
  if (vid.paused) {
    vid.play();
    pauseButton.innerHTML = "Pause";
  } else {
    vid.pause();
    pauseButton.innerHTML = "Paused";
  }
})


</script>


</body>
</html>
