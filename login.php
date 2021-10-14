<?php include "include/header.php";?>

<?php 
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1 ) {
    header('Location: myaccount.php');
    die();
}

if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql="select * from users where email='$email' && password='$password'";
    $result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	$status=$row['block'];
    $count = mysqli_num_rows($result);
    if($count>=1 && $status==0)
    {
        $_SESSION['puser'] = $email;
		$_SESSION['loggedin'] = 1;
		if(isset($_GET['wishlist'])){
			$sql="select user_id from users where email='$email'";
			$result=$conn->query($sql);
			$row = mysqli_fetch_assoc($result);
			$id = $row["user_id"];
    		$pid=$_GET['wishlist'];
    		$ssql="insert into wishlist(user_id,product_id)values('$id','$pid')";
    		$rresult=$conn->query($ssql);
			if($rresult){
			header("Location:wishlist.php");
			}
			else{
				$conn->error;
			}
		}
		else if(isset($_GET['direct'])){
			header("Location:wishlist.php");
		}
		else{
        header("Location:myaccount.php");
		}
        die();
    }
    else{
        $_SESSION['lerror']="Invalid Username Or Password";
		if($status==1){
			$_SESSION['lerror']="Your Account is temporarily Blocked by Admin. Please Contact Customercare for more Details.";
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
								<li class="active"><a href="#">Login</a></li>
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
							<h2>Login</h2>
							<p>Please Sign In to view your Order summary.</p>
							<!-- Form -->
							<form class="form" method="post" action="#">
								<div class="row">
								<?php if(isset($_SESSION['registered'])){?>
									<div class="col-12">
										<div class="alert alert-info" role="alert">
											<?php echo $_SESSION['registered']; ?>
										</div>
									<div>
									<?php }unset($_SESSION['registered'])?>
									<?php if(isset($_SESSION['lerror'])){?>
									<div class="col-12">
										<div class="alert alert-danger" role="alert">
											<?php echo $_SESSION['lerror']; ?>
										</div>
									<div>
									<?php }unset($_SESSION['lerror'])?>
									<div class="col-12">
										<div class="form-group">
											<label>Your Email<span>*</span></label>
											<input type="email" name="email" placeholder="john@domain.com" required="required">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Your Password<span>*</span></label>
											<input type="password" name="password" placeholder="********" required="required">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group login-btn">
											<button class="btn " type="submit" name="login" >Login</button>
											<a href="register.php" class="btn">Register</a>
										</div>
										<div class="checkbox">
                                            <a href="#" class="lost-pass">Forgot your password?</a>
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