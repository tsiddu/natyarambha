<?php

function learn_view_lessons()
{
?>
<!--Sorry About the Heavy CSS But its neaded for the components make it external for quicker load time :) -->
<style>
.pricing-table .plan {
  border-radius: 5px;
  text-align: center;
  background-color: #f3f3f3;
  -moz-box-shadow: 0 0 6px 2px #b0b2ab;
  -webkit-box-shadow: 0 0 6px 2px #b0b2ab;
  box-shadow: 0 0 6px 2px #b0b2ab;
}
 
 .plan:hover {
  background-color: #fff;
  -moz-box-shadow: 0 0 12px 3px #b0b2ab;
  -webkit-box-shadow: 0 0 12px 3px #b0b2ab;
  box-shadow: 0 0 12px 3px #b0b2ab;
}
 
 .plan {
  padding: 20px;
  color: #ff;
  background-color: #5e5f59;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
}
  
.plan-name-bronze {
  padding: 20px;
  color: #fff;
  background-color: #665D1E;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
 }
  
.plan-name-silver {
  padding: 20px;
  color: #fff;
  background-color: #C0C0C0;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
 }
  
.plan-name-gold {
  padding: 20px;
  color: #fff;
  background-color: #FFD700;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
  } 
  
.pricing-table-bronze  {
  padding: 20px;
  color: #fff;
  background-color: #f89406;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
}
  
.pricing-table .plan .plan-name span {
  font-size: 20px;
}
 
.pricing-table .plan ul {
  list-style: none;
  margin: 0;
  -moz-border-radius: 0 0 5px 5px;
  -webkit-border-radius: 0 0 5px 5px;
  border-radius: 0 0 5px 5px;
}
 
.pricing-table .plan ul li.plan-feature {
  padding: 15px 10px;
  border-top: 1px solid #c5c8c0;
}
 
.pricing-three-column {
  margin: 0 auto;
  //width: 80%;
  float:left;
  padding: 10px;
width: 300px;
}
 
.pricing-variable-height .plan {
  float: none;
  margin-left: 2%;
  vertical-align: bottom;
  display: inline-block;
  zoom:1;
  *display:inline;
}
 
.plan-mouseover .plan-name {
  background-color: #4e9a06 !important;
}
 
.btn-plan-select {
  padding: 8px 25px;
  font-size: 18px;
}
</style>
 
 <?php
 
 $db = getdb();
 $select_lessons = "SELECT * FROM lesson";
 $query_result = mysqli_query($db,$select_lessons);
 $i = 3;
 ?>
	<div class='span10'>
	<?php
	while($row=mysqli_fetch_array($query_result))
	{
		?>
		<div class="row pricing-table pricing-three-column"> 
			<div class=" plan">
			  <div class="plan-name-bronze">
				<h2><?php echo $row['lessons_name'];?></h2>
			  </div>
			  <ul>
				<li class="plan-feature"><?php echo substr($row['lesson_description'],0,150)."...";?></li>  
				<li class="plan-feature"><a href="?module=learn&task=lessons_view&lessons_id=<?php  echo $row['lessons_id']; ?>" class="btn btn-primary btn-plan-select"><i class="icon-white icon-ok"></i> Choose this Lesson</a></li>
			  </ul>
			</div>
		</div>
	<?php
	}
	?>
	</div>
<?php	
}


