<?php


function invoices_view()
{
	$db = getdb();
	$query = "SELECT * FROM `payments` left join `users` ON payments.user_id = users.User_id";
	$result = mysqli_query($db,$query);
	?>
	<div class="span9">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="?module=invoices&task=view">All Payments</a>
			
			</li>
			<li>
				<a href="?module=invoices&task=paid">Success Payments</a>
			</li>
		</ul>
		<div>
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>
							User Id
						</th>
						<th>
							UserName
						</th>
						<th>
							User Email 
						</th>
						<th>
							Order Id
						</th>
						<th>
							Order Status
						</th>
						<th>
							Tracking Id
						</th>
						<th>
							Amount
						</th>
						<th>
							Country
						</th>
						<th>
							City
						</th>
						<th>
							Country
						</th>
					</tr>
				</thead>
				<tbody>
			<?php
			$i = 1;
			while($row = mysqli_fetch_array($result))
			{
				?>
				<tr>
					<td>
					<?= $row['user_id']?>
					</td>
					<td>
					<?php echo $row['Username'];?>
					</td>
					<td>
					<?= $row['email'];  ?>
					</td>
					<td>
					<?= $row['order_id'];  ?>
					</td>
					<td>
					<?= $row['order_status'];  ?>
					</td>
					<td>
					<?= $row['tracking_id'];  ?>
					</td>
					<td>
					<?= $row['amount'];  ?>
					</td>
					<td>
					<?= $row['currency'];  ?>
					</td>
					<td>
					<?= $row['city'];  ?>
					</td>
					<td>
					<?= $row['country'];  ?>
					</td>
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

function invoices_paid()
{
	$db = getdb();
	$query = "SELECT * FROM `payments` left join `users` ON payments.user_id = users.User_id where payments.order_status = 'Success'";
	$result = mysqli_query($db,$query);
	?>
	<div class="span9">
		<ul class="nav nav-tabs">
			<li >
			<a href="?module=invoices&task=view">All Invoices</a>
			
			</li>
			<li class="active">
				<a href="?module=invoices&task=paid">Paid Invoices</a>
			</li>
		</ul>
		<div>
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>
							User Id
						</th>
						<th>
							UserName
						</th>
						<th>
							User Email 
						</th>
						<th>
							Order Id
						</th>
						<th>
							Order Status
						</th>
						<th>
							Tracking Id
						</th>
						<th>
							Amount
						</th>
						<th>
							Country
						</th>
						<th>
							City
						</th>
						<th>
							Country
						</th>
					</tr>
				</thead>
				<tbody>
			<?php
			$i = 1;
			while($row = mysqli_fetch_array($result))
			{
				?>
				<tr>
					<td>
					<?= $row['user_id']?>
					</td>
					<td>
					<?php echo $row['Username'];?>
					</td>
					<td>
					<?= $row['email'];  ?>
					</td>
					<td>
					<?= $row['order_id'];  ?>
					</td>
					<td>
					<?= $row['order_status'];  ?>
					</td>
					<td>
					<?= $row['tracking_id'];  ?>
					</td>
					<td>
					<?= $row['amount'];  ?>
					</td>
					<td>
					<?= $row['currency'];  ?>
					</td>
					<td>
					<?= $row['city'];  ?>
					</td>
					<td>
					<?= $row['country'];  ?>
					</td>
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


function invoices_Completed_invoice()
{
	$db = getdb();
	$query = "SELECT a.user_id, a.invoice_number, a.payed_date, a.payed_amount, c.Username, c.email  FROM user_invoices as a, users as c where a.user_id = c.User_id";
	$result = mysqli_query($db,$query);
	?>
	<div class="span9">
		<ul class="nav nav-tabs">
			<li>
				<a href="?module=invoices&task=view">Pending Invoice</a>
			</li>
			<li class="active">
				<a href="?module=invoices&task=Completed_invoice">Paid Invoices</a>
			</li>
		</ul>
		<div>
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>
							Sr .No
						</th>
						<th>
							User Name
						</th>
						<th>
							Paid date 
						</th>
						<th>
							Amount
						</th>
						<th>
							Email
						</th>
					</tr>
				</thead>
				<tbody>
			<?php
			$i = 1;
			while($row = mysqli_fetch_array($result))
			{
				?>
				<tr>
					<td>
					<?php echo $i; $i= $i+1;?>
					</td>
					<td>
					<?php echo $row['Username'];?>
					</td>
					<td>
					<?php echo date('d-m-Y',strtotime($row['payed_date']));?>
					</td>
					<td>
					<?php echo $row['payed_amount'];?>
					</td>
					<td>
					<?php echo $row['email'];?>
					</td>
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


function invoices_send_invoices() {
	if(isset($_GET['user_id']))
	{
		$id_val = $_GET['user_id'];
		echo "this is send incvoice function";
		$db = getdb();
		$query = "SELECT `User_id`, `Username`, `email`, `first_name`, `Last_name`, `User_Phone`, `User_type`, `gender`, `user_access`, `Date_subscription`, `date_sub_exp`, `country`, `state`, `address` FROM `users` WHERE `User_id`='$id_val'";
		$result = mysqli_query($db,$query);			
		$row = mysqli_fetch_array($result);
		$to = $row['email'];
		$subject = "Natyam invoice";
		$message = "Dear ".$row['first_name']." ".$row['Last_name'].", 
		please login and pay your bill";
		$re = mail($to, $subject, $message, $additional_headers = null, $additional_parameters = null);
		if($re == true)
		{
			echo "ok";
		}
		else {
			echo "not sent";
		}
		
		echo "<a href='?module=invoices&task=view'>go to back</a>";
	}
	else {
		echo "sorry no user selected";
	}
}

function invoices_view_user_invoices() {
	$user_id = $_SESSION['User_id'];
	$db = getdb();
	$query = "SELECT `invoice_id`, `user_id`, `invoice_number`, `payed_date`, `payed_amount` FROM `user_invoices` WHERE `user_id`='$user_id'";
	$result = mysqli_query($db,$query);
	$cout_val = mysqli_num_rows($result);
	if($cout_val != 0)
	{
	?>
	<div class="span9" style="min-height:50px;border:1px solid silver;">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>
					#
					</th>
					<th>
						Invoice Number
					</th>
					<th>
						Paid Date
					</th>
					<th>
	 					Paid Amount
					</th>
					<th>
					</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$i = 1;
				while($row = mysqli_fetch_array($result)) {
					
					echo "<tr>";
					echo "<td>";
					echo $i;
					$i = $i + 1;
					echo "</td>";
					echo "<td>";
					echo $row['invoice_number'];
					echo "</td>";
					echo "<td>";
					$inv_date = $row['payed_date'];
					echo date('d-M-Y', strtotime($inv_date));
					echo "</td>";
					echo "<td>";
					echo $row['payed_amount'];
					echo "</td>";
					echo "<td>";
					echo "<a href='?module=invoices&task=view_Invoice_single&invnum=".$row['invoice_id']."' class='btn'>view</a>";
					echo "</td>";
					echo "</tr>";
				}
			?>
			</tbody>
			</table>
	</div>
	<?php
	}
	else {
	?>
	<div class="span9" style="min-height:50px;border:1px solid silver;">
	no invoice found
	</div>
	<?php
	}
}

function invoices_Pay_bill() {
	echo "pay bill function";
}


function invoices_view_Invoice_single()
{
	if(isset($_GET['invnum']))
	{
		$invNum = $_GET['invnum'];
		$db = getdb();
		$get_invoice_data = "SELECT user_id, invoice_number, payed_date, payed_amount FROM user_invoices WHERE invoice_id='$invNum'";
		$result = mysqli_query($db,$get_invoice_data);
		$row = mysqli_fetch_array($result);
		
		$user_id = $row['user_id'];
		$invoice_number = $row['invoice_number'];
		$payed_date = $row['payed_date'];
		$payed_amount = $row['payed_amount'];
		
		$get_user_data = 	"SELECT User_id, Username, password, email, first_name, Last_name, User_Phone, User_type, gender, user_access, 
							Date_subscription, date_sub_exp, country, state, address FROM users WHERE User_id='$user_id'";
		$result1 = 	mysqli_query($db,$get_user_data);
		$row1 = 	mysqli_fetch_array($result1);
		$first_name = $row1['first_name'];
		$Last_name = $row1['Last_name'];
		$User_Phone = $row1['User_Phone'];
		$address = $row1['address'];
		$email = $row1['email'];
		
		?>
		<h3 style='text-align: center;'>Invoice</h3>
		<div class='span10'>
			<div style='float:left'>
				<table class='span3' style='text-align: left;'>
					<tr>
						<td>To</td>
					</tr>
					<tr>
						<td>Name</td>
						<td><?php echo $first_name." ".$Last_name;?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $email; ?></td>
					</tr>
					<tr>
						<td>Phone:</td>
						<td><?php echo $User_Phone; ?></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><?php echo $address; ?></td>
					</tr>
				</table>
			</div>
			<div style='float:right'>
				<table class='span3' >
					<tr>
						<td>From</td>
					</tr>
					<tr>
						<td>Name</td>
						<td>Natyam</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>Natyam@gmail.com</td>
					</tr>
					<tr>
						<td>Phone:</td>
						<td>+919966554412</td>
					</tr>
					<tr>
						<td>Address</td>
						<td>kshdkjhs lshlhdls lsajdlkjds lkjsdlkjsd lkjsd lksajd</td>
					</tr>
				</table>
			</div>
			<div class='span12'>
				<hr/>
			</div>
			<div class='span5'>
				<table>
					<tr>
						<td>
							Invoice Numbre:
						</td>
						<td>
							<?php echo $invoice_number;?>
						</td>
					</tr>
					<tr>
						<td>
							Invoice Date:
						</td>
						<td>
							<?php echo $payed_date;?>
						</td>
					</tr>
					<tr>
						<td>
							Invoice Amount:
						</td>
						<td>
							<?php echo $payed_amount;?> &#10004;
						</td>
					</tr>
					<tr>
						<td colspan="2">
							Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla
						</td>
					</tr>
				</table>
			</div>
		</div>
		
		<?php
	}
	else
	{
		echo "no invoice selected";
	}
}
?>	
