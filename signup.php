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
		unset($_SESSION['date_sub_exp']);
	
	 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Natyarambha - Signup</title>

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
<!-- jQuery --> 
<script src="js/jquery.js"></script> 

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<div class="canvas" > 
 <!-- Navigation -->
  <?php include "nav.php"; ?>
      <!-- /.navbar-collapse --> 

<div class="jumbotron jumbotron-sm" style="margin-top:50px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h2>
                    Sign Up</h2>
            </div>
        </div>
    </div>
</div>

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

	 include 'env.php'; 

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

			
			
			echo $user_check_query = "SELECT count(*) as ct, User_id ,email, `user_access`,first_name,date_sub_exp,User_type,music , vis FROM `users` WHERE `fbid`='$id'"; 
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
			$user_check_query = "SELECT count(*) as ct,email, User_id ,`user_access`,first_name,date_sub_exp,User_type,music , vis FROM `users` WHERE `fbid`='$id'"; 

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

  <!-- /lessons -->
  <div class="clearfix"></div>
 
  <!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    --> 
 
  <br>
  <br>
  <div class="container">
    <div class="card card-container"> 
      <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" />
      <img id="profile-img" class="profile-img-card" src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" />
      <p id="profile-name" class="profile-name-card"></p> --> 
	  
	   <a class="btn btn-lg btn-primary btn-block btn-signin btn-fb"  href="<?php echo $helper->getLoginUrl(array('email')); ?>" >Sign Up with Facebook</a>
	  
	  <div class="signup-or-separator">
      <span class="h6 signup-or-separator--text">or</span>
      <hr>
	</div>
	  
	  
	  
	  
	  
      <form class="form-signin" id="signin_form" action="signup_process.php" method="POST">
        <span id="reauth-email" class="reauth-email"></span>
		 <input type="text" id="Name" name="name" class="form-control" placeholder="Name" required autofocus>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
       
        <input type="password" id="inputPassword" name="Password" class="form-control" placeholder="Password" required>
        <input type="password" id="CheckPassword" name="CheckPassword" class="form-control" placeholder="Confirm Password" required>
       
		 <select name="country" id="country" class="form-control" placeholder="Select Country" required>
    						<option value="" selected>Select Country</option>
    						<option value="AR">Argentina</option>
    						<option value="AU">Australia</option>
    						<option value="AT">Austria</option>
    						<option value="BY">Belarus</option>
    						<option value="BE">Belgium</option>
    						<option value="BA">Bosnia and Herzegovina</option>
    						<option value="BR">Brazil</option>
    						<option value="BG">Bulgaria</option>
    						<option value="CA">Canada</option>
    						<option value="CL">Chile</option>
    						<option value="CN">China</option>
    						<option value="CO">Colombia</option>
    						<option value="CR">Costa Rica</option>
    						<option value="HR">Croatia</option>
    						<option value="CU">Cuba</option>
    						<option value="CY">Cyprus</option>
    						<option value="CZ">Czech Republic</option>
    						<option value="DK">Denmark</option>
    						<option value="DO">Dominican Republic</option>
    						<option value="EG">Egypt</option>
    						<option value="EE">Estonia</option>
    						<option value="FI">Finland</option>
    						<option value="FR">France</option>
    						<option value="GE">Georgia</option>
    						<option value="DE">Germany</option>
    						<option value="GI">Gibraltar</option>
    						<option value="GR">Greece</option>
    						<option value="HK">Hong Kong S.A.R., China</option>
    						<option value="HU">Hungary</option>
    						<option value="IS">Iceland</option>
    						<option value="IN">India</option>
    						<option value="ID">Indonesia</option>
    						<option value="IR">Iran</option>
    						<option value="IQ">Iraq</option>
    						<option value="IE">Ireland</option>
    						<option value="IL">Israel</option>
    						<option value="IT">Italy</option>
    						<option value="JM">Jamaica</option>
    						<option value="JP">Japan</option>
    						<option value="KZ">Kazakhstan</option>
    						<option value="KW">Kuwait</option>
    						<option value="KG">Kyrgyzstan</option>
    						<option value="LA">Laos</option>
    						<option value="LV">Latvia</option>
    						<option value="LB">Lebanon</option>
    						<option value="LT">Lithuania</option>
    						<option value="LU">Luxembourg</option>
    						<option value="MK">Macedonia</option>
    						<option value="MY">Malaysia</option>
    						<option value="MT">Malta</option>
    						<option value="MX">Mexico</option>
    						<option value="MD">Moldova</option>
    						<option value="MC">Monaco</option>
    						<option value="ME">Montenegro</option>
    						<option value="MA">Morocco</option>
    						<option value="NL">Netherlands</option>
    						<option value="NZ">New Zealand</option>
    						<option value="NI">Nicaragua</option>
    						<option value="KP">North Korea</option>
    						<option value="NO">Norway</option>
    						<option value="PK">Pakistan</option>
    						<option value="PS">Palestinian Territory</option>
    						<option value="PE">Peru</option>
    						<option value="PH">Philippines</option>
    						<option value="PL">Poland</option>
    						<option value="PT">Portugal</option>
    						<option value="PR">Puerto Rico</option>
    						<option value="QA">Qatar</option>
    						<option value="RO">Romania</option>
    						<option value="RU">Russia</option>
    						<option value="SA">Saudi Arabia</option>
    						<option value="RS">Serbia</option>
    						<option value="SG">Singapore</option>
    						<option value="SK">Slovakia</option>
    						<option value="SI">Slovenia</option>
    						<option value="ZA">South Africa</option>
    						<option value="KR">South Korea</option>
    						<option value="ES">Spain</option>
    						<option value="LK">Sri Lanka</option>
    						<option value="SE">Sweden</option>
    						<option value="CH">Switzerland</option>
    						<option value="TW">Taiwan</option>
    						<option value="TH">Thailand</option>
    						<option value="TN">Tunisia</option>
    						<option value="TR">Turkey</option>
    						<option value="UA">Ukraine</option>
    						<option value="AE">United Arab Emirates</option>
    						<option value="GB">United Kingdom</option>
    						<option value="US">USA</option>
    						<option value="UZ">Uzbekistan</option>
    						<option value="VN">Vietnam</option>
    					</select>
		<p style="font-size:10px;">By clicking Sign Up, you agree to our <a target="_blank" href="/terms.php">Terms</a>.</p>
        
        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign Up</button>
		
      </form>
      <!-- /form --> 
		<script>
			$( document ).ready(function() {
				$("#signin_form").submit(function(){
					var pass = $("#inputPassword").val();
					var chec_pass = $("#CheckPassword").val();
					if(pass == chec_pass){
						return true;
					}
					else{
					return false;
					}
				});
			});
		</script>
	</div>
    <!-- /card-container --> 
  </div>
  <!-- /container --> 
  
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
		<?php } ?>
</body>
</html>