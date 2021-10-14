<?php
if(isset($_POST['news'])){
	$email = $_POST['newsletter'];
	$sql="select * from newsletter where email = '$email'";
	$result=mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
	if($count >= 1){
		//You have already subcribed to our newsletter
	}
	else{
		$sqll="insert into newsletter(email)values('$email')";
		$resultt=$conn->query($sqll);
		if($resultt){
			//You have successfully subscribed to our news letter
		}
	}
}

?>


<!-- Start Shop Newsletter  -->
<section class="shop-newsletter section">
			<div class="container">
				<div class="inner-top">
					<div class="row">
						<div class="col-lg-8 offset-lg-2 col-12">
							<!-- Start Newsletter Inner -->
							<div class="inner">
								<h4>Newsletter</h4>
								<p> Subscribe to our newsletter to get future updates</p>
								<form action="#" method="POST" class="newsletter-inner">
									<input name="newsletter" placeholder="Your email address" required="" type="email">
									<button class="btn" name="news">Subscribe</button>
								</form>
							</div>
							<!-- End Newsletter Inner -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Shop Newsletter -->

<!-- Start Footer Area -->
<footer class="footer">
		<!-- Footer Top -->
		<div class="footer-top section">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer about">
							<div class="logo">
								<center><a href="index.html"><img src="public/images/zeb-e-khass-png1.png" alt="#"></a></center>
							</div>
							<p class="text" style="color:#C9C9C9">Zeb e Khaas's differences are what make it unique, and it matters to the brand that people can share every brilliant aspect of themselves with the world, comfortably and with confidence. Zeb e Khaas was founded on a belief that the clothes you choose should let you wear your individuality. </p>
							<p class="call" style="color:#C9C9C9">Got Question? Call us 24/7<span><a href="tel:+923017971212"> +92 301 7971212</a></span></p>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links " style="color:#C9C9C9">
							<h4>Information</h4>
							<ul style="color:#C9C9C9">
								<li><a style="color:#C9C9C9" href="aboutus.php">About Us</a></li>
								<li><a style="color:#C9C9C9" href="#">Faq</a></li>
								<li><a style="color:#C9C9C9" href="#">Terms & Conditions</a></li>
								<li><a style="color:#C9C9C9" href="contact.php">Contact Us</a></li>
								<li><a style="color:#C9C9C9" href="mailto:support@zebekhaas.com">Help</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links" style="color:#C9C9C9">
							<h4>Customer Service</h4>
							<ul style="color:#C9C9C9">
								<li><a href="#" style="color:#C9C9C9">Payment Methods</a></li>
								<li><a href="#" style="color:#C9C9C9">Money-back</a></li>
								<li><a href="#" style="color:#C9C9C9">Returns</a></li>
								<li><a href="#" style="color:#C9C9C9">Shipping</a></li>
								<li><a href="#" style="color:#C9C9C9">Privacy Policy</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer social">
							<h4>Get In Tuch</h4>
							<!-- Single Widget -->
							<div class="contact">
								<ul style="color:#C9C9C9">
									<li style="color:#C9C9C9"><a href="mailto:support@zebekhaas.com"><i class="fas fa-envelope"></i> Support@zebekhaas.com</a></li>
									<li style="color:#C9C9C9"><a href="tel:+923017971212"><i class="fas fa-phone-alt"></i> +92 301 7971212</a></li>
								</ul>
							</div>
							<!-- End Single Widget -->
							<ul>
								<li><a href="#" target="_blank"><i class="ti-facebook" style="color:#1197F5"></i></a></li>
								<li><a href="https://www.instagram.com/invites/contact/?i=177n45r3bjj1n&utm_content=htccbdm" target="_blank"><i class="ti-instagram" style="background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%,#d6249f 60%,#285AEB 90%);"></i></a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer Top -->
		<div class="copyright">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="left">
								<p style="color:#C9C9C9">Copyright © 2021 <a href="#">Zeb e Khaas</a>  -  All Rights Reserved.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /End Footer Area -->