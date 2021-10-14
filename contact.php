<?php include "include/header.php";?>
<?php
if(isset($_POST['contact_email'])){
$to = "support@zebekhaas.com";
$name = $_POST['name'];
$subject = $_POST['subject'];
$phone = $_POST['phone'];
$from = $_POST['email'];
$txt = $_POST['message'];
$msg = "Name = $name\r\n" . "Sender = $from\r\n" . "Sender Phone Number= $phone\r\n" . "Message = $txt\r\n";
$headers = "From: support@zebekhaas.com";

if(mail($to,$subject,$msg,$headers)){
    $_SESSION['mail_success']="Messege has been sent successfully";
    header("location:contact.php");
    die();
}
else{
    $_SESSION['mail_error']="Some Technical Issue!";
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
							<li class="active"><a href="#">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
  
	<!-- Start Contact -->
	<section id="contact-us" class="contact-us section">
		<div class="container">
				<div class="contact-head">
					<div class="row">
						<div class="col-lg-8 col-12">
							<div class="form-main">
								<div class="title">
									<h4>Get in touch</h4>
									<h3>Write us a message</h3>
								</div>
								<?php if(isset($_SESSION['mail_success'])){?>
			<div class="alert alert-success" role="alert">
			<?php echo $_SESSION['mail_success'];?>
			</div>
		<?php }unset($_SESSION['mail_success']);?>
		<?php if(isset($_SESSION['mail_error'])){?>
			<div class="alert alert-danger" role="alert">
			<?php echo $_SESSION['mail_error'];?>
			</div>
		<?php }unset($_SESSION['mail_error']);?>
								<form class="form" method="post" action="#">
									<div class="row">
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Your Full Name<span>*</span></label>
												<input name="name" type="text" placeholder="Enter Full Name.." required>
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Your Subjects<span>*</span></label>
												<input name="subject" type="text" placeholder="Enter Subject.." required>
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Your Email<span>*</span></label>
												<input name="email" type="email" placeholder="Enter Your Email.." required>
											</div>	
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Your Phone<span>*</span></label>
												<input name="phone" type="text" placeholder="Enter Your Phone Number.. " required>
											</div>	
										</div>
										<div class="col-12">
											<div class="form-group message">
												<label>your message<span>*</span></label>
												<textarea name="message" placeholder="Type Your Message.." required></textarea>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group button">
												<button type="submit" class="btn" name="contact_email">Send Message</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="col-lg-4 col-12">
							<div class="single-head">
								<div class="single-info">
									<i class="fa fa-phone"></i>
									<h4 class="title">Call us Now:</h4>
									<ul>
										<li><a href="tel:+923017971212">+92 301 7971212</a></li>
									</ul>
								</div>
								<div class="single-info">
									<i class="fa fa-envelope-open"></i>
									<h4 class="title">Email:</h4>
									<ul>
										<li><a href="mailto:support@zebekhaas.com">support@zebekhaas.com</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
	<!--/ End Contact -->
	
	<!-- Map Section -->
	<!-- <div class="map-section">
		<div id="myMap"></div>
	</div> -->
	<!--/ End Map Section -->
	
	
	<?php include "include/footer.php";?>

<?php include "include/scripts.php";?>
<script>
		$(".alert").delay(5000).slideUp(200, function() {
    		$(this).alert('close');
		});
	</script>
</body>
</html>