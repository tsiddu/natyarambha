<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Natyarambha - Lessons</title>
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

<style>
h3.description {
	font-weight: bold;
	letter-spacing: 2px;
	color: #999;
	border-bottom: 1px solid rgba(0, 0, 0, 0.1);
	padding-bottom: 5px;
}
.profile {
	margin-top: 25px;
}
.profile h1 {
	font-weight: normal;
	font-size: 20px;
	margin:10px 0 0 0;
}
.profile h2 {
	font-size: 14px;
	font-weight: lighter;
	margin-top: 5px;
}
.profile .img-box {
	opacity: 1;
	display: block;
	position: relative;
}
.profile .img-box:after {
	content:"";
	opacity: 0;
	background-color: rgba(0, 0, 0, 0.75);
	position: absolute;
	right: 0;
	left: 0;
	top: 0;
	bottom: 0;
}
.img-box ul {
	position: absolute;
	z-index: 2;
	bottom: 50px;
	text-align: center;
	width: 100%;
	padding-left: 0px;
	height: 0px;
	margin:0px;
	opacity: 0;
}
.profile .img-box:after, .img-box ul, .img-box ul li {
	-webkit-transition: all 0.5s ease-in-out 0s;
	-moz-transition: all 0.5s ease-in-out 0s;
	transition: all 0.5s ease-in-out 0s;
}
.img-box ul i {
	font-size: 20px;
	letter-spacing: 10px;
}
.img-box ul li {
	width: 30px;
	height: 30px;
	text-align: center;
	border: 1px solid #88C425;
	margin: 2px;
	padding: 5px;
	display: inline-block;
}
.img-box a {
	color:#fff;
}
a {
	color:#88C425;
}
a:hover {
	text-decoration:none;
	color:#519548;
}
i.red {
	color:#BC0213;
}
.glyphicon-user {
	font-size:18em;
	text-align:center;
	color:#c3c3c3;
}
.greyline-btm3 {
	width: 60px;
	border: solid 1px #e31b3f;
	display: block;
	margin: auto auto;
}
.prof-dis{line-height: 18px;
    font-size: 13px;}
</style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<div class="canvas" > 
  <!-- Navigation -->
  <?php include "nav.php"; ?>
      <!-- /.navbar-collapse --> 
    </div>
    <!-- /.container --> 
 
  <!-- /lessons -->
  <div class="clearfix"></div>
  
  
<div class="jumbotron jumbotron-sm" style="margin-top:50px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h2>
                    Credits </h2>
            </div>
        </div>
    </div>
</div>
 
  <div class="container">
  
  
  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-md-offset-4">
    <br>
                <h2 class="text-center" style="margin-left:30px;">Meet the team	</h2>
                <span class="greyline-btm3 text-center"></span> <br>
               
  
  </div>
    
    <section class="team">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 profile col-md-offset-4">
              <div class="img-box"> <img class="img-responsive img-rounded" src="img/ASJ.jpg" data-holder-rendered="true" > </div>
            <h1>Ananda Shankar Jayant
</h1>
            <h2>Concept and Choreography</h2>
            <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>-->
          </div>
          <div class="col-md-12 ">
            <div class="col-lg-12">
              <div class="row pt-md">
                <div class="clearfix"></div>
                
                
                
                
              
               
                <div class="clearfix"></div>
               
                <br>
                <h2 class="text-center">Music</h2>
                <span class="greyline-btm3 text-center"></span> <br>
                <br>
                
                
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 profile">
                  <div class="img-box"> <img class="img-responsive img-rounded" src="img/Balasubramanyam.jpg" data-holder-rendered="true" style=" width:260px; margin:auto auto; display:block;" ></div>
                  <h1>TP Balasubramaniam</h1>
                  <h2>Percussion</h2>
                  <p>
                  
                  
                  
                  </p>
                  
                  
                  
                  <p class="prof-dis">T P Balasubramanyam is a critical and essential part of Shankarananda Kalakshetra and provides the rich and resonating percussion that signifies all of the institutions dance productions. He has toured with  the repertory widely in India, and overseas.<br/>

 A disciple of Shri SV Satyanarayana and Nemmani Somayajulu, Balu as he is fondly called is an active Mridangam and Ghatam player on the Carnatic music circuit too.<br/>

