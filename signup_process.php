<?php
include 'db1.php';
	$first_name = $_POST['name'];
//	$last_name = $_POST['last_name'];
//	$user_name = $_POST['user_name'];
 	$Email = $_POST['email'];
//	$Phone = $_POST['Phone'];
	$password = md5($_POST['Password']);
//	$Gender = $_POST['Gender'];
	$country = $_POST['country'];
//	$State = $_POST['State'];
//	$Address = $_POST['Address'];
//	$registration = $_POST['registration'];
	$useraccess = 'normal';
	$date_of_sub = date('Y-m-d');
	$date_sub_exp = '';
	// echo $date_of_sub."<br/>";
	// echo $date_sub_exp;
	// die();
	
	$user_check_query = "SELECT first_name FROM `users` WHERE `email`='$Email'";
	$check_result = mysqli_query($db,$user_check_query);
	if($row=mysqli_fetch_array($check_result,MYSQLI_ASSOC))
	{
		?>
			<script>
				alert("Email is already registered. Please login to Continue.");
				window.location = 'login.php';
			</script>
		
		<?php 
	}
	else{
	
	$insertQuert = "INSERT INTO `users`(`Username`, `password`, `email`, `first_name`, `Last_name`, `User_Phone`, `User_type`, `gender`, `user_access`, `Date_subscription`, `date_sub_exp`, `country`, `state`, `address`, `music`, `vis`) VALUES 
	('$Email','$password','$Email','$first_name','','','','','$useraccess','$date_of_sub','$date_sub_exp','$country','','',1,1)";
	//echo $insertQuert;
	
	$result = mysqli_query($db,$insertQuert);
	if($result== true)
	{
		?>
			<script>
				alert("Registration Successful. Please login to Continue.");
				window.location = 'login.php';
			</script>
		
		<?php 
	}
	else
	{
		?>
			<script>
				alert("Something went wrong. Please try again.");
				window.location = 'signup.php';
			</script>
		
		<?php 	
	}
	}
?>