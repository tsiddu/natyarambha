<?php session_start();
$User_id = $_SESSION['User_id'];
if(!$_SESSION['checker']){
	$_SESSION['last_page'] = 'workouts.php';
	echo "<script>window.location = 'login.php';</script>";
}

include 'db1.php';

?>
<!DOCTYPE html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
<style>
@media only screen and (min-width : 320px) and (max-width : 480px) {
/* Styles */

.video-list-thumbs {
margin:0px -30px;
}

}
</style>
<?php include 'head.php' ?>
<title>Natyarambha - Practice</title>
<script src="js/jquery.js"></script>
<script>
var data1 = [];
var tags1 = [];
var filter1 = [];
var tags2 = [];
var tags3 = [];
var workout1 = [];
<?php
	$User_id = $_SESSION['User_id'];
	$select_publick_workouts = "select s.WorkoutId,s.Name,c.Username,s.Access,s.Description,round(s.WorkoutDuration,2) as WorkoutDuration, s.code from workouts as s,users as c where s.CreatedBy = c.user_id and (`Access`='public' or `CreatedBy` in(7,$User_id))";
	$publick_workouts = mysqli_query($db,$select_publick_workouts);
	
	$select_tag = "select max(id) as max_id from tags;";
			$result_tag = mysqli_query($db,$select_tag);
			$row_tag = mysqli_fetch_array($result_tag);
	
	
	while($row2 = mysqli_fetch_array($publick_workouts))
	{
		$workout  = $row2['WorkoutId'];
		$getvideos = "SELECT s.VideoID,c.video_thumb_path FROM `workoutvedios` as s,videos as c WHERE WorkoutID =$workout and c.video_id=s.VideoID";
		//echo $getvideos;
		$result_videos_workout = mysqli_query($db,$getvideos);
		//echo $getvideos;
		$row_videos = mysqli_fetch_array($result_videos_workout);
		?>
		workout1.push('<?php echo $workout; ?>');
		data1['<?php echo $workout; ?>'] = new Array(4);
		data1['<?php echo $workout; ?>'] = ["<?php echo $row2['Name']; ?>","<?php echo $row2['Description']; ?>","<?php echo $row_videos['video_thumb_path']; ?>","<?php echo $workout; ?>"];		
		//console.log(data1);
		
			tags1['<?php echo $workout; ?>'] = new Array(<?php echo $row_tag['max_id'];?>);
			tags1['<?php echo $workout; ?>'].map(function(){
			   return 0;
			});
			console.log(tags1['<?php echo $workout; ?>'].length);
			<?php 	
		
			$select_tags = "select * from workout_tags,tags where workout_tags.tags_id = tags.id and workout_tags.workout_id='$workout';";
			
			$result_tags = mysqli_query($db,$select_tags);
			while($row_tags = mysqli_fetch_array($result_tags)){
		?>
			tags1['<?php echo $row_tags['workout_id'];?>']['<?php echo $row_tags['tags_id'];?>'] = 1;
			<?php } 
			
		}	
				$select_ctag = "select t1.id as id, t1.name as name,t2.name as pname from tags t1, tags t2 where t1.parent = t2.id";
				$ctag_result = mysqli_query($db,$select_ctag);
				while($ctag_row = mysqli_fetch_array($ctag_result))
				{
				?>
					tags2['<?php echo $ctag_row['id'];?>'] = '<?php echo $ctag_row['name'];?>';
					tags3['<?php echo $ctag_row['id'];?>'] = '<?php echo $ctag_row['pname'];?>';
					
				<?php }
	?>
	
	
