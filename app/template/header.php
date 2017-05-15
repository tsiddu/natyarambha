<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Natyam</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="admin" >

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="img/favicon.png">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body style='font-family: 'Open Sans', sans-serif;' <!--style="background:rgba(255, 255, 255, 0.5) url('img/Bharatanatyam11.jpg')  no-repeat;background-size: 100%;" -->
<div class="container" style='width:1000px;'>
	<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">
				<div class="span12">
				</div>
			</div>
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container-fluid">
						 <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a>
<a href="http://test.schemax.in/natyam/app/" class="brand">
<img style="position: absolute;top: 10px;" src="../images/lg.png" />
</a>
						<div class="nav-collapse collapse navbar-responsive-collapse">
							<?php
							if($active_user==true)
							{
								if($user_access == 'admin')
								{
								?>
								<!-- admin -->
								
								<ul class="nav" style="margin-left:100px">
									<li <?php if($module=='users'){echo 'class="active"';} ?> >
										<a href="?module=users&task=view">Users</a>
									</li>
									<li <?php if($module=='videos'){echo 'class="active"';} ?>>
										<a href="?module=videos&task=view">Videos</a>
									</li>
									<li <?php if($module=='lessons'){echo 'class="active"';} ?>>
										<a href="?module=lessons&task=view">Lessons</a>
									</li>
									<li <?php if($module=='invoices'){echo 'class="active"';} ?>>
										<a href="?module=invoices&task=view">Invoices</a>
									</li>
									<li <?php if($module=='Workouts'){echo 'class="active"';} ?>>
										<a href="http://natyarambha.com/workouts.php">Workouts</a>
									</li>
								</ul>
								<?php
								}
								else
								{
								?>
								<ul class="nav" style="margin-left:100px">
									<?php
									$expdate = $_SESSION['date_sub_exp'];
									$diff = (strtotime($expdate)) - strtotime(date("M d Y "));
									$diff = floor($diff/3600/24);
									if($diff >=0)
									{
									?>
									<li <?php if($module=='dashboard'){echo 'class="active"';} ?>>
										<a href="?module=dashboard&task=view">Dashboard</a>
									</li>
									<li <?php if($module=='learn'){echo 'class="active"';} ?>>
										<a href="?module=learn&task=view_lessons">Learn</a>
									</li>
									<li <?php if($module=='Workouts'){echo 'class="active"';} ?>>
										<a href="?module=Workouts&task=view">Work outs</a>
									</li>
									<li <?php if($module=='invoices'){echo 'class="active"';} ?>>
										<a href="?module=invoices&task=view_user_invoices">My invoices</a>
									</li>
									<?php
									}
									if( $diff <= 5 )
									{
									?>
										<li>
											<a href="?module=invoices&task=Pay_bill">Invoices (You have <?php if($diff <=0){ echo "0";}else{echo $diff;}?> days of trail period)</a>
										</li>
									<?php
									}
									?>
								</ul>
								
								<?php
								}
							}else
							{
							?>
							<ul class="nav" style="margin-left:100px">
								<li <?php if($task=='home'){echo 'class="active"';} ?> >
									<a href="?module=home&task=home">Home</a>
								</li>
								<li <?php if($task=='plans'){echo 'class="active"';} ?>>
									<a href="?module=home&task=plans">Our Plans</a>
								</li>
								<li <?php if($task=='about'){echo 'class="active"';} ?>>
									<a href="?module=home&task=about">About us</a>
								</li>
							</ul>
							<?php
							}
							?>
							<?php
							if($active_user==true)
							{
							?>
							<div class="pull-right">
								<form class="navbar-search pull-left" action="index.php?module=search&task=view" method="POST">
								<input type="text" name='search_value' style="width:200px" autocomplete="off" class="search-query span2" placeholder="Search Lessons/Workouts">
								</form>
							<ul class="nav pull-left">
								
								<li class="divider-vertical">
								</li>
								<li class="dropdown">
									 <a data-toggle="dropdown" class="dropdown-toggle" href="#">Hi <?php echo $name; ?><strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<?php
										if($user_access != 'admin')
										{
										?>
										<li>
											<a href="?module=users&task=profile_view"><i class="icon-user"></i>  Profile</a>
										</li>
										<li>
											<a href="?module=Workouts&task=Myworkouts"><i class="icon-film"></i>  My saved workouts</a>
										</li>
										<li>
											<a href="?module=learn&task=view_bookmarks"><i class="icon-eye-open"></i>  My lesson Bookmarks</a>
										</li>
										<li>
											<a href="?module=invoices&task=view_user_invoices"><i class="icon-list"></i>  Invoices</a>
										</li>
										<?php
										}
										?>
										<li class="divider">
										</li>
										<li>
											<a href="?module=users&task=change_password"><i class="icon-refresh"></i>  Change Password</a>
										</li>
										<li>
											<a href="?module=users&task=logout"><i class="icon-off	"></i>  Log-out</a>
										</li>
									</ul>
								</li>
							</ul>
							</div>
							<?php
							}
							else
							{
							?>
							<ul class="nav pull-right">
								<li <?php if($task=='login'){echo 'class="active"';} ?>>
									<a href="?module=users&task=login">Log-In</a>
								</li>
								<li <?php if($task=='register'){echo 'class="active"';} ?>>
									<a href="?module=users&task=register">Register</a>
								</li>
							</ul>
							<?php
							}
							?>
						</div>
						
					</div>
				</div>
				
			</div>
		</div>
	</div>