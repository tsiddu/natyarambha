<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
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
	

<style>
.intro{ position:absolute; background:none; bottom:10%;}

video {
	position: relative;
	top:0px;
	left: 0px;
	/*min-width: 100%;
	min-height: 100%;*/
	width: 100%;
	height: auto;
	z-index: -100;
	/*transform: translateX(-50%) translateY(-50%);
	background: url('//demosthenes.info/assets/images/polina.jpg') no-repeat;*/
	background-size: cover;
	transition: 1s opacity;
}
.content-section {
	padding-top: 0px;
}
.abt-nat p, .container p{font-size:14px;}
.abt-nat {
	background:#e31b3f;
	color:#fff;
	
}
.pricing {
	background:#ECECEC;
}
.box-pri {
	background:#fff;
}
.box-pri h3 {
	background:#e31b3f;
	color:#fff;
	padding:20px;
	margin-top:0px;
}
.greyline-btm {
	width:30px;
	border:solid 1px #eff0f2;
	display:inline-block;
	margin:auto auto;
}
.box-pri .btn {
	border-radius: 50px !important;
}
.box-pri .para1 {
	font-size:21px;
}
.box-pri .para2 {
	font-size:14px;
}
.greyline-btm2 {
	width:30px;
	border:solid 1px #EC8089;
	display:inline-block;
	margin:auto auto;
}
.greyline-btm3 {
	width:60px;
	border:solid 1px #e31b3f;
	display:inline-block;
	margin:auto auto;
}
.test .media-body {
	text-align:left;
	font-size:18px;
}
.test .media-object {
	border-radius:180px;
}
.test .media-body p {
	font-size:14px;
	margin-top:10px;
	
}
..social-buttons li {
background-color:#292d35;
}
.social-buttons li a {
	background-color:#3e4249;
	border-radius:1px !important;
	border:solid 1px #3e4249;
	font-size:20px;
}
.social-buttons {
	text-align:left;
}
.lst-btn {
	border-radius:180px;
}
.latline{ margin-top:10px; font-size:20px !important;}
.btnColo, .btnColo:hover{ color:#fff; }
h2{ margin-top:0px; }


.MsoNormal img{ width:100% !important;}
	img#pic {
    background-repeat: no-repeat;
    background-position: 50%;
    border-radius: 50%;
    width: 25px;
    height: 25px;
}
</style>
</head>

<body >
<div class="canvas" > 
  <!-- Navigation -->
  
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=1570270806522989";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse"> <i class="fa fa-bars"></i> </button>
        <a class="navbar-brand" href="index.php"> <img src="img/logo-w.png" width="120"  alt="logo"> </a> </div>
      <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
        <ul class="nav navbar-nav">
          <li> 
			<form action="search.php" method="post">
				<span class="input-group custom-search-form" style="width:250px;">
				<input type="text" class="form-control" name="search">
				<span class="input-group-btn">
				<button class="btn btn-default" type="submit"> <span class="glyphicon glyphicon-search"></span> </button>
				</span> </span><!-- /input-group --> 
			</form>
          </li>
         <!-- <li> <a  href="index.php"><i class="glyphicon glyphicon-home"></i></a> </li> -->
          <li> <a  href="lessons.php">Lessons</a> </li>
          
          <?php 
		  if($_SESSION['checker']){
			?>
			<li> <a  href="workouts.php">Workouts</a> </li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php if($_SESSION['fb_image']){ ?><img id="pic" src="<?php echo $_SESSION['fb_image'];?>" /> <?php } ?> <?php echo $_SESSION['name'] ;?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
				<li> <a  href="settings.php" style="color:#000;">Settings</a> </li>
				<li> <a  href="login.php?logout=true" style="color:#000;">Signout</a> </li>
			</ul>
            </li>
			 
			<?php 
		  }
		  else{ ?>
          <li> <a  href="login.php">sign in</a> </li>
          <li> <a  href="signup.php">signup</a> </li>
		  <?php } ?>
        </ul>
      </div>
      <!-- /.navbar-collapse --> 
    </div>
    <!-- /.container --> 
  </nav>
 
