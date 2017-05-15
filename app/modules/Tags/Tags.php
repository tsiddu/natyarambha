<style type="text/css">
.doxtumb{
height: 180px;
margin-bottom: 30px;
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

.popover
{
	max-width: 256px !important;
	margin-bottom: 10px;
	padding-bottom: 10px !important;
}
</style>

<?php

function Tags_view()
{
?>
				<div>
					<?php
					$db = getdb();
					if($_SESSION['user_access'] == "admin")
					{
					?>
					<script>
						function total_data_load(){
							location.reload();
						}
						function add_parent(){
							var parent = $("#parent").val();
							//alert(1);
							$.ajax({
							  url: 'admin_add_parent.php',
							  type: 'POST',
							  data: 'parent='+parent,
							  success: function(data) {
								if(data){
									total_data_load();
								}
								else{ alert("Please try again"); }
							  }
							});
						}
						function add_child(){
							var parent = $("#parent1").val();
							var child = $("#child").val();
							$.ajax({
							  url: 'admin_add_child.php',
							  type: 'POST',
							  data: {'parent':parent,'child':child},
							  success: function(data) {
								if(data){
									total_data_load();
								}
								else{ alert("Please try again"); }
							  }
							});
						}
					</script>
					<form class="form-inline" role="form" id="add_parent">
						<div class="form-group">
							<label for="parent">New Parent Tag Name:</label>
							<input type="text" class="form-control" id="parent" style="height:30;">
							<button type="button" onclick="add_parent();" class="btn btn-default"  id="add_parent_btn">Add</button>
						</div>
					</form>
					
					<form class="form-inline" role="form" id="add_child">
						<div class="form-group">
							<label for="parent">New Child Tag Name:</label>
							<select id="parent1">
								<option>Select Parent Tag</option>
								<?php
									$select_ptag = "select id,name from tags where level=0;";
									$ptag_result = mysqli_query($db,$select_ptag);
									while($ptag_row = mysqli_fetch_array($ptag_result))
									{
								?>
									<option value="<?php echo $ptag_row['id']; ?>"><?php echo $ptag_row['name']; ?></option>
								<?php 
									}
								?>
							</select>
							<input type="text" class="form-control" id="child" style="height:30;" placeholder="Child Tag name" />
							<button type="button" class="btn btn-default" onclick="add_child();">Add</button>
						</div>
					</form>
					
					<div>
						<a style = 'margin:20px;' class='btn' href="?module=Workouts&task=Create">Create Workout</a>
						</br>
						<!-- list of workouts -->
						
						<script>
						$( document ).ready(function() {
    
						$( "form" ).on( "submit", function( event ) {
						  event.preventDefault();
						  var data2 = $( this ).serialize(); 
						  $.ajax({
							  url: 'admin_update_tag.php',
							  type: 'POST',
							  data: data2,
							  success: function(data) {
								if(data == 0){
									total_data_load();
								}
								else{ alert("Please try again"); }
							  }
							});
						});
						
						
						});
							</script>
						<?php
							
							$query = "select s.WorkoutId,s.Name,c.Username,s.Access,s.Description,s.WorkoutDuration from workouts as s,users as c where s.CreatedBy = c.user_id";
							$result = mysqli_query($db,$query);
							//print_r($result);
								?>
								<table class="table table-hover table-bordered">
								<thead>
									<tr>
									<th>
									Name
									</th>
									<th>
									Created By
									</th>
									<th>
									Tags
									</th>
									
									</tr>
								</thead>
								<tbody>
								<?php
							while($row = mysqli_fetch_array($result))
							{
								?>
								<tr>
									<td><?php	echo $row['Name']; ?></td>
									<td><?php	echo $row['Username']; ?></td>
									<td>
										<form>
										<input type="hidden" value="<?php echo $row['WorkoutId']; ?>" name="workoutid" />	
										<?php 
											$select_ptag = "select id,name from tags where level=0;";
											$ptag_result = mysqli_query($db,$select_ptag);
											$cc=0;
											while($ptag_row = mysqli_fetch_array($ptag_result))
											{
											echo $ptag_row['name']; 
											
										?>
										
											<select name="ctag<?php echo $cc;?>">
													<option value="0">NA</option>
												<?php 
													$select_ctag = "select id,name from tags where level =1 and parent ='".$ptag_row['id']."';";
													$ctag_result = mysqli_query($db,$select_ctag);
													while($ctag_row = mysqli_fetch_array($ctag_result))
													{
														$select_tag = "select id from workout_tags where workout_id = '".$row['WorkoutId']."' and tags_id = '".$ctag_row['id']."'";
														$stag_result = mysqli_query($db,$select_tag);
												?>
													<option value="<?php echo $ctag_row['id']; ?>" <?php if($stag_row = mysqli_fetch_array($stag_result)) { echo "selected"; }?>><?php echo $ctag_row['name']; ?></option>
												<?php } ?>	
											</select>
											<br/>
										<?php 
											$cc++;
											}
										?>
										<input type="submit" class="btn" value="Update Tag" /> 
										</form>
									</td>
									
								</tr>
								<?php
							}
						?>
						</tbody>
						</table>
					</div>
					<?php
					}
					else
					{
					?>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="?module=Workouts&task=view">All Workouts</a>
						</li>
						<li>
							<a href="?module=Workouts&task=Myworkouts">My Workouts</a>
						</li>
						<li>
							<a href="?module=Workouts&task=my_activities">My Activities</a>
						</li>
						<a class="btn" style="float:right;" href="?module=Workouts&task=user_own_workouts">Manage my Workouts</a>
					</ul>
					<div>
					<?php
						$User_id = $_SESSION['User_id'];
						$db = getdb();
						$select_publick_workouts = "select s.WorkoutId,s.Name,c.Username,s.Access,s.Description,s.WorkoutDuration from workouts as s,users as c where s.CreatedBy = c.user_id and (`Access`='public' or `CreatedBy` in(7,$User_id))";
						$publick_workouts = mysqli_query($db,$select_publick_workouts);
						$workout = "";
						while($row2 = mysqli_fetch_array($publick_workouts))
						{
							$workout  = $row2['WorkoutId'];
							$workoutid_for_play = $row2['WorkoutId'];
							$getvideos = "SELECT s.VideoID,c.video_name,c.video_thumb_path FROM `workoutvedios` as s,videos as c WHERE WorkoutID =
										$workout and	c.video_id=s.VideoID limit 3";

							$result_videos_workout = mysqli_query($db,$getvideos);
							$row_videos = mysqli_fetch_array($result_videos_workout);
							$vid_tumb = $row_videos['video_thumb_path'];

							if($vid_tumb == "")
							{
								$vid_tumb = "videosthumb/no_tumb.png";
							}
							$video_images = "<div style='widht:500px'>";
							$video_names = "Videos:";
							$count = mysqli_num_rows($result_videos_workout);

							while($videoresult_tumb = mysqli_fetch_array($result_videos_workout))
							{
								$vid_tumb = $videoresult_tumb['video_thumb_path'];

								if($vid_tumb == "")
								{
									$vid_tumb = "videosthumb/no_tumb.png";
								}
								$video_images = $video_images."<img src='$vid_tumb' style='margin-right: 8px;width: 226px;float: left;border: 1px solid silver;'>";
								$video_names = $video_names.",".$videoresult_tumb['video_name'];
							}
							if($count == 0)
							{
								$video_images = $video_images."No Videos for this Workout";
							}

							$video_images = $video_images."</div>";
							?>

							<div data-toggle="popover" title="<?php echo $video_names;?>" data-content="<?php echo $video_images; ?>" data-html="true" class="span3 doxtumb" style='position: relative;background-size: cover;background-image: url(<?php echo $vid_tumb;?>);'>
							<?php
							echo "<div  style='color:white;position: absolute;width: 97%;bottom: 0px;height: 71px;padding-left: 7px;background: rgba(67, 68, 70, 0.64);'>";
							echo "<span style='font-weight: bold;'>".$row2['Name']."</span><span style='float: right;font-size:11px'>Duration:".$row2['WorkoutDuration']."</span><br>";
							echo substr($row2['Description'], 0,50)."...";
							echo "<a style='position: absolute;right: 5px;bottom: 5px;' href='?module=Workouts&task=play_workout&wrkoutid=".$workoutid_for_play."'><i class='icon-play-circle icon-white'></i></a>";
							?>
							<div  class='navbar' style='bottom: 0px;position: absolute;left: 0px;margin: 0px !important;'>
							<ul class="nav navbar-nav navbar-right">
									<li class="dropdown" style='margin: -2px;'>
										<a data-toggle="dropdown" class="dropdown-toggle" href="#" style='background: rgba(240, 232, 232, 0.46);color: white;border-radius: 4px;padding: 3px;'>more
											<strong class="caret" style='border-top-color:white;border-bottom-color:white;'></strong>
										</a>
										<ul class="dropdown-menu">
											<li>
												<a href="#"><i class="icon-share"></i>  Share</a>
											</li>
											<?php
												$check_for_user_favrit = "SELECT count(*) as ct FROM `user_favrits` WHERE `Category`='workout' and userID='$User_id' and type_id='$workoutid_for_play'";
												$result = mysqli_query($db,$check_for_user_favrit);
												$result_row_fav = mysqli_fetch_array($result);
												if($result_row_fav['ct'] == 0)
												{
													?>
											<li>
												<a href="?module=Workouts&task=add_user_fav_wk&jobID=<?php echo $row2['WorkoutId'];?>"><i class="icon-plus"></i>  Add to my workouts</a>
											</li>
													<?php
												}
											?>
											<li>
												<a href="?module=Workouts&task=search&workoutid=<?php echo $row2['WorkoutId'];?>"><i class="icon-search"></i>  Search Similar</a>
											</li>
										</ul>
									</li>
							</ul>
							</div>
							<?php
							echo "</div></div>";
							?><?php
						}
					?>
					<script type="text/javascript">
					$( document ).ready(function() {	    
					    $(document).popover({
					        selector: '[data-toggle="popover"]',
						    trigger: 'hover focus',
						    placement: 'bottom'
					    });
					});
					</script>
					</div>
					<?php
					}
					?>
				</div>
<?php
}

function Workouts_recommended()
{
echo "recommended function";
}

function Workouts_all()
{
echo "all workout function";
}

function Workouts_Create()
{
	//echo "creating workout";
	?>
	<div>
		<form class="form-horizontal" method="post" action="?module=Workouts&task=add_worout">
			<fieldset>

			<!-- Form Name -->
			<br>
			<br>
			<span style='font-weight:bold;font-size:20px'>Create Workout</span>
			<a href="?module=Workouts&task=view" class='btn' style='float:right'>Back to Workouts</a>
			<hr>
			<br>
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="Name">Workout Name</label>
			  <div class="controls">
				<input id="Name" name="Name" type="text" placeholder="" class="input-xlarge" required="">
				
			  </div>
			</div>

			<!-- Textarea -->
			<div class="control-group">
			  <label class="control-label" for="Description">Description</label>
			  <div class="controls">                     
				<textarea id="Description" name="Description"></textarea>
			  </div>
			</div>

			<!-- Select Basic -->
			<div class="control-group">
			  <label class="control-label" for="acccess">Access</label>
			  <div class="controls">
				<select id="acccess" name="acccess" class="input-xlarge">
				  <option value = 'Private'>Private</option>
				  <option value = 'Public'>Public</option>
				</select>
			  </div>
			</div>

			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="Tags">Tags</label>
			  <div class="controls">
				<input id="Tags" name="Tags" type="text" placeholder="ex: step1,hard,lastLevel" class="input-xlarge" required="">
			  </div>
			</div>
			
			<!-- Button -->
			<div class="control-group">
			  <label class="control-label" for="Save"></label>
			  <div class="controls">
				<button id="Save" name="Save" class="btn btn-success">Save</button>
			  </div>
			</div>

			</fieldset>
		</form>
	</div>
	<?php
}

function Workouts_add_worout()
{

	if(isset($_POST['Name']))
	{
		$name = $_POST['Name'];
		$description = $_POST['Description'];
		$access = $_POST['acccess'];
		$Tags = $_POST['Tags'];
		$userName = $_SESSION['User_id'];
		//echo "ok";
		$query = "INSERT INTO `workouts`(`Name`, `CreatedBy`, `Access`, `Description`, WorkoutDuration,tags) 
				VALUES ('$name','$userName','$access','$description',0.00,'$Tags')";
		$db = getdb();
		
		echo $query;
		$result = mysqli_query($db,$query);
		if($result == true)
		{
			$queryGetId = "SELECT `WorkoutId` FROM `workouts` order by `WorkoutId` desc limit 1";
			$result = mysqli_query($db,$queryGetId);
			$row = mysqli_fetch_array($result);
			$idvalue =  $row['WorkoutId'];
			echo "<script>window.location = '?module=Workouts&task=view_byid&jobID=$idvalue';</script>";
		}
		else
		{
			echo "Not added";
		}
	}
	else
	{
		echo "<script>window.location = '?module=Workouts&task=Create';</script>";
	}
}


function Workouts_view_byid()
{
	if(isset($_GET['jobID']))
	{
		$idvalue = $_GET['jobID'];
		
		$db = getdb();
		$query = "SELECT * FROM `workouts` where WorkoutId = $idvalue";
		$result = mysqli_query($db,$query);
		//print_r($result);
		while($row = mysqli_fetch_array($result))
		{
			//echo $row['WorkoutId'];
			?>
			<script>
			
			function change_elements()
			{
				$('#name').prop("disabled",false);
				$('#Access').prop("disabled",false);
				$('#Description').prop("disabled",false);
				$('#Tags').prop("disabled",false);
				$('#save').show();
				$('#cancel').show();
				$('#edit').hide();
			}
			
			function chaneg_forcancel()
			{
				$('#name').prop("disabled",true);
				$('#Access').prop("disabled",true);
				$('#Description').prop("disabled",true);
				$('#Tags').prop("disabled",true);
				$('#save').hide();
				$('#cancel').hide();
				$('#edit').show();
			}
			</script>
			<div>
				<br>
				<br>
				<a href="?module=Workouts&task=view" style='float:right;' class='btn'>Back to Workouts</a>
				<hr>
				<br>
				<form action='?module=Workouts&task=update&id=<?php echo $idvalue; ?>' method='post'>
				<label>Name:</label><input type='text' name='Name' id='name' value ='<?php echo $row['Name']; ?>' class='span4' disabled>
				<label>Access:</label>  <select name='Access' class='span4'  id='Access' disabled>
										<option value="Private" <?php if($row['Access'] == "Private"){echo "selected";} ?>>Private</option>
										<option value="Public" <?php if($row['Access'] == "Public"){echo "selected";} ?>>Public</option>
										</select>
				<label>Description:</label><textarea class='span4' rows='5' id='Description' name = 'Description' disabled><?php echo$row['Description']; ?></textarea>
				<label>Tags:</label><input type='text' name='Tags' id='Tags' value ='<?php echo $row['tags']; ?>' class='span4' disabled>
				</br>
				<input type='button' value = 'Edit' id='edit'  name ='Edit' class='btn' onClick='change_elements()'>		
				<input type='submit' value = 'Save' id='save' name ='Save' class='btn' style='display:none'>		
				<input type='reset' value = 'Cancel'  id='cancel' name ='Cancel' class='btn' onclick="chaneg_forcancel()" style='display:none'>		
				</form>
				
			<a id="modal-759260" href="#modal-container-759260" role="button" class="btn" data-toggle="modal">Add Video</a>
			
			<div class="modal fade" id="modal-container-759260" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title" id="myModalLabel">
								Videos
							</h4>
						</div>
						<div class="modal-body">
						<?php
						}
							$getVideos = "SELECT * FROM videos";
							$resut_vodeos = mysqli_query($db,$getVideos);
							while($row = mysqli_fetch_array($resut_vodeos))
							{
								//print_r($row);
								?>
								<a href="?module=Workouts&task=Add_video&wkid=<?php echo $idvalue; ?>&vdid=<?php echo $row['video_id']; ?>">
								<div style="width:180px;height:120px;border:1px solid silver;margin:10px;float:left;background-image:url('<?php echo $row['video_thumb_path'];?>');background-size: cover;">
								</div>
								</a>
								<?php
							}
						?>
						</div>
						<div class="modal-footer">
							 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			</br>
			<?php
			$getVideos = "SELECT * FROM `videos` WHERE video_id in (SELECT `VideoID` FROM `workoutvedios` WHERE WorkoutID=$idvalue)";
							$resut_vodeos1 = mysqli_query($db,$getVideos);
							while($row = mysqli_fetch_array($resut_vodeos1))
							{
								//print_r($row);
								?>
								<div style="width:180px;height:120px;border:1px solid silver;margin:10px;float:left;background-image:url('<?php echo $row['video_thumb_path'];?>');background-size: cover;">
								<a href="?module=Workouts&task=deled_video_wk&wkid=<?php echo $idvalue; ?>&vdid=<?php echo $row['video_id']; ?>"> Remove</a>
								</div>
								<?php
							}
			?>
		</div>
		<?php
	}
}


function Workouts_Add_video()
{
	if(isset($_GET['wkid']) and  isset($_GET['vdid']))
	{
		$db = getdb();
		$wkid = $_GET['wkid'];
		$vdid = $_GET['vdid'];
		$query = "INSERT INTO `workoutvedios`(`WorkoutID`, `VideoID`) VALUES ($wkid,$vdid)";
		$result = mysqli_query($db,$query);
		if($result == true)
		{
			echo "ok";
			$query_insert = "update workouts set WorkoutDuration =  (SELECT sum(video_duration) from videos where video_id  in (select VideoID from workoutvedios where WorkoutID = $wkid)) where WorkoutId = $wkid";
			$resuitfordusration = mysqli_query($db,$query_insert);
			if($resuitfordusration==true)
			{
				echo "duration also updated";
				echo "<script>window.location = '?module=Workouts&task=view_byid&jobID=$wkid';</script>";
			}
		}
	}
}	



function Workouts_deled_video_wk()
{
	if(isset($_GET['wkid']) and  isset($_GET['vdid']))
	{
		$db  = getdb();
		$wkid = $_GET['wkid'];
		$vdid = $_GET['vdid'];
		$delete_query = "DELETE FROM `workoutvedios` WHERE `WorkoutID`=$wkid and `VideoID`=$vdid";
		$result = mysqli_query($db,$delete_query);
		if($result == true)
		{
			echo "<script>alert('Video Removed form Workout');</script>";
			echo "<script>window.location = '?module=Workouts&task=view_byid&jobID=$wkid';</script>";
		}
	}
}


function Workouts_add_user_fav_wk()
{
	if(isset($_GET['jobID']))
	{
		//echo "ok";
		$db = getdb();
		$id = $_GET['jobID'];
		$category = "Workout";
		$User_id = $_SESSION['User_id'];
		$insertquery = "INSERT INTO `user_favrits`( `Category`, `userID`, `type_id`,viewDate) VALUES ('$category','$User_id','$id',now())";
		$result = mysqli_query($db,$insertquery);
		if($result == true)
		{
			if(isset($_GET['play']))
			{
				echo "<script>window.location = '?module=Workouts&task=play_workout&wrkoutid=".$id."';</script>";
			}
			else
			{
				echo "<script>window.location = '?module=Workouts&task=view';</script>";
			}
		}
		else
		{
			echo "<script>alert('Already Workout added');</script>";
			if(isset($_GET['play']))
			{
				echo "<script>window.location = '?module=Workouts&task=play_workout&wrkoutid=".$id."';</script>";
			}
			else
			{
				echo "<script>window.location = '?module=Workouts&task=view';</script>";
			}
		}
	}
}


function Workouts_update()
{
	if(isset($_GET['id']))
	{
		$id =  $_GET['id'];
		$Name = $_POST['Name'];
		$Access = $_POST['Access'];
		$User_id = $_SESSION['User_id'];
		$Description = $_POST['Description'];
		$Tags = $_POST['Tags'];
		$db = getdb();
		$update = "UPDATE `workouts` SET `Name`='$Name',`CreatedBy`='$User_id',`Access`='$Access',`Description`='$Description',
					`tags`='$Tags' WHERE WorkoutId='$id'";
		echo $update;
		$result = mysqli_query($db,$update);
		if($result == true)
		{
			echo "<script>window.location = '?module=Workouts&task=view_byid&jobID=$id';</script>";
		}
		else{
			echo "<script>alert('not updated');</script>";
			echo "<script>window.location = '?module=Workouts&task=view_byid&jobID=$id';</script>";
		}
	}
}


function Workouts_search()
{
	if(isset($_GET['workoutid']))
	{
		$db = getdb();
		$id = $_GET['workoutid'];
		$User_id = $_SESSION['User_id'];
		//echo $id;
		$query_search = "SELECT * FROM `workouts` WHERE `WorkoutId` = '$id'";
		//echo $query_search;
		$result = mysqli_query($db,$query_search);
		$row = mysqli_fetch_array($result);
		$tags = $row['tags'];
		$select_publick_workouts = "select s.WorkoutId,s.Name,c.Username,s.Access,s.Description,s.WorkoutDuration,s.tags from workouts as s,users as c where s.CreatedBy = c.user_id and (`Access`='public' or `CreatedBy` in(7,$User_id)) ";
		$tags1 = explode(",", $tags);
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
			$save_search = "INSERT INTO `user_Search`(`User_id`, `search tags`) VALUES ('$User_id', '$tags_value')";
			$result = mysqli_query($db,$save_search);
			
		}
		$select_publick_workouts = $select_publick_workouts.")";
		//echo $select_publick_workouts;
		
	}
	?>
					<div>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#">Search</a>
						</li>
					</ul>
					<div>
					<?php
						$publick_workouts = mysqli_query($db,$select_publick_workouts);
						//Print_r($publick_workouts); 
						$j=	1;
						while($row2 = mysqli_fetch_array($publick_workouts))
						{
							?>
							<div style='width:220px;height:180px;border:1px solid silver;float:left;margin:30px;'>
							<div style='width:220px;height:180px;' >
							<?php
							$workout  = $row2['WorkoutId'];
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
							$workoutid_for_play = $row2['WorkoutId'];
							?>
							<a href = '?module=Workouts&task=play_workout&wrkoutid=<?php echo $workoutid_for_play;?>' 
									style='float:left;text-decoration:none;cursor:pointer;'>Play</a>
							<div style='float:right'>
								<ul class="nav navbar-nav navbar-right">
									<li class="dropdown" style='text-align: right;margin:2px;'>
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" style='font-size:20px'><b>....</b><strong class="caret"></strong></a>
										<ul class="dropdown-menu">
											<li>
												<a href="#"><i class="icon-share"></i>Share</a>
											</li>	
											<li>
												<a href="?module=Workouts&task=add_user_fav_wk&jobID=<?php echo $row2['WorkoutId'];?>">Add to my workouts</a>
											</li>
											<li>
												<a href="?module=Workouts&task=search&workoutid=<?php echo $row2['WorkoutId'];?>">Search Similar</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					<?php
					if($j == 3)
					{
						$j=	1;
						//echo "<div class='span9' style='border:1px solid'></div>";
					}
					$j++;
						}
					?>
					</div>
					</div>
	<?php
}



