<?php


function videos_view()
{

$db = getdb();
$select_videos_query = "SELECT * FROM `videos`";
$selec_result = mysqli_query($db,$select_videos_query);

?>
			<div class="row-fluid">
				<div class="span8">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="?module=videos&task=view">List Videos</a>
						</li>
						<li>
							<a href="?module=videos&task=add_video">Add Video</a>
						</li>
					</ul>
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>
									#
								</th>
								<th>
									Video Title
								</th>
								<th>
									Duration
								</th>
								<th>
									video file
								</th>
								<th>
								
								</th>
							</tr>
						</thead>
						<tbody>
						<?php
						
								$i = 1;
								while($row = mysqli_fetch_array($selec_result))
								{
									if ($i % 2 == 0) {
									  echo "<tr class='warning'>";
									}
									else
									{
										echo "<tr class='info'>";
									}
									echo "<td>".$i."</td>";
									echo "<td>".$row['video_name']."</td>";
									echo "<td>".$row['video_duration']."</td>";
									$file = explode("/", $row['video_path']);
									$file_count_expo = count($file);
									$file_count_expo = $file_count_expo - 1;
									echo "<td>".$file[$file_count_expo]."</td>";
									echo "<td><a href='?module=videos&task=edit_video&videoID=".$row['video_id']."'><button class='btn btn-mini btn-success' type='button'>Edit</button></a></td>";
									echo "</tr>";
									$i = $i+1;
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
<?php
}

function videos_add_video()
{

// require_once('videofunctions/getid3/getid3.php');
// $getID3 = new getID3;


$dir = "videos/";
$dirlist  = scandir($dir,1);
	$arraylength = count($dirlist);
	$i = 0;
	$option = "";
	while($arraylength != $i)
	{
		$split_string = explode(".", $dirlist[$i]);
		$split_count = count($split_string);
		$split_count-=1;
		if($split_string[1] == 'mp4')
		{
			
			$option = $option."<option value='".$dir."".$dirlist[$i]."'>".$dirlist[$i]."</option>";
		}
		$i+=1;
	}
	
	
	
	$dir1 = "videosthumb/";
	$dirlist1  = scandir($dir1,1);
	$arraylength1 = count($dirlist1);
	$i = 0;
	$option1 = "";
	while($arraylength1 != $i)
	{
		$split_string = explode(".", $dirlist1[$i]);
		$split_count = count($split_string);
		$split_count-=1;
		if(($split_string[1] == 'jpeg') or ($split_string[1] == 'jpg') or ($split_string[1] == 'png') or ($split_string[1] == 'gif'))
		{
			$option1 = $option1."<option>".$dirlist1[$i]."</option>";
		}
		$i+=1;
	}
	?>
	<div class="row-fluid">
				<div class="span8">
					<ul class="nav nav-tabs">
						<li>
							<a href="?module=videos&task=view">List Videos</a>
						</li>
						<li class="active">
							<a href="?module=videos&task=add_video">Add Video</a>
						</li>
					</ul>
					<form class="form-horizontal" action='?module=videos&task=add_video_process' method='post'>
						<fieldset>
						<!-- Select Basic -->
						<div class="control-group">
						  <label class="control-label">Select the Video</label>
						  <div class="controls">
							<select id="VideoPath" name="VideoPath" class="input-xlarge">
							<?php
							echo $option;
							?>
							</select>
						  </div>
						</div>

						<!-- Select Basic -->
						<div class="control-group">
						  <label class="control-label">Video thumbnail</label>
						  <div class="controls">
							<select id="Select_video_thumb" name="Select_video_thumb" class="input-xlarge">
							  <?php
							echo $option1;
							?>
							</select>
						  </div>
						</div>

						<!-- Text input-->
						<div class="control-group">
						  <label class="control-label">Video Name</label>
						  <div class="controls">
							<input id="Video_name" name="Video_name" type="text" placeholder="video Name" class="input-xlarge" required="">
							
						  </div>
						</div>
						
						<!-- Short Description Textarea -->
						<div class="control-group">
						  <label class="control-label">Short Description</label>
						  <div class="controls" style="width:400px">   
						  	                   
							<textarea id="short_description"  name="short_description"  style="min-width:400px;min-height:50px;"></textarea>
						  </div>
						</div>
						
						<!-- Textarea -->
						<div class="control-group">
						  <label class="control-label">Description</label>
						  <div class="controls" style="width:400px">   
						  	 <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
							//<![CDATA[
							  bkLib.onDomLoaded(function() {
							        new nicEditor().panelInstance('video_description');
							        
							  });
							  //]]>
							  </script>                  
							<textarea id="video_description"  name="video_description"  style="min-width:500px;min-height:200px;"></textarea>
						  </div>
						</div>
						
						<!-- Multiple Radios (inline) -->
						<!-- <div class="control-group">
						  <label class="control-label" for="is_worout">Is Work out Video</label>
						  <div class="controls">
							<label class="radio inline" for="is_worout-0">
							  <input type="radio" name="is_worout" id="is_worout-0" value="Yes" checked="checked">
							  Yes
							</label>
							<label class="radio inline" for="is_worout-1">
							  <input type="radio" name="is_worout" id="is_worout-1" value="No">
							  No
							</label>
						  </div>
						</div> -->

						<!-- Button (Double) -->
						<div class="control-group">
						  <label class="control-label"></label>
						  <div class="controls">
							<button id="Save" name="Save" class="btn btn-success" type="submit">Save</button>
							<button id="Cancel" name="Cancel" class="btn btn-warning" type='reset'>Cancel</button>
						  </div>
						</div>

						</fieldset>
					</form>			
				</div>
	</div>
	<?php
}

function videos_add_video_process()
{
	$VideoPath = $_POST['VideoPath'];
	$Select_video_thumb = $_POST['Select_video_thumb'];
	$Video_name = $_POST['Video_name'];
	$video_description = $_POST['video_description'];
	$short_description = $_POST['short_description'];
	$is_worout = $_POST['is_worout'];
	
	require_once('videofunctions/getid3/getid3.php');
	$getID3 = new getID3;
	$ThisFileInfo = $getID3->analyze($VideoPath);
	$videoduration1 = $ThisFileInfo['playtime_string'];
	$videoduration = str_replace(":",".",$videoduration1);
	$date = date('Y-m-d');
	$db = getdb();
	$add_video_query = "INSERT INTO `videos`(`video_name`, `video_duration`, `Desctiption`, `short_desc`, `video_path`, video_thumb_path,video_date,is_workout) VALUES
	('$Video_name','$videoduration','$video_description', '$short_description', '$VideoPath','$Select_video_thumb','$date','$is_worout')";
	
	
	$result = mysqli_query($db,$add_video_query);
	if($result == true)
	{
		echo "<script>window.location = 'index.php?module=videos&task=view';</script>";
	}
	else
	{
		echo "Not saved this file is already saved or you given wrong data";
	}
}


///////////////////////////////////////////////////////////////////////////////////////
///////////////-------------------------------------------------------------------------

function videos_edit_video()
{
if(isset($_GET['videoID']))
{

$video_ID = $_GET['videoID'];
//echo $video_ID;

$db = getdb();

$selec_vide_query = "SELECT * FROM videos WHERE video_id='$video_ID'";

$result = mysqli_query($db,$selec_vide_query);
$row = mysqli_fetch_array($result);
//echo $date;

$dir = "videos/";
$dirlist  = scandir($dir,1);
	$arraylength = count($dirlist);
	$i = 0;
	$option = "";
	while($arraylength != $i)
	{
		$split_string = explode(".", $dirlist[$i]);
		$split_count = count($split_string);
		$split_count-=1;
		if($split_string[1] == 'mp4')
		{
			if($dir."".$dirlist[$i] == $row['video_path'])
			{$option = $option."<option selected value='".$dir."".$dirlist[$i]."'>".$dirlist[$i]."</option>";}
			$option = $option."<option value='".$dir."".$dirlist[$i]."'>".$dirlist[$i]."</option>";
		}
		$i+=1;
	}
	
	
	$dir1 = "videosthumb/";
	$dirlist1  = scandir($dir1,1);
	$arraylength1 = count($dirlist1);
	$i = 0;
	$option1 = "";
	while($arraylength1 != $i)
	{
		$split_string = explode(".", $dirlist1[$i]);
		$split_count = count($split_string);
		$split_count-=1;
		if(($split_string[1] == 'jpeg') or ($split_string[1] == 'jpg') or ($split_string[1] == 'png') or ($split_string[1] == 'gif'))
		{
			if($dirlist1[$i] == $row['video_thumb_path'])
			{ $option1 = $option1."<option selected value='".$dirlist1[$i]."'>".$dirlist1[$i]."</option>"; }
			$option1 = $option1."<option value='".$dirlist1[$i]."'>".$dirlist1[$i]."</option>";
		}
		$i+=1;
	}
	?>
	<div class="span8">
		<div class="tabbable" id="tabs-329233">
			<ul class="nav nav-tabs">
				<!-- <li class="active">
					<a href="#points" data-toggle="tab">Cue points</a>
				</li> -->
				<li>
					<a href="#Edit_Video" data-toggle="tab">Edit Video</a>
				</li>
				<a href='?module=videos&task=view'><button class="btn" type="button" style='display: block;float: right;'>Back to videos</button></a>
			</ul>
			<div class="tab-content">
				<!-- <div class="tab-pane active" id="points">
									<span><h3>List of video1 Cuepoints</h3></span>
					 <a href='?module=videos&task=add_cuepoint&videoID=<?php echo $video_ID ?>'><button class="btn" type="button">Add new cue point to this video</button></a>
					<hr>
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>
									#
								</th>
								<th>
									cuepoint
								</th>
								<th>
									Description
								</th>
								<th>
									
								</th>
							</tr>
						</thead>
						<tbody>
						<?php
						/*
						$cue_points_query = "SELECT * FROM videos_q_points WHERE video_id=$video_ID";
						$result_cuepoints = mysqli_query($db,$cue_points_query);	
						$i=1;
						foreach($result_cuepoints as $cprow)
						{
							if ($i % 2 == 0) {
							  echo "<tr class='warning'>";
							}
							else
							{
								echo "<tr class='info'>";
							}
							echo "<td>".$i."</td>";
							echo "<td>".$cprow['q_point_value']."</td>";
							echo "<td>".$cprow['q_point_description']."</td>";
							echo "<td><a href='?module=videos&task=edit_cuepoint&cuepointID=".$cprow['q_points_id']."'><button class='btn btn-mini btn-success' type='button' id='5454' onclick='alert(this.attributes['id'].value)'>Edit</button></a></td>";
							echo "</tr>";
							$i = $i+1;
						}
						*/
						?>
						</tbody>
					</table>
				</div>  -->
				<div class="tab-pane active" id="Edit_Video">
					<form class="form-horizontal" action='?module=videos&task=edit_video_process&videoID=<?php echo $video_ID; ?>' method='post'>
					<fieldset>
					<!-- Select Basic -->
					<div class="control-group">
					  <label class="control-label">Select the Video</label>
					  <div class="controls">
						<select id="VideoPath" name="VideoPath" class="input-xlarge">
						<?php
						echo $option;
						?>
						</select>
					  </div>
					</div>

					<!-- Select Basic -->
					<div class="control-group">
					  <label class="control-label">Video thumbnail</label>
					  <div class="controls">
						<select id="Select_video_thumb" name="Select_video_thumb" class="input-xlarge">
						<?php
						echo $option1;
						?>
						</select>
					  </div>
					</div>

					<!-- Text input-->
					<div class="control-group">
					  <label class="control-label">Video Name</label>
					  <div class="controls">
						<input id="Video_name" name="Video_name" type="text" value="<?php echo $row['video_name']?>" class="input-xlarge" required="">
						
					  </div>
					</div>
					
					<!-- Short Description -->
					<div class="control-group">
					  <label class="control-label">Short Description</label>
					  <div class="controls" style="width:400px">   
					                    
							
						<textarea id="short_description" name="short_description"  style="width:500px;min-height:50px;"><?php echo $row['short_desc']?></textarea>
					  </div>
					</div>
					
					<!-- Textarea -->
					<div class="control-group">
					  <label class="control-label">Description</label>
					  <div class="controls" style="width:400px">   
					   <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
							//<![CDATA[
							  bkLib.onDomLoaded(function() {
							        new nicEditor().panelInstance('video_description');
							        
							  });
							  //]]>
							  </script>                  
							
						<textarea id="video_description" name="video_description"  style="width:500px;min-height:200px;"><?php echo $row['Desctiption']?></textarea>
					  </div>
					</div>
					
					<!-- Multiple Radios (inline) -->
					<!-- <div class="control-group">
					  <label class="control-label" for="is_worout">Is Work out Video</label>
					  <div class="controls">
						<label class="radio inline" for="is_worout-0">
						  <input type="radio" name="is_worout" id="is_worout-0" value="Yes"  <?php if($row['is_workout'] == 'Yes'){echo 'checked="checked"';}?> >
						  Yes
						</label>
						<label class="radio inline" for="is_worout-1">
						  <input type="radio" name="is_worout" id="is_worout-1" value="No"  <?php if($row['is_workout'] == 'No'){echo 'checked="checked"';}?>  >
						  No
						</label>
					  </div>
					</div>  -->
					
					<!-- Button (Double) -->
					<div class="control-group">
					  <label class="control-label"></label>
					  <div class="controls">
						<button id="Save" name="Save" class="btn btn-success" type="submit">Save</button>
						<button id="Cancel" name="Cancel" class="btn btn-warning" type='reset'>Cancel</button>
					  </div>
					</div>

					</fieldset>
					</form>	
				</div>
			</div>
		</div>
	</div>
<?php
}
else{
	echo "<script>window.location = 'index.php?module=videos&task=view';</script>";
}
}


//////////////////////////////////////////////////////////////////
//////////////////-----------------------------------------------
function videos_edit_video_process()
{

	if(isset($_GET['videoID']))
	{
		$video_id = $_GET['videoID'];
		$VideoPath = $_POST['VideoPath'];
		$Select_video_thumb = $_POST['Select_video_thumb'];
		$Video_name = $_POST['Video_name'];
		$video_description = $_POST['video_description'];
		$short_description = $_POST['short_description'];
		$is_worout = $_POST['is_worout'];
		
		require_once('videofunctions/getid3/getid3.php');
		$getID3 = new getID3;
		$ThisFileInfo = $getID3->analyze($VideoPath);
		$videoduration1 = $ThisFileInfo['playtime_string'];
		$videoduration = str_replace(":",".",$videoduration1);
		$date = date('Y-m-d');
		$db = getdb();
		$edit_video_query = "update  videos set video_name = '$Video_name', video_duration = '$videoduration', `Desctiption` = '$video_description', `short_desc` = '$short_description', `video_path` = '$VideoPath', video_thumb_path = '$Select_video_thumb', is_workout='$is_worout' where video_id = $video_id";
		//echo $edit_video_query;
		$result = mysqli_query($db,$edit_video_query);
		if($result == true)
		{
			echo "<script>window.location = 'index.php?module=videos&task=view';</script>";
		}
		else
		{
			echo "Not saved this file is already saved or you given wrong data";
		}
	}
	else
	{
		echo "<script>window.location = 'index.php?module=videos&task=view';</script>";
	}
}

////////////////////////////////////////////////////////////////////////////////////
//---------------------------------------------------------------
function videos_add_cuepoint()
{

	if(isset($_GET['videoID']))
	{
	$video_id = $_GET['videoID'];
	$db = getdb();
	$sel_query = "SELECT * FROM `videos` WHERE `video_id`=".$video_id;
	$result =  mysqli_query($db,$sel_query);
	$videos_row = mysqli_fetch_array($result);
	?>
	<div class="span8">
	<div class="player">
		
		<video poster="http://corrupt-system.de/assets/media/sintel/sintel-trailer.jpg" controls preload="none" style="width: 400px; height: 228px;">
			<source src="<?php echo $videos_row['video_path']; ?>" type="video/mp4" />
		</video>
		<form class="form-horizontal" method='post' action='?module=videos&task=add_cuepoint_process'>
			<fieldset>
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="current-time">current-time</label>
			  <div class="controls">
				<span class="current-time">--/--</span>
			  </div>
			</div>

			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="slider">slider</label>
			  <div class="controls">
				<input id="slider" name="slider" type="range" class="time-slider input-large" value="0" step="any">
				<input id="slider" name="video_id" type="text" value="<?php echo $video_id; ?>" style='display:none'>
				
			  </div>
			</div>

			<!-- Textarea -->
			<div class="control-group">
			  <label class="control-label" for="textarea">Text Area</label>
			  <div class="controls">                     
				<textarea id="textarea" name="textarea"></textarea>
			  </div>
			</div>

			<!-- Button (Double) -->
			<div class="control-group">
			  <label class="control-label" for="save"></label>
			  <div class="controls">
				<button id="save" name="save" class="btn btn-success" type='submit'>save</button>
				<button id="cancel" name="cancel" class="btn btn-danger" type="reset">cancel</button>
			  </div>
			</div>
			</fieldset>
		</form>
	</div>
	</div>
	<script>
	syncpnbar();
	</script>

	<?php
	}
	else{
		echo "<script>window.location = 'index.php?module=videos&task=view';</script>";
	}
}


function videos_add_cuepoint_process()
{
	$video_id = $_POST['video_id'];
	$slider = $_POST['slider'];
	$textarea = $_POST['textarea'];
	// echo $video_id;
	// echo $slider;
	// echo $textarea;
	$db = getdb();
	$query = "INSERT INTO `videos_q_points`(`video_id`, `q_point_value`, `q_point_description`) VALUES
	($video_id,'$slider','$textarea')";
	$results = mysqli_query($db,$query);
	if($results == true)
	{
		echo "<script>window.location = '?module=videos&task=edit_video&videoID=".$video_id."';</script>";
	}
	else
	{
		echo "not ok";
	}
}

///////////////////////////////////////////////////////////////////////////////////////
/////////--------------------------------------------------------------------------------

function videos_edit_cuepoint()
{
	if(isset($_GET['cuepointID'])){
		
		$db = getdb();
		$cuepointid = $_GET['cuepointID'];
		$query_sele_cue = "SELECT s.q_points_id, s.video_id, s.q_point_value, s.q_point_description, c.video_name, c.video_path FROM videos_q_points s,videos c where s.video_id = c.video_id and s.q_points_id=".$cuepointid;
		$result = mysqli_query($db,$query_sele_cue);
		$row_cuepints = mysqli_fetch_array($result);
		
	
	?>
	<div class="span8">
		<div class="player">
			
			<video id="vid" controls style="width: 400px; height: 228px;">
				<source src="<?php echo $row_cuepints['video_path']; ?>" type="video/mp4" />
			</video>
			<form class="form-horizontal" method='post' action='?module=videos&task=edit_cuepoint_process'>
				<fieldset>
				<!-- Text input-->
				<div class="control-group">
				  <label class="control-label" for="current-time">current-time</label>
				  <div class="controls">
					<span class="current-time"><?php echo $row_cuepints['q_point_value'];?></span>
				  </div>
				</div>

				<!-- Text input-->
				<div class="control-group">
				  <label class="control-label" for="slider">slider</label>
				  <div class="controls">
					<input id="slider" onChange="syncpnbar()" name="slider" type="range" class="time-slider input-large" value='5' step="any">
					<input id="slider" name="cuepoint_id" type="text" value="<?php echo $cuepointid; ?>" style='display:none'>
					
				  </div>
				</div>
<script>
  
	var myVideo=document.getElementById("vid"); 


document.getElementById('vid').addEventListener('loadedmetadata', function() {
  this.currentTime = 10;
}, false);
syncpnbar();


</script>
				<!-- Textarea -->
				<div class="control-group">
				  <label class="control-label" for="textarea">Text Area</label>
				  <div class="controls">                     
					<textarea id="textarea" name="textarea"><?php echo $row_cuepints['q_point_description'];?></textarea>
				  </div>
				</div>

				<!-- Button (Double) -->
				<div class="control-group">
				  <label class="control-label" for="save"></label>
				  <div class="controls">
					<button id="save" name="save" class="btn btn-success" type='submit'>save</button>
					<button id="cancel" name="cancel" class="btn btn-danger" type="reset">cancel</button>
				  </div>
				</div>
				</fieldset>
			</form>
		</div>
	</div>
	<?php
	}
	else{
		echo "<script>window.location = 'index.php?module=videos&task=view';</script>";
	}
}


function videos_edit_cuepoint_process()
{
	$cuepoint_id = $_POST['cuepoint_id'];
	$slider = $_POST['slider'];
	$textarea = $_POST['textarea'];
	// echo $video_id;
	// echo $slider;
	// echo $textarea;
	$db = getdb();
	$query = "update videos_q_points set q_point_value='$slider', q_point_description ='$textarea' where q_points_id=$cuepoint_id";
	$results = mysqli_query($db,$query);
	if($results == true)
	{
		echo "ok";
		echo "<script>window.location = 'index.php?module=videos&task=view';</script>";
	}
	else
	{
		echo "record not added or edited";
	}
}



?>