<?php
session_start();
$User_id = $_SESSION['User_id'];
if(!$_SESSION['checker']){
	echo "<script>window.location = 'login.php';</script>";
}

include 'db1.php';

$search_word = $_POST['search'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'head.php' ?>
<title>Natyarambha - Search</title>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<div class="canvas" > 
  <!-- Navigation -->
  <?php include 'nav.php' ?>
  <!-- /lessons -->
  <div class="clearfix"></div>
  <br>
  <br>
  <br>
  <div class="container search-results"> <br>
  <?php
  if(!$search_word){
  	echo "<h2>Please enter some text for search</h2>";
  }
  
  if($search_word)
	{
		//genarating query for get related workouts by search query
		$User_id = $_SESSION['User_id'];
		$tags = $search_word;
		$select_publick_workouts = "select s.WorkoutId,s.Name,c.Username,s.Access,s.Description,s.WorkoutDuration,s.tags,s.code from workouts as s,users as c where s.CreatedBy = c.user_id and (`Access`='public' or `CreatedBy` in (7,$User_id)) ";
		$cnt_publick_workouts = "select count(*) as cnt from workouts as s,users as c where s.CreatedBy = c.user_id and (`Access`='public' or `CreatedBy` in (7,$User_id)) ";
		$tags1 = explode(" ", $tags);
		$nooftages = count($tags1);
		$i = 0;
		while($i<$nooftages)
		{
			if($i == 0)
			{
				$select_publick_workouts = $select_publick_workouts . "and (";
				$cnt_publick_workouts = $cnt_publick_workouts . "and (";
			}
			$select_publick_workouts  = $select_publick_workouts."s.tags like '%".$tags1[$i]."%' or s.Name like '%".$tags1[$i]."%' or s.Description like '%".$tags1[$i]."%'";
			$cnt_publick_workouts  = $cnt_publick_workouts."s.tags like '%".$tags1[$i]."%' or s.Name like '%".$tags1[$i]."%' or s.Description like '%".$tags1[$i]."%'";
			
			$tags_value = $tags1[$i];
			$i = $i + 1;
			if($i < $nooftages)
			{
				$select_publick_workouts  = $select_publick_workouts. " or ";
				$cnt_publick_workouts  = $cnt_publick_workouts. " or ";
				
			}
			$save_search = "INSERT INTO `user_Search`(`User_id`, `search_tags`) VALUES ('$User_id', '$tags_value')";
			$result = mysqli_query($db,$save_search);
		}
		$select_publick_workouts = $select_publick_workouts.") ";
		$cnt_publick_workouts = $cnt_publick_workouts.") ";
		$cnt_publick_workouts;
		$cnt_publick_workouts_result = mysqli_query($db,$cnt_publick_workouts);
		$cnt_row = mysqli_fetch_array($cnt_publick_workouts_result);
		$count = $cnt_row['cnt'];
		
		//genarating query for get related lessons by search query
		$selec_lessons_search = "SELECT lessons_id, lessons_name, lesson_description, lesson_level, tags, vesson_tumb FROM lesson WHERE ";
		$cnt_lessons_search = "SELECT count(*) as cnt FROM lesson WHERE ";
		$i = 0;
		while($i<$nooftages)
		{
			$selec_lessons_search  = $selec_lessons_search."tags like '%".$tags1[$i]."%' or lessons_name like '%".$tags1[$i]."%' or lesson_description like '%".$tags1[$i]."%'";
			$cnt_lessons_search  = $cnt_lessons_search."tags like '%".$tags1[$i]."%' or lessons_name like '%".$tags1[$i]."%' or lesson_description like '%".$tags1[$i]."%'";
			$i = $i + 1;
			if($i < $nooftages)
			{
				$selec_lessons_search  = $selec_lessons_search . " or ";
				$cnt_lessons_search  = $cnt_lessons_search . " or ";
			}
		}
		$cnt_lessons_search_result = mysqli_query($db,$cnt_lessons_search);
		$cnt_row = mysqli_fetch_array($cnt_lessons_search_result);
		$count += $cnt_row['cnt'];
		//echo $selec_lessons_search;
		
		?>
	
  
    <hgroup>
      <h3>Search Results</h3>
      <h6 class="lead"><strong class="text-danger"><?php echo $count; ?></strong> results were found for the search for <strong class="text-danger"><?php echo $search_word; ?></strong></h6>
    </hgroup>
    <h2><span class="head-bg">Lessons</span></h2>
    <hr>
     <?php }
  if($search_word)
	{ ?>
    <br>
    <ul class="list-unstyled video-list-thumbs row">
	<?php 
		$check_lesson = 1;
		$selec_lessons_search_result = mysqli_query($db,$selec_lessons_search);
		while($row1 = mysqli_fetch_array($selec_lessons_search_result))
		{		
			$check_lesson = 0;
	?>
      <li class="col-lg-3 col-sm-4 col-xs-6"> <a href="video_detail.php?lessons_id=<?php echo $row1['lessons_id'] ;?>" title="<?php echo $row1['lessons_name']; ?>"> <img src="app/lessonsthumb/<?php echo $row1['vesson_tumb'] ;?>" alt="<?php echo $row1['lessons_name']; ?>" class="img-responsive" height="130px"/>
        <h2><?php echo $row1['lessons_name']; ?></h2>
        <div> <?php echo $row1['lesson_description']; ?></div>
        <button type="button" class="btn btn-default pull-left"> Start </button>
        <span class="glyphicon glyphicon-play-circle"></span> 
        <!--<span class="duration">03:15</span>-->
        <div class="clearfix"></div>
        </a> </li>
		<?php } ?>
	
        
    </ul>
    <?php if($check_lesson){ echo "<h3>No Lessons Found</h3>"; }?>
    <?php  ?>
    <div class="clearfix"></div>
    
     <h2><span class="head-bg">Routines</span></h2>
    <hr>
    <?php }
  if($search_word)
	{ ?>
    <br>
    <ul class="list-unstyled video-list-thumbs row">
	<?php
		/* display workouts */
		$check_workout = 1;
		$select_publick_workouts_result = mysqli_query($db,$select_publick_workouts);
		while($row = mysqli_fetch_array($select_publick_workouts_result))
		{
		$check_workout = 0;
		$workout  = $row['WorkoutId'];
		$code = $row['code'];
		$getvideos = "SELECT s.VideoID,c.video_thumb_path FROM `workoutvedios` as s,videos as c WHERE WorkoutID =$workout and c.video_id=s.VideoID limit 4";
					//echo $getvideos;
					$result_videos_workout = mysqli_query($db,$getvideos);
					//echo $getvideos;
					$row_videos = mysqli_fetch_array($result_videos_workout);
						
	?>
		
      <li class="col-lg-3 col-sm-4 col-xs-6"> <a href="workout_video.php?workout=<?php echo $code; ?>" title="Claudio Bravo, antes su debut con el Barça en la Liga"> <img src="app/videosthumb/<?php echo $row_videos['video_thumb_path']; ?>" alt="Barca" class="img-responsive" height="130px"/>
        <h2><?php echo $row['Name']." ".$row['duration']; ?></h2>
        <div><?php echo $row['Description']; ?></div>
        <button type="button" class="btn btn-default pull-left"> Start </button>
        <span class="glyphicon glyphicon-play-circle"></span> 
        <!--<span class="duration">03:15</span>-->
        <div class="clearfix"></div>
        </a> </li>
        
		<?php } ?>
    </ul>
    <?php if($check_workout){ echo "<h3>No Routines Found</h3>"; }?>
    
    <?php } ?>
    
  </div>
  <div class="clearfix"></div>
  <br>
  <br>
  
  <!-- Footer --> 
  <br>
  <br>
  <br>
  <br>
  <br>
  <footer>
    <?php include 'footer.php'; ?>
  </footer>
</div>
<!-- jQuery --> 
<script src="js/jquery.js"></script> 

<!-- Bootstrap Core JavaScript --> 
<script src="js/bootstrap.min.js"></script> 

<!-- Plugin JavaScript --> 
<script src="js/jquery.easing.min.js"></script> 

<!-- Custom Theme JavaScript --> 
<script src="js/grayscale.js"></script> 

<!-- Menubar JS--> 
<script src="js/jasny-bootstrap.min.js"></script> 

<!-- Custome JS--> 
<script src="js/custom.js"></script>
</body>
</html>