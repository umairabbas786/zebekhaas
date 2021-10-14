<?php include "include/header.php";?>

<?php
	if(isset($_POST['register'])){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$pass=$_POST['password'];
		$cpass=$_POST['confirmpassword'];

		$sql="select * from users where email='$email'";
		$result=$conn->query($sql);
		if($result->num_rows > 0){
			$_SESSION['error']="Email Already Registered.";
			//die();
		}
		else
		{
			$ssql="insert into users(name,email,password)values('$name','$email','$pass');";
			$insert=$conn->query($ssql);
			if($insert and $pass == $cpass){
				$_SESSION['registered']="Email: $email Registered Successfully.";
				header("location: login.php");
				die();
			}
			else{
				$_SESSION['error']="Passwords must be same.";
				//die();
			}
			if(!$insert){
				echo $conn->error;
			}
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
								<li class="active"><a href="#">Register</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
				
		<!-- Shop Login -->
		<section class="shop login section">
			<div class="container">
				<div class="row"> 
					<div class="col-lg-6 offset-lg-3 col-12">
						<div class="login-form">
							<h2>Register</h2>
							<p>Please register in order to checkout more quickly.</p>
							<!-- Form -->
							<form class="form" method="POST" action="#">
								<div class="row">
									<?php if(isset($_SESSION['error'])){?>
									<div class="col-12">
										<div class="alert alert-danger" role="alert">
											<?php echo $_SESSION['error']; ?>
										</div>
									<div>
									<?php }unset($_SESSION['error'])?>
									<div class="col-12">
										<div class="form-group">
											<label>Your Name<span>*</span></label>
											<input type="text" name="name" placeholder="john Wick" required="required">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Your Email<span>*</span></label>
											<input type="text" name="email" placeholder="John@domain.com" required="required">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Your Password<span>*</span></label>
											<input type="password" name="password" placeholder="********" required="required">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Confirm Password<span>*</span></label>
											<input type="password" name="confirmpassword" placeholder="********" required="required">
										</div>
									</div>
                                    <div class="col-12 checkbox">
                                        <div class="form-group">
											<label for="news"><input class="form-check-input" name="news" id="news" type="checkbox">Subscribe to our Newsletter?</label>
                                        </div>
										</div>
									<div class="col-12">
										<div class="form-group login-btn">
											<button class="btn" type="submit" name="register">Register</button>
											<a href="login.php" class="btn">Login</a>
										</div>
									</div>
								</div>
							</form>
							<!--/ End Form -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Login -->

        <?php include "include/footer.php";?>

<?php include "include/scripts.php";?>
</body>
</html>