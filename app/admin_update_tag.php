<?php
include 'db1.php';
$workout_id = $_POST['workoutid'];
$select_ptag = "select count(*) as cnt from tags where level=0;";
$ptag_result = mysqli_query($db,$select_ptag);
$ptag_row = mysqli_fetch_array($ptag_result);
for($i = 0;$i < $ptag_row['cnt'];$i++){
	$tags_id = $_POST['ctag'.$i];
	$select_tag = "select id from workout_tags where workout_id = '$workout_id' and tags_id = '$tags_id'";
	$tag_result = mysqli_query($db,$select_tag);
	if($tag_row = mysqli_fetch_array($tag_result)){
		$update_tag = "UPDATE `workout_tags` SET `workout_id` = '$workout_id', `tags_id` = '$tags_id' WHERE `workout_tags`.`id` = '".$tag_row['id']."';";
		mysqli_query($db,$update_tag);
	}
	else{
		$insert_tag = "INSERT INTO `workout_tags` (`id`, `workout_id`, `tags_id`) VALUES ('', '$workout_id', '$tags_id');";
		mysqli_query($db,$insert_tag);
		
	}
}
echo 0;
?>
