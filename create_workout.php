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
$len = sizeof($vids_id);
$da = microtime(true);
 $code = md5($name.''.$da);
//Create workout ////////////////////////////
	$userName = $_SESSION['User_id'];
	//echo "ok";
	$query = "INSERT INTO `workouts`(`Name`, `CreatedBy`, `Access`, `Description`, WorkoutDuration,tags, `code`) 
			VALUES ('$name','$userName','Private','$description',0.00,'','$code')";
	//echo $query;
	$result = mysqli_query($db,$query);
	
	$wkid = mysqli_insert_id($db);
	
	$query = "INSERT INTO `workout_tags`(`workout_id`, `tags_id`) 
			VALUES ('$wkid','$speed')";
	//echo $query;
	$result = mysqli_query($db,$query);

///adding videos to workout /////

		
	for($i = 0;$i<$len;$i++){
		$vdid = $vids_id[$i];
		$query = "INSERT INTO `workoutvedios`(`WorkoutID`, `VideoID`, `speed`) VALUES ('$wkid','$vdid','$speed')";
		$result = mysqli_query($db,$query);
		if($result == true)
		{
			
			$query_insert = "update workouts set WorkoutDuration =  (SELECT sum(video_duration) from videos where video_id  in (select VideoID from workoutvedios where WorkoutID = $wkid)) where WorkoutId = $wkid";
			$resuitfordusration = mysqli_query($db,$query_insert);
		
		}	
	}
	echo 1;
?>