</script>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<div class="canvas" > 
  <!-- Navigation -->
  <nav class="navbar nav-inner-cus navbar-fixed-top" role="navigation">
    <?php include 'nav.php'; ?>
  </nav>
  <!-- /lessons -->
  
  <div class="jumbotron jumbotron-sm" style="margin-top:50px;">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-lg-12">
          <h2> Practice</h2>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="container workouts"> <a href="new_workout.php" class="btn btn-default pull-right">Create your own Practice Routine</a>
    <div class=" clearfix"></div>
    <hr/>
    <div class=" clearfix"></div>
    <br>
    <script>
		
		$(document).ready(function() {
		var loc = window.location.href;
		//console.log(window.location.hostname);
		
			$("input[type='checkbox']").change(function() {
				if(this.checked) {
					if($.isEmptyObject(filter1)){
						$('#tegs-select').addClass('tegs-select');
					}
					add_filter(this.value);
				}
				if(!$(this).is(':checked')) {
					remove_filter(this.value);
			//		console.log(filter1);
			//		console.log(filter1.length);
				}
			});
		});
		function filter(){
			//alert(filter1);
			//alert(tags2);
			var i,work;
			$.each(workout1 , function(i, val) { 
				work = workout1[i];
				if(filter1.length==0){
					$("#work"+work).show();
				} else{
				$("#work"+work).hide();
				for(i = 0; i<filter1.length; i++ ){
					if(tags1[work][filter1[i]]){
						$("#work"+work).show();
					}
				}
				}
			});
			
			$total_data = "";
			
		}
		function add_filter(va){
			filter1.push(va);
			filter();
			var add_data = "<span class='tag-selected' style='margin-right:5px;'>"+tags3[va]+":&nbsp;"+tags2[va]+"<a style='color:black' onclick='remove_filter("+va+");return false;'><span class='glyphicon glyphicon-remove'></span></a></span>";
			$("#filter_data").append(add_data);
		}
		function remove_filter(va){
			filter1.splice(filter1.indexOf(va),1);
			filter();
			$("span").remove(":contains('"+tags2[va]+"')");
			$("input[type=checkbox][value="+va+"]").prop('checked', false);
			if(filter1.length==0){	
				$('#tegs-select').removeClass('tegs-select');
			}
		}
	</script>
    <div class="col-lg-2 col-xs-12">
      <?php 
		$select_ptag = "select id,name from tags where level=0;";
		$ptag_result = mysqli_query($db,$select_ptag);
		$tat = 1;
		while($ptag_row = mysqli_fetch_array($ptag_result))
		{
	?>
      <nav>
        <ul class="nav">
          <?php if($tat) { ?>
          <?php } 
		  $tat = 0; 
		  ?>
          <h5><?php echo $ptag_row['name']; ?></h5>
          <?php 
				$select_ctag = "select id,name from tags where level =1 and parent ='".$ptag_row['id']."';";
				$ctag_result = mysqli_query($db,$select_ctag);
				while($ctag_row = mysqli_fetch_array($ctag_result))
				{
					?>
          <li>
            <input type="checkbox" name="speed" value="<?php echo $ctag_row['id']; ?>">
            <?php echo $ctag_row['name']; ?></li>
          <?php } ?>
        </ul>
      </nav>
      <?php } ?>
    </div>
    <div class="col-lg-10 col-xs-12  ">
      <ul class="list-unstyled video-list-thumbs">
        <div id="tegs-select">
          <div id="filter_data"></div>
        </div>
        <h4>Nāytārambha Practice Routines</h4>
        <?php
		/* display workouts */
		$select_publick_workouts1 = "select s.WorkoutId,s.Name,c.Username,s.Access,s.Description,round(s.WorkoutDuration,2) as WorkoutDuration, s.code, s.CreatedBy from workouts as s,users as c where s.CreatedBy = c.user_id and ( `Access`='public' or `CreatedBy` = '7') ";
		$select_publick_workouts_result = mysqli_query($db,$select_publick_workouts1);
		while($row = mysqli_fetch_array($select_publick_workouts_result))
		{
		$workout  = $row['WorkoutId'];
		$getvideos = "SELECT count(*) as cnt,s.VideoID,c.video_thumb_path,s.speed FROM `workoutvedios` as s,videos as c WHERE WorkoutID =$workout and c.video_id=s.VideoID limit 1";
					//echo $getvideos;
					$result_videos_workout = mysqli_query($db,$getvideos);
					//echo $getvideos;
					$row_videos = mysqli_fetch_array($result_videos_workout);
						
	?>
        <li class="col-lg-3 col-sm-4 col-xs-6" id="work<?php echo $workout; ?>" ><a href="javascript:void();" > <img src="app/videosthumb/<?php echo $row_videos['video_thumb_path']; ?>" alt="" class="img-responsive" height="130px"/>
          <h2 style="height:35px;!important"><?php echo $row['Name']; ?></h2>
          <div style="height:60px;!important"> <?php echo $row['Description']; ?></div>
          
		  <div class="row">
		  <div class="col-xs-12 col-md-6" ><?php echo $row_videos['cnt']; ?>&nbsp; Videos</div>
		  <div class="workoutSpeed col-xs-12 col-md-6" >
              <?php
				$spee = $row_videos['speed'];
				if($spee == 6){ echo '1<sup>st</sup> Speed'; }
				if($spee == 7){ echo '2<sup>nd</sup> Speed'; }
				if($spee == 8){ echo '3<sup>rd</sup> Speed'; }
				if($spee == 9){ echo 'All Speeds'; }
			
			?>
            </div>
		  </div>
          &nbsp;
          <div class="btn-group pull-left workout-right">
            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#share<?php echo $workout; ?>">Share</button>
          </div>
          <?php if($row['CreatedBy']==$User_id){  ?>
          <div class="btn-group pull-right workout-right">
            <button  type="button" class="btn btn-primary" onclick="edit_workout('<?php echo $row['code']; ?>');"><span class="glyphicon glyphicon-edit"></span></button>
            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#delete<?php echo $workout; ?>"><span class="glyphicon glyphicon-trash"></span></button>
          </div>
          <?php } ?>
          <span class="glyphicon glyphicon-play-circle" onclick="view_workout('<?php echo $row['code']; ?>');" ></span> <span class="duration" style="margin-left:12px !important;">
          <?php list($mins , $secs) = explode('.' ,$row['WorkoutDuration']); echo $mins.":".$secs; ?>
          </span>
          <div class="clearfix"></div>
          </a>
          <div class="clearfix"></div>
        </li>
        <?php } ?>
        <div class="clearfix"></div>
      </ul>
      <div class="clearfix"></div>
      <ul class="list-unstyled video-list-thumbs">
        <div class="tegs-select">
          <div id="action_data">
            <h2>
              <?php if($_GET['action']=='delete_success'){ echo "Routine successfully deleted"; } ?>
              <?php if($_GET['action']=='delete_fail'){ echo "Something went wrong. Please try again"; } ?>
              <?php if($_GET['action']=='new_workout_success'){ echo "Routine Successfully created"; } ?>
              <?php if($_GET['action']=='edit_workout_success'){ echo "Routine Successfully edited"; } ?>
            </h2>
          </div>
        </div>
        <h4>User Practice Routines</h4>
        <?php
		/* display workouts */
		$check_workouts = 1;
		$select_publick_workouts1 = "select s.WorkoutId,s.Name,c.Username,s.Access,s.Description,round(s.WorkoutDuration,2) as WorkoutDuration, s.code, s.CreatedBy from workouts as s,users as c where s.CreatedBy = c.user_id and ( `CreatedBy` = '$User_id') ";
		$select_publick_workouts_result = mysqli_query($db,$select_publick_workouts1);
		while($row = mysqli_fetch_array($select_publick_workouts_result))
		{
		$check_workout =0;
		$workout  = $row['WorkoutId'];
		$getvideos = "SELECT count(*) as cnt,s.VideoID,c.video_thumb_path,s.speed FROM `workoutvedios` as s,videos as c WHERE WorkoutID =$workout and c.video_id=s.VideoID limit 1";
					//echo $getvideos;
					$result_videos_workout = mysqli_query($db,$getvideos);
					//echo $getvideos;
					$row_videos = mysqli_fetch_array($result_videos_workout);
						
	?>
        <li class="col-lg-3 col-sm-4 col-xs-6" id="work<?php echo $workout; ?>" ><a href="javascript:void();" > <img src="app/videosthumb/<?php echo $row_videos['video_thumb_path']; ?>" alt="" class="img-responsive" height="130px"/>
          <h2 style="height:35px;!important"><?php echo $row['Name']; ?></h2>
          <div style="height:45px;!important"> <?php echo $row['Description']; ?></div>
          
		  <div class="row">
		  <div class="col-xs-12 col-md-6"> <?php echo $row_videos['cnt']; ?> Videos</div>
		   <div class="workoutSpeed col-xs-12  col-md-6">
              <?php
				$spee = $row_videos['speed'];
				if($spee == 6){ echo '1st Speed'; }
				if($spee == 7){ echo '2nd Speed'; }
				if($spee == 8){ echo '3rd Speed'; }
				if($spee == 9){ echo 'All Speeds'; }
			
			?>
            </div>
			</div>
			
			
          <div class="btn-group pull-left workout-right">
            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#share<?php echo $workout; ?>">Share</button>
          </div>
          <?php if($row['CreatedBy']==$User_id){  ?>
          <div class="btn-group pull-right workout-right">
            <button  type="button" class="btn btn-primary" onclick="edit_workout('<?php echo $row['code']; ?>');"><span class="glyphicon glyphicon-edit"></span></button>
            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#delete<?php echo $workout; ?>"><span class="glyphicon glyphicon-trash"></span></button>
          </div>
          <?php } ?>
          <span class="glyphicon glyphicon-play-circle" onclick="view_workout('<?php echo $row['code']; ?>');" ></span> <span class="duration" style="margin-left:12px !important;">
          <?php list($mins , $secs) = explode('.' ,$row['WorkoutDuration']); echo $mins.":".$secs; ?>
          </span>
          <div class="clearfix"></div>
          </a>
          <div class="clearfix"></div>
        </li>
        <?php }
      if($check_workout){echo "No user routines found. You can create one using the Create New Practice Routine option."; }
      
       ?>
      </ul>
    </div>
    <div> </div>
    <script>
