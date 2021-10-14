<?php include "include/header.php";?>

<?php 
if ($_SESSION['loggedin'] == 0 ) {
    header('Location: index.php');
    die();
}
?>

<?php
	if(isset($_POST['addadd'])){
		$ifname=$_POST['fname'];
		$ilname=$_POST['lname'];
		$iemail=$_POST['email'];
		$icompany="None";
		if(isset($_POST['company'])){
			$icompany=$_POST['company'];
		}
		$iaddress=$_POST['address'];
		$icity=$_POST['city'];
		$icountry=$_POST['country'];
		$ipostal=$_POST['postalcode'];
		$iphone=$_POST['phone'];
		$status=1;
		
		$email=$_SESSION['puser'];
		$sql="select user_id from users where email='$email'";
		$result=$conn->query($sql);
		$row = mysqli_fetch_assoc($result);
		$id = $row["user_id"];

		$sqll="insert into shippingaddress (user_id,first_name,last_name,email,company,address,city,country,zipcode,phone_number,status)values('$id','$ifname','$ilname','$iemail','$icompany','$iaddress','$icity','$icountry','$ipostal','$iphone','$status')";	
		$resultt=$conn->query($sqll);
		if($resultt){
			$_SESSION['addsuccess']="Address has been saved successfully.";
		}
		else{
			$conn->error;
		}

	}
?>