function learn_lessons_view()
{
	if(isset($_GET['lessons_id']))
	{
		$lessons_id = $_GET['lessons_id'];
		$User_id = $_SESSION['User_id'];
		$db = getdb();
		
		$insert_favirets = "INSERT INTO `user_views_logs`(`category`, `userid`, `caty_id`,date_time) VALUES ('lessons','$User_id','$lessons_id',now())";
		$insetResult = mysqli_query($db,$insert_favirets);
		
		$query_lessons = "SELECT * FROM `lesson` where lessons_id=".$lessons_id;
		$result = mysqli_query($db,$query_lessons);
		$row = mysqli_fetch_array($result);	
		$query_forget_bookmark_count = "SELECT count(*) as count_val FROM `user_favrits` WHERE Category='lessons' and type_id='$lessons_id'";
		$result_bookmark = mysqli_query($db,$query_forget_bookmark_count);
		$row_count = mysqli_fetch_array($result_bookmark);
		$bookmarkCount = $row_count['count_val'];
		$lesson_name = $row['lessons_name'];
		$lesson_descrp = $row['lesson_description'];
		
			$query_lesson = "SELECT * FROM lessons_topic WHERE topic_lesson=".$row['lessons_id'];
			$result1 = mysqli_query($db,$query_lesson);
				
				$row1 = mysqli_fetch_array($result1 );
				
			?>
		<div class='span7' style="font-family: 'Open Sans', sans-serif;margin-left: 20px !important;">
			<br>
			<br>
			<blockquote style='border-left: 5px solid #AA8D8D;'>
			<span style='font-family: "Open Sans", sans-serif;font-size: 30px;text-shadow: 1px 2px 3px orange;'><?php echo $lesson_name." - ".$lesson_descrp;?></span>
			<?php
			if($bookmarkCount == 0) {
				echo "<a href='?module=learn&task=add_to_bookmark&lession_id=".$lessons_id."' style='float:right;'>Add to bookmarks</a>";
			}
			else {
				echo "<a href='?module=learn&task=remove_bookmark&lession_id=".$lessons_id."' style='float:right;'>Remove from bookmarks</a>";
			}
			?>
			<p style="font-family: 'Open Sans', sans-serif;min-height: 100px;min-height: 100px;background-color: rgb(250, 250, 250);padding: 10px;">
			<?php echo $row1['tpoic_description'] ;?>
			</p>
			</blockquote>
			<a href="?module=learn&task=view_lessons" class='btn'> Back to Lessons</a>
		</div>
		<div class='span3' style="font-family: 'Open Sans', sans-serif;">
		<br>
		<br>
		<span style='font-weight: bold;'>Topics List</span>
		<br>
		<br>
			<?php echo '<a href="?module=learn&task=lessons_view_topics&topic_id='.$row1['topic_id'].'&lessons_id='.$lessons_id.'">View Videos</a>'; ?>
			
			
				
			
		</div>
		<?php
	}
	else{
		echo "sorry no row selected";
	}
}


