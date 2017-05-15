<?php
function users_view()
{
	$user_id = $_SESSION['User_id'];
	//echo $user_id;
	if($user_id == 7)
	{
		$db = getdb();
		$get_users = "SELECT `User_id`, `Username`, `password`, `email`, `first_name`, `Last_name`, `User_Phone`, `User_type`, `gender`, `user_access`, `Date_subscription`, `date_sub_exp`, `country`, `state`, `address` FROM `users`";
		
		$result = mysqli_query($db,$get_users);
		?>
		<div class="col-md-12 column">
			<table class="table table-bordered table-hover table-condensed">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							UserName
						</th>
						<th>
							Email
						</th>
						<th>
							Phone
						</th>
						<!-- <th>
							Subscription Date
						</th>
						<th>
							Expiry Date
						</th> -->
						<th>User Type</th>
						<th>
							chage Password
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					while($row = mysqli_fetch_array($result))
					{	
						echo "<tr>";
						echo "<td>".$i."</td>";
						$i = $i + 1;
						echo "<td>".$row['Username']."</td>";
						echo "<td>".$row['email']."</td>";
						echo "<td>".$row['User_Phone']."</td>";
						/*echo "<td>".date('d-M-Y', strtotime($row['Date_subscription']))."</td>";
						echo "<td>".date('d-M-Y', strtotime($row['date_sub_exp']))."</td>"; */
						echo "<td>".$row['User_type']." <a href='alter_user_type.php?id=".$row['User_id']."&type=".$row['User_type']."' >Change</change></td>";
						echo "<td><a href='?module=users&task=change_password_from_admin&user_id_for_admin=".$row['User_id']."'>Click</a></td>";
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
		
		<?php
	}
}

function users_login()
{
?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=306004806213066";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<div class="span3 centred">
      <form class="form-signin" action="?module=users&task=login_process" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="input-block-level" placeholder="Username" name='username'>
        <input type="password" class="input-block-level" placeholder="Password" name='Password'>
		<a href="?module=users&task=get_password">Forget Password</a><br/><br/>
        <input type="submit" value="submit" name="submit" class="btn btn-primary" />
      </form>
    </div>
    <div class="fb-login-button" data-width="200"></div>
	<style>
	.span3 .nav{
	display:none;
	}
	.navbar .nav:nth-child(1){
	display:none
	}
	</style>
<?php
}

function users_login_process()
{
	/* $username = $_POST['username'];
	$password = md5($_POST['Password']);
	$user_check_query = "SELECT count(*) as ct, User_id ,`user_access`,Username,date_sub_exp FROM `users` WHERE `Username`='$username' and `password`='".$password."'";
	$db = getdb();
	$result = mysqli_query($db,$user_check_query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	//foreach($results as $row)
	//{
		$user_verification = $row['ct'];
		$name = $row['Username'];
		$User_id = $row['User_id'];
		$user_access = $row['user_access'];
		$date_sub_exp = $row['date_sub_exp'];
	//}
	//echo "Loading..." ;
	if($user_verification == 1)
	{
		$_SESSION['checker'] = true;
		$_SESSION['name'] = $name;	
		$_SESSION['User_id'] = $User_id;	
		$_SESSION['user_access'] = $user_access;
		$_SESSION['date_sub_exp'] = $date_sub_exp;
		if($user_access == "admin")
		{
			echo "<script>window.location = '//natyarabha.com';</script>";
		}
		else
		{
			echo "<script>window.location = '?module=dashboard&task=view';</script>";
		}
	}else{
	echo "Username or Password is wrong <a href='?module=users&task=login'>Go back & Try Again</a>";
	} */
}

function users_register()
{/* 
?>
<script>
$(function(){
	//Form validation
	$('#formForRegistration').submit(function(){
		var pw1 = $('#password').val();
		var pw2 = $('#confirm_password').val();
		if(pw2 != pw1)
		{
			$('#notepade').show();
			return false;
		}
	});
});

$(function(){
	//Form validation
	$('#confirm_password').focusout(function(){
		var pw1 = $('#password').val();
		var pw2 = $('#confirm_password').val();
		if(pw2 != pw1)
		{
			$('#notepade').show();
		}
		else{
			$('#notepade').hide();
		}
	});
});
</script>

<div class="span3 row-fluid">
<form class="form-horizontal" id='formForRegistration' action="?module=users&task=registration_process" method='post'>
<div style="padding: 20px;margin-left: 94px;font-size: 30px;">Register</div>
<div id='notepade' class='span12' style=' display:none;color: red;background-color: antiquewhite;margin-bottom: 10px;padding: 2px;border: 1px solid silver;width: 400px;text-align: center;'>Note: Both Password not matching please try again</div>
<fieldset>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="first_name">First Name</label>
  <div class="controls">
    <input id="first_name" name="first_name" type="text" placeholder="First Name" class="input-large" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="last_name">Last Name</label>
  <div class="controls">
    <input id="last_name" name="last_name" type="text" placeholder="Last Name" class="input-large" required="">
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="user_name">User Name</label>
  <div class="controls">
    <input id="user_name" name="user_name" type="text" placeholder="User Name" class="input-large" required="">
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="Email">E-mail</label>
  <div class="controls">
    <input id="Email" name="Email" type="email" placeholder="Email" class="input-large" required="">
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="Phone">Phone</label>
  <div class="controls">
    <input id="Phone" name="Phone" type="text" placeholder="ex: +919955668866" class="input-large" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="control-group">
  <label class="control-label" for="password">Password</label>
  <div class="controls">
    <input id="password" name="password" type="password" placeholder="Password" class="input-large" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="control-group">
  <label class="control-label" for="confirm_password">confirm Password</label>
  <div class="controls">
    <input id="confirm_password" name="confirm_password" type="password" placeholder="confirm your password" class="input-large" required="">
    <span>
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="Gender">Gender</label>
  <div class="controls">
    <select id="Gender" name="Gender" class="input-large">
      <option>Male</option>
      <option>Female</option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="country">country</label>
  <div class="controls">
    <select id="country" name="country" class="input-large">
      <option>Afghanistan</option>
      <option>Aland Islands</option>
      <option>Albania</option>
      <option>Algeria</option>
      <option>American Samoa</option>
      <option>Andorra</option>
      <option>Angola</option>
      <option>Anguilla</option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="State">State</label>
  <div class="controls">
    <select id="State" name="State" class="input-large">
      <option>Option one</option>
      <option>Option two</option>
    </select>
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="Address">Address</label>
  <div class="controls">                     
    <textarea id="Address" name="Address"></textarea>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<div class="control-group">
  <label class="control-label" for="registration">Type of Registration</label>
  <div class="controls">
    <label class="radio inline" for="registration-0">
      <input type="radio" name="registration" id="registration-0" value="Trail" checked="checked">
      Trail
    </label>
    <label class="radio inline" for="registration-1">
      <input type="radio" name="registration" id="registration-1" value="Paid">
      Paid( $ XXX )
    </label>
  </div>
</div>

<!-- Button (Double) -->
<div class="control-group">
  <label class="control-label" for="submit"></label>
  <div class="controls">
    <button id="submit" name="submit" class="btn btn-success">Submit</button>
    <input type='reset' id="Cancel" name="Cancel" class="btn btn-danger" value='reset'>
</div>

</fieldset>
</form>
</div>
<style>
	.span3 .nav{
	display:none;
	}
	.navbar .nav:nth-child(1){
	display:none
	}
	</style>
<?php */
}


function users_registration_process()
{
	/* $first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$user_name = $_POST['user_name'];
	$Email = $_POST['Email'];
	$Phone = $_POST['Phone'];
	$password = md5($_POST['password']);
	$Gender = $_POST['Gender'];
	$country = $_POST['country'];
	$State = $_POST['State'];
	$Address = $_POST['Address'];
	$registration = $_POST['registration'];
	$useraccess = 'normal';
	$date_of_sub = date('Y-m-d');
	$date_sub_exp = date('Y-m-d', strtotime('+ 5 days'));
	// echo $date_of_sub."<br/>";
	// echo $date_sub_exp;
	// die();
	$insertQuert = "INSERT INTO `users`(`Username`, `password`, `email`, `first_name`, `Last_name`, `User_Phone`, `User_type`, `gender`, `user_access`, `Date_subscription`, `date_sub_exp`, `country`, `state`, `address`) VALUES 
	('$user_name','$password','$Email','$first_name','$last_name','$Phone','$registration','$Gender','$useraccess','$date_of_sub','$date_sub_exp','$country','$State','$Address')";
	//echo $insertQuert;
	
	$db = getdb();
	$result = mysqli_query($db,$insertQuert);
	if($result== true)
	{
		echo "registration success";
	}
	else
	{
		echo "registration not success";
		
	} */
}


function users_logout()
{
		/* session_destroy();
		echo "<script>window.location = '?module=users&task=login';</script>"; */
}


function users_get_password()
{/* 
?>
<div class="span3 centred">
      <form class="form-signin" action="?module=users&task=chek_email_user" method="post">
        <h3>Requesting for Password</h2>
        <input type="email" class="input-block-level" placeholder="E-mail" name='emailid' required>
		<br/>
        <input type="submit" value="submit" name="submit" class="btn btn-primary" />
      </form>
</div>
<?php */
}


function users_chek_email_user()
{
	if(isset($_POST['emailid']))
	{
		$emailID = $_POST['emailid'];

		$db = getdb();
		$query_check_user = "SELECT count(*) AS count, User_id,password FROM users WHERE email = '$emailID'";
		$result = mysqli_query($db,$query_check_user);
		$row = mysqli_fetch_array($result);
		//echo $query_check_user;
		//print_r($row);
		//print_r($row);
		//echo $row['count'];
		if($row['count'] == 1)
		{
			$uid = $row['User_id']; 
			$password = $row['password'];
			echo $uid;
			echo $password."<br/>";
			echo hash($uid,$password);
			//echo hash();
		}
		
		// if($_GET['id'])
		// {	
			//echo "ok";
			?>
		<!--
			<script>
			$(function() {
				$('#form1').submit(function() {
					var pass1 = $('#pw1').val();
					var pass2 = $('#pw2').val();
					if(pass1 == pass2)
					{
					return true;
					}
					else{
					$('#notepade').show();
					return false;
					}
				});
			});
			</script>
			<div class='span3'>
				<form  id='form1' class="form-signin" action="?module=users&task=process_new_password_request&uid=<?php echo $uid;?>" method="post">
						<h3>Reset Password</h3>
						<div id='notepade' style=' display:none;background-color: antiquewhite;margin-bottom: 10px;padding: 5px;border: 1px solid yellow;'>Note: Both Password not matching please try again</div>
						<input type="Password" class="input-block-level" placeholder="New Password" id='pw1' name='pw1' required>
						<input type="Password" class="input-block-level" placeholder="Confirm Password" id='pw2' name='pw2' required>
						<br/>
						<input type="submit" value="submit" name="submit" class="btn btn-primary" />
				</form>
			</div>
			-->
			<?php
		// }
		// else{
			// echo "Note: No such user found <a href='?module=users&task=get_password'>click here to go back</a> ";
		// }
	}
	else{
	echo "<script>window.location = '?module=users&task=login';</script>";
	}
}
function users_process_new_password_request()
{
	/* //echo "ok yar";
	if((isset($_GET['uid'])) and (isset($_POST['pw1'])))
	{
		//echo "ok";
		$userid = $_GET['uid'];
		//echo $userid;
		$passwpord = $_POST['pw1'];
		$encryption_password = md5($passwpord);
		//echo $encryption_password;
		$updatePassword = "update users set password='$encryption_password' where User_id=$userid";
		$db = getdb();
		$result = mysqli_query($db,$updatePassword);
		if($result == true)
		{
			echo "password updated <a href='?module=users&task=login'>click here to Login</a>";
		}
		else{
			echo "not updated";
		}
	}
	else{
		echo "access denied"; 
		//echo "<script>window.location = '?module=users&task=login';</script>";
	} */
}

//////////////////////////////////////////////////////////////////////////////////////////////////
//view profile
//////////////////////////////////////////////////////////////////////////////////////////////////

function users_profile_view()
{
	//echo "user profile funtion";
	$db = getdb();
	$user_id = $_SESSION['User_id'];
	$get_user_data = "SELECT User_id, Username, password, email, first_name, Last_name, User_Phone, User_type, gender, 
	user_access, Date_subscription, date_sub_exp, country, state, address FROM users WHERE User_id='$user_id'";
	$result = mysqli_query($db,$get_user_data);
	$row = mysqli_fetch_array($result);
	$Username = $row['Username'];
	$email = $row['email'];
	$first_name = $row['first_name'];
	$Last_name = $row['Last_name'];
	$User_Phone = $row['User_Phone'];
	$User_type = $row['User_type'];
	$gender = $row['gender'];
	$Date_subscription = $row['Date_subscription'];
	$date_sub_exp = $row['date_sub_exp'];
	$address = $row['address'];
	?>
	<script>
		$(function(){
			$( "#Edit" ).click(function() {
				$('#FirstName').attr('readonly', false);
				$('#LastName').attr('readonly', false);
				$('#Phone').attr('readonly', false);
				$('#Address').attr('readonly', false);
				$('#submit').show();
				$('#cancel').show();
				$('#Edit').hide();
			});
			
			$( "#cancel" ).click(function() {
				$('#FirstName').attr('readonly', true);
				$('#LastName').attr('readonly', true);
				$('#Phone').attr('readonly', true);
				$('#Address').attr('readonly', true);
				$('#submit').hide();
				$('#cancel').hide();
				$('#Edit').show();
			});
			
		});
	</script>
	<div class='span6'>
		<form class="form-horizontal" method='post' action='?module=users&task=update_userData'>
			<fieldset>

			<!-- Form Name -->
			<legend>Edit Profile</legend>

			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="FirstName">First Name</label>
			  <div class="controls">
				<input id="FirstName" name="FirstName" type="text" value="<?php echo $first_name;?>" class="input-xlarge" required="" readonly>
				
			  </div>
			</div>

			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="LastName">Last Name</label>
			  <div class="controls">
				<input id="LastName" name="LastName" type="text" value="<?php echo $Last_name;?>" class="input-xlarge" required="" readonly>
				
			  </div>
			</div>

			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="Phone">Phone</label>
			  <div class="controls">
				<input id="Phone" name="Phone" type="text" value="<?php echo $User_Phone;?>"class="input-xlarge" required="" readonly>
				
			  </div>
			</div>

			<!-- Textarea -->
			<div class="control-group">
			  <label class="control-label" for="Address">Address</label>
			  <div class="controls">                     
				<textarea id="Address" name="Address" readonly><?php echo $address;?></textarea>
			  </div>
			</div>

			<!-- Button (Double) -->
			<div class="control-group">
			  <label class="control-label" for="Submit"></label>
			  <div class="controls">
				<input type='submit' class='btn' id='submit' name='submit' style='display:none' />
				<input type='button' class='btn' id='cancel' value='cancel' style='display:none'/>
				<input type='button' class='btn' id='Edit' name='Edit' value='Edit'/>
			  </div>
			</div>

			</fieldset>
		</form>

	</div>
	<DIV class='span3'>
		<legend>User Data</legend>
		username: <?php echo $Username; ?><br/>
		First Name: <?php echo $Username; ?><br/>
		Second Name: <?php echo $Username; ?><br/>
		Email: <?php echo $Username; ?><br/>
		Phone: <?php echo $Username; ?><br/>
		Date of Subscription: <?php echo date('d-M-Y',strtotime($Username)); ?><br/>
		Expiry Date: <?php echo date('d-M-Y',strtotime($date_sub_exp)); ?><br/>
		Address: <?php echo $address; ?><br/>
	</DIV>
	<?php
}


function users_change_password()
{
	/* //echo "changing password";
	?>
	<script>
	$(function(){
		//Form validation
		$('#chagePassword').submit(function(){
			var pw1 = $('#password').val();
			var pw2 = $('#confirm_password').val();
			if(pw2 != pw1)
			{
				$('#notepade').show();
				return false;
			}
		});
	});
	
	</script>
	<div class="span3 centred">
		<div id='notepade'  class='span12' style=' display:none;color: red;background-color: antiquewhite;margin-bottom: 10px;padding: 2px;border: 1px solid silver;width: 400px;text-align: center;'>Note: Both Password not matching please try again</div>
      <form class="form-signin" id='chagePassword' action="?module=users&task=change_password_process" method="post">
        <h3 class="form-signin-heading">Change Password</h3>
        <input type="password" class="input-block-level" id='password' name='password' required>
        <input type="password" class="input-block-level" id='confirm_password' name='confirm_password' required>
        <input type="submit" value="submit" name="submit" class="btn btn-primary" />
      </form>
    </div>
	<?php */
}


function users_change_password_process()
{
	/* $db = getdb();
	$userid = $_SESSION['User_id'];
	if(isset($_POST['password']))
	{
		$password = md5($_POST['password']);
		$change_query_pass = "UPDATE users SET password='$password' WHERE User_id='$userid'";
		$result = mysqli_query($db, $change_query_pass);
		if($result == true)
		{
			echo "ok updated";
			echo "<script>window.location = '?module=dashboard&task=view';</script>";
		}
		else
		{
			echo "not updated";
		}
	} */
}


function users_update_userData()
{
	if(isset($_POST['FirstName']))
	{
		$FirstName = $_POST['FirstName'];
		$LastName = $_POST['LastName'];
		$Phone = $_POST['Phone'];
		$Address = $_POST['Address'];
		$userid = $_SESSION['User_id'];
		$db = getdb();
		$update_user_data = "UPDATE `users` SET `first_name`='$FirstName',`Last_name`='$LastName',`User_Phone`='$Phone',`address`='$Address' WHERE `User_id`='$userid'";
		$result = mysqli_query($db,$update_user_data);
		if($result == true)
		{
			echo "<script>window.location = '?module=users&task=profile_view';</script>";
		}
		else
		{
			echo "not updated";
		}
	}
}


function users_change_password_from_admin()
{
	if(isset($_GET['user_id_for_admin']))
	{
		$user_id = $_GET['user_id_for_admin'];
	//echo "changing password";
	?>
	<script>
	$(function(){
		//Form validation
		$('#chagePassword').submit(function(){
			var pw1 = $('#password').val();
			var pw2 = $('#confirm_password').val();
			if(pw2 != pw1)
			{
				$('#notepade').show();
				return false;
			}
		});
	});
	
	</script>
	<div class="span3 centred">
		<div id='notepade'  class='span12' style=' display:none;color: red;background-color: antiquewhite;margin-bottom: 10px;padding: 2px;border: 1px solid silver;width: 400px;text-align: center;'>Note: Both Password not matching please try again</div>
      <form class="form-signin" id='chagePassword' action="?module=users&task=change_password_process_admin" method="post">
        <h3 class="form-signin-heading">Change Password</h3>
        <input type="password" class="input-block-level" id='password' name='password' required>
        <input type="password" class="input-block-level" id='confirm_password' name='confirm_password' required>
        <input type="hidden" class="input-block-level" id='user_id' name='user_id' value='<?php echo $user_id;?>' required>
        <input type="submit" value="submit" name="submit" class="btn btn-primary" />
      </form>
    </div>
	<?php
	}
}



function users_change_password_process_admin()
{
	$db = getdb();
	if(isset($_POST['password']))
	{
		$userid = $_POST['user_id'];
		$password = md5($_POST['password']);
		$change_query_pass = "UPDATE users SET password='$password' WHERE User_id='$userid'";
		$result = mysqli_query($db, $change_query_pass);
		if($result == true)
		{
			echo "ok updated";
			echo "<script>window.location = '?module=users&task=view';</script>";
		}
		else
		{
			echo "not updated";
		}
	}
}



?>
