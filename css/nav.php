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
        <a class="navbar-brand hidden-xs hidden-sm" href="index.php" > <img src="img/logo-w.png" width="120"  alt="logo"> </a>
         <a style="width:40px; padding:4px; margin-top:7px; " class="visible-xs visible-sm" href="index.php" > <img src="img/s-logo.png" width="100%"   alt="logo"> </a>

		</div>
      <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
        <ul class="nav navbar-nav">
          <li class="hidden-xs"> 
			<form action="search.php" method="post">
				<span class="input-group custom-search-form sform" style="max-width:250px;">
				<input type="text" class="form-control" name="search">
				<span class="input-group-btn">
				<button class="btn btn-default" type="submit"> <span class="glyphicon glyphicon-search"></span> </button>
				</span> </span><!-- /input-group --> 
			</form>
          </li>
         <!-- <li> <a  href="index.php"><i class="glyphicon glyphicon-home"></i></a> </li> -->
		 <li class="visible-xs"> 
			<form action="search.php" method="post">
				<span class="input-group custom-search-form sform" style="max-width:250px;">
				<input type="text" class="form-control" name="search">
				<span class="input-group-btn">
				<button class="btn btn-default" type="submit"> <span class="glyphicon glyphicon-search"></span> </button>
				</span> </span><!-- /input-group --> 
			</form>
          </li>
			
          <li> <a  href="lessons.php">Lessons</a> </li>
          
          <?php 
		  if($_SESSION['checker']){
			?>
			<li> <a  href="workouts.php">Workouts</a> </li>
			
			 
			
			
			<li class="main-dropdown">
			 <div class="dropdown">
			
              <button href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php if($_SESSION['fb_image']){ ?><img id="pic" src="<?php echo $_SESSION['fb_image'];?>" /> <?php } ?> <?php echo $_SESSION['name'] ;?> <span class="caret"></span></button>
              <ul class="dropdown-menu" >
				<li> <a  href="settings.php" >Settings</a> </li>
				<li> <a  href="login.php?logout=true" >Signout</a> </li>
			</ul>
            </div>
			</li>
			 
			<?php 
		  }
		  else{ ?>
          <li> <a  href="login.php">sign in</a> </li>
          <li> <a  href="signup.php">signup</a> </li>
		  <?php } ?>
		  <li>
		  
		  </li>
        </ul>
      </div>
      <!-- /.navbar-collapse --> 
    </div>
    <!-- /.container --> 
  </nav>
  <style>
	img#pic {
    background-repeat: no-repeat;
    background-position: 50%;
    border-radius: 50%;
    width: 25px;
    height: 25px;
}
  </style>