/////////////////////////////////////////////////////////////////////
//////////////////////----------------------------------------------
function learn_lessons_view_topics()
{
	if(isset($_GET['topic_id']) and isset($_GET['lessons_id']))
	{
		$topic_id = $_GET['topic_id'];
		$db = getdb();
		$query = "SELECT s.`t_v_id`,s.`description`,c.`video_name`,c.`video_id`, c.video_path,c.video_thumb_path,c.Desctiption FROM `topic_videos` s, videos c where s.`Vides_id` = c.video_id and `topic_id`=".$topic_id;
		$result = mysqli_query($db,$query);
	?>
	<div class="row-fluid">
	<div class='span12'>
	<?php
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 	 {
	  //cue points
	  $cuepoints='';
	  $select_query="SELECT * FROM videos_q_points where video_id='".$row['video_id']."'";
	  $cuepoint_data = mysqli_query($db,$select_query);
	  while($cue_row = mysqli_fetch_array($cuepoint_data))
	  {
		$cuepoints .= round($cue_row["q_point_value"],2).",";
		$cue_desc[] = array('point'=>round($cue_row["q_point_value"],2),'desc'=>$cue_row["q_point_description"]);
	  }
	$cuepoints = substr($cuepoints,0,-1);
	 $video_full_data[]= array('id'=> $row['video_id'],
	  'video_name' =>$row['video_name'],
	  'video_path' => $row['video_path'],
	  'video_thumb' =>$row['video_thumb_path'],
	  'cuepoints'=>$cuepoints
	  );
	  
  }
//var_dump($cue_desc);
//var_dump($video_full_data);
$cue_encode_data=array_merge($video_full_data,$cue_desc);
//var_dump($cue_encode_data);
$cue=json_encode($cue_encode_data);
$cuevid=json_encode($video_full_data);
$cuepts=json_encode($cue_desc);
?>
<script>
var small;
var checked;
$(document).ready(function(){
	
  $("#2").click(function(){
	$('#playerdiv').removeClass("pull-left col-md-8");
	$('#playerdiv').addClass("pull-right col-md-4");
	if(window.checked==true){
			$('video').css('display','none');
			$('.flowplayer').css('height','40px');
			}else{
			$('video').css('display','block');
			
			$('.flowplayer').css('height','250px');
			
			}
	
	$('#descdiv').show();
	$('#minidiv').hide();
	$('#workoutdiv').hide();
	small = 1;
   
  });
 $("#1").click(function(){
	$('#playerdiv').addClass("pull-left col-md-8");
	$('#playerdiv').removeClass("pull-right col-md-4");
	if(window.checked==true){
			$('video').css('display','none');
			$('.flowplayer').css('height','40px');
			}else{
			$('video').css('display','block');
			
			$('.flowplayer').css('height','400px');
			
			}
	$('#descdiv').hide();
	$('#minidiv').show();
		$('#workoutdiv').hide();
		

});
$("#3").click(function(){
		$('#workoutdiv').show();

	
});


});
</script>
<!-- player skin -->
<link rel="stylesheet" type="text/css" href="skin/minimalist.css">
<!-- site specific styling -->
<style type="text/css">
#jsplaylist { width: 80%; background-color: #222; background-size: cover; max-width: 800px; }
#jsplaylist .fp-controls { background-color: rgba(247, 244, 244, 0)}
#jsplaylist .fp-timeline { background-color: rgba(0, 0, 0, 0.5)}
#jsplaylist .fp-progress { background-color: rgba(15, 117, 52, 1)}
#jsplaylist .fp-buffer { background-color: rgba(249, 249, 249, 1)}
.last-video.is-finished
{
   / do your marketing magic /
   { background-color: red}
}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<!-- include flowplayer -->
<script type="text/javascript" src="flowplayer.min.js"></script>
<!--<script type="text/javascript" src="flowplayer-3.2.12.min.js"></script>-->   
<script>
/* flowplayer(function (api, root) {

api.bind("load", function () {

// do something when a new video is about to be loaded

}).bind("ready", function () {
// do something when a video is loaded and ready to play

});

}); */
// run script after document is ready
$(function () {
var i=0;
//$("#jsplaylist").flowplayer();
var cuecnt=-1;
$(".flowplayer").bind("cuepoint", function(e, api, cuepoint) {
 cuecnt=cuecnt+1;
   var points= <?php echo $cuevid;?>;
   var cues= <?php echo $cuepts;?>;
 for(i=0;i<points.length;i++){
 var pnts=points[i]['cuepoints'].split(',')
 for(k=0;k<pnts.length;k++){
 if(pnts[k]==cuepoint.time){
 if(cues[cuecnt]['point']==cuepoint.time){
 $('#content').html(cues[cuecnt]['desc']);
 }
 }
 }
 }
});
});
</script>
<link rel="stylesheet" href="js/jquery.checkbox.css" />
<link rel="stylesheet" href="js/jquery.safari-checkbox.css" />
<script type="text/javascript" src="js/jquery.checkbox.js"></script><div style="width:100%">
<script>
$(document).ready( function () {
				$('input:checkbox:not([safari])').checkbox();
});


			function toggleaudio(){
			var isChecked = $('#checkOne:checked').val()?true:false;
			checked = isChecked;
			if(isChecked==true){
			$('video').css('display','none');
			$('.flowplayer').css('height','40px');
			}else{
				$('video').css('display','block');
					if(window.small == 1){
					$('.flowplayer').css('height','250px');
					}
					else{
					$('.flowplayer').css('height','400px');	
					}
				}
			}
</script>
Audio Mode: <input type="checkbox" id="checkOne" onclick="toggleaudio();" />
<a style='float:right;' href="?module=learn&task=lessons_view&lessons_id=<?php echo $_GET['$lessons_id'];?>" class='btn'>Back To lesson</a>
<br/><hr/>

<div class="flowplayer no-toggle play-button span9" style='height: 420px;' data-embed="false" >
   <video id='myVideoTag'>
   <?php
	if(isset($_GET['vid']))
	{
		$vidpath = base64_decode($_GET['vid']);
		echo '<source type="video/mp4" src="'.$vidpath.'">';
		//break;
	}
	else
	{
		foreach($video_full_data as $row_data)
		{
		echo '<source type="video/mp4" src="'.$row_data["video_path"].'">';
		//break;
		}
	}
   ?>
    </video>
</div>

<script type="text/javascript">
function change_video (a)
{
//alert(a);
window.location.href = 'http://localhost/natyam/app/?module=learn&task=lessons_view_topics&topic_id='+<?php echo $topic_id; ?>+'&vid='+a;
}
</script>

<!-- Video Thumbnails-->
<div class="span2">
	<span style='padding: 5px;font-size: 16px;'>Videos List</span>
<?php 
$get_videos_topics = "SELECT `video_id`,video_duration,`video_path`,video_name,video_thumb_path FROM `videos` WHERE `video_id` in (SELECT `Vides_id` FROM `topic_videos` WHERE `topic_id`='".$topic_id."')";
$get_videos_topics_result = mysqli_query($db,$get_videos_topics);
	  while($list_data = mysqli_fetch_array($get_videos_topics_result))
	  {
	  	$vid_path_gen = base64_encode(baseurl.'app/'.$list_data["video_path"]);
	  	$vid_path_gen = urlencode($vid_path_gen);
		?>
		<div class='span12' onclick='change_video("<?php echo $vid_path_gen; ?>")' style="position: relative;background-size: cover;cursor: pointer;width: 190PX;height: 120PX;margin: 5px;background-image:URL(<?php echo $list_data["video_thumb_path"]; ?>);">
		<div style='bottom: 0;background: rgba(68, 58, 82, 0.6);padding: 4px;color: wheat;position: absolute;width: 182px;'>
		<span><?php echo substr($list_data['video_name'],0,50);?></span>
		<span style='float: right;' class='sssss'><?php echo substr($list_data['video_duration'],0,50);?></span>
		</div>			
		</div>	
		<?php
	  }
	  ?>
</div>
</div>
<style>
.fp-playlist{
width: 200px;
margin-left: 530px;
}

</style>
<div id="content" class='span5'>test tests</div>
	</div>
	</div>
	<?php
	}
}