Balu's Mridangam accompanies the dancers on N&#257;tyarambha.</p>

                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 profile">
                   <div class="img-box"> <img style=" width:260px; margin:auto auto; display:block;" class="img-responsive img-rounded" src="img/Kolanka_Bros.jpg" data-holder-rendered="true" ></div>
                  <h1>Kolanka Brothers </h1>
                  <h2>Violin</h2>
                  <p class="prof-dis">
                  
                  
                  The brothers Kolanka Sai Kumar and Kolanka Anil Kumar, the very popular violinist duo have composed and played the lilting musical notes accompanying every adavu, setting the music to suit the texture and nuances of the adavus<br/>
 
Trained under the well known violinist Shri Peri Sree Rama Murthy, both the brothers, have been an essential part of the Shankarananda Kalakshetra ensemble touring regularly, even as they continue to perform as soloists and as a duo on the Carnatic Music circuit.
</p>
                </div>
                <div class="clearfix"></div>
                
                
               <br>
                <h2 class="text-center">Dance	</h2>
                <span class="greyline-btm3 text-center"></span> <br>
                <br>
                
                
                
                <div class="col-lg-4 col-md-3 col-sm-4 col-xs-12 profile">
                  <div class="img-box"> <img class="img-responsive img-rounded" src="img/kavitha.jpg" data-holder-rendered="true" > </div>
                  <h1>Krithika Varsha</h1>
                  <h2>Dancer</h2>
                  <p class="prof-dis">Krithika Varsha, an emerging soloist, faculty member  and an  integral part of the Shankarananda Kalakshetra repertory, has essayed lead roles in performances  across major festivals in India and overseas, such as; Corfu Festival, Greece, Syria, Edinburgh Mela and Festivals of India in Russia, Brazil, Jakarta, Indonesia, and USA and Canada. 
<br/>
Krithika Varsha demonstrates adavus  for the videos on N&#257;tyarambha
</p>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-4 col-xs-12 profile">
                  <div class="img-box"> <img class="img-responsive img-rounded" src="img/sneha.jpg" data-holder-rendered="true" > </div>
                  <h1>Sneha Magapu </h1>
                  <h2>Dancer & Product Head</h2>
                  <p class="prof-dis">Sneha Magapu, a lead dancer and faculty member of Shankarananda Kalakshetra, pursues a full time career as a software engineer, in Microsoft R&D, alongside her passion for dance

She has toured with the Shankarananda Kalakshetra   ensemble as a lead artiste at the Festival of India in Brazil in 2011, USA and Canada tour 2014 and ICCR tour to Korea and China 2015.
<br/>
Sneha Magapu demonstrates adavus for the videos on N&#257;tyarambha.
</p>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-4 col-xs-12 profile">
                  <div class="img-box">  <img class="img-responsive img-rounded" src="img/Jinnakaraj.jpg" data-holder-rendered="true" > </div>
                  <h1>Jinakaraj </h1>
                  <h2>Dancer</h2>
                  <p class="prof-dis">Jinnakaraj MP Is a Bharatanatyam dancer trained under Kalakshetra Vilasini, and Kalakshetra Usha G Menon . He later came under the tutelage of  Ananda Shankar Jayant, soon becoming an important part of the Shankarananda Kalakshetra repertory, performing in major festivals in India and  in Festivals of India at Corfu, Syria, Edinburgh, Russsia, and Brazil 
