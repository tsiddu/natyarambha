<?php
session_start();
$User_id = $_SESSION['User_id'];
if(!$_SESSION['checker']){
	echo "<script>window.location = 'login.php';</script>";
}

include 'db1.php';

$select_cnt_workout = "select count(*) as cnt from workouts where CreatedBy = '$User_id'";
$cnt_workout_result = mysqli_query($db,$select_cnt_workout);
while($cnt_workout_row = mysqli_fetch_array($cnt_workout_result)){
	$cnt_workouts = $cnt_workout_row['cnt'];
}

if($cnt_workouts >= 3 && $User_id != 7)
{
	echo "<html><script>alert('Only 3 workouts can be created by Free user. Please upgrade your account to continue'); window.location = 'workouts.php'; </script></html>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'head.php' ?>
<title>Natyarambha - New Routine</title>
<style>


</style>
</head>
<script>
var videos_list = [];
</script>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<div class="canvas" > 
  <!-- Navigation -->
  <nav class="navbar nav-inner-cus navbar-fixed-top" role="navigation">
     <?php include 'nav.php'; ?>
  </nav>
  <!-- /lessons -->
  <div class="clearfix"></div>
   
   <div class="jumbotron jumbotron-sm" style="margin-top:50px;">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-lg-12">
          <h2> Create New Workout</h2>
        </div>
      </div>
    </div>
  </div>
   
   
   
  <div class="container create-new-wkout-strip"> 
    <div>
      <div class="col-md-12 row">
        <div class="well-sm">
          <form class="form-horizontal" >
          <div id="error_message"></div>
            <fieldset>
              
              <!-- Name input-->
              <div class="form-group">
                <label class="col-md-2 control-label" for="name">Routine Name</label>
                <div class="col-md-4">
                  <input id="workout-name" name="workout-name" type="text" placeholder="Enter a name for the routine" class="form-control" required >
                </div>
              </div>
              
              <!-- Message body -->
              <div class="form-group">
                <label class="col-md-2 control-label" for="message">Description</label>
                <div class="col-md-4">
                  <textarea class="form-control" id="message" name="message" placeholder="Enter a short description for the Routine" rows="2" required ></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label" for="message">Speed</label>
                <div class="col-md-4">
	              <select id="speed" class="form-control" name="speed" style="color:black;">
	        	<option value="6">First</option>
	        	<option value="7">Second</option>
	        	<option value="8">Third</option>
				<option value="9">All</option>
	              </select>
	        </div>
              </div>
              <!-- Form actions -->
              
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="container search-opt">
    
      
	  
        <div class="col-md-4 col-md-offset-2" style="left:-10px;">
          <div class="input-group adv-search">
            <input type="text" class="form-control" placeholder="Search for Adavus to add" id="search_description" />
            <div class="input-group-btn">
              <div class="btn-group " role="group">
                <div class="dropdown dropdown-lg ">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                  <div class="dropdown-menu dropdown-menu-right" role="menu">
                    <form class="form-horizontal" role="form">
                      <div class="form-group">
                        <label for="filter">Filter by</label>
                        <select class="form-control" id="filter_lesson_id">
                          <option value="0" selected>All Lessons</option>
						  <?php 
							  $select_lesson_list = "SELECT * FROM `lesson`";
							  $select_lesson_list_result = mysqli_query($db,$select_lesson_list);
							  							  
							  while($lesson_list_row = mysqli_fetch_array($select_lesson_list_result)){
							  ?>
							  <option value="<?php echo $lesson_list_row['lessons_id']; ?>"><?php echo $lesson_list_row['lessons_name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
					  
                      <!--
                      <br>
                      <button type="button" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search" aria-hidden="true" id="lesson_submit" onclick="form_submit()"></span></button>
					  -->
					  
                    </form>
                  </div>
                </div>
                <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true" id="search_submit" onclick="form_submit()"></span></button>
              </div>
            </div>
          </div>
		   <div class="clearfix"></div>
        </div>
		 
		 <div class="clearfix"></div>
      
    
	

      <div class="form-group">
        <div class="col-md-4 text-right col-md-offset-2" style=" left:-10px;"> 
          <button type="submit" class="display-center btn btn-primary btn-lg pull-right" onclick="create_workout()">Submit</button>
          <!--<button type="submit" class="display-center btn btn-primary btn-lg pull-left"><span class="glyphicon glyphicon-edit"></span>&nbsp Edit this workout</button>-->
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>
    
	<hr/>
  </div>	
  
	<script>
		function form_submit() {
				var lesson_id =$("#filter_lesson_id").val();
				//var lesson_tags =$("#filter_lesson_tags").val();
				//var lesson_content =$("#filter_lesson_content").val();
				var search_description = $("#search_description").val();
				$.ajax(
				  {
					method:'POST',
					data:{'lesson_id':lesson_id,'search_description':search_description},
					url:'get_lesson_videos.php',
					success:function(res)
					{
						$("#video_list").html(res);
						for (ij = 0; ij < videos_list.length; ij++) { 
							//$("#"+videos_list[ij]).addClass("workout-new-strip-active");
							$('#select_'+videos_list[ij]).addClass("liOpacity");
							$('#unselect_'+videos_list[ij]).show();
						}
					}
				  }		  
				);
			return false;
			}
	</script>
  
   
 <div class="container" id="extvid">
    <h2 class="chead"><span > Selected Adavus</span></h2>
    
    <ul class="list-unstyled video-list-thumbs row "> 
	<?php 
	
	$select_lesson = "SELECT * FROM `lesson` order by `order`";
	$select_lesson_result = mysqli_query($db,$select_lesson);
	while($lesson_row = mysqli_fetch_array($select_lesson_result)){
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

			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
			 {
  ?>
      
		
		
      <li class="col-lg-3 col-sm-4 col-xs-6" style="display:none" id="unselect_<?php echo $row['video_id']; ?>">
        <div class="remove-from-workout" id="<?php echo $row['video_id']; ?>"></div>
        <a title="<?php echo $row['video_name']; ?>"> <img src="app/videosthumb/<?php echo $row['video_thumb_path']; ?>" alt="<?php echo $row['video_name']; ?>" class="img-responsive" height="130px"/>
         <h2><?php echo $row['video_name']; ?></h2>
		<div style="height:30px;"> <?php echo $row['short_desc'];?></div>
        <span class="glyphicon glyphicon-play-circle"></span> 
        <span class="duration"><?php list($mins , $secs) = explode('.' ,$row['video_duration']); echo $mins.":".$secs; ?></span>
        <div class="clearfix"></div>
        </a> </li>
		
	<?php } } ?>
    </ul>
    <div id="no_vid_message"><p class="head-bg">No Adavus selected</p></div>
    <div class="clearfix"></div>
    
  
  </div>  
  
  
  
  <div class="container c-al-vid" id="video_list">
 <h4 class="chead"><span >All Adavus</span></h4>
 
    <div class="clearfix"></div>
 
 
  <script>
  	$(document).ready(function() {
		
		$('.addto-workout').click(function() {
			//alert(1);
			vid_id = this.id;
			//alert(vid_id);
			$('#select_'+vid_id).addClass("liOpacity");
			$('#unselect_'+vid_id).show();
			//alert(str);
			videos_list.push(vid_id);
			$('#no_vid_message').hide();
			//show in selected
		});
		
		
			
		$('.remove-from-workout').click(function() {
			//alert(1);
			vid_id = this.id;
			//alert(vid_id);
			$('#unselect_'+vid_id).hide();
			$('#select_'+vid_id).removeClass("liOpacity");
			videos_list.splice(videos_list.indexOf(vid_id),1);
			if(videos_list.length == 0){
				$('#no_vid_message').show();
			}
			//show in selected
		});	
			
		/*	
		$('.addto-workout').click(function() {
			if($.inArray(this.id, videos_list)==-1){
				$(this).addClass("workout-new-strip-active");
				
			}
			else{
				$(this).removeClass("workout-new-strip-active");
				videos_list.splice(videos_list.indexOf(this.id),1);
			}
			//alert(videos_list);
		}); */
	});
	</script>
  <?php 
	
	$select_lesson = "SELECT * FROM `lesson` order by `order`";
	$select_lesson_result = mysqli_query($db,$select_lesson);
	while($lesson_row = mysqli_fetch_array($select_lesson_result)){
	  
  ?>
  
    <p><span class="head-bg"><?php echo $lesson_row['lessons_name']; ?></span></p>
   
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

	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 	 {
	?>
	
	
		
	
      <li class="col-lg-3 col-sm-4 col-xs-6" id="select_<?php echo $row['video_id']; ?>">
        <div class="cre-new-workot" ></div>
		
		<a title="<?php echo $row['video_name']; ?>"> <img src="app/videosthumb/<?php echo $row['video_thumb_path']; ?>" alt="<?php echo $row['video_name']; ?>" class="img-responsive" height="130px"/>
        <p><?php echo $row['video_name']; ?></p>
       
	   <span class="duration"><?php list($mins , $secs) = explode('.' ,$row['video_duration']); echo $mins.":".$secs; ?></span>
        <button type="button" class="btn btn-default pull-left addto-workout" id="<?php echo $row['video_id']; ?>" > Add to Routine </button>
        
        <span class="glyphicon glyphicon-play-circle"></span> 
        <!--<span class="duration">03:15</span>-->
        <div class="clearfix"></div>
        </a>
		
		
        
        
        
        
       </li>
	<?php } ?>
	  
    </ul>
    <div class="clearfix"></div>
	<?php } ?>
	
    
    <br>
    
  </div>
  
		  <script>
			function create_workout(){
				var workout_name = $("#workout-name").val();
				var message = $("#message").val();
				var speed = $('#speed').val();
				if(workout_name.length == 0 || workout_name.length >20  ){
					$("#workout-name").focus();
					$("#error_message").html("Name cannot be empty or more than 20 characters");
					return 0;
				}
				if(message.length == 0 || message.length >50  ){
					$("#message").focus();
					$("#error_message").html("Description cannot be empty or more than 50 characters");
					return 0;
				}
				$.ajax(
				  {
					method:'POST',
					data:{'videos_list':videos_list,'speed':speed,'workout-name':workout_name,'message':message},
					url:'create_workout.php',
					success:function(res)
					{
						if(res==1){
							//alert("Workout Successfully created");
							window.location = 'workouts.php?action=new_workout_success';
						}
						else{
							alert("Something went wrong. Please try again");
						}
					}
				  }		  
				);
				
			}
		  </script>

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
</body>
</html>