function alert_function(a) {
    alert("workout_video.php?workout="+a);
}
</script> 
  </div>
  <div class="clearfix"></div>
  <br>
  <br>
  
  <!--- MOdals -------------------------------------> 
  
  <!-- Modal -->
  
  <?php
		/* display workouts */
		$select_publick_workouts1 = "select s.WorkoutId,s.Name,c.Username,s.Access,s.Description,round(s.WorkoutDuration,2) as WorkoutDuration, s.code from workouts as s,users as c where s.CreatedBy = c.user_id and ( `CreatedBy` = '$User_id' or `Access`='public' or `CreatedBy` = '7') ";
		$select_publick_workouts_result = mysqli_query($db,$select_publick_workouts1);
		while($row = mysqli_fetch_array($select_publick_workouts_result))
		{
		$workout_1  = $row['WorkoutId'];
		$code = $row['code'];
		$name = $row['Name'];			
	?>
  <div class="modal fade" id="share<?php echo $workout_1; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Use this link for Sharing</h4>
        </div>
        <div class="modal-body" >
          <textarea id="share_body_<?php echo $code; ?>" style="border:0;width:100%"><?php echo $_SERVER['SERVER_NAME'];?>/workout_video.php?workout=<?php echo $code; ?></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="copy_link('<?php echo $code; ?>')" >Copy</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="delete<?php echo $workout_1; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Confirm</h4>
        </div>
        <div class="modal-body"> Are you sure to delete this routine - "<?php echo $name; ?>" </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="delete_workout('<?php echo $code; ?>')">Delete</button>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  <TEXTAREA ID="holdtext" STYLE="display:none;"></TEXTAREA>
  <script>
	
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
  
	function copy_link(code){

			var test = document.querySelector('#share_body_'+code);
			var bkp = test.value;
    
			test.select();
			document.execCommand('cut');
			test.value = bkp;
		
	}
	function delete_workout(code){
		$.ajax(
				  {
					method:'POST',
					data:{'workout':code},
					url:'delete_workout.php',
					success:function(res)
					{
						if(res==1){
							//alert("Workout Successfully Deleted");
							window.location = 'workouts.php?action=delete_success';
						}
						else{
							//alert("Something went wrong. Please try again");
							window.location = 'workouts.php?action=delete_fail';
						}
					}
				  }		  
				);
		
	}
  
	function edit_workout(code){
		window.location = 'edit_workout.php?workout='+code;
	}
  	function view_workout(code){
		window.location = 'workout_video.php?workout='+code;
	}
  
  </script> 
  
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