<br/>
Jinnakaraj demonstrates a few adavus for the videos on N&#257;tyarambha 
</p>
                </div>
                <div class="clearfix"></div>
                
                
                 <br>
                <h2 class="text-center">Design</h2>
                <span class="greyline-btm3 text-center"></span> <br>
                <br>
                
                
                
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 profile">
                    <div class="img-box"> <img style=" width:260px; margin:auto auto; display:block;" class="img-responsive img-rounded" src="img/Pratima.jpg" data-holder-rendered="true" ></div>
                  <h1>Pratima Sagar</h1>
                  <h2>Logo design & chapter sketches</h2>
                  <p class="prof-dis">
                  Pratima Sagar, an artist and cultural commentator;  has been a vital and indispensable part of the aesthetic that Shankarananda Kalakshetra represents.<br/>
Pratima's free style drawings, sketches and paintings, have anchored many of the conferences, books, brochures and events that have been created and presented by Ananda Shankar Jayant<br/>

As, founder director of Bhairava Publications, Pratima  edits, designs and publishes coffee table books and  catalogues  on performing and visual arts <br/>

Pratima's  delicate free style sketches and design brings alive the logo and chapter delineations on N&#257;tyarambha. <br/>

                  
                  </p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 profile">
                  <div class="img-box"> <img style=" width:260px; margin:auto auto; display:block;" class="img-responsive img-rounded" src="img/aditi.jpg" data-holder-rendered="true" >  </div>
                <h1>Aditi Nigam</h1>
                  <h2>Pencil sketches for adavus</h2>
                  <p class="prof-dis">
                  Aditi Nigam is a Bharatanatyam dancer, painter, animation artist, research scholar and a regular performing artiste of the Shankarananda Kalakshetra repertory, having performed in USA, Canada, Korea and China<br/>

Aditi combines her multiple talents, as a dancer and   animation artist, to draw the detailed pencil sketches for the adavus.


                  
                  </p>
                
                </div>
                <!--<div class="col-lg-4 col-md-3 col-sm-4 col-xs-12 profile">
                  <div class="img-box"> <img src="https://d30su0b7sry5gh.cloudfront.net/repo/wdUzt3Ih/images/QnblY2Dd.jpg" class="img-responsive"> </div>
                </div>-->
                <div class="clearfix"></div>
                
                
                 <br>
                <h2 class="text-center">Others</h2>
                <span class="greyline-btm3 text-center"></span> <br>
                <br>
                
                
                
            
                
                
                
                
                <div class="col-md-12  profile">




<h1>Dance videos:</h1>   K Padmavathi and Madhu Rayudu

<h1>Promo video:</h1>   The Chitrakars
with performance by Soundarya Lahari, Neha Sathanapalli, Smt. Naga Lakshmi and students of Shankarananda Kalakshetra

<h1>Development:</h1> 
<b>UI/UX Design –</b> Rama Chandra<br/>
<b>Development –</b> Siddhartha Verma

<h1>Text and editing:</h1>
Ananda Shankar Jayant,
Chelna Galada,
Krupa Ravi,
Lahari Jalamangala,
Nandini Bhamidipati,
Shrinidhi Narasimhan



                </div>
                
                
                
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="clearfix"></div>
  <br>
  <br>
  
  <!-- Footer --> 
  <br>
  <br>
  <br>
  <br>
  <br>
    <footer>

 <?php include 'footer.php' ?>
 </footer>
</div>
<!-- jQuery --> 
<script src="js/jquery.js"></script> 

<!-- Bootstrap Core JavaScript --> 
<script src="js/bootstrap.min.js"></script> 

<!-- Plugin JavaScript --> 
<script src="js/jquery.easing.min.js"></script> 

<!-- Custom Theme JavaScript --> 
<script src="js/grayscale.js"></script> 

<!-- Menubar JS--> 
<script src="js/jasny-bootstrap.min.js"></script> 

<!-- Custome JS--> 
<script src="js/custom.js"></script>
</body>
</html>
