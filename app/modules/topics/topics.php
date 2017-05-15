<?php

function topics_view()
{

$db = getdb();
$lessons_topic = "SELECT * FROM `lessons_topic`";

$results = mysqli_query($db , $lessons_topic);

?>
<div class="row-fluid">
				<div class="span8">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="?module=topics&task=view">List Videos</a>
						</li>
						<li>
							<a href="?module=topics&task=add_topics">Add Video</a>
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
									echo "<td>".$row['topics_name']."</td>";
									echo "<td>".$row['lesson_description']."</td>";
									echo "<td>".$row['lesson_level']."</td>";
									echo "<td><a href='?module=topics&task=edit_topics&lessonID=".$row['topics_id']."'><button class='btn btn-mini btn-success' type='button'>Edit</button></a></td>";
									echo "<td><a href='?module=topics&task=delete_topics&lessonID=".$row['topics_id']."'><button class='btn btn-mini btn-success' type='button'>Delet</button></a></td>";
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
function topics_add_topics()
{
	
?>
<div class="span8">
	<form class="form-horizontal" method='post' action='?module=topics&task=add_topics_process'>
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
		  <label class="control-label" for="description">description</label>
		  <div class="controls">                     
			<textarea id="description" name="description">default text</textarea>
		  </div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label" for="lessonlevel">Lesson Level</label>
		  <div class="controls">
			<input id="lessonlevel" name="lessonlevel" type="number" placeholder="Lesson Level" class="input-large" required="">
			
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
function topics_add_topics_process()
{

$lessonName = $_POST['lessonName'];
$description = $_POST['description'];
$lessonlevel = $_POST['lessonlevel'];
	$db = getdb();
	$insert_query = "INSERT INTO `lesson`(`topics_name`, `lesson_description`, `lesson_level`) VALUES 
	('$lessonName','$description',$lessonlevel)";
	$result = mysqli_query($db , $insert_query);
	if($result == true)
	{
		echo "<div class='span8'>
			 <a href='?module=topics&task=add_topics'><button class='btn' type='button'>Add Another Lesson</button></a>
			 <h3>Record Added</h3>
			 <a href='?module=topics&task=view'><button class='btn' type='button'>Back to Lesson List</button></a>
		</div>";
	}
	else{
		echo "<div class='span8'>
		<hr>
			 <h3>Record Not Added</h3>
			 <a href='?module=topics&task=add_topics'><button class='btn' type='button'>Back to Add topics</button></a>
		<hr>
		</div>";
	}
}

//////////////////////////////////////////////////////////////////////////
////////////////////////-----------------------------------
function topics_edit_topics()
{
	if($_GET['lessonID'])
	{
		$lessonID = $_GET['lessonID'];
		$db = getdb();
		$select_query_lesson = "SELECT * FROM lesson WHERE topics_id=".$lessonID;
		$result = mysqli_query($db , $select_query_lesson);
		$row = mysqli_fetch_array($result);
		
		?>
		
		<div class="span8">
			<form class="form-horizontal" method='post' action='?module=topics&task=edit_topics_process'>
				<fieldset>

				<!-- Form Name -->
				<legend>Add Lesson</legend>

				<!-- Text input-->
				<div class="control-group">
				  <label class="control-label" for="lessonName">Lesson Name</label>
				  <div class="controls">
					<input id="lessonName" name="lessonName" type="text" value="<?php echo $row['topics_name'];?>" class="input-large" required="">
					
				  </div>
				</div>

				<!-- Textarea -->
				<div class="control-group">
				  <label class="control-label" for="description">description</label>
				  <div class="controls">                     
					<textarea id="description" name="description"><?php echo $row['lesson_description'];?></textarea>
				  </div>
				</div>

				<!-- Text input-->
				<div class="control-group">
				  <label class="control-label" for="lessonlevel">Lesson Level</label>
				  <div class="controls">
					<input id="lessonlevel" name="lessonlevel" type="number" value="<?php echo $row['lesson_level'];?>" class="input-large" required="">
					<input id="lessonlevel" name="lessonID" type="number" value="<?php echo $row['topics_id'];?>" class="input-large" required="" style='display:none'>
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
	else{
		echo "<script>window.location = '?module=topics&task=view';</script>";
	}
	
}

////////////////////////////////////////////////////////////////////////////
/////////////////////////////-------------------------------------
function topics_edit_topics_process()
{
$lessonName = $_POST['lessonName'];
$description = $_POST['description'];
$lessonlevel = $_POST['lessonlevel'];
$topics_id = $_POST['lessonID'];
	$db = getdb();
	$insert_query = "update `lesson`set `topics_name`='$lessonName',`lesson_description`='$description', `lesson_level`=$lessonlevel where topics_id = $topics_id";
	$result = mysqli_query($db , $insert_query);
	if($result == true)
	{
		echo "<div class='span8'>
			 <h3>Record Edited</h3>
			 <a href='?module=topics&task=view'><button class='btn' type='button'>Back to Lesson List</button></a>
		</div>";
	}
	else{
		echo "<div class='span8'>
			 <h3>Record Not Edited</h3>
			 <a href='?module=topics&task=view'><button class='btn' type='button'>Back to Lesson List</button></a>
		</div>";
	}
}

//////////////////////////////////////////////////////////////////////////////
////////////////////////////////////----------------------------------
function topics_delete_topics()
{
	if($_GET['lessonID'])
	{
		$lessonID = $_GET['lessonID'];
		
		$db  = getdb();
		$query_topics_delete = "DELETE FROM `topics_topic` WHERE topic_lesson=$lessonID";
		$result1 = mysqli_query($db,$query_topics_delete);
		if($result1 == true)
		{
			$query_topics_delete = "DELETE FROM `lesson` WHERE topics_id = $lessonID";
			$result2 = mysqli_query($db,$query_topics_delete);
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
?>