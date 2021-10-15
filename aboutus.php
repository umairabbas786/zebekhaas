<?php include "include/header.php";?>
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
							<li class="active"><a href="aboutus.php">About Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
    <!-- About Us -->
	<section class="about-us section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="about-content">
							<h3>About <span>Us</span></h3>
							<p>Zeb e Khaas's differences are what make it unique, and it matters to the brand that people can share every brilliant aspect of themselves with the world, comfortably and with confidence. Zeb e Khaas was founded on a belief that the clothes you choose should let you wear your individuality.</p>
							<p>Born of proud tradition, Zeb e Khaas's unparalleled selection of ever-changing patterns and colours is always pushing the boundaries of Pakistan’s fashion culture. By giving every woman a greater freedom of choice in her everyday wardrobe, she can easily bring out the forever unfolding layers of her kaleidoscopic personality – in her own way and at the right moment.</p>
							<p>This meld of exquisite design and high class fabric has resulted in the breakthrough of this one of a kind retail brand. Zeb e Khaas’s commitment to quality fabric over the years has made it a household name, synonymous with excellence. We hope you enjoy wearing them as much we love making them for you!</p>
							<div class="button">
								<a href="contact.php" class="btn">Contact Us</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="about-img">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/sc-CIh6ynFQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- End About Us -->
    <!-- Start Shop Services Area -->
	<section class="shop-services section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free shiping</h4>
						<?php 
						$sql="select price from shipping_charges";
						$result=$conn->query($sql);
						$row=mysqli_fetch_assoc($result);
						$price=$row['price'];
						?>
						<p>Orders over <?php echo $price;?> PKR</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Free Return</h4>
						<p>Within 30 days returns</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Sucure Payment</h4>
						<p>100% secure payment</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Best Peice</h4>
						<p>Guaranteed price</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Services Area -->
    <?php include "include/footer.php";?>

	
    <?php include "include/scripts.php";?>
</body>
</html>