function learn_add_to_bookmark()
{
	if(isset($_GET['lession_id'])) {
		$db = getdb();
		$lessons_id = $_GET['lession_id'];
		$user_id = $_SESSION['User_id'];
		$query = "INSERT INTO `user_favrits`(`Category`, `userID`, `type_id`, `viewDate`) VALUES ('Lessons','$user_id','$lessons_id',now())";
		$result = mysqli_query($db,$query);
		if($result == true) {
			echo "<script>window.location = 'index.php?module=learn&task=lessons_view&lessons_id=".$lessons_id."';</script>";
		}
		else {
			echo "<script>alert('please select lesson')</script>";
			echo "<script>window.location = 'index.php?module=learn&task=view_lessons';</script>";
		}
	}
}

function learn_view_bookmarks() {
	
?>
<!--Sorry About the Heavy CSS But its neaded for the components make it external for quicker load time :) -->
<style>
.pricing-table .plan {
  border-radius: 5px;
  text-align: center;
  background-color: #f3f3f3;
  -moz-box-shadow: 0 0 6px 2px #b0b2ab;
  -webkit-box-shadow: 0 0 6px 2px #b0b2ab;
  box-shadow: 0 0 6px 2px #b0b2ab;
}
 
 .plan:hover {
  background-color: #fff;
  -moz-box-shadow: 0 0 12px 3px #b0b2ab;
  -webkit-box-shadow: 0 0 12px 3px #b0b2ab;
  box-shadow: 0 0 12px 3px #b0b2ab;
}
 
 .plan {
  padding: 20px;
  color: #ff;
  background-color: #5e5f59;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
}
  