<div style="position:relative; margin-bottom:0px !important;">
   <video autoplay   id="bgvid" loop> 
    <!-- WCAG general accessibility recommendation is that media such as background video play through only once. Loop turned on for the purposes of illustration; if removed, the end of the video will fade in the same way created by pressing the "Pause" button 
  <source src="//demosthenes.info/assets/videos/polina.webm" type="video/webm">
   -->
    <source src="http://natyarambha.com/img/Natyarambha_Website.mp4" type="video/mp4">
  </video>
  
  <!-- Intro Header -->
 <!-- <header class="intro"> 
   <br>
      <br>
      <br>
      <div class="col-lg-12">
        <h1>N&#257;ty&#257;rambha</h1>
      </div>
      <a href="#about" class="btn btn-circle page-scroll"> <i class="fa fa-angle-double-down animated"></i> </a> 
  </header>-->
  
  
  </div>
  
  <!-- About Section -->
  <section id="about" class="abt-nat content-section text-center" style=" margin-top:-20px;" >
    <br/>
      <div class=" container">
        <h3>About N&#257;ty&#257;rambha</h3>
        <p><b>N&#257;ty&#257;rambha</b> is a first of its kind Bharatanatyam practice app,that intersects at the crossroads of tradition and technology, an arts education initiative of <b>Shankarananda Kalakshetra</b>, inspired by <b>Make in India</b>. </p>

		<p>N&#257;ty&#257;rambha, has been created to bridge the gap between classroom training and home rehearsals, for Bharatanatyam practitioners and students across the globe. With detailed guidance, and a choice of practice options, that is interactive and engaging, N&#257;ty&#257;rambha which can run on any of your devices, enables a traditional dance form ride the technology wave.</p>
<br/>     
	 </div>
    
  </section>
  <section  class="container  text-center">
    <div class="row">
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
         
          <div class="col-md-3 box-pri col-xs-12 col-lg-offset-2">
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
          <div class="col-md-3 box-pri col-xs-12 col-lg-offset-2" style="height:440px">
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
              <p  class="latline">Rs. 1499 - One time</p>
            </div>
            <div>
              <button class="btn btn-primary btn-default"><a href="http://natyarambha.com/signup.php" class="btnColo">subscribe now</a></button>
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
            <div class="media-left"> <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="/img/AnitaRatnam.jpg" data-holder-rendered="true" style="width: 120px; height: 120px;"> </a> </div>
            <div class="media-body"><p> With Bharatanatyam now a global form, it is timely for technology to link with art for a larger purpose. From Baku to Barcelona, dancers of all shapes, sizes, nationalities and faiths have embraced Bharatanatyam for its splendour and irresistible charm. N&#257;ty&#257;rambha creates the platform to synergise practice, knowledge, rehearsal and a sense of community on a global cyber dance class. 
Congratulations to ANANDA SHANKAR JAYANT, a fearless dreamer, who has conceived this software to unite us all through time and space into remembering that our bodies in constant practice is how we acknowledge this international sororiety we call DANCE.</p>
              <p class="text-muted"> Dr Anita R Ratnam, Performer-Scholar
</p>
            </div>
          </div>
          <br>
          
          
          
          <div class="media">
            <div class="media-left"> <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="/img/vpd.jpg" data-holder-rendered="true" style="width: 120px; height: 120px;"> </a> </div>
            <div class="media-body"><p>Smt. ANANDA SHANKAR JAYANT one of the prominent alumni of the KALAKSHETRA has come out with a unique, innovative, and imaginative web system titled NAATYAARAMBHA.  
Unlike a web class, this will enable every practitioner of Bharatanaatyam, irrespective of their style differences to practice, remember and improve their total standard of dancing.  The application is very easy for both teachers and students to practice with inspiring musical accompaniments.<br/>
I recommend every Bharatanaatyam artiste to subscribe to this new innovative and  meticulously crafted web system by a stalwart.

</p>
              <p class="text-muted"> Naatyaachaarya V.P.Dhananjayan
</p>
            </div>
          </div>
          <br>
          
              <div class="media">
            <div class="media-left"> <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="/img/cv.jpg" data-holder-rendered="true" style="width: 120px; height: 120px;"> </a> </div>
            <div class="media-body"><p> This is the age of the app. And the app is what all youngsters gravitate towards. In addition, it is a fast life that they lead with numerous pressures and preoccupations, finding very little time to practice with the Acharya on a daily basis, as did our generation. Geographical restrictions too, sometimes augment this problem. Given this scenario, natyarambha offers a readymade tool for students of natyam to keep essential practice going. Keeping in sync with times, Dr. Ananda Shankar Jayant has shown farsightedness in developing this app.

</p>
              <p class="text-muted"> Chitra Visweswaran
</p>
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
<script src="http://pupunzi.com/mb.components/mb.YTPlayer/demo/inc/jquery.mb.YTPlayer.js"></script>
</body>
</html>
