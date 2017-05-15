<?php
session_start();
$User_id = $_SESSION['User_id'];
$User_type = $_SESSION['User_type'];
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
	echo "<html><script>alert('Please upgrade to view this lesson'); window.location = 'lessons.php'; </script></html>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'head.php'; ?>
	<title>Natyarambha - Lesson</title>
    <link rel="shortcut icon" href="natya.ico"/>

	
	
	<style>
	@media screen and (max-width: 480px) {
    .lesson img{ width:100% !important;}
    }
	</style>
	
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<?php 
  
  	$name_qry = "SELECT lessons_name FROM lesson where lessons_id = '$lessons_id'";
	$name_res= mysqli_query($db,$name_qry);
	$name_row= mysqli_fetch_array($name_res);
  
  
  ?>


<div class="canvas" > 
   <!-- Navigation -->
  <?php include 'nav.php'; ?>
  <!-- /lessons --> 
  
  <div class="jumbotron jumbotron-sm" style="margin-top:50px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                  <h2><?php echo $name_row['lessons_name']; ?></h2>
            </div>
        </div>
    </div>
</div>
    <div class="clearfix"></div>

  <div class="clearfix"></div>
  <div class="container lessons lesson">
  
  	<a href="video_detail.php?lessons_id=<?php echo $lessons_id ;?>" title="<?php echo $name_row['lessons_name']; ?>" class="btn btn-default pull-right">Start Lesson</a>
  
  <div class="clearfix"></div>
  <div class="para-des">
   <div class="row">
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> Description </h3>
          <span class="pull-right btn-click"> <i class="fa fa-chevron-circle-up"></i> </span> </div>
        <div class="clearfix"></div>
        <div class="panel-body">
         
 <?php 


			$query_lesson = "SELECT * FROM lessons_topic WHERE topic_lesson='$lessons_id'";
			$result1 = mysqli_query($db,$query_lesson);
				
				$row1 = mysqli_fetch_array($result1 );
			$topic_id = $row1['topic_id'];	
			echo $desc = $row1['tpoic_description'];	

	
	$vid_id = $_GET['video_id'];
	$query = "select `t_v_id` FROM `topic_videos` WHERE `topic_id`='$topic_id';";
	$res = mysqli_query($db,$query);
	$vif_row = mysqli_fetch_array($res,MYSQLI_ASSOC);
	$t_v_id = $vif_row['t_v_id'];
	
	$query = "SELECT s.`t_v_id`,s.`description`,c.`video_name`,c.`video_id`, c.video_path,c.video_thumb_path,c.Desctiption, c.short_desc FROM `topic_videos` s, videos c where s.`Vides_id` = c.video_id and `topic_id`='".$topic_id."' and c.video_id in (SELECT `Vides_id` FROM `topic_videos` WHERE `topic_id`='".$topic_id."' and `t_v_id`>='".$t_v_id."' ORDER BY Vides_id ASC) ";
	$result = mysqli_query($db,$query);

?> 
</div>
      </div>
    </div>
  </div>
</div>

    <ul class="list-unstyled video-list-thumbs row">
	
<?php 

	


	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 	 {

 
 ?>
	
	  
	  
	  <li class="col-lg-3 col-sm-4 col-xs-6">
		<a href="video_detail.php?lessons_id=<?php echo $lessons_id; ?>&video_id=<?php echo $row['video_id']; ?>"  title="<?php echo $row['video_name']; ?>"> <img src="app/videosthumb/<?php echo $row['video_thumb_path']; ?>" alt="Video" class="img-responsive" height="130px"/>
		 <h2 style="height:15px;"><?php echo $row['video_name']; ?></h2>
       
		<!--<div style="height:45px;!important"> <?php echo $row['short_desc']; ?></div>
            <button type="button" class="btn btn-default pull-left"> Start </button>-->
			<span class="glyphicon glyphicon-play-circle"></span>
			<!--<span class="duration">03:15</span>-->
            <div class="clearfix"></div>
		</a>
	</li>
	  <?php
  }
  
	
//print_r($video_full_data);
?>
 
	
    
   
	</ul>
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
	
	<script>

	$(document).ready( function(){
		$('.btn-click').click();
	});
	
$(document).on('click', '.btn-click', function(e){


	var $this = $(this);
    if(!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('i').removeClass('fa-chevron-circle-up').addClass('fa-chevron-circle-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('i').removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-up');
	}
})

</script>



</body>
</html>