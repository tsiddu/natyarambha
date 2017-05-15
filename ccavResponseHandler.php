
<?php include('Crypto.php');?>
<?php include 'db1.php';?>
<html lang="en">
<head>
<?php include 'head.php'; ?>
<title>Natyarambha Payment Response</title>
<style>
.jumbotron {
	background:#e31b3f;
	color: #FFF;
	border-radius: 0px;
}
.jumbotron-sm {
	padding-top: 24px;
	padding-bottom: 24px;
}
.jumbotron small {
	color: #FFF;
}
.h1 small {
	font-size: 24px;
}
.checkbox label input[type="checkbox"], .radio label input[type="radio"]{ display: block; }
</style>
</head>

<?php

	
	error_reporting(0);
	
	<?php include "env.php"; ?>
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	//echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==0){ $order_id = $information[1];}
		if($i==1){ $tracking_id = $information[1];}
		if($i==9){ $currency = $information[1];}
		if($i==10){ $amount = $information[1];}
		if($i==13){ $city = $information[1];}
		if($i==16){ $country = $information[1];}
		if($i==3){	$order_status=$information[1]; }
		if($i==27){ $a = $information[1]; }
		if($i==28){ $em = $information[1]; }
	}
	//echo $a;
	session_id($a);
	session_start();
	
	$payment_query = "INSERT INTO `payments` (`id`, `user_id`, `email`, `order_id`, `tracking_id`, `order_status`, `amount`, `currency`, `city`, `country`, `date_time`) VALUES (NULL, '".$_SESSION['User_id']."', '".$_SESSION['email']."', '$order_id', '$tracking_id', '$order_status', '$amount', '$currency', '$city', '$country', CURRENT_TIMESTAMP);"; 
			
	$result = mysqli_query($db,$payment_query);
	
	paid_query = "UPDATE `natyam`.`users` SET `User_type` = 'Paid' WHERE `users`.`User_id` = '".$_SESSION['User_id']."';"
	$result = mysqli_query($db,$paid_query);
?>
<body>
<div class="canvas" >
    <!-- Navigation -->
  <nav class="navbar nav-inner-cus navbar-fixed-top" role="navigation">
   <?php include 'nav.php'; ?>
  </nav>

  <div class="clearfix"></div>


  
  

<div class="jumbotron jumbotron-sm" style="margin-top:50px;">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <h2> Pay</h2>
      </div>
    </div>
  </div>
</div>

  
  

  
   <div class="container">
   <div class="row setup-content" id="ProfileSetup-step">
        <div class="col-md-12">
		<?php if($order_status==="Success") { ?>
		<div>
		<h2 class="alert alert-success">You have successfully subscribed to Natyarambha.</h2>
		<p>
		<br>Your invoice has been emailed to:&nbsp <span><strong> <?= $email ?></strong></span>
		<br>Your Order ID is:&nbsp<span><strong><?= $order_id ?></strong></span>
		<br>Your transaction ID is:&nbsp<span><strong><?= $tracking_id ?></strong></span>
		<br>If you have any questions about your subscription, please feel free to <a href="http://natyarambha.com/contact.php">Contact us</a>
		<br>
		<br><strong>Bharatanatyam practice has never been so easy. So Natyarambha on and practice on!</strong>
		</p><br/>
		<a href="index.php" class="btn btn-primary btn-cons btn-md">Get started</a>
		</div>
	     <div class="clearfix"></div><br/><br/>
		<?php }
		else if($order_status==="Aborted") { ?>
		
		<div><h2 class="alert alert-warning">Your transaction was aborted.</h2>
		<br>Your Order ID is:&nbsp<span><strong><?= $order_id ?></strong></span>
		<br>Your transaction ID is:&nbsp<span><strong><?= $tracking_id ?></strong></span>
		<br>If you have any concerns about the transaction, please feel free to <a href="http://natyarambha.com/contact.php">Contact us</a>
		<div class="clearfix"></div><br/><br/>
		<a href="payment.php" class="btn btn-primary btn-cons btn-md">Retry payment</a>
		</div>
		<div class="clearfix"></div><br/><br/>
		<?php }
		else if($order_status==="Failure"){ ?>
		
		<div><h2 class="alert alert-danger">Your transaction was declined.</h2>
		<br>Your Order ID is:&nbsp<span><strong><?= $order_id ?></strong></span>
		<br>Your transaction ID is:&nbsp<span><strong><?= $tracking_id ?></strong></span>
		<br>If you have any concerns about the transaction, please feel free to <a href="http://natyarambha.com/contact.php">Contact us</a>
		<div class="clearfix"></div><br/><br/>
		<a href="payment.php" class="btn btn-primary btn-cons btn-md">Retry payment</a>
		</div>
		<div class="clearfix"></div><br/><br/>
		<?php }
		else{
		
		?>
		<div><h2 class="alert alert-info">Your transaction failed due to a security error.</h2>
		<br>Your Order ID is:&nbsp<span><strong><?= $order_id ?></strong></span>
		<br>Your transaction ID is:&nbsp<span><strong>353535</strong></span> 
		<br>If you have any concerns about the transaction, please feel free to <a href="http://natyarambha.com/contact.php">Contact us</a>
		<div class="clearfix"></div><br/><br/>
		<a href="payment.php" class="btn btn-primary btn-cons btn-md">Retry payment</a>
		</div>
	    <?php } ?>    
     </div>
  </div>
  <!-- /container --> 
  
  <!-- Footer --> 
  <br>
  <br>
  <br>
  <br>
  <br>
  
  
 
</div> <footer>

 <?php include 'footer.php' ?>
 </footer>
   <?php include 'scripts.php' ?>
		
</body>
</html>