function Workouts_Myworkouts()
{
?>
	<div>
		<ul class="nav nav-tabs">
			<li >
				<a href="?module=Workouts&task=view">All Workouts</a>
			</li>
			<li class="active">
				<a href="?module=Workouts&task=Myworkouts">My Workouts</a>
			</li>
			<li>
				<a href="?module=Workouts&task=my_activities">My Activities</a>
			</li>
			<a class="btn" style="float:right;" href="?module=Workouts&task=user_own_workouts">Manage my Workouts</a>
		</ul>
		<div>
		<?php
			$User_id = $_SESSION['User_id'];
			$db = getdb();
			$select_publick_workouts = "select s.WorkoutId,s.Name,c.Username,c.User_id, s.Access,s.Description,s.WorkoutDuration from workouts as s, 
			users as c where s.CreatedBy = c.user_id and (s.WorkoutId in (SELECT type_id FROM `user_favrits` where Category='workout' and userId = '$User_id') or 
			s.WorkoutId in (select WorkoutId from workouts where CreatedBy='$User_id') ) and  s.CreatedBy in ('7','$User_id ')";
			$publick_workouts = mysqli_query($db,$select_publick_workouts);
			$row_count_value = mysqli_num_rows($publick_workouts);
			if($row_count_value == 0)
			{
				echo "you dont have my workouts";
			}
			$j = 1;
			while($row2 = mysqli_fetch_array($publick_workouts))
			{
				$workout  = $row2['WorkoutId'];
				$workoutid_for_play = $row2['WorkoutId'];
				$getvideos = "SELECT s.VideoID,c.video_name,c.video_thumb_path FROM `workoutvedios` as s,videos as c WHERE WorkoutID =
							$workout and	c.video_id=s.VideoID limit 3";
				$result_videos_workout = mysqli_query($db,$getvideos);
				$row_videos = mysqli_fetch_array($result_videos_workout);
				$count = mysqli_num_rows($result_videos_workout);
				$vid_tumb = $row_videos['video_thumb_path'];
				if($vid_tumb == "")
				{
					$vid_tumb = "videosthumb/no_tumb.png";
				}
				$video_images = "<div style='widht:500px'>";
				$video_names = "Videos:";
				while($videoresult_tumb = mysqli_fetch_array($result_videos_workout))
				{
					$vid_tumb = $videoresult_tumb['video_thumb_path'];

					if($vid_tumb == "")
					{
						$vid_tumb = "videosthumb/no_tumb.png";
					}
					$video_images = $video_images."<img src='$vid_tumb' style='margin-right: 8px;width: 226px;float: left;border: 1px solid silver;'>";
					$video_names = $video_names.",".$videoresult_tumb['video_name'];
				}
				
				if($count == 0)
				{
					$video_images = $video_images."No Videos for this Workout";
				}

				$video_images = $video_images."</div>";


				?>
				<div data-toggle="popover" title="<?php echo $video_names;?>" data-content="<?php echo $video_images; ?>" data-html="true" class="span3 doxtumb" style='position: relative;background-size: cover;background-image: url(<?php echo $vid_tumb;?>);'>
				<?php
				echo "<div  style='color:white;position: absolute;width: 97%;bottom: 0px;height: 71px;padding-left: 7px;background: rgba(67, 68, 70, 0.64);'>";
				echo "<span style='font-weight: bold;'>".$row2['Name']."</span><span style='float: right;font-size:11px;'>Duration:".$row2['WorkoutDuration']."</span><br>";
				echo substr($row2['Description'], 0,50)."...";
				echo "<a style='position: absolute;right: 5px;bottom: 5px;' href='?module=Workouts&task=play_workout&wrkoutid=".$workoutid_for_play."'><i class='icon-play-circle icon-white'></i></a>";
				?>
				<div class='navbar' style='bottom: 0px;position: absolute;left: 0px;margin: 0px !important;'>
				<ul class="nav navbar-nav navbar-right">
						<li class="dropdown" style='margin: -2px;'>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#" style='background: rgba(240, 232, 232, 0.46);color: white;border-radius: 4px;padding: 3px;'>more
								<strong class="caret" style='border-top-color:white;border-bottom-color:white;'></strong>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="#"><i class="icon-share"></i>   Share</a>
								</li>	
								<?php
								if($row2['User_id'] == "7")
								{
								?>
								<li>
									<a href="?module=Workouts&task=Remove_workout_user_list&workoutid=<?php echo $row2['WorkoutId'];?>"><i class="icon-remove-circle"></i>   Remove from list</a>	
								</li>
								<?php
								}
								?>	
								<li>
									<a href="?module=Workouts&task=search&workoutid=<?php echo $row2['WorkoutId'];?>"><i class="icon-search"></i>    Search Similar</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
				<?php
				if($j == 3)
				{
					$j=	1;
					//echo "<div class='span9' style='border:1px solid'></div>";
				}
				$j++;
			}
		?>
					<script type="text/javascript">
					$( document ).ready(function() {	    
					    $(document).popover({
					        selector: '[data-toggle="popover"]',
					        placement: 'bottom',
					        html: true,
					        animation: true,
					        trigger: 'hover'
					    });
					});
					</script>
		</div>
	</div>
<?php	
}



