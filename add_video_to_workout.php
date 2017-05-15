<?php
session_start();
include "db1.php";
		$wkid = $_POST['id'];
		$vdid = $_POST['video_id'];
		$check = "select * from workoutvedios where WorkoutID = '$wkid' and VideoID = '$vdid'";
		$check_result = mysqli_query($db,$check);
		if($check_row = mysqli_fetch_array($check_result)){
			echo 3;		
		}
		else{		
		$query = "INSERT INTO `workoutvedios`(`WorkoutID`, `VideoID`) VALUES ($wkid,$vdid)";
		$result = mysqli_query($db,$query);
		if($result == true)
		{
			echo 1;
			$query_insert = "update workouts set WorkoutDuration =  (SELECT sum(video_duration) from videos where video_id  in (select VideoID from workoutvedios where WorkoutID = $wkid)) where WorkoutId = $wkid";
			$resuitfordusration = mysqli_query($db,$query_insert);
			if($resuitfordusration==true)
			{
				echo 2;
				
			}
		}
		
		}

?>