.plan-name-bronze {
  padding: 20px;
  color: #fff;
  background-color: #665D1E;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
 }
  
.plan-name-silver {
  padding: 20px;
  color: #fff;
  background-color: #C0C0C0;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
 }
  
.plan-name-gold {
  padding: 20px;
  color: #fff;
  background-color: #FFD700;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
  } 
  
.pricing-table-bronze  {
  padding: 20px;
  color: #fff;
  background-color: #f89406;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
}
  
.pricing-table .plan .plan-name span {
  font-size: 20px;
}
 
.pricing-table .plan ul {
  list-style: none;
  margin: 0;
  -moz-border-radius: 0 0 5px 5px;
  -webkit-border-radius: 0 0 5px 5px;
  border-radius: 0 0 5px 5px;
}
 
.pricing-table .plan ul li.plan-feature {
  padding: 15px 10px;
  border-top: 1px solid #c5c8c0;
}
 
.pricing-three-column {
  margin: 0 auto;
  //width: 80%;
  float:left;
  padding: 10px;
width: 300px;
}
 
.pricing-variable-height .plan {
  float: none;
  margin-left: 2%;
  vertical-align: bottom;
  display: inline-block;
  zoom:1;
  *display:inline;
}
 
.plan-mouseover .plan-name {
  background-color: #4e9a06 !important;
}
 
.btn-plan-select {
  padding: 8px 25px;
  font-size: 18px;
}
</style>
 
 <?php
	
	$db = getdb();
	$user_id = $_SESSION['User_id'];
	$select_lessons = "SELECT * FROM `lesson` WHERE `lessons_id` in (SELECT type_id FROM `user_favrits` WHERE userID='$user_id' and Category='Lessons')";
	$query_result = mysqli_query($db,$select_lessons);
	
	$rows_count_value =  mysqli_num_rows($query_result);
	$i = 3;
	?>
	<div class='span9'>
		<?php
		if($rows_count_value == 0)
		{
			echo "You dont have lesson bookmarks";
		}
	while($row=mysqli_fetch_array($query_result))
	{
		?>
		<div class="row pricing-table pricing-three-column"> 
			<div class=" plan">
			  <div class="plan-name-bronze">
				<h2><?php echo $row['lessons_name'];?></h2>
			  </div>
			  <ul>
				<li class="plan-feature"><?php echo substr($row['lesson_description'], 0,100);?></li>  
				<li class="plan-feature"><a href="?module=learn&task=lessons_view&lessons_id=<?php  echo $row['lessons_id']; ?>" class="btn btn-primary btn-plan-select"><i class="icon-white icon-ok"></i> Choose this Lesson</a></li>
			  </ul>
			</div>
		</div>
	<?php
	}
	?>
	</div>
	<?php	

}

function learn_remove_bookmark() 
{	
		if(isset($_GET['lession_id'])) {
		$db = getdb();
		$lessons_id = $_GET['lession_id'];
		$user_id = $_SESSION['User_id'];
		$query = "DELETE FROM user_favrits WHERE userID='$user_id' and Category='Lessons' and type_id='$lessons_id'";
		$result = mysqli_query($db,$query);
		if($result == true) {
			echo "<script>window.location = 'index.php?module=learn&task=lessons_view&lessons_id=".$lessons_id."';</script>";
		}
		else {
			echo "<script>alert('please select lesson')</script>";
			echo "<script>window.location = 'index.php?module=learn&task=view_lessons';</script>";
		}
	}
}
?>