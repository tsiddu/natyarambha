<?php

function search_view()
{
	if(isset($_POST['search_value']))
	{
		//genarating query for get related workouts by search query
		$db = getdb();
		$search_value = $_POST['search_value'];
		$User_id = $_SESSION['User_id'];
		$tags = $search_value;
		$select_publick_workouts = "select s.WorkoutId,s.Name,c.Username,s.Access,s.Description,s.WorkoutDuration,s.tags from workouts as s,users as c where s.CreatedBy = c.user_id and (`Access`='public' or `CreatedBy` in (7,$User_id)) ";
		$tags1 = explode(" ", $tags);
		$nooftages = count($tags1);
		$i = 0;
		while($i<$nooftages)
		{
			if($i == 0)
			{
				$select_publick_workouts = $select_publick_workouts . "and (";
			}
			$select_publick_workouts  = $select_publick_workouts."s.tags like '%".$tags1[$i]."%'";
			$tags_value = $tags1[$i];
			$i = $i + 1;
			if($i < $nooftages)
			{
				$select_publick_workouts  = $select_publick_workouts . " or ";
			}
			$save_search = "INSERT INTO `user_Search`(`User_id`, `search_tags`) VALUES ('$User_id', '$tags_value')";
			$result = mysqli_query($db,$save_search);
		}
		$select_publick_workouts = $select_publick_workouts.") limit 0,10";
		
		//genarating query for get related lessons by search query
		$selec_lessons_search = "SELECT lessons_id, lessons_name, lesson_description, lesson_level, tags FROM lesson WHERE ";
		$i = 0;
		while($i<$nooftages)
		{
			$selec_lessons_search  = $selec_lessons_search."tags like '%".$tags1[$i]."%'";
			$i = $i + 1;
			if($i < $nooftages)
			{
				$selec_lessons_search  = $selec_lessons_search . " or ";
			}
		}
		
		$selec_lessons_search  = $selec_lessons_search . " limit 0,10";	
		
		?>
		<div class="tabbable" id="">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#panel-503768" data-toggle="tab">Workouts</a>
				</li>
				<li>
					<a href="#panel-81633" data-toggle="tab">Lessons</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="panel-503768">
				<?php
				/* display workouts */
				$select_publick_workouts_result = mysqli_query($db,$select_publick_workouts);
				while($row = mysqli_fetch_array($select_publick_workouts_result))
				{
				?>
					<div style='width:220px;height:180px;border:1px solid silver;float:left;margin:30px;'>
					<div style='width:220px;height:180px;' >
					<?php
					$workout  = $row['WorkoutId'];
					$getvideos = "SELECT s.VideoID,c.video_thumb_path FROM `workoutvedios` as s,videos as c WHERE WorkoutID =
								$workout and	c.video_id=s.VideoID limit 4";
					//echo $getvideos;
					$result_videos_workout = mysqli_query($db,$getvideos);
					//echo $getvideos;
					while($row_videos = mysqli_fetch_array($result_videos_workout))
					{
						echo "<img src='".$row_videos['video_thumb_path']."'  border='1' style='width:80px;height:80px;border:1px solid silver' >";
					}
					
					echo "</div>";
					$workoutid_for_play = $row['WorkoutId'];
					//echo "<a style='float:left;text-decoration:none;cursor:pointer;'>Play</a>";
					?>
					<a href = '?module=Workouts&task=play_workout&wrkoutid=<?php echo $workoutid_for_play;?>' style='float:left;text-decoration:none;cursor:pointer;'>Play</a>
				<?php
				echo "<span style='float:right;'>".$row['Name']."</span>";
				echo "</div>";
				}
				?>
				</div>
				<div class="tab-pane" id="panel-81633">
				<?php
				/* display lessons */
				$selec_lessons_search_result = mysqli_query($db,$selec_lessons_search);
				while($row1 = mysqli_fetch_array($selec_lessons_search_result))
				{
					echo "<div style='width:200px;height:200px;border:1px solid silver;float:left;margin:10px;'>";
					echo "<b>".$row1['lessons_name']."</b>";
					echo $row1['lesson_description'];
					echo "<br/>";
					echo "<a href='?module=learn&task=lessons_view&lessons_id=".$row1['lessons_id']."' class='btn'>view</a>";
					echo "</div>";
				}
				
				?>
				</div>
			</div>
		</div>
		<?php
		
	}
	
	
}



?>