<body class="js">
	<?php include "include/navbar.php";?>
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="index.php">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="#">My Account</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
	<?php 
		$uemail=$_SESSION['puser'];
		$sql="select name from users where email='$uemail'";
		$result=$conn->query($sql);
		$row=mysqli_fetch_assoc($result);
		$name=$row['name'];
		?>
	<br><br>
	<div class="container">
		<?php if(isset($_SESSION['addsuccess'])){?>
		<div class="col-12">
			<div class="alert alert-success" role="alert">
				<?php echo $_SESSION['addsuccess']; ?>
			</div>
			<div>
				<?php }unset($_SESSION['addsuccess'])?>
				<?php if(isset($_SESSION['order_success'])){?>
		<div class="col-12">
			<div class="alert alert-success" role="alert">
				<?php echo $_SESSION['order_success']; ?>
			</div>
			<div>
				<?php }unset($_SESSION['order_success'])?>
				<div class="row">
					<div class="col-md-4 col-12">
						<div class="text-center mb-3">
							<div class="card text-white" style="background-color:#333333">
								<div class="card-body">
									<h5><i class="fas fa-signature" style="color:#F7941D;"></i>
										<?php echo strtoupper($name);?></h5>
								</div>
							</div>
						</div>
						<div class="text-center mb-3">
							<div class="card text-white" style="background-color:#333333">
								<div class="card-body">
									<h5><i class="fas fa-envelope" style="color:#F7941D;"></i>
										<?php echo $_SESSION['puser'];?></h5>
								</div>
							</div>
						</div>
						<div class="list-group mb-3" id="list-tab" role="tablist">
							<a class="list-group-item list-group-item-action btn text-white active" id="list-home-list"
								data-toggle="list" href="#list-home" role="tab" aria-controls="home">Orders</a>
							<a class="list-group-item list-group-item-action btn text-white" id="list-messages-list"
								data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Address</a>
							<a class="list-group-item list-group-item-action btn text-white"
								href="logout.php">Logout</a>
						</div>
					</div>
					<div class="col-md-8 col-12">
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="list-home" role="tabpanel"
								aria-labelledby="list-home-list">
								<div class="btn btn-block mb-2" style="pointer-events:none">
									<h3 class="lead text-center">Order Summary</h3>
								</div>
								<table class="table table-bordered table-hover mt-4" style="font-size:16px;">
									<thead style="background-color:#333333" class="text-white">
										<tr>
											<th>Order Number</th>
											<th>Date</th>
											<th>Total</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$email=$_SESSION['puser'];
									$sqll="select * from orders where email = '$email' order by date desc";
									$resultt=$conn->query($sqll);
									if ($resultt->num_rows > 0) {
										while($roww=mysqli_fetch_assoc($resultt)){
											$order_id = $roww['id'];
											$date = $roww['date'];
											$bill = $roww['total_bill'];
											$status = $roww['status'];
								?>
										<tr>
											<th># <?php echo $order_id;?></th>
											<td><?php echo $date;?></td>
											<td><?php echo $bill;?> PKR</td>
											<?php if($status == 0){?>
											<td><span class="badge badge-warning">Pending</span></td>
											<?php }else if($status == 1){?>
												<td><span class="badge badge-success">Completed</span></td>
											<?php }else if($status == 2){?>
												<td><span class="badge badge-danger">Cancelled</span></td>
											<?php }?>
										</tr>
										<?php }}else{?>
											<tr><td class="text-center" colspan="4">No Data Found.</td></tr>
										<?php }?>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="list-messages" role="tabpanel"
								aria-labelledby="list-messages-list">
								<?php 
									$email=$_SESSION['puser'];
									$sql="select user_id from users where email='$email'";
									$result=$conn->query($sql);
									$row = mysqli_fetch_assoc($result);
									$id = $row["user_id"];

									$sqll="select * from shippingaddress where user_id=$id";
									$resultt=$conn->query($sqll);
									if ($resultt->num_rows > 0) {
										while($roww=mysqli_fetch_assoc($resultt)){
											$fname=$roww['first_name'];
											$lname=$roww['last_name'];
											$company=$roww['company'];
											$address=$roww['address'];
											$city=$roww['city'];
											$country=$roww['country'];
											$zipcode=$roww['zipcode'];
											$phone=$roww['phone_number'];
										}
								?>
								<div class="btn btn-block mb-5" style="pointer-events:none">
									<h3 class="lead text-center">Address</h3>
								</div>
								<div class="container">
									<div class="row">
										<div class="col-md-6 offset-md-3 col-12 text-center">
								<address style="font-size:18px;display:block;font-family:italic;">
								<span style="font-size:24px;"><?php echo strtoupper($fname);?>&nbsp;<?php echo strtoupper($lname);?></span><br> 
								<?php echo $company;?><br>
								<?php echo $address;?><br>
								<?php echo $city;?>&nbsp;<?php echo $zipcode;?><br>
								<?php echo $country;?><br>
								<?php echo $phone;?>
								</address>
								<button class="btn btn-block "><a href="deleteaddress.php?id=<?php echo $id;?>">Delete</a></button>
								</div>
								</div>
								</div>
								<?php }else{?>
								<div class="btn btn-block mb-2" style="pointer-events:none">
									<h3 class="lead text-center">Invoice/Shipping Address</h3>
								</div>
								<!-- Address Start -->
								<div class="container">
									<form class="form" method="POST" action="#">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label style="font-size:16px;">First
														Name<span>*</span></label>
													<input type="text" name="fname" class="form-control form-control-lg"
														required="required">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label style="font-size:16px;">Last
														Name<span>*</span></label>
													<input type="text" class="form-control form-control-lg" name="lname"
														required="required">
												</div>
											</div>
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label style="font-size:16px;">Email<span>*</span></label>
													<input type="email" class="form-control form-control-lg"
														name="email" value="<?php echo $_SESSION['puser'];?>"
														required="required">
												</div>
											</div>
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label style="font-size:16px;">Company</label>
													<input type="text" class="form-control form-control-lg"
														name="company">
												</div>
											</div>
											<div class="col-12">
												<div class="form-group">
													<label style="font-size:16px;">Address<span>*</span></label>
													<input type="text" class="form-control form-control-lg"
														name="address" required="required">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label style="font-size:16px;">City<span>*</span></label>
													<input type="text" class="form-control form-control-lg" name="city"
														required="required">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label style="font-size:16px;">Country<span>*</span></label>
													<input type="text" class="form-control form-control-lg"
														name="country" required="required">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label style="font-size:16px;">Postal/Zip
														Code<span>*</span></label>
													<input type="text" class="form-control form-control-lg"
														name="postalcode" required="required">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label style="font-size:16px;">Phone
														Number<span>*</span></label>
													<input type="number" class="form-control form-control-lg"
														name="phone" placeholder="555-555-1234" min="10" required="required">
												</div>
											</div>
											<div class="col-md-6 offset-md-3">
											<div class="form-group login-btn">
												<button class="btn btn-block btn-lg" type="submit" name="addadd">Add
													Address</button>
											</div>
										</div>
										</div>
									</form>
								</div>
								<?php }?>
								<!-- Adress End -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br><br>


	<?php include "include/footer.php";?>

	<?php include "include/scripts.php";?>

	<script>
		$(".alert").delay(5000).slideUp(200, function () {
			$(this).alert('close');
		});
	</script>

</body>

</html>