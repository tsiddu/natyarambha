<?php


function lessons_view()
{

$db = getdb();
$quert_list_lessons = "SELECT * FROM `lesson`";

$results = mysqli_query($db , $quert_list_lessons);

?>
<div class="row-fluid">
				<div class="span8">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="?module=lessons&task=view">List Lessons</a>
						</li>
						<li>
							<a href="?module=lessons&task=add_lessons">Add Lesson</a>
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
									Description
								</th>
								<th>
									Level
								</th>
								<th>
								
								</th>
								<th>
								
								</th>
							</tr>
						</thead>
						<tbody>
						<?php

								$i = 1;
								while($row = mysqli_fetch_array($results))
								{
									if ($i % 2 == 0) {
									  echo "<tr class='warning'>";
									}
									else
									{
										echo "<tr class='info'>";
									}
									echo "<td>".$i."</td>";
									echo "<td>".$row['lessons_name']."</td>";
									echo "<td>".substr($row['lesson_description'], 0,15)."...</td>";
									if($row['lesson_level']){
										echo "<td>Paid</td>";
									}
									else{
										echo "<td>Free</td>";
									}
									echo "<td><a href='?module=lessons&task=edit_lessons&lessonID=".$row['lessons_id']."'><button class='btn btn-mini btn-success' type='button'>Edit</button></a></td>";
									echo "<td><a href='?module=lessons&task=delete_lessons&lessonID=".$row['lessons_id']."'><button class='btn btn-mini btn-success' type='button'>Delete</button></a></td>";
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

/////////////////////////////////////////////////////////////////////
/////////---------------------------------------------
function lessons_add_lessons()
{
	
?>

<div class="span8">
	<ul class="nav nav-tabs">
		<li>
			<a href="?module=lessons&task=view">List Lessons</a>
		</li>
		<li class="active">
			<a href="?module=lessons&task=add_lessons">Add Lesson</a>
		</li >
	</ul>
	<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
	<form class="form-horizontal" method='post' action='?module=lessons&task=add_lessons_process'>
		<fieldset>

		<!-- Form Name -->
		<legend>Add Lesson</legend>

		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label" for="lessonName">Lesson Name</label>
		  <div class="controls">
			<input id="lessonName" name="lessonName" type="text" placeholder="Lesson Name" class="input-large" required="">
			
		  </div>
		</div>

		<!-- Textarea -->
		<div class="control-group">
		<script type="text/javascript">
							//<![CDATA[
							  bkLib.onDomLoaded(function() {
							        new nicEditor().panelInstance('description');
							        
							  });
							  //]]>
							  </script> 
		  <label class="control-label" for="description">description</label>
		  <div class="controls">     
			<textarea id="description"  name="description"  style="min-width:500px;min-height:200px;">default text</textarea>
		  </div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label" for="lessonlevel">Lesson Level</label>
		  <div class="controls">
			<input type="radio" id="lessonlevel" name="lessonlevel" value="0" >Free &nbsp;&nbsp;&nbsp;
			<input type="radio" id="lessonlevel" name="lessonlevel" value="1" >Paid
			
			
		  </div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label" for="tags">Tags</label>
		  <div class="controls">
			<input id="tags" name="tags" type="text" placeholder="ex : easy, hard, " class="input-large" required="">
			
		  </div>
		</div>
		
		<!-- Button (Double) -->
		<div class="control-group">
		  <label class="control-label" for="save"></label>
		  <div class="controls">
			<button id="save" name="save" class="btn btn-success" type="submit">Save</button>
			<button id="cancel" name="cancel" class="btn btn-danger" type='reset'>Cancel</button>
		  </div>
		</div>

		</fieldset>
	</form>
</div>

<?php	
	
}
////////////////////////////////////////////////////////////////////
////////////////---------------------------------------
function lessons_add_lessons_process()
{

$lessonName = $_POST['lessonName'];
$description = $_POST['description'];
$lessonlevel = $_POST['lessonlevel'];
$tags = $_POST['tags'];
	$db = getdb();
	$insert_query = "INSERT INTO lesson(lessons_name, lesson_description, lesson_level,tags) VALUES 
	('$lessonName','$description',$lessonlevel,'$tags')";
	$result = mysqli_query($db , $insert_query);
	if($result == true)
	{
		echo "<div class='span8'>
			 <a href='?module=lessons&task=add_lessons'><button class='btn' type='button'>Add Another Lesson</button></a>
			 <h3>Record Added</h3>
			 <a href='?module=lessons&task=view'><button class='btn' type='button'>Back to Lesson List</button></a>
		</div>";
	}
	else{
		echo "<div class='span8'>
		<hr>
			 <h3>Record Not Added</h3>
			 <a href='?module=lessons&task=add_lessons'><button class='btn' type='button'>Back to Add Lessons</button></a>
		<hr>
		</div>";
	}
}

//////////////////////////////////////////////////////////////////////////
////////////////////////-----------------------------------
function lessons_edit_lessons()
{
	if($_GET['lessonID'])
	{
		$lessonID = $_GET['lessonID'];
		$db = getdb();
		
		//for lessons
		$select_query_lesson = "SELECT * FROM lesson WHERE lessons_id=".$lessonID;
		$result = mysqli_query($db , $select_query_lesson);
		$row = mysqli_fetch_array($result);
		//for topics
		$select_query_lesson_topics = "SELECT * FROM lessons_topic WHERE topic_lesson=".$lessonID;
		$result_topics = mysqli_query($db , $select_query_lesson_topics);
		?>
		
		<div class="span8">
		
		<div class="tabbable" id="tabs-329233">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#Edit_Lesson" data-toggle="tab">Edit Lesson</a>
				</li>
				<li>
					<a href="#List_Topics" data-toggle="tab">List of the Topics</a>
				</li>
				<a href='?module=lessons&task=view'><button class="btn" type="button" style='display: block;float: right;'>Back to Lessons</button></a>
			</ul>
		<div class="tab-content">
				<div class="tab-pane active" id="Edit_Lesson">
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>


<script type="text/javascript">
							//<![CDATA[
							  bkLib.onDomLoaded(function() {
							        new nicEditor().panelInstance('description');
							        
							  });
							  //]]>
							  </script> 
					<form class="form-horizontal" method='post' action='?module=lessons&task=edit_lessons_process'>
						<fieldset>
						<!-- Text input-->
						<div class="control-group">
						  <label class="control-label" for="lessonName">Lesson Name</label>
						  <div class="controls">
							<input id="lessonName" name="lessonName" type="text" value="<?php echo $row['lessons_name'];?>" class="input-large" required="">
							
						  </div>
						</div>

						<!-- Textarea -->
						<div class="control-group">
						  <label class="control-label" for="description">description</label>
						  <div class="controls">                     
							<textarea id="description" name="description" style="min-width:500px;min-height:200px;"><?php echo $row['lesson_description'];?></textarea>
						  </div>
						</div>

						<!-- Text input-->
						<div class="control-group">
						  <label class="control-label" for="lessonlevel">Lesson Level</label>
						  <div class="controls">
							<input type="radio" id="lessonlevel" name="lessonlevel" value="0" <?php if($row['lesson_level'] == 0) { echo "checked='checked'";}?> >Free &nbsp;&nbsp;&nbsp;
							<input type="radio" id="lessonlevel" name="lessonlevel" value="1" <?php if($row['lesson_level'] == 1) { echo "checked='checked'";}?> >Paid
							<input id="lessonID" name="lessonID" type="number" value="<?php echo $row['lessons_id'];?>" class="input-large" required="" style='display:none'>
						  </div>
						</div>
						
						<!-- Text input-->
						<div class="control-group">
						  <label class="control-label" for="tags">Tags</label>
						  <div class="controls">
							<input id="tags" name="tags" type="text" placeholder="ex : easy, hard, " class="input-large" >
							
						  </div>
						</div>

						<!-- Button (Double) -->
						<div class="control-group">
						  <label class="control-label" for="save"></label>
						  <div class="controls">
							<button id="save" name="save" class="btn btn-success" type="submit">Save</button>
							<button id="cancel" name="cancel" class="btn btn-danger" type='reset'>Cancel</button>
						  </div>
						</div>

						</fieldset>
					</form>
				</div>
				<div class="tab-pane" id="List_Topics">
					<span><h3>List of lessons Topic</h3></span>
					 <a href='?module=lessons&task=add_topics&lessonID=<?php echo $lessonID; ?>'><button class="btn" type="button">Add New Topic</button></a>
					<hr>
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>
									#
								</th>
								<th>
									Topic Name
								</th>
								<th>
									Description
								</th>
								<th style='width: 40px;'>
								</th>								
								<th style='width: 65px;'>
								</th>								
								<th style='width: 70px;'>
								</th>
								<th style='width: 45px;'>
								</th>
							</tr>
						</thead>
						<tbody>
						<?php

								$i = 1;
								while($row_topic = mysqli_fetch_array($result_topics))
								{
									if ($i % 2 == 0) {
									  echo "<tr class='warning'>";
									}
									else
									{
										echo "<tr class='info'>";
									}
									echo "<td>".$i."</td>";
									echo "<td>".$row_topic['topic_name']."</td>";
									echo "<td>".$row_topic['tpoic_description']."</td>";
									echo "<td><a href='?module=lessons&task=edit_topics&topic_id=".$row_topic['topic_id']."'><button class='btn btn-mini btn-success' type='button'>Edit</button></a></td>";
									?> <td><a id='modal-add-video' href='#add-video' role='button' onClick="document.getElementById('topicID').value = '<?php echo $row_topic['topic_id'];?>';" class='btn btn-mini' data-toggle='modal' >Add video</a></td><?php
									echo "<td><a href='?module=lessons&task=view_topic_video&topic_id=".$row_topic['topic_id']."&lessonID=".$lessonID."'> <button class='btn btn-mini btn-info'>List Videos</button></a></td>";
									echo "<td><a href='?module=lessons&task=topics_delete&topic_id=".$row_topic['topic_id']."'><button class='btn btn-mini btn-danger' type='button'>Delete</button></a></td>";
									echo "</tr>";
									$i = $i+1;
								}

							?>
								<div id="add-video" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-header">
										 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h3 id="myModalLabel">
											Add Video
										</h3>
									</div>
									<div class="modal-body">
									<form class="form-horizontal" action='?module=lessons&task=add_topic_video_process' method='post'>
											<fieldset>
											<!-- Select Basic -->
											<div class="control-group">
											  <label class="control-label" for="VideoName">Video Name</label>
											  <div class="controls">
												<select id="VideoName" name="VideoName" class="input-large">
												<?php
													$options = "";
													$select_videos = "SELECT * FROM `videos`";
													$result_Query = mysqli_query($db,$select_videos);
													while($row1 = mysqli_fetch_array($result_Query))
													{
														echo "<option value='".$row1['video_id']."'>".$row1['video_name']."</option>";
													}
												 ?>
												</select>
											  </div>
											</div>
											<input type='text' value='' name='topicID' id='topicID' style="display:none"/>
											<!-- Textarea -->
											<div class="control-group">
											  <label class="control-label" for="description">Description</label>
											  <div class="controls">                     
												<textarea id="description" name="description"></textarea>
											  </div>
											</div>

											</fieldset>
										
									</div>
									<div class="modal-footer">
										 <button type='Save' class="btn btn-primary">Add Video</button><button class="btn" data-dismiss="modal" aria-hidden="true" type='reset'>Close</button> 
									</form>
									</div>
								</div>
						</tbody>
					</table>
					
				</div>
		</div>
		
		<?php
		
	}
	else{
		echo "<script>window.location = '?module=lessons&task=view';</script>";
	}
	
}

////////////////////////////////////////////////////////////////////////////
/////////////////////////////-------------------------------------
function lessons_edit_lessons_process()
{
$lessonName = $_POST['lessonName'];
$description = $_POST['description'];
$lessonlevel = $_POST['lessonlevel'];
$lessons_id = $_POST['lessonID'];
$tags = $_POST['tags'];
	$db = getdb();
	$insert_query = "update `lesson`set `lessons_name`='$lessonName',`lesson_description`='$description', `lesson_level`=$lessonlevel, tags='$tags' where lessons_id = $lessons_id";
	$result = mysqli_query($db , $insert_query);
	if($result == true)
	{
		echo "<div class='span8'>
			 <h3>Record Edited</h3>
			 <a href='?module=lessons&task=view'><button class='btn' type='button'>Back to Lesson List</button></a>
		</div>";
	}
	else{
		echo "<div class='span8'>
			 <h3>Record Not Edited</h3>
			 <a href='?module=lessons&task=view'><button class='btn' type='button'>Back to Lesson List</button></a>
		</div>";
	}
}

//////////////////////////////////////////////////////////////////////////////
////////////////////////////////////----------------------------------
function lessons_delete_lessons()
{
	if($_GET['lessonID'])
	{
		$lessonID = $_GET['lessonID'];
		
		$db  = getdb();
		$query_topics_delete = "DELETE FROM `lessons_topic` WHERE topic_lesson=$lessonID";
		$result1 = mysqli_query($db,$query_topics_delete);
		if($result1 == true)
		{
			$query_lessons_delete = "DELETE FROM `lesson` WHERE lessons_id = $lessonID";
			$result2 = mysqli_query($db,$query_lessons_delete);
			if($result2 == true)
			{
				echo "lesson deleted";
			}
		}
		else{
			echo "not deleted";
		}
	}
}


function lessons_add_topics()
{
	if(isset($_GET['lessonID'])){
	$lessonID = $_GET['lessonID'];
	
?>
<div class='span8'>
	<br>
	<br>
	<form class="form-horizontal" action='?module=lessons&task=add_topics_process' method='post'>
	<fieldset>

	<!-- Form Name -->
	<spane style='font-weight: bold;font-size: 20px;'>Add topic to Lessons</span><a style='float: right;' class='btn' href='?module=lessons&task=edit_lessons&lessonID=<?php echo $lessonID;?>'>Back to lesson</a>
	<hr>

	<!-- Text input-->
	<div class="control-group">
	  <label class="control-label" for="topicsname">Topic Name</label>
	  <div class="controls">
		<input id="topicsname" name="topicsname" type="text" placeholder="Topic Name" class="input-large" required="">		
	  </div>
	</div>
	<input id="lessonID" name="lessonID" type="text" value="<?php echo $lessonID; ?>" class="input-large" required="" style='display:none'>
	<!-- Textarea -->
	<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>


	<script type="text/javascript">
	//<![CDATA[
	  bkLib.onDomLoaded(function() {
			new nicEditor().panelInstance('topic_description');
			
	  });
	  //]]>
	  </script> 
	<div class="control-group">
	  <label class="control-label" for="topic_description">Topics Description</label>
	  <div class="controls">                     
		<textarea id="topic_description" name="topic_description"  style="width:100%;min-height:200px;"></textarea>
	  </div>
	</div>

	<!-- Button (Double) -->
	<div class="control-group">
	  <label class="control-label" for="save"></label>
	  <div class="controls">
		<button id="save" name="save" class="btn btn-success" type='submit'>Save</button>
		<button id="Cancel" name="Cancel" class="btn btn-danger" type='reset'>Cancel</button>
	  </div>
	</div>

	</fieldset>
	</form>
</div>
<?php
	}
	else{
	}
}
//////////////////////////////////////////////////////////////////////////////
/////////////////////---------------------------------------------------------
function lessons_add_topics_process()
{
	$topicsname = $_POST['topicsname'];
	$lessonID = $_POST['lessonID'];
	$topic_description = $_POST['topic_description'];
	
	$db = getdb();
	$inser_topic = "INSERT INTO `lessons_topic`(`topic_name`, `topic_lesson`, `tpoic_description`) VALUES 
	('$topicsname','$lessonID','$topic_description')";
	
	$result = mysqli_query($db , $inser_topic);
	if($result == true){
		echo "ok";
		echo "<script>window.location = '?module=lessons&task=edit_lessons&lessonID=".$lessonID."';</script>";
	}
	else{
		echo "<script>alert('not added');</script>";
		echo "<script>window.location = '?module=lessons&task=edit_lessons&lessonID=".$lessonID."';</script>";
	}
}

///////////////////////////////////////////////////////////////////////////////
////////////////////-----------------------------------------------------------
function lessons_edit_topics()
{
	if(isset($_GET['topic_id'])){
		$topic_id = $_GET['topic_id'];
		$db = getdb();
		$query = "SELECT * FROM `lessons_topic` WHERE topic_id=".$topic_id;
		$result = mysqli_query($db , $query);
		$row = mysqli_fetch_array($result);
		?>
		<div class='span8'>
			<form class="form-horizontal" action='?module=lessons&task=edit_topics_process' method='post'>
				<fieldset>

				<!-- Form Name -->
				<legend>Edit topic to Lessons</legend>

				<!-- Text input-->
				<div class="control-group">
				  <label class="control-label" for="topicsname">Topic Name</label>
				  <div class="controls">
					<input id="topicsname" name="topicsname" type="text" value="<?php echo $row['topic_name']; ?>" class="input-large" required="">		
				  </div>
				</div>
				<input id="topic_id" name="topic_id" type="text" value="<?php echo $topic_id; ?>" class="input-large" required="" style='display:none'>
				<!-- Textarea -->
								<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>


								<script type="text/javascript">
								//<![CDATA[
								  bkLib.onDomLoaded(function() {
										new nicEditor().panelInstance('topic_description');
										
								  });
								  //]]>
								  </script> 
								<div class="control-group">
								  <label class="control-label" for="topic_description">Topics Description</label>
								  <div class="controls">                     
									<textarea id="topic_description" name="topic_description"  style="width:100%;min-height:200px;"><?php echo $row['tpoic_description']; ?></textarea>
								  </div>
								</div>

				<!-- Button (Double) -->
				<div class="control-group">
				  <label class="control-label" for="save"></label>
				  <div class="controls">
					<button id="save" name="save" class="btn btn-success" type='submit'>Save</button>
					<button id="Cancel" name="Cancel" class="btn btn-danger" type='reset'>Cancel</button>
				  </div>
				</div>

				</fieldset>
			</form>
		</div>
		<?php
	}
	else{
		echo "<script>window.location = '?module=lessons&task=view';</script>";
	}
	
}

////////////////////////////////////////////////////////////////////////////////
/////////////////////////////---------------------------------------------------
function lessons_edit_topics_process()
{
	$topicsname = $_POST['topicsname'];
	$topic_id = $_POST['topic_id'];
	$topic_description = $_POST['topic_description'];
	
	$db = getdb();
	$inser_topic = "update lessons_topic set topic_name='$topicsname', `tpoic_description`='$topic_description' where topic_id=".$topic_id;
	
	$result = mysqli_query($db , $inser_topic);
	if($result == true){
		echo "Record Updated";
	}
	else{
		echo "record Not Updated";
	}
}

/////////////////////////////////////////////////////////////////////////////////
//////////////////////////////---------------------------------------------------
function lessons_topics_delete()
{
	if(isset($_GET['topic_id'])){
		$topic_id = $_GET['topic_id'];
		$db = getdb();
		$query = "DELETE FROM `lessons_topic` WHERE `topic_id`=".$topic_id;
		$result = mysqli_query($db ,$query);
		if($result == true)
		{
			echo "record deleted";
		}
	}
	else{
		echo "sorry no record selected";
	}
}

/////////////////////////////////////////////////////////////////////////////////
///////////////////////////------------------------------------------------------
function lessons_add_topic_video()
{
	
}

/////////////////////////////////////////////////////////////////////////////////
///////////////////////////------------------------------------------------------
function lessons_add_topic_video_process()
{
	$VideoName = $_POST['VideoName'];
	$topicID = $_POST['topicID'];
	$description = $_POST['description'];
	$db = getdb();
	$query = "INSERT INTO `topic_videos`(`topic_id`, `Vides_id`, `description`) VALUES
	($topicID,$VideoName,'$description')";
	$result = mysqli_query($db,$query);
	if($result == true){
		echo "record added";
	}
	else{
		echo "record not added";
	}
	
}

////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////-----------------------------------------------
function lessons_view_topic_video()
{
	if($_GET['topic_id'] and $_GET['lessonID'])
	{
		$topic_id = $_GET['topic_id'];
		$db = getdb();
		$query = "SELECt s.topic_id, s.t_v_id, s.description, c.video_name from topic_videos s, videos c where s.Vides_id = c.video_id and s.topic_id=".$topic_id;
		$result = mysqli_query($db,$query);

		$get_topc_name= "SELECT `topic_name` FROM `lessons_topic` WHERE `topic_id`='".$topic_id."'";
		$result1 = mysqli_query($db,$get_topc_name);
		$resout1row = mysqli_fetch_array($result1);
		$name = $resout1row['topic_name'];
	?>
	<br>
	<br>
	<span style='font-weight:bold'>Videos List of the <?php echo $name; ?></span>
	<a href="?module=lessons&task=edit_lessons&lessonID=<?php echo $_GET['lessonID'];?>" style='float: right;' class='btn'>Back to lesson</a>
	<br>
	<hr>
	<div class="span8">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							Video name
						</th>
						<th>
							Description
						</th>
						<th>
						</th>
						<th>
						</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i = 1;
				while($row = mysqli_fetch_array($result))
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
					echo "<td>".$row['description']."</td>";
					echo "<td><a href='?module=lessons&task=edit_topic_video&t_v_id=".$row['t_v_id']."&lessonID=".$_GET['lessonID']."&topic_id=".$_GET['topic_id']."'><button class='btn btn-mini btn-success' type='button'>Edit</button></a></td>";
					echo "<td><a href='?module=lessons&task=delete_topic_video&topic_id=".$row['t_v_id']."&lessonID=".$_GET['lessonID']."&topic_id=".$_GET['topic_id']."'><button class='btn btn-mini btn-danger' type='button'>Delete</button></a></td>";
					echo "</tr>";
					$i = $i+1;
				}
				?>
				</tbody>
			</table>
		</div>
	<?php
	}
	else
	{
		echo "sory no topic selectd";
	}
}


/////////////////////////////////////////////////////////////////////////////////
///////////////////////////------------------------------------------------------
function lessons_edit_topic_video()
{	
	if(isset($_GET['t_v_id'])){
		$db = getdb();
		$t_v_id = $_GET['t_v_id'];
		$lessonID = $_GET['lessonID'];
		$topic_id = $_GET['topic_id'];
		$query1 = "SELECT s.Vides_id ,s.description, c.video_path,c.video_name from topic_videos s, videos c where s.Vides_id = c.video_id and t_v_id=".$t_v_id;
		$result = mysqli_query($db,$query1);
		foreach($result as $rowval);
		?>
		<div class='span8'>
		<video controls preload="none" style="width: 400px; height: 228px;">
			<source src="<?php echo $rowval['video_path'];?>" type="video/mp4" />
		</video>
			<form class="form-horizontal" method="post" action='?module=lessons&task=edit_topic_video_process&lessonID=<?php echo $lessonID; ?>&topic_id=<?php echo $topic_id; ?>'>
				<fieldset>

				<!-- Form Name -->
				<span style='font-size:20px'>Edit topic Video</span>
				<span style='float:right;'><a class='btn' href="?module=lessons&task=view_topic_video&lessonID=<?php echo $lessonID;?>&topic_id=<?php echo $topic_id;?>">Back to List of Topics</a></span>
				<hr>

				<!-- Select Basic -->
				<div class="control-group">
				  <label class="control-label" for="VideoName">Video Name</label>
				  <div class="controls">
					<select id="VideoName" name="VideoName" class="input-large" onChange='changevideo()'>
					<?php
						$options = "";
						$select_videos = "SELECT * FROM `videos`";
						$result_Query = mysqli_query($db,$select_videos);
						while($row1 = mysqli_fetch_array($result_Query))
						{
							if($row1['video_id']== $rowval['Vides_id'])
							{	
								echo "<option selected value='".$row1['video_id']."'>".$row1['video_name']."</option>";
							}
							else
							{
								echo "<option value='".$row1['video_id']."'>".$row1['video_name']."</option>";
							}
						}
					?>
					</select>
				  </div>
				</div>

				<!-- Textarea -->
				<div class="control-group">
				  <label class="control-label" for="description">Description</label>
				  <div class="controls">                     
					<textarea id="description" name="description"><?php echo $rowval['description']; ?></textarea>
				  </div>
				</div>
				<input type='text' value="<?php echo $t_v_id; ?>" name='t_v_id' style="display:none;">
				<!-- Button (Double) -->
				<div class="control-group">
				  <label class="control-label" for="save"></label>
				  <div class="controls">
					<button id="save" name="save" class="btn btn-success" type='submit'>save</button>
					<button id="cancel" name="cancel" class="btn btn-danger" type='reset'>cancel</button>
				  </div>
				</div>

				</fieldset>
			</form>
		</div>
		<?php
	}
	else{
		echo "sorry no topic selectcd";
	}
	
}

/////////////////////////////////////////////////////////////////////////////////
///////////////////////////------------------------------------------------------
function lessons_edit_topic_video_process()
{
	$lessonID = $_GET['lessonID'];
	$topic_id = $_GET['topic_id'];
	$VideoName = $_POST['VideoName'];
	$t_v_id = $_POST['t_v_id'];
	$description = $_POST['description'];
	$db = getdb();
	$query = "update topic_videos set `Vides_id`=$VideoName, `description`='$description' where t_v_id=".$t_v_id;
	
	$result = mysqli_query($db,$query);
	if($result == true){
		echo "<script>window.location = '?module=lessons&task=view_topic_video&lessonID=".$lessonID."&topic_id=".$topic_id."';</script>";
	}
	else{
		echo "<script>window.location = '?module=lessons&task=view_topic_video&lessonID=".$lessonID."&topic_id=".$topic_id."';</script>";
	}
	
}

/////////////////////////////////////////////////////////////////////////////////
///////////////////////////------------------------------------------------------
function lessons_delete_topic_video()
{
if(isset($_GET['topic_id']))
{
	$topic_id = $_GET['topic_id'];
	$db = getdb();
	$query = "DELETE FROM `topic_videos` WHERE `t_v_id`=".$topic_id;
	$result = mysqli_query($db,$query);
	if($result == true)
	{
		echo "record deleted";
	}
	else{
		echo "record not deleted";
	}
}
else{
	echo "sorry no topic video selected";
}

}




function lessons_bookmark_lession() {
	//~ if() {
	//~ }
}

?>