<?php 
session_start();
include 'db1.php';
echo $_SESSION['user_access'];
if($_SESSION['user_access'] == "admin")
		{
			
		$id = $_GET['id'];
		$type = $_GET['type'];
		if($type=='Trail') { $t = 'Paid'; }
		if($type=='Paid') { $t = 'Trail'; }
		$updateUserType = "update users set User_type='$t' where User_id=$id";
		$result = mysqli_query($db,$updateUserType);
			
			
		echo "<script>window.location = 'index.php?module=users&task=view';</script>";	
			
			
			
			
			
		}
else{
	
	echo "<script>window.location = '../login.php';</script>";
}	
?>