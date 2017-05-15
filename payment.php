<?php
session_start();

$User_id = $_SESSION['User_id'];
$User_type = $_SESSION['User_type'];
$email = $_SESSION['email'];
//$email = str_replace("@","-",$email);
$a = session_id();
if($User_type == 'Paid'){
?>	
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

  <?php 
	$payment_query = "select * from payments where user_id = '$User_id' and order_status = 'Success';";
	$payment_result = mysqli_query($db,$payment_query);
	$payment_row = mysqli_fetch_array($payment_result);
	
  
  ?>
  

  
   <div class="container">
   <div class="row setup-content" id="ProfileSetup-step">
        <div class="col-md-12">
		
		<div>
		<h2 class="alert alert-success">You are already subscribed to Natyarambha.</h2>
		<p>
		<br>You are subscribed to us from:&nbsp <span><strong> <?php echo date("jS F, Y", strtotime($payment_row['date_time'])); ?></strong></span>
		<br>Your Order ID is:&nbsp<span><strong><?= $payment_row['order_id']; ?></strong></span>
		<br>Your transaction ID is:&nbsp<span><strong><?= $payment_row['tracking_id']; ?></strong></span>
		<br>If you have any questions about your subscription, please feel free to <a href="http://natyarambha.com/contact.php">Contact us</a>
		<br>
		<br><strong>Bharatanatyam practice has never been so easy. So Natyarambha on and practice on!</strong>
		</p><br/>
		<a href="index.php" class="btn btn-primary btn-cons btn-md">Go to Home</a>
		</div>
	     <div class="clearfix"></div><br/><br/>
		   
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



<?php }
else{

if(!$_SESSION['checker']){
		$_SESSION['last_page'] = 'payment.php';
	echo "<script>window.location = 'login.php';</script>";
}

include 'db1.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'head.php' ?>
<title>Natyarambha- Contact Us</title>
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
        <div class="col-xs-12">
            <div class="col-md-12">
                 <br/>
				 
				<form class="form-horizontal" id="ccPayment" name="ccPayment" method="post" action="ccavRequestHandler.php"> 
				<fieldset>
				<legend>Payment Info</legend><br/>
					<input type="text" name="tid" id="tid" value="" hidden>
						<input type="text" name="merchant_id" value="97675" hidden>
						<input  type="text" id="oid" name="order_id" placeholder="Project Code" value="123456" hidden>
						<input  type="text" name="amount" placeholder="Amount" value="5" hidden>
						<input type="text" name="currency" value="INR" hidden>
						<input type="text" name="redirect_url" value="http://www.natyarambha.com/ccavResponseHandler.php" hidden>
						<input type="text" name="cancel_url" value="http://www.natyarambha.com/ccavResponseHandler.php" hidden>
						<input type="text" name="language" value="EN" hidden>
						<input type="text" name="billing_email" value="<?= $email ?>" hidden>
						<input type="text" name="merchant_param2" value="<?= $a ?>" hidden>
						<input type="text" name="merchant_param3" value="<?= $email ?>" hidden>

                    <div class="form-horizontal">
					  <div class="form-group">
						<label class="col-md-4 control-label">Amount</label>
						<div class="col-md-4">
						  <p class="form-control-static">2500 INR</p>
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-md-4 control-label">Order ID</label>
						<div class="col-md-4">
						  <p class="form-control-static">233312218</p>
						</div>
					  </div>
					   <div class="checkbox">
					   <label class="col-md-4 control-label"></label>
						  <label>
							<input type="checkbox"> Agree to our terms and conditions
						  </label>
						</div>
					</div>
                <hr/>
				<div class="clearfix"></div>
				<div class="col-md-4">	</div>	
<div class="col-md-8">			
                <button class="btn btn-primary nextBtn btn-lg pull-left" type="submit">Pay</button></div>					
						
						
						
				
				</fieldset>
				</form>
				
				
				<!--<form>
				  <fieldset disabled>
					<div class="form-group">
					  <label for="disabledTextInput">Disabled input</label>
					  <input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input">
					</div>
					<div class="form-group">
					  <label for="disabledSelect">Disabled select menu</label>
					  <select id="disabledSelect" class="form-control">
						<option>Disabled select</option>
					  </select>
					</div>
					<div class="checkbox">
					  <label>
						<input type="checkbox"> Can't check this
					  </label>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				  </fieldset>
				</form>-->
				
				
				
            </div>
        </div>
    </div>
  </div>
  <!-- /container --> 
  
  <!-- Footer --> 
  <br>
  <br>
  <br>
  <br>
  <br>
  <footer>

 <?php include 'footer.php' ?>
 </footer>
</div>
<script>

	$(document).ready(function(){
		var d = new Date().getTime();
		var m = new Date().getMonth() +1;
		var y = new Date().getDate();
		var str = "" + <?= $User_id; ?>;
		var pad = "0000";
		var pad_1 = "00";
		var _id = pad.substring(0, pad.length - str.length) + str;
		var _m = pad.substring(0, pad_1.length - m.length) + m;
		var _y = pad.substring(0, pad_1.length - y.length) + y;
	
		var oder_id = _y+_m+_id;
		console.log(oder_id);
		
		$('#tid').val(d);
		$('#oid').val(oder_id);
	});
</script>

</script>
   <?php include 'scripts.php'; ?>
<?php } ?>	
</body>
</html>
