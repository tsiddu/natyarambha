<?php
session_start();

include 'db1.php';
$User_type = $_SESSION['User_type'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'head.php'; ?>
	<title>Natyarambha - All Lessons</title>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<div class="jumbotron jumbotron-sm" style="margin-top:50px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h2>
                    Lessons </h2>
            </div>
        </div>
    </div>
</div> 

<div class="canvas" > 
   <!-- Navigation -->
  <?php include 'nav.php'; ?>
  <!-- /lessons --> 

  <div class="container lessons">
    <ul class="list-unstyled video-list-thumbs row">
	<?php
	if($User_type == 'Paid'){
		$quert_list_lessons = "SELECT * FROM `lesson` order by `order`";
	}
	else{
		$quert_list_lessons = "SELECT * FROM `lesson` order by `order`";
	//$quert_list_lessons = "SELECT * FROM `lesson` where lesson_level='0' order by `order`";	
	}
		$results = mysqli_query($db , $quert_list_lessons);	
		$i=0;
		$les = [];
		while($row = mysqli_fetch_array($results))
		{
				
	?>
	
	<li class="col-lg-3 col-sm-4 col-xs-6 <?php if($row['lesson_level']== 1 && $User_type == 'Trail'){ echo 'liOpacity'; }?>" >
		<a href="lesson.php?lessons_id=<?php echo $row['lessons_id'] ;?>" title="<?php echo $row['lessons_name']; ?>">
			<img src="app/lessonsthumb/<?php echo $row['vesson_tumb'] ;?>" alt="Barca" class="img-responsive" height="130px"/>
			
			
            <div class="VidDis"> 
			<h2 ><?php echo $row['lessons_name']; ?></h2>
			<div class="clearfix"></div>
			<p><?php echo $row['lesson_description']; ?></p>
			
			</div>
			
			 <div class="clearfix"></div>
           
			<span class="glyphicon glyphicon-play-circle"></span>
			<!--<span class="duration">03:15</span>-->
            <div class="clearfix"></div>
		</a>
	</li>
	
		<?php } ?>
	
    
   
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
  <footer>	<?php include 'footer.php'; ?>

  </footer>
</div>
	<?php include 'scripts.php'; ?>
    
    
    
    
   <script type="text/javascript">
   
   if ($(this).parent(".lessons>ul>li").length) {
    // parent is li
	
	
	$(this).css({"display": "block", "foverflow": "hidden", "overflow-x": "scroll" });
}
else {
    // wrap
}
   
	</script>

</body>
</html>