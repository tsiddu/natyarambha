<?php
session_start();
if($_SESSION['checker']){
	echo "<script>window.location = 'lessons.php';</script>";
}


 if(isset($_REQUEST['logout'])){

	 	unset($_SESSION['fb_token']);
		unset($_SESSION['checker']);
		unset($_SESSION['name']);	
		unset($_SESSION['User_id']);
		unset($_SESSION['user_access']);
		unset($_SESSION['User_type']);
		unset($_SESSION['date_sub_exp']);
		unset($_SESSION['fb_image']);
		unset($_SESSION['music']);
		unset($_SESSION['video']);
		unset($_SESSION['email']);
		session_destroy();
	 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'head.php'; ?>
<title>Natyarambha - Login</title>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<div id="tallModal" class="modal modal-wide fade videoModal">
  <div class="modal-dialog">
    <div class="modal-content">
	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Forgot password</h4>
      </div>
      <div class="modal-body">
        
		Please contact us at<a href="mailto:natyarambha@gmail.com?Subject=Hello%20Natyarambha" target="_top"> natyarambha@gmail.com </a> to help you reset your password.
		
		
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<div class="canvas" > 
<?php 

/* INCLUSION OF LIBRARY FILEs*/

	require_once( 'Facebook/FacebookSession.php');

	require_once( 'Facebook/FacebookRequest.php' );

	require_once( 'Facebook/FacebookResponse.php' );

	require_once( 'Facebook/FacebookSDKException.php' );

	require_once( 'Facebook/FacebookRequestException.php' );

	require_once( 'Facebook/FacebookRedirectLoginHelper.php');

	require_once( 'Facebook/FacebookAuthorizationException.php' );

	require_once( 'Facebook/GraphObject.php' );

	require_once( 'Facebook/GraphUser.php' );

	require_once( 'Facebook/GraphSessionInfo.php' );

	require_once( 'Facebook/Entities/AccessToken.php');

	require_once( 'Facebook/HttpClients/FacebookCurl.php' );

	require_once( 'Facebook/HttpClients/FacebookHttpable.php');

	require_once( 'Facebook/HttpClients/FacebookCurlHttpClient.php');



/* USE NAMESPACES */

	

	use Facebook\FacebookSession;

	use Facebook\FacebookRedirectLoginHelper;

	use Facebook\FacebookRequest;

	use Facebook\FacebookResponse;

	use Facebook\FacebookSDKException;

	use Facebook\FacebookRequestException;

	use Facebook\FacebookAuthorizationException;

	use Facebook\GraphObject;

	use Facebook\GraphUser;

	use Facebook\GraphSessionInfo;

	use Facebook\FacebookHttpable;

	use Facebook\FacebookCurlHttpClient;

	use Facebook\FacebookCurl;


//check if users wants to logout

	

	
	//2.Use app id,secret and redirect url 

	<?php include 'env.php'; ?>

	$redirect_url='http://natyarambha.com/login.php';



	//3.Initialize application, create helper object and get fb sess

	 FacebookSession::setDefaultApplication($app_id,$app_secret);

	 $helper = new FacebookRedirectLoginHelper($redirect_url);

	 $sess = $helper->getSessionFromRedirect();



	//check if facebook session exists

	if(isset($_SESSION['fb_token'])){

	 	$sess = new FacebookSession($_SESSION['fb_token']);

	}



	//logout

	$logout = 'http://natyarambha.com/login.php?logout=true';

	//4. if fb sess exists echo name 

	 	if(isset($sess)){
			//echo "fb session exists";
	 		//store the token in the php session

	 		$_SESSION['fb_token']=$sess->getToken();

	 		//create request object,execute and capture response

	 		$request = new FacebookRequest($sess,'GET','/me');

			// from response get graph object

			$response = $request->execute();

			$graph = $response->getGraphObject(GraphUser::classname());

			// use graph object methods to get user details

			$name = $graph->getName();

			$id = $graph->getId();

			$image = 'https://graph.facebook.com/'.$id.'/picture?width=300';

			$email = $graph->getProperty('email');

			
			
			$user_check_query = "SELECT count(*) as ct, User_id, email ,`user_access`,first_name,date_sub_exp,User_type,music , vis FROM `users` WHERE `fbid`='$id'"; 
			include 'db1.php';
			$result = mysqli_query($db,$user_check_query);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			//foreach($results as $row)
			//{
				$user_verification = $row['ct'];
				$login_name = $row['first_name'];
				$User_id = $row['User_id'];
				$user_type = $row['User_type'];
				$user_access = $row['user_access'];
				$date_sub_exp = $row['date_sub_exp'];
				$email = $row['email'];
				$music = $row['music'];
				$video = $row['vis'];
			//}
			//echo "Loading..." ;
			if($user_verification == 1)
			{
				$_SESSION['checker'] = true;
				$_SESSION['name'] = $login_name;	
				$_SESSION['User_id'] = $User_id;	
				$_SESSION['user_access'] = $user_access;
				$_SESSION['date_sub_exp'] = $date_sub_exp;
				$_SESSION['login_type'] = 'fbook';
				$_SESSION['email'] = $email;
				$_SESSION['music'] = $music;
				$_SESSION['User_type'] = $user_type;
				$_SESSION['video'] = $video;
				if($user_access == "admin")
				{
					echo "<script>window.location = 'app/index.php?module=videos&task=view';</script>";
				}
				else
				{
					$_SESSION['fb_image'] = $image;
					if($_SESSION['last_page'] != ''){
						echo "<script>window.location = '".$_SESSION['last_page']."';</script>";
						unset($_SESSION['last_page']);
					}
					else{
						echo "<script>window.location = 'lessons.php';</script>";
					}
				}
			}
			else{
				$date_of_sub = date('Y-m-d');
			//echo "fb session not exists";
			$user_fb_qry =  "INSERT INTO `users`(`Username`, `password`, `email`,`fbid`, `first_name`, `Last_name`, `User_Phone`, `User_type`, `gender`, `user_access`, `Date_subscription`, `date_sub_exp`, `country`, `state`, `address`, `music`, `vis`) VALUES ('$email','$password','$email','$id','$name','','','Trail','','normal','$date_of_sub','$date_sub_exp','','','',1,1)";
			
			mysqli_query($db,$user_fb_qry);
			$user_check_query = "SELECT count(*) as ct, User_id ,email,`user_access`,first_name,date_sub_exp,User_type,music , vis FROM `users` WHERE `fbid`='$id'"; 

			$result = mysqli_query($db,$user_check_query);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			//foreach($results as $row)
			//{
				$user_verification = $row['ct'];
				$login_name = $row['first_name'];
				$User_id = $row['User_id'];
				$user_type = $row['User_type'];
				$user_access = $row['user_access'];
				$date_sub_exp = $row['date_sub_exp'];
				$email = $row['email'];
				$music = $row['music'];
				$video = $row['vis'];
			//}
			//echo "Loading..." ;
			if($user_verification == 1)
			{
				$_SESSION['checker'] = true;
				$_SESSION['name'] = $login_name;	
				$_SESSION['User_id'] = $User_id;	
				$_SESSION['user_access'] = $user_access;
				$_SESSION['date_sub_exp'] = $date_sub_exp;
				$_SESSION['login_type'] = 'fbook';
				$_SESSION['email'] = $email;
				$_SESSION['music'] = $music;
				$_SESSION['User_type'] = $user_type;
				$_SESSION['video'] = $video;
				if($user_access == "admin")
				{
					echo "<script>window.location = 'app/index.php?module=videos&task=view';</script>";
				}
				else
				{
					$_SESSION['fb_image'] = $image;
					if($_SESSION['last_page'] != ''){
						echo "<script>window.location = '".$_SESSION['last_page']."';</script>";
						unset($_SESSION['last_page']);
					}
					else{
						echo "<script>window.location = 'lessons.php';</script>";
					}
				}
			}
			
			
			}		
		
	 	}else{


	 	

?>

  <!-- Navigation -->
  <?php include 'nav.php';?>
  <!-- /lessons -->
  <div class="clearfix"></div>
  <div class="clearfix"></div>
  <!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    --> 
  <br>
  <br>
  <br>
  <br>
  <br>
  <div class="container">
    <div class="card card-container"> 
      <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> --> 
     
      
	  <a class="btn btn-lg btn-primary btn-block btn-signin btn-fb"  href="<?php echo $helper->getLoginUrl(array('email')); ?>" >Login with Facebook</a>
	  
	  <div class="signup-or-separator">
      <span class="h6 signup-or-separator--text">or</span>
      <hr>
	</div>
	
      <form class="form-signin" action="login_process.php" method="POST">
	  
	  
	  
	  
        <span id="reauth-email" class="reauth-email"></span>
        <input type="email" id="inputEmail" name="username" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" id="inputPassword" name="Password" class="form-control" placeholder="Password" required>
        <div id="remember" class="checkbox">
          <label>
            <input type="checkbox" value="remember-me">
            Remember me </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block btn-signin btn-login" type="submit">Sign in</button>
        
      </form>
      <!-- /form --> 
     <!-- <a href="#" class="forgot-password"> Forgot the password? </a> </div>-->
	  <a href="#" data-toggle="modal" data-target="#tallModal" class="forgot-password"  >  Forgot password?</a>
    <!-- /card-container --> 
  </div>
  <!-- /container --> 
  
  <!-- Footer --> 
  <br>
  <br>
  <br>
  <br>
  <br>
  
</div>
<footer>
   <?php include 'footer.php' ?>
  </footer>
   <?php include 'scripts.php' ?>
		<?php } ?>
</body>
</html>