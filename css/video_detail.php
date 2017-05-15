<?php
session_start();
/*
echo "<h3> PHP List All Session Variables</h3>";
    foreach ($_SESSION as $key=>$val)
    echo $key." ".$val."<br/>";
	die();
*/
$User_id = $_SESSION['User_id'];
$User_type = $_SESSION['User_type'];
  $music = $_SESSION['music'];
$vis = $_SESSION['video'];
if(!$_SESSION['checker']){
	echo "<script>window.location = 'login.php';</script>";
}

include 'db1.php';

$lessons_id = $_GET['lessons_id'];
if($User_type == 'Trail'){
	$check_qry = "SELECT lesson_level FROM lesson where lessons_id = '$lessons_id'";
	$check_res = mysqli_query($db,$check_qry);
	$check_row = mysqli_fetch_array($check_res);
	
	if($check_row['lesson_level']==1){
		$access = 'denied';
	}
	
}

if($access=='denied')
{
	echo "<html><script>alert('Your are not authorized to view this video'); window.location = 'lessons.php'; </script></html>";
}
else{
?>
<?php 

			$query_lesson = "SELECT * FROM lessons_topic WHERE topic_lesson='$lessons_id'";
			$result1 = mysqli_query($db,$query_lesson);
				
				$row1 = mysqli_fetch_array($result1 );
			$topic_id = $row1['topic_id'];	

	
	$vid_id = $_GET['video_id'];
	$query = "select `t_v_id` FROM `topic_videos` WHERE `topic_id`='$topic_id';";
	$res = mysqli_query($db,$query);
	$vif_row = mysqli_fetch_array($res,MYSQLI_ASSOC);
	$t_v_id = $vif_row['t_v_id'];
	
	$query = "SELECT s.`t_v_id`,s.`description`,c.`video_name`,c.`video_id`, c.video_path,c.video_thumb_path,c.Desctiption FROM `topic_videos` s, videos c where s.`Vides_id` = c.video_id and `topic_id`='".$topic_id."' and c.video_id in (SELECT `Vides_id` FROM `topic_videos` WHERE `topic_id`='".$topic_id."' and `t_v_id`>='".$t_v_id."' ORDER BY Vides_id ASC) ";
	$result = mysqli_query($db,$query);
	
	$now_id = 0;
	$now_i = 0;

	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 	 {
	
		$vid_location = $row['video_path'];
		$aud_location = substr($row['video_path'],0,-1)."3";
			
		if($music == 0){
			//echo 1;
			$loc = explode("/",$vid_location);
			$row['video_path'] = "videos_nomusic/".$loc[1];
			//str_replace('videos','videos_nomusic',$row['video_path']);
			//echo $row['video_path'];
			
		}
		
		if($vis == 0){
			//echo 1;
			$loc = explode("/",$aud_location);
			$row['video_path'] = "audioonly/".$loc[1];
			//str_replace('videos','videos_nomusic',$row['video_path']);
			//echo $row['video_path'];
			
		}
		
		if($music == 0 && $vis == 0){
			//echo 1;
			$loc = explode("/",$aud_location);
			$row['video_path'] = "audioonly_nomusic/".$loc[1];
			//str_replace('videos','videos_nomusic',$row['video_path']);
			//echo $row['video_path'];
			
		}
		
	 $video_full_data[] = array('id'=> $row['video_id'],
	  'video_name' => $row['video_name'],
	  'video_path' => $row['video_path'],
	  'video_thumb' =>$row['video_thumb_path'],
	  'video_desc' => $row['Desctiption']
	  );
	  
	 if($vid_id == $row['video_id'] ){
		 $now_id = $now_i;
	 }
	  
	  $now_i++;
  }
  $now_vid = $video_full_data[$now_id]['id'];
  if($now_id==0){
	  $prev_vid=-1;
  }else{ $prev_vid = $video_full_data[$now_id-1]['id']; }
  if($now_id==$now_i){
	  $next_vid=-1;
  }else{
  $next_vid = $video_full_data[$now_id+1]['id'];  }
	
//print_r($video_full_data);
?>
			
			
			
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'head.php'; ?>
<link type="text/css" href="skin/blue.monday/css/jplayer.blue.monday.css" rel="stylesheet" />
<title>Natyarambha - Lesson Video</title>
<link rel="shortcut icon" href="natya.ico"/>

<style>


</style>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<div class="canvas video-detail2" > 
  <!-- Navigation -->
  <?php include 'nav.php'; ?>
  <!-- /lessons -->
  <div class="clearfix"></div>
  <br>
  <br>
  <div class="container lessons video-detail"> <br>
    <h4 class="chead"><?php echo $video_full_data[$now_id]['video_name']; ?></h4>
    <br>
    <ul class="list-unstyled video-list-thumbs row big-vid  " >
    
    <li class="col-sm-5 col-xs-12 vid-det-cont">
		<?php echo $video_full_data[$now_id]['video_desc'];?> 
    </li>
    
      <li class="big-video pull-left toggl-video col-sm-9 col-xs-12" style="max-height:480px; "> 
		<script type="text/javascript">
			var same_vid = false;
			var full_screen = false;
			<?php 
			if(isset($_GET['repeat']))
			{
				?>
				same_vid = true;
				<?php
			}
			if(isset($_GET['fullscreen']))
			{
				?>
				full_screen = <?= $_GET['fullscreen'] ?>;
				<?php
			}
			?>
				$(document).ready(function(){
				  
				  
					$("#jquery_jplayer_N").jPlayer( {
					  ready: function() { // The $.jPlayer.event.ready event
						$(this).jPlayer("setMedia", { // Set the media
						  m4v: "app/<?php echo $video_full_data[$now_id]['video_path'];?> "
						})
						
						.jPlayer("play"); // Attempt to auto play the media
					  },
					  
					  ended: function() { // The $.jPlayer.event.ended event
					  if (same_vid) { 
							
							same_video();
							
						  } else {
							next_video();
						  }
					  },
					  cssSelectorAncestor: "#jp_container_N",
					  playlistOptions: {
						autoPlay: true,
						loopOnPrevious: true,
						enableRemoveControls: true
						},
						swfPath: "/js",
						supplied: "m4v",
						useStateClassSkin: true,
						autoBlur: false,
						smoothPlayBar: true,
						keyEnabled: true,
						audioFullScreen: true,
						size: {
							width:'638px',
							height:'400px',
							cssClass:'jp-video-360p'
						},
						
			
						<?php 
			if(isset($_GET['repeat']))
			{
				?>
				loop: true
				<?php
			}
			else{
				?>
				loop: false
				<?php
			}
			?>
			
					});
					
					
				});					
					
					$(document).on('click', "button.jp-next", function () {
						next_video();
					});
					$(document).on('click', "button.jp-previous", function () {
						prev_video();
					});
					$(document).on('click', "button.jp-full-screen", function () {
						full_screen = !full_screen;
					});
					$(document).on('click', "button#repeat_btn1", function () {
						//alert(1);
						same_vid = !same_vid;
						if(same_vid){
							$("#repeat_btn1").addClass("jp-state-looped");
							$("#repeat_btn2").addClass("jp-state-looped");
						}
						else{
							$("#repeat_btn1").removeClass("jp-state-looped");
							$("#repeat_btn2").removeClass("jp-state-looped");
						}
					});
					$(document).on('click', "button#repeat_btn2", function () {
						//alert(1);
						same_vid = !same_vid;
						if(same_vid){
							$("#repeat_btn1").addClass("jp-state-looped");
							$("#repeat_btn2").addClass("jp-state-looped");
						}
						else{
							$("#repeat_btn1").removeClass("jp-state-looped");
							$("#repeat_btn2").removeClass("jp-state-looped");
						}
					});
					var next_vid = '<?php echo $next_vid; ?>';
					var prev_vid = '<?php echo $prev_vid; ?>';
					if($_GET['fullscreen'])
					{
					
						$("#jquery_jplayer_N").jPlayer("option", {"fullScreen": true});
					}
					function next_video(){
						if(next_vid==-1){ 
							alert('No Video avaliable');
						}else{
							window.location = 'video_detail.php?lessons_id=<?php echo $lessons_id; ?>&video_id=<?php echo $next_vid; ?>&fullscreen='+full_screen;
						}
					}
					function prev_video(){
						if(prev_vid==-1){
							alert('No Video avaliable');
						}else{
							window.location = 'video_detail.php?lessons_id=<?php echo $lessons_id; ?>&video_id=<?php echo $prev_vid; ?>&fullscreen='+full_screen;
						}
					}
					function same_video(){
						
						window.location = 'video_detail.php?lessons_id=<?php echo $lessons_id; ?>&video_id=<?php echo $vid_id; ?>&repeat='+same_vid+'&fullscreen='+full_screen;
					}
					
			  </script>

			<div id="jp_container_N" class="jp-video" role="application" aria-label="media player">
				<div class="jp-type-playlist">
					<div id="jquery_jplayer_N" class="jp-jplayer"></div>
					<div class="jp-gui">
						<div class="jp-video-play">
							<button class="jp-video-play-icon" role="button" tabindex="0">play</button>
						</div>
						<div class="jp-interface">
							<div class="jp-progress">
								<div class="jp-seek-bar">
									<div class="jp-play-bar"></div>
								</div>
							</div>
							<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
							<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
							<div class="jp-details">
								<div class="jp-title" aria-label="title">&nbsp;</div>
							</div>
							<div class="jp-controls-holder">
								<div class="jp-volume-controls">
									<button class="jp-mute" role="button" tabindex="0">mute</button>
									<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
									<div class="jp-volume-bar">
										<div class="jp-volume-bar-value"></div>
									</div>
								</div>
								<div class="jp-controls">
									<button class="jp-previous" role="button" tabindex="0">previous</button>
									<button class="jp-play" role="button" tabindex="0">play</button>
									<button class="jp-stop" role="button" tabindex="0">stop</button>
									<button class="jp-next" role="button" tabindex="0">next</button>
								</div>
								<div class="jp-toggles">
									<button class="jp-repeat" id="repeat_btn1" role="button" tabindex="0">repeat</button>
									
									<button class="jp-full-screen" role="button" tabindex="0">full screen</button>
								</div>
							</div>
						</div>
					</div>
					<div class="jp-playlist" style="display:none;">
						<ul>
							<!-- The method Playlist.displayPlaylist() uses this unordered list -->
							<li></li>
						</ul>
					</div>
					<div class="jp-no-solution" style="display:none;">
						<span>Update Required</span>
						To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
					</div>
				</div>
			</div>
        <div class="content-video"> </div>
      </li>
	  <script>
		$(document).ready(function(){
			$(".learnMore").click(function(){
				
				$("#jquery_jplayer_N1").jPlayer("unmute");
				$("#jquery_jplayer_N").jPlayer("mute");
				$(".toggl-video").removeClass("col-sm-9");
				$(".toggl-video").addClass("col-sm-6");
				$(".vid-opt").removeClass("col-sm-3");
				$(".vid-opt").addClass("col-sm-6");	
				
			});
			$(".watchVid").click(function(){
				$("#jquery_jplayer_N1").jPlayer("mute");
				$("#jquery_jplayer_N").jPlayer("unmute");
				$(".toggl-video").removeClass("col-sm-6");
				$(".toggl-video").addClass("col-sm-9");	
				$(".vid-opt").removeClass("col-sm-6");
				$(".vid-opt").addClass("col-sm-3");	
			});
		});
	  </script>
      <nav class="vid-opt pull-right col-sm-3 col-xs-12">
		
		<!------------------------------------------------------------------------------------------------------------>
		<div id="small_player" style="display:none">
		<script type="text/javascript">
				$(document).ready(function(){
				  
					$("#jquery_jplayer_N1").jPlayer( {
					  ready: function() { // The $.jPlayer.event.ready event
						$(this).jPlayer("setMedia", { // Set the media
						  m4v: "app/<?php echo $video_full_data[$now_id]['video_path'];?> "
						}).jPlayer("play"); // Attempt to auto play the media
					  },
					  ended: function() { // The $.jPlayer.event.ended event
						if (same_vid) { 
							
							same_video();
							
						  } else {
							next_video();
						  }
					  
					  },
					  cssSelectorAncestor: "#jp_container_N1",
					  playlistOptions: {
						autoPlay: true,
						loopOnPrevious: true,
						enableRemoveControls: true
						},
						swfPath: "/js",
						supplied: "m4v",
						useStateClassSkin: true,
						autoBlur: false,
						smoothPlayBar: true,
						keyEnabled: true,
						audioFullScreen: true,
						size: {
							
						},
						<?php 
							if(isset($_GET['repeat']))
							{
								?>
								loop: true
								<?php
							}
							?>
					});
					
					$("#jquery_jplayer_N1").jPlayer("play");
					$("#jquery_jplayer_N1").jPlayer("mute");
					$("#jquery_jplayer_N1").jPlayer("loop");
					
					
					
				});					
					
					$(document).on('click', "button.jp-next", function () {
						next_video();
					});
					$(document).on('click', "button.jp-previous", function () {
						prev_video();
					});
					$(document).on('click', "button.jp-play", function (event) {
						event.preventDefault();
						  if($("#jquery_jplayer_N").data("jPlayer").status.paused) {
						   $("#jquery_jplayer_N").jPlayer("play");
						   $("#jquery_jplayer_N1").jPlayer("play");
						} else {
						   $("#jquery_jplayer_N").jPlayer("pause");
						   $("#jquery_jplayer_N1").jPlayer("pause");
						}
					});
					var next_vid = '<?php echo $next_vid; ?>';
					var prev_vid = '<?php echo $prev_vid; ?>';
					function next_video(){
						if(next_vid==-1){ 
							alert('No Video avaliable');
						}else{
							window.location = 'video_detail.php?lessons_id=<?php echo $lessons_id; ?>&video_id=<?php echo $next_vid; ?>&fullscreen='+full_screen;
						}
					}
					function prev_video(){
						if(prev_vid==-1){
							alert('No Video avaliable');
						}else{
							window.location = 'video_detail.php?lessons_id=<?php echo $lessons_id; ?>&video_id=<?php echo $prev_vid; ?>&fullscreen='+full_screen;
						}
					}
					
			  </script>

			<div id="jp_container_N1" class="jp-video jp-video-270p" role="application" aria-label="media player">
				<div class="jp-type-playlist">
					<div id="jquery_jplayer_N1" class="jp-jplayer"></div>
					<div class="jp-gui">
						<div class="jp-video-play">
							<button class="jp-video-play-icon" role="button" tabindex="0">play</button>
						</div>
						<div class="jp-interface">
							<div class="jp-progress">
								<div class="jp-seek-bar">
									<div class="jp-play-bar"></div>
								</div>
							</div>
							<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
							<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
							<div class="jp-details">
								<div class="jp-title" aria-label="title">&nbsp;</div>
							</div>
							<div class="jp-controls-holder">
								<div class="jp-volume-controls">
									<button class="jp-mute" role="button" tabindex="0">mute</button>
									<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
									<div class="jp-volume-bar">
										<div class="jp-volume-bar-value"></div>
									</div>
								</div>
								<div class="jp-controls">
									<button class="jp-previous" role="button" tabindex="0">previous</button>
									<button class="jp-play" role="button" tabindex="0">play</button>
									<button class="jp-stop" role="button" tabindex="0">stop</button>
									<button class="jp-next" role="button" tabindex="0">next</button>
								</div>
								<div class="jp-toggles">
									<button class="jp-repeat" id = "repeat_btn2" role="button" tabindex="0">repeat</button>
									
									<button class="jp-full-screen" role="button" tabindex="0">full screen</button>
								</div>
							</div>
						</div>
					</div>
					<div class="jp-playlist" style="display:none;">
						<ul>
							<!-- The method Playlist.displayPlaylist() uses this unordered list -->
							<li></li>
						</ul>
					</div>
					<div class="jp-no-solution" style="display:none;">
						<span>Update Required</span>
						To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
					</div>
				</div>
			</div>
        <div class="content-video"> </div>
		</div>
		
		<!------------------------------------------------------------------------------------------------------------>
		
        <ul class="nav">
         <!-- <li class="sm-thumb-vid" style="display:none;"> <a href="#"  title="Claudio Bravo, antes su debut con el Barça en la Liga"> <img src="img/ted2.jpg" alt="Natyam" class="img-responsive " width="100%"> 
            <span class="duration">03:15</span>-->
            <div class="clearfix"></div>
            </a>
            <div class="clearfix"></div>
          </li>
          <li><a href="#" class="watchVid">Watch</a></li>
          <li><a href="#" class="learnMore">Learn more </a></li>
          <li><a href="#" id="add_to_workout">
		  <?php
				
				 $query = "select s.WorkoutId,s.Name,s.Access,s.Description,s.WorkoutDuration from workouts as s where s.CreatedBy = '$User_id'";
				
				?>
				
				<select id="add_workout" class="form-control">
					<option >Add to Workout</option>
				<?php 
				$result = mysqli_query($db,$query);
				while($row = mysqli_fetch_array($result))
							{
				?>
					<option value="<?php echo $row['WorkoutId'];?>"><?php	echo $row['Name']; ?></option>
				<?php } ?>	
				
				</select>
          
            
            <button type="button" id="workout_btn" class="btn btn-default pull-right">GO</button>
            
             <div class="clearfix"></div>
            </a>
           <div class="clearfix"></div>
          </li>
        </ul>
      </nav>
      
    </div>
    <div class="clearfix"></div>
	
	<script>
	$( document ).ready(function() {
			$("#workout_btn").click(function(){
				var workout_id = $('#add_workout').val();
				var vids_id = <?php echo $now_vid;?>;
				$.ajax(
					  {
						method:'POST',
						data:{'id':workout_id,'video_id':vids_id},
						url:'add_video_to_workout.php',
						success:function(res)
						{
							if(res==3){
								alert("Already in workout");
							}
							if(res==12){
								$("#add_to_workout").html("Added to Workout");
							}
							else{
								alert("Please try again");
							}
						}
					  }		  
					);
			});
		});
	</script>
    <br>
	
   
	
	<div class="container">
	 <hr><br>
    <ul class="list-unstyled video-list-thumbs row strip-video">
      
      <?php 
			for($list_i=$now_id;$list_i<$now_i;$list_i++){
				
			
		?>
	  
      <li class="col-lg-3 col-sm-4 col-xs-6 " > <a href="video_detail.php?lessons_id=<?php echo $lessons_id; ?>&video_id=<?php echo $video_full_data[$list_i]['id'] ?>"  title="<?php echo $video_full_data[$list_i]['video_name']; ?>"> <img src="app/videosthumb/<?php echo $video_full_data[$list_i]['video_thumb']; ?>" alt="Video" class="img-responsive" height="130px"/>
        <h2><?php echo $video_full_data[$list_i]['video_name']; ?></h2>
        
        <span class="glyphicon glyphicon-play-circle"></span> 
        <div class="clearfix"></div>
        </a> </li>
		
		<?php } ?>
      
    </ul>
	</div>
	
	
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

<?php include 'scripts.php'; ?>

<!-- Player JS -->
<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="js/jplayer.playlist.js"></script>

</body>
</html>
<?php	
}
?>