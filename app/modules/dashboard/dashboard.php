<style type="text/css">
	.doxtumb{
	width: 270px;
	height: 200px;
	border: 1 solid silver;
	margin-bottom:30px; 
	}
	.carousel-caption
	{
		background: rgba(0, 0, 0, 0.36);
	}
	.imgs
	{
		width: 100%;
	}
	.carousel-caption{
		background: rgba(0, 0, 0, 0.21) !important;
	}
</style>

<?php

function dashboard_view()
{
	$db = getdb();
	$User_id = $_SESSION['User_id'];
	?>
	<div class='span10'>
		<div class="tabbable" id="tabs-518469">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#panel-644758" data-toggle="tab">Recent Workout</a>
				</li>
				<li>
					<a href="#panel-137338" data-toggle="tab">Recent lessons</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="panel-644758">

				<?php
					//DISPALYING WORKOUTS
					$select_recent_workouts = "SELECT s.WorkoutId,a.date_time, s.Name, s.Description, s.WorkoutDuration, s.tags from workouts as s,user_views_logs as a where a.caty_id=s.WorkoutId and a.category='workout' and a.userid='$User_id' group by a.caty_id limit 0,5";
					$select_recent_workouts_result = mysqli_query($db,$select_recent_workouts);
					while($row = mysqli_fetch_array($select_recent_workouts_result))
					{
						$workout = $row['WorkoutId'];
						$getvideos = "SELECT s.VideoID,c.video_thumb_path FROM `workoutvedios` as s,videos as c WHERE WorkoutID =
						'$workout' and	c.video_id=s.VideoID limit 1";						
						$result_videos_workout = mysqli_query($db,$getvideos);
						$aa = gettype($result_videos_workout);
						if($aa != "boolean")
						{
							$row_videos = mysqli_fetch_array($result_videos_workout);
							$vid_tumb = $row_videos['video_thumb_path'];
							if ($vid_tumb == "") {
								$vid_tumb = "videosthumb/no_tumb.png";
							}
						}
						else
						{
							$vid_tumb = "videosthumb/no_tumb.png";
						}
					?>
						<div class='span3 doxtumb' style='position: relative;background-size: cover;cursor: pointer;background-image: url(<?php echo $vid_tumb; ?>);'>
						<?php
						$workout  = $row['WorkoutId'];
						$workoutid_for_play = $row['WorkoutId'];
						?>
						<div class="carousel-caption">
							<p><h4><?php if($row['Name'] != ""){echo substr($row['Name'],0,20); }?></h4>
							<span style='color:white'>Duration:<?php echo $row['WorkoutDuration'];?></span><span style='color:white;float:right;'>Date:<?php echo date('d/m/y',strtotime($row['date_time']));?></span>
							</p>
							<a style='position: absolute;right: 5px;bottom: 5px;' href = '?module=Workouts&task=play_workout&wrkoutid=<?php echo $workoutid_for_play;?>' style='float:left;text-decoration:none;cursor:pointer;'><i class="icon-play-circle icon-white"></i></a>
							</div>
						</div>
					<?php
					}
				?>
				</div>
				<div class="tab-pane" id="panel-137338">
					<?php
					$select_recent_lessons = "SELECT l.lessons_id, l.lessons_name, l.vesson_tumb, l.lesson_description, l.lesson_level, l.tags, c.date_time FROM lesson as l, user_views_logs as c WHERE c.caty_id = l.lessons_id and category='lessons' and c.userid='$User_id' group by caty_id limit 0,5";
					$select_recent_lessons_result = mysqli_query($db,$select_recent_lessons);
					//echo count($select_recent_lessons_result);
					try
					{
						if(count($select_recent_lessons_result) > 0)
						{
							while($row1 = mysqli_fetch_array($select_recent_lessons_result))
							{
								$lession_name = $row1['lessons_name'];
								$lession_des = $row1['lesson_description'];
								$vesson_tumb = $row1['vesson_tumb'];
								if($vesson_tumb == "")
								{
									$vesson_tumb = "videosthumb/no_tumb.png";
								}
								?>

								<div class='span3 doxtumb' style='position: relative;background-size: cover;cursor: pointer;background-image: url(<?php echo $vesson_tumb; ?>);'>
								<div class="carousel-caption">
								<h4><?php echo substr($lession_name,0,20);?></h4>
								<p><span style='color:white;float:right;'>Date:<?php echo date('d/m/y',strtotime($row1['date_time']));?></span></p>
								<?php
								echo "<a style='position: absolute;right: 5px;bottom: 5px;' href='?module=learn&task=lessons_view&lessons_id=".$row1['lessons_id']."' class='btn btn-mini'><i class='icon-tasks'></i></a>";
								?>
								</div>
								</div>
								<?php
							}
						}
						else
						{
							echo "No data";
						}
					}
					catch (Exception $e){
						echo "No data";
					}
					?>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>