function Workouts_play_workout()
{
	if(isset($_GET['wrkoutid']))	
	{	
		$id = $_GET['wrkoutid'];
		$wrkid = $_GET['wrkoutid'];
		$User_id = $_SESSION['User_id'];
		$db = getdb();
		
		$insert_favirets = "INSERT INTO `user_views_logs`(`category`, `userid`, `caty_id`,date_time) VALUES ('Workout','$User_id','$id',now())";
		$insetResult = mysqli_query($db,$insert_favirets);
		//echo $insert_favirets;
		if($insetResult == true)
		{
			//echo "ok";
		}
		else
		{
			//echo "no";
		}
		$getWorkout = "SELECT WorkoutId, Name, CreatedBy, Access, Description, WorkoutDuration, tags FROM workouts WHERE WorkoutId = $id";
		$result = mysqli_query($db,$getWorkout);
		$row = mysqli_fetch_array($result);
		//print_r($row);
		?>
		<div>
			<ul class="nav nav-tabs">
			<li >
				<a href="?module=Workouts&task=view">All Workouts</a>
			</li>
			<li>
				<a href="?module=Workouts&task=Myworkouts">My Workouts</a>
			</li>
			<li>
				<a href="?module=Workouts&task=my_activities">My Activities</a>
			</li>
			<a class="btn" style="float:right;" href="?module=Workouts&task=user_own_workouts">Manage my Workouts</a>
		</ul>
		<div class="row-fluid">
		<div class='span12'>
		<span style='font-weight:bold'><?php echo $row['Name']; ?></span><br>
		<?php echo $row['Description']; ?></br>
		Total Workout Duration:<?php echo $row['WorkoutDuration']; ?></br>

		<?php
												$check_for_user_favrit = "SELECT count(*) as ct FROM `user_favrits` WHERE `Category`='workout' and userID='$User_id' and type_id='$wrkid'";
												$result = mysqli_query($db,$check_for_user_favrit);
												$result_row_fav = mysqli_fetch_array($result);
												if($result_row_fav['ct'] == 0)
												{
													?>
													<a href="?module=Workouts&task=add_user_fav_wk&jobID=<?php echo $wrkid;?>&play=yes">Add to my workouts</a>
													<?php
												}
												else
												{
													?>
													<a href="?module=Workouts&task=Remove_workout_user_list&workoutid=<?php echo $wrkid;?>&play=yes">Remove from my workouts</a>	
													<?php
												}
											?>
		<br>
		<?php
		$getWorkout_video = "SELECT a.video_name,a.video_id,a.Desctiption,a.video_path FROM videos as a, workoutvedios as b WHERE a.video_id = b.VideoID and b.WorkoutID = $id";
			$result_videos = mysqli_query($db,$getWorkout_video);
		?>
	<?php
	while($row = mysqli_fetch_array($result_videos))
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

	//total video data
	 $video_full_data[]= array('id'=> $row['video_id'],
	'video_name' =>$row['video_name'],
	'video_path' => $row['video_path'],
	'cuepoints'=>$cuepoints
	);
	  
  }

$cue_encode_data=array_merge($video_full_data,$cue_desc);
	  $cue=json_encode($cue_encode_data);
	  $cuevid=json_encode($video_full_data);
	  $cuepts=json_encode($cue_desc);
?>
<link rel="stylesheet" type="text/css" href="skin/minimalist.css">
<style type="text/css">
   #jsplaylist { width: 80%; background-color: #222; background-size: cover; max-width: 800px; }
   #jsplaylist .fp-controls { background-color: rgba(247, 244, 244, 0)}
   #jsplaylist .fp-timeline { background-color: rgba(0, 0, 0, 0.5)}
   #jsplaylist .fp-progress { background-color: rgba(15, 117, 52, 1)}
   #jsplaylist .fp-buffer { background-color: rgba(249, 249, 249, 1)}
   .last-video.is-finished {
   / do your marketing magic /
   { background-color: red}
	}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="flowplayer.min.js"></script>
<script>
	$(function () {
		var i=0;
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
<script type="text/javascript" src="js/jquery.checkbox.js"></script>
<script>
$(document).ready( function () {
				$('input:checkbox:not([safari])').checkbox();
});

function toggleaudio(){
var isChecked = $('#checkOne:checked').val()?true:false;
if(isChecked==true){
$('video').css('display','none');
$('.flowplayer').css('height','40px');
}else{
$('video').css('display','block');
$('.flowplayer').css('height','400px');
}
}
</script>
<br>
Audio Mode: <input type="checkbox" id="checkOne" onclick="toggleaudio();" /><br/>
<hr/>
<div class="flowplayer no-toggle play-button span9" style='height: 420px;margin-left: 0px;' data-embed="false">
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
window.location.href = 'http://localhost/natyam/app/?module=learn&task=lessons_view_topics&topic_id='+<?php echo $topic_id; ?>+'&vid='+a;
}
</script>

<div class="span2">
<span style='padding: 5px;font-size: 16px;'>Videos List</span>
<?php 
$get_videos_topics = "SELECT `video_id`,video_duration,`video_path`,video_name,video_thumb_path FROM `videos` WHERE `video_id` in (SELECT `VideoID` FROM `workoutvedios` WHERE `WorkoutID`='".$wrkid."')";
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
<div style="clear:both"></div>
</div>
<style>
.fp-playlist{
width: 200px;
margin-left: 530px;
}
</style>
<div id="content">test tests</div>
	</div>
	</div>
		<?php
	}
}



