<?php
session_start();
$User_id = $_SESSION['User_id'];
if(!$_SESSION['checker']){
	echo "<script>window.location = 'login.php';</script>";
}

include 'db1.php';

$lesson_id  = $_POST['lesson_id'];

$search_description = $_POST['search_description']; 
$list = $_POST['list'];
	$select_lesson = "SELECT * FROM `lesson`";
	$tag = 0;
	if($lesson_id){
		$tag = 1;
		$select_lesson = $select_lesson." where lessons_id='$lesson_id'";
	}

	if($search_description){
		if($tag == 0){
			$select_lesson = $select_lesson." where ";
			$tag =1;
		}
		else{
			$select_lesson = $select_lesson." and ";
		}
		$select_lesson = $select_lesson."( lesson_description like '%$search_description%' OR lessons_name like '%$search_description%' )";
	}
	//echo $select_lesson;
	$select_lesson_result = mysqli_query($db,$select_lesson);
	
	  
  ?>
  
   <div class="container c-al-vid" id="video_list">
 <h2><span class="head-bg">All Videos</span></h2>
    <hr>
    <div class="clearfix"></div>
 <?php 
 while($lesson_row = mysqli_fetch_array($select_lesson_result)){
	 
	 ?>
 
  <script>
  	$(document).ready(function() {
			
		$('.addto-workout').click(function() {
			//alert(1);
			vid_id = this.id;
			//alert(vid_id);
			$('#select_'+vid_id).addClass("liOpacity");
			$('#unselect_'+vid_id).show();
			videos_list.push(vid_id);
			//show in selected
		});
			
		$('.remove-from-workout').click(function() {
			//alert(1);
			vid_id = this.id;
			//alert(vid_id);
			$('#unselect_'+vid_id).hide();
			$('#select_'+vid_id).removeClass("liOpacity");
			videos_list.splice(videos_list.indexOf(vid_id),1);
			//show in selected
		});	
			
		
	});
	</script>
  
  
    <h2><span class="head-bg"><?php echo $lesson_row['lessons_name']; ?></span></h2>
    <hr>
    <br>
    <ul class="list-unstyled video-list-thumbs row workout-new-strip">
		<?php 
		$query_lesson = "SELECT * FROM lessons_topic WHERE topic_lesson='".$lesson_row['lessons_id']."'";
			$result1 = mysqli_query($db,$query_lesson);
				
				$row1 = mysqli_fetch_array($result1 );
			$topic_id = $row1['topic_id'];	

	
	$query = "select `t_v_id` FROM `topic_videos` WHERE `topic_id`='$topic_id';";
	$res = mysqli_query($db,$query);
	$vif_row = mysqli_fetch_array($res,MYSQLI_ASSOC);
	$t_v_id = $vif_row['t_v_id'];
	
	$query = "SELECT s.`t_v_id`,s.`description`,c.`video_name`,c.`video_id`, c.video_path,c.video_thumb_path,c.short_desc,c.video_duration FROM `topic_videos` s, videos c where s.`Vides_id` = c.video_id and `topic_id`='".$topic_id."' and c.video_id in (SELECT `Vides_id` FROM `topic_videos` WHERE `topic_id`='".$topic_id."' and `t_v_id`>='".$t_v_id."' ORDER BY Vides_id ASC) ";
	$result = mysqli_query($db,$query);
	
	$now_id = 0;
	$now_i = 0;
	$vid_cnt_stat = 0;
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 	 {
 	 $vid_cnt_stat = 1;
	?>
	
	
		
	
      <li class="col-lg-3 col-sm-4 col-xs-6" id="select_<?php echo $row['video_id']; ?>">
        <div class="cre-new-workot" ></div>
		
		<a title="<?php echo $row['video_name']; ?>"> <img src="app/videosthumb/<?php echo $row['video_thumb_path']; ?>" alt="<?php echo $row['video_name']; ?>" class="img-responsive" height="130px"/>
        <h2><?php echo $row['video_name']; ?></h2>
       <div  style="height:30px;"> <?php echo $row['short_desc'];?></div>
	   <span class="duration"><?php list($mins , $secs) = explode('.' ,$row['video_duration']); echo $mins.":".$secs; ?></span>
        <button type="button" class="btn btn-default pull-right addto-workout" id="<?php echo $row['video_id']; ?>" > Add to workout </button>
        <span class="glyphicon glyphicon-play-circle"></span> 
        <!--<span class="duration">03:15</span>-->
        <div class="clearfix"></div>
        </a>
		
		
        
        
        
        
       </li>
	<?php }
	if($vid_cnt_stat == 0){
		echo "<h4>No Videos Found</h4>";
	}
	 ?>
	  
    </ul>
    <div class="clearfix"></div>

    
    <br>
    
  </div>
  
	<?php } ?>