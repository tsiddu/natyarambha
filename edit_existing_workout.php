<?php
session_start();
$User_id = $_SESSION['User_id'];
if(!$_SESSION['checker']){
	echo "<script>window.location = 'login.php';</script>";
}
include 'db1.php';

$vids_id = $_POST['videos_list'];
$speed = $_POST['speed'];

$name = $_POST['workout-name'];
$description = $_POST['message'];
$workoutid = $_POST['workout-id'];
$len = sizeof($vids_id);

//Create workout ////////////////////////////
	$userName = $_SESSION['User_id'];
	//echo "ok";
	
$userName = $_SESSION['User_id'];






$check_qry = "select CreatedBy from workouts where WorkoutId = '$workoutid'";
$check_res = mysqli_query($db,$check_qry);
$check_row = mysqli_fetch_array($check_res);
if($userName != $check_row['CreatedBy']){
	?>
	<script>
		alert("You are not authorized to acces this page");
		window.location = 'workouts.php';
	</script>
	<?php
}
else{
///adding videos to workout /////
	 $query_update = "update workout_tags set tags_id='$speed' where workout_id= $workoutid";
	$resultforspeedupdate = mysqli_query($db,$query_update);
	
	
	$remove_qry = "DELETE FROM workoutvedios WHERE WorkoutID = '$workoutid'";
	$remove_result = mysqli_query($db,$remove_qry);
	$result_flag = true;
		$wkid = $workoutid;
	for($i = 0;$i<$len;$i++){
		$vdid = $vids_id[$i];
		$spid = $speed;
		$query = "INSERT INTO `workoutvedios`(`WorkoutID`, `VideoID`,`speed`) VALUES ('$wkid','$vdid','$spid')";
		$result = mysqli_query($db,$query);
		if($result == true)
		{
			
			$query_insert = "update workouts set WorkoutDuration =  (SELECT sum(video_duration) from videos where video_id  in (select VideoID from workoutvedios where WorkoutID = '$wkid')), name = '$name', Description = '$description' where WorkoutId = '$wkid'";
			$resuitfordusration = mysqli_query($db,$query_insert);
			$result_flag = $result_flag && $resuitfordusration; 
		}	
	}
	echo $result_flag;
}
?>