function Workouts_my_activities()
{
?>
	<div>
		<ul class="nav nav-tabs">
			<li >
				<a href="?module=Workouts&task=view">All Workouts</a>
			</li>
			<li>
				<a href="?module=Workouts&task=Myworkouts">My Workouts</a>
			</li>
			<li class="active">
				<a href="?module=Workouts&task=my_activities">My Activities</a>
			</li>
			<a class="btn" style="float:right;" href="?module=Workouts&task=user_own_workouts">Manage my Workouts</a>
		</ul>
		<div>
			<?php
			$db = getdb();
			$User_id = $_SESSION['User_id'];
			$getWorkouts = "SELECT s.WorkoutId,a.date_time, s.Name, s.Description, s.WorkoutDuration, s.tags from workouts as s,user_views_logs as a where a.caty_id=s.WorkoutId and a.category='workout' and a.userid='$User_id' group by a.caty_id limit 0,10";
			//echo $getWorkouts;
			
			$result = mysqli_query($db,$getWorkouts);
			$row_count_value = mysqli_num_rows($result);
			if($row_count_value == 0)
			{
				echo "no workouts found";
			}
			
			while($row = mysqli_fetch_array($result))
			{
				?>
				<div class='span10' style='margin: 0px;border-radius: 5px;border:1px solid silver;padding:10px;margin-bottom:10px;'>
				<div class='span2'>
					<h3><?php echo $row['Name'];?></h3>
					Description:<?php echo $row['Description'];?><br/>
					Duration:<?php echo $row['WorkoutDuration'];?><br/>
					Date:<?php echo date('d/m/y H:m', strtotime($row['date_time']))?><br> 
					<a href = '?module=Workouts&task=play_workout&wrkoutid=<?php echo $row['WorkoutId'];?>'>Play</a>
				</div>
				<?php
					$wrkid = $row['WorkoutId'];
					$getVideos = "SELECT a.video_name,a.Desctiption,a.video_path,a.video_thumb_path FROM videos as a, 
								workoutvedios as b WHERE a.video_id = b.VideoID and b.WorkoutID = $wrkid limit 3";
					$videos_result = mysqli_query($db,$getVideos);
					while($row_video = mysqli_fetch_array($videos_result))
					{
						//print_r($row_video);
						?>
						<div style='background-size: cover;width: 26%;float: left;height: 23%;background-image: url("<?php echo $row_video['video_thumb_path']; ?>");'>
						</div>
						<?php
					}
				?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
<?php	
}

function Workouts_user_own_workouts() {
?>
		<div>
					<div>
						<a class='btn' style='margin:20px;' href="?module=Workouts&task=Create">Create Workout</a>
						</br>
						<!-- list of workouts -->
						<?php
							$db = getdb();
							$user_id_val = $_SESSION['User_id'];
							$query = "select s.WorkoutId,s.Name,c.Username,s.Access,s.Description,s.WorkoutDuration from workouts as s,users as c where s.CreatedBy = c.user_id and s.CreatedBy = '$user_id_val'";
							$result = mysqli_query($db,$query);
							//print_r($result);
								?>
								<table class="table table-hover table-bordered">
								<thead>
									<tr>
									<th>
									Name
									</th>
									<th>
									Created By
									</th>
									<th>
									Access
									</th>
									<th>
									Duration
									</th>
									<th>
									
									</th>
									</tr>
								</thead>
								<tbody>
								<?php
							while($row = mysqli_fetch_array($result))
							{
								?>
								<tr>
									<td><?php	echo $row['Name']; ?></td>
									<td><?php	echo $row['Username']; ?></td>
									<td><?php	echo $row['Access']; ?></td>
									<td><?php	echo $row['WorkoutDuration']; ?></td>
									<td><a class='btn' href='?module=Workouts&task=view_byid&jobID=<?php echo $row['WorkoutId'];?>'>Manage</a></td>
								</tr>
								<?php
							}
						?>
						</tbody>
						</table>
					</div>
					</div>
<?php
}



function Workouts_Remove_workout_user_list()
{
	echo "remove function";
	if(isset($_GET['workoutid']))
	{
		$User_id = $_SESSION['User_id'];
		$workoutid = $_GET['workoutid'];
		$db = getdb();
		$query_remove = "DELETE FROM `user_favrits` WHERE userID='$User_id' and type_id='$workoutid' and Category='Workout'";
		mysqli_query($db,$query_remove);
			if(isset($_GET['play']))
			{
				echo "<script>window.location = '?module=Workouts&task=play_workout&wrkoutid=".$workoutid."';</script>";
			}
			else
			{
				echo "<script>window.location = '?module=Workouts&task=view';</script>";
			}
	}
	else
	{
		echo "<script>window.location = '?module=Workouts&task=Myworkouts';</script>";
	}
}
