<?php
session_start();
$User_id = $_SESSION['User_id'];
if(!$_SESSION['checker']){
	echo "<script>window.location = 'login.php';</script>";
}

include 'db1.php';

if($_GET[action]=='save' && $_GET['category']=='pref'){
	$music = $_POST['music'];
	if($music=='on'){
		$music = 1;
	}
	else{
		$music = 0;
	}
	$_SESSION['music']= $music;
	$vis = $_POST['video'];
	if($vis=='on'){
		$vis = 1;
	}
	else{
		$vis = 0;
	}
	$_SESSION['video']= $vis;

	$updateUserMusic = "update users set music='$music',vis='$vis' where User_id=$User_id";
		$result = mysqli_query($db,$updateUserMusic);
}
if($_GET[action]=='save' && $_GET['category']=='pass'){
	$old_pass = $_POST['old_pass'];
	$new_pass = $_POST['new_pass'];
	$repeat_pass = $_POST['repeat_pass'];
	if($new_pass==$repeat_pass){
		$password= md5($old_pass);
		$check_qry = "SELECT User_id from users where password = '$password' and User_id = '$User_id'";
		$check_res = mysqli_query($db,$check_qry);
		if($check_row = mysqli_fetch_array($check_res)){
			$password = md5($new_pass);
		$updatePassword = "update users set password='$password' where User_id='$User_id'";
		$result = mysqli_query($db,$updatePassword);
		
		unset($_SESSION['fb_token']);
		unset($_SESSION['checker']);
		unset($_SESSION['name']);	
		unset($_SESSION['User_id']);
		unset($_SESSION['user_access']);
		unset($_SESSION['User_type']);
		unset($_SESSION['date_sub_exp']);
		unset($_SESSION['fb_image']);
		unset($_SESSION['music']);
		session_destroy();
		
		
			?>
			<script>
			alert("Password Changed Successfully. Please login to continue.");
			window.location = 'login.php';
		</script>
		<?php
		}
		else{ ?>
			<script>
			alert("Old Password don't match the Database. Please try again");
		</script>
		<?php }
		
		
	}
	else{ ?>
		<script>
			alert("New Password and Repeated Password must be same.");
		</script>
	<?php }

}

	$name = $_REQUEST['name'];
	$country = $_REQUEST['country'];
	$gender = $_REQUEST['gender'];
if($_REQUEST['name']){

	$updateUser = "update users set first_name='$name',country='$country',gender='$gender' where User_id=$User_id";
		$result = mysqli_query($db,$updateUser);
}
$settings_qry = "SELECT first_name,Last_name,gender,country,music,vis from users where User_id = '$User_id'";
$settings_res = mysqli_query($db,$settings_qry);
$settings_row = mysqli_fetch_array($settings_res);
$mus = $settings_row['music'];
$vis = $settings_row['vis'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'head.php'; ?>
	<title>Natyarambha - Settings</title>
	<style>


.material-switch > input[type="checkbox"] {
  display: none;
}

.material-switch > label {
  cursor: pointer;
  height: 0px;
  position: relative;
  width: 40px;
}

.material-switch > label::before {
  background: rgb(0, 0, 0);
  box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
  border-radius: 8px;
  content: '';
  height: 16px;
  margin-top: -8px;
  position: absolute;
  opacity: 0.3;
  transition: all 0.4s ease-in-out;
  width: 40px;
}

.material-switch > label::after {
  background: rgb(255, 255, 255);
  border-radius: 16px;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
  content: '';
  height: 24px;
  left: -4px;
  margin-top: -8px;
  position: absolute;
  top: -4px;
  transition: all 0.3s ease-in-out;
  width: 24px;
}

.material-switch > input[type="checkbox"]:checked + label::before {
  background: inherit;
  opacity: 0.5;
}

.material-switch > input[type="checkbox"]:checked + label::after {
  background: inherit;
  left: 20px;
}
	
	
	</style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">


<div class="canvas" > 
   <!-- Navigation -->
  <?php include 'nav.php'; ?>
  <!-- /lessons --> 
  <div class="clearfix"></div>
  
  
  <div class="jumbotron jumbotron-sm" style="margin-top:50px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h2>
                    Settings</small></h2>
            </div>
        </div>
    </div>
</div>
  
  

  <div class="container">
  <form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Profile Settings</legend><br/>
<div class="form-group">
  <div class="col-md-4 control-label" ></div>
  <div class="col-md-4"><h4>Edit Your Account setting</h4>
    </div>
</div>

<!-- Text input-->

<!-- Password input-->
<form action="settings.php" method="POST">
 <div class="form-group">
        <label class="col-md-4 control-label" for="Name" >Name:</label>
        <div class="col-md-4 ">
            <input type="text" class="form-control" name="name" value="<?php echo $settings_row['first_name']; ?>" >
        </div>
 </div>
 
 
 
  <div class="form-group">
        <label class="col-md-4 control-label" for="country" >Country:</label>
        <div class="col-md-4 ">
          <select name="country" id="country" class="form-control" placeholder="Select" required>
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
        </div>
 </div>
 
 <script>
	sel("country","<?php echo $settings_row['country']; ?>");
	
	function sel(id,val){
			document.getElementById(id).value=val;
		}
 </script>
 
 <div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Gender</label>  
  <div class="col-md-4">
  <label class="radio-inline"><input type="radio" name="gender" value="Male" <?php if($settings_row['gender']=="Male"){ echo checked; }?>>Male</label>
	<label class="radio-inline"><input type="radio" name="gender" value="Female" <?php if($settings_row['gender']=="Female"){ echo checked; }?>>Female</label>

  </div>
</div>
<br/>
<div class="form-group">
  <div class="col-md-4 control-label" ></div>
  <div class="col-md-4">  <button type="submit" class="btn btn-primary btn-cons btn-md">Update Profile</button>
    </div>
</div>
 
 
</form> 
 
 
 
 <?php if($_SESSION['login_type']!='fb'){ ?>
<br/>

<form action="settings.php?action=save&category=pass" method="POST">
<div class="form-group">
  <div class="col-md-4 control-label" ></div>
  <div class="col-md-4"><h4>Change Password</h4>
    </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="passwordinput">Old password</label>
  <div class="col-md-4">
    <input id="old_pass" name="old_pass" type="password" placeholder="Old password" class="form-control input-md" required="true" >
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="passwordinput">New password</label>
  <div class="col-md-4">
    <input id="new_pass" name="new_pass" type="password" placeholder="New password" class="form-control input-md" required>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="passwordinput">Repeat password</label>
  <div class="col-md-4">
    <input id="repeat_pass" name="repeat_pass" type="password" placeholder="Repeat password" class="form-control input-md" required>
    
  </div>
</div>


<br/>
<div class="form-group">
  <div class="col-md-4 control-label" ></div>
  <div class="col-md-4">  <button type="submit" class="btn btn-primary btn-cons btn-md" >Update Password</button>
    </div>
</div>
</form>
 <?php } ?>
<br/>
<div class="form-group">
  <div class="col-md-4 control-label" ></div>
  <div class="col-md-4"><h4>Application Preferences</h4>
    </div>
</div>

<form action="settings.php?action=save&category=pref" method="POST">
<div class="form-group">
  <label class="col-md-4 control-label" for="passwordinput">Music</label>
  <div class="col-md-4">
    <ul class="list-group">
   <li class="list-group-item">
    <div class="material-switch pull-left"><br/>
                            <input id="someSwitchOptionSuccess" name="music" type="checkbox" <?php if($mus) echo "checked";?>/>
                            <label for="someSwitchOptionSuccess" class="label-success"></label>
                        </div><br/><br/><br/>
                        Specify whether you wish to have the background music along with the videos on. The rhythmic syllables will be kept on in both options.
                       <br/><br/>
                    </li></ul>    
  </div>
</div>
	<br/>
	<div class="form-group">
  <label class="col-md-4 control-label" for="passwordinput">Video</label>
  <div class="col-md-4">
    <ul class="list-group">
   <li class="list-group-item">
    <div class="material-switch pull-left"><br/>
                            <input id="someSwitchOptionSuccess1" name="video" type="checkbox" <?php if($vis) echo "checked";?>/>
                            <label for="someSwitchOptionSuccess1" class="label-success"></label>
                        </div><br/><br/><br/>
                        Select ON if you wish to have the video play. If you select OFF, only the audio will play. 
                       <br/><br/>
                    </li></ul>    
  </div>
</div>
<br>
<div class="form-group">
  <div class="col-md-4 control-label" ></div>
  <div class="col-md-4">  <button type="submit" class="btn btn-primary btn-cons btn-md">Update Preferences</button>
    </div>
</div>
</form>

</fieldset>
  </div>	 

	
  <!-- Footer --> 
  <br>
  <br>
  <br>
  <br>
  <br>
  <footer>
	<?php include 'footer.php'; ?>
  </footer>
</div>
	<?php include 'scripts.php'; ?>

</body>
</html>
