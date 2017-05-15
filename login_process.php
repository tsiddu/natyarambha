<?php
session_start();
if($_SESSION['checker']){
	echo "<script>window.location = 'lessons.php';</script>";
}
	$username = $_POST['username'];
	//$_POST['Password'];
	 $password = md5($_POST['Password']);
	 $user_check_query = "SELECT count(*) as ct, User_id ,email, `user_access`,first_name,date_sub_exp,User_type, music, vis FROM `users` WHERE `email`='$username' and `password`='".$password."'";
	include 'db1.php';
	$result = mysqli_query($db,$user_check_query);
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	//foreach($results as $row)
	//{
		$user_verification = $row['ct'];
		$name = $row['first_name'];
		$User_id = $row['User_id'];
		$user_access = $row['user_access'];
		$date_sub_exp = $row['date_sub_exp'];
		$user_type = $row['User_type'];
		$email = $row['email'];
		$music = $row['music'];
		$video = $row['vis'];
	//}
	//echo "Loading..." ;
	if($user_verification == 1)
	{
		$_SESSION['checker'] = true;
		$_SESSION['name'] = $name;	
		$_SESSION['User_id'] = $User_id;	
		$_SESSION['user_access'] = $user_access;
		$_SESSION['User_type'] = $user_type;
		$_SESSION['date_sub_exp'] = $date_sub_exp;
		$_SESSION['email'] = $email;
		$_SESSION['music'] = $music;
		$_SESSION['video'] = $video;
		 if($user_access == "admin")
		{
			echo "<script>window.location = 'app/index.php?module=videos&task=view';</script>";
		}
		else
		{ 
			if($_SESSION['last_page'] != ''){
				echo "<script>window.location = '".$_SESSION['last_page']."';</script>";
				unset($_SESSION['last_page']);
			}
			else{
				echo "<script>window.location = 'lessons.php';</script>";
			}
		 } 
	}else{
	  echo "<script> alert('Username or Password is wrong. Go back & Try Again.');window.location = 'login.php';</script>";
	}


?>