<?php
session_start();
if(!$_SESSION['checker']){
	echo "<script>window.location = 'login.php';</script>";
}

include 'db1.php';
$code = $_POST['workout'];
$userName = $_SESSION['User_id'];

$check_qry = "select CreatedBy,WorkoutId from workouts where code = '$code'";
$check_res = mysqli_query($db,$check_qry);
$check_row = mysqli_fetch_array($check_res);
$workoutid = $check_row['WorkoutId'];
if($userName != $check_row['CreatedBy']){
	?>
	<script>
		alert("You are not authorized to acces this page");
		window.location = 'workouts.php';
	</script>
	<?php
}
else{
	$remove_qry = "DELETE FROM workoutvedios WHERE WorkoutID = '$workoutid';";
	$remove_result = mysqli_query($db,$remove_qry);
	$remove_qry = "DELETE FROM workouts WHERE WorkoutId = '$workoutid';";
	$remove_result = mysqli_query($db,$remove_qry);
	if($remove_result == true)
		{
			echo 1;
		}
	else{
		echo 0;
	}
	}

?>
