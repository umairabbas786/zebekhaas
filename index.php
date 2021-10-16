<?php include "include/header.php";?>
<body class="js">
    <?php include "include/navbar.php";?>
	<!-- Start Area 2 -->
	<section class="hero-area4">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="home-slider-4">
						<div class="big-content" style="background-image: url('public/images/home/img8.jpeg');">
							<div class="inner">
								<h3 class="title"><span style="color:#333333">Always dress <br> like it's <br> the Best day <br> of your life.</span></h3>
								<br><br>
								<div class="button">
									<a href="product.php" class="btn">Shop Now</a>
								</div>
							</div>
						</div>
						<div class="big-content" style="background-image: url('public/images/home/img9.jpeg');">
							<div class="inner">
								<h3 class="title"><span style="color:#333333">Life is <br> too short <br> to wear <br> boring Dresses.</span></h3>
								<br><br>
								<div class="button">
									<a href="product.php" class="btn">Shop Now</a>
								</div>
							</div>
						</div>
						<div class="big-content" style="background-image: url('public/images/home/img3.jpeg');">
							<div class="inner">
								<h3 class="title"><span style="color:#333333">You can gain <br> anything you want in <br> life, if you <br> dress for it.</span></h3>
								<br><br>
								<div class="button">
									<a href="product.php" class="btn">Shop Now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/ End Hero Area 2 -->
	<br><br>
	<!-- Start Midium Banner  -->
	<section class="midium-banner">
		<div class="container">
			<div class="row">
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-banner main-img">
						<img src="public/images/home/img1.jpeg" alt="#">
						<div class="content">
						<h4 style="color:#F6931D">New Arrivals</h4>
							<a href="product.php">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-banner main-img">
						<img src="public/images/home/img7.jpeg" alt="#">
						<div class="content">
							<h4 style="color:#F6931D">Winters Collection</h4>
							<a href="product.php" class="btn">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
			</div>
		</div>
	</section>
	<!-- End Midium Banner -->

	<br><br><br>
	<!-- Start Product Area -->
    <div class="product-area most-popular related-product section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Trending Items</h2>
					</div>
				</div>
            </div>
				<div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
					<?php 
$sql="select * from product order by product_id desc limit 6";
$show=$conn->query($sql);
while ($row = mysqli_fetch_assoc($show)) {
	$pid=$row['product_id'];
    $name=$row['name'];
    $desc=$row['description'];
    $price=$row['price'];
	$pdiscount=$row['discount'];
	$discount=$row['discount'];
	$discount=($discount*$price)/100;
	$quan=$row['quantity'];
	$discount=$price-$discount;
    $mainimg=$row['mainphoto'];
	$date=$row['upload_date'];
	$timestamp = strtotime($date);
	$current="";
?>
						<!-- Start Single Product -->
						<div class="single-product">
							<div class="product-img">
								<a href="product_detail.php?pid=<?php echo $row['product_id']; ?>">
									<?php echo "<img src='public/product/".$mainimg."' class='default-img img-thumbnail' alt='#' >"?>
									<?php if($quan==0){ ?>
										<span class="out-of-stock">Out Of Stock</span>
									<?php }?>
										<?php if($current==date("m", $timestamp) and $quan!=0){ ?>
										<span class="new">New</span>
									<?php }?>
								</a>
								<div class="button-head">
									<div class="product-action">
									<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1 ){
										$useremail=$_SESSION['puser'];
										$qq="select user_id from users where email='$useremail'";
										$rr=$conn->query($qq);
										$data = mysqli_fetch_assoc($rr);
										$id = $data["user_id"];
										$ssss="select count(id) from wishlist where user_id='$id' and product_id='$pid'";
										$showw=$conn->query($ssss);
										if($r=mysqli_fetch_assoc($showw))
											{
											$cout=$r['count(id)'];
											}
										if($cout<1){
										?>
										<a title="Wishlist" href="addtowishlist.php?wishlist=<?php echo $row['product_id'];?>&&location=<?php echo $_SERVER['REQUEST_URI'];?>"><i class="far fa-heart" style="font-size:20px"></i><span>Add to Wishlist</span></a>
										<?php }else{?>
											<a title="Wishlist" style="pointer-events:none;" href="#"><i class="fas fa-heart" style="font-size:20px;color:red"></i><span>Add to Wishlist</span></a>
											<?php }?>
										<?php }else{?>
											<a title="Wishlist" href="login.php?wishlist=<?php echo $row['product_id'];?>"><i class="far fa-heart" style="font-size:20px"></i><span>Add to Wishlist</span></a>
									<?php }?>
									</div>
									<div class="product-action-2">
									<form action="addtocart_detail.php" method="POST" id="cartform">
												<input type="hidden" name="productid" id="productid" value="" />
												</form>
												<?php if($quan!=0){?>
												<a title="Add to cart" href="addtocart.php?productid=<?php echo $row['product_id']; ?>&&location=<?php echo $_SERVER['REQUEST_URI'];?>" class="formforcart">Add to cart</a>
												<?php }else{?>
													<a title="Add to cart"  style="pointer-events: none;" href="addtocart.php?productid=<?php echo $row['product_id']; ?>&&location=<?php echo $_SERVER['REQUEST_URI'];?>" class="formforcart">Add to cart</a>
												<?php }?>
									</div>
								</div>
							</div>
							<div class="product-content">
								<h3><a href="product_detail.php?pid=<?php echo $row['product_id']; ?>"><?php echo $name;?></a></h3>
								<div class="product-price">
								<?php if($pdiscount!=0){ ?>
										<span style="color:#F7941D;"><?php  echo round($discount); ?> PKR</span>&nbsp;&nbsp;&nbsp;<span class="old"><?php echo $price;?> PKR</span>
										<?php }else{?>
											<span style="color:#F7941D;"><?php echo $price;?> PKR</span>
										<?php }?>
								</div>
							</div>
						</div>
						<!-- End Single Product -->
						<?php }?>
                    </div>
                </div>
            </div>

				</div>
            </div>
    </div>
	<!-- End Product Area -->
	<br><br><br>
	<!-- Start Shop Home List  -->
	<section class="shop-home-list section">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>On sale</h1>
							</div>
						</div>
					</div>
					<?php 
$sql="select * from product where discount != 0 limit 3;";
$show=$conn->query($sql);
while ($row = mysqli_fetch_assoc($show)) {
	$pid=$row['product_id'];
    $name=$row['name'];
    $price=$row['price'];
	$pdiscount=$row['discount'];
	$discount=$row['discount'];
	$discount=($discount*$price)/100;
	$discount=$price-$discount;
    $mainimg=$row['mainphoto'];
?>
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
								<?php echo "<img src='public/product/".$mainimg."' alt='#' >"?>
									<a href="product_detail.php?pid=<?php echo $pid;?>" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h4 class="title"><a href="product_detail.php?pid=<?php echo $pid;?>"><?php echo $name;?></a></h4>
									<p class="price with-discount"><?php echo round($discount);?> PKR</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<?php } ?>
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>Best Seller</h1>
							</div>
						</div>
					</div>
					<?php 
$sql="select * from product where discount = 0 ORDER BY RAND() limit 3;";
$show=$conn->query($sql);
while ($row = mysqli_fetch_assoc($show)) {
	$pid=$row['product_id'];
    $name=$row['name'];
    $price=$row['price'];
	$pdiscount=$row['discount'];
	$discount=$row['discount'];
	$discount=($discount*$price)/100;
	$discount=$price-$discount;
    $mainimg=$row['mainphoto'];
?>
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
								<?php echo "<img src='public/product/".$mainimg."' alt='#' >"?>
									<a href="product_detail.php?pid=<?php echo $pid;?>" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="product_detail.php?pid=<?php echo $pid;?>"><?php echo $name;?></a></h5>
									<p class="price with-discount"><?php echo $price;?> PKR</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<?php }?>
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>Top viewed</h1>
							</div>
						</div>
					</div>
					<?php 
$sql="select * from product ORDER BY RAND() limit 3;";
$show=$conn->query($sql);
while ($row = mysqli_fetch_assoc($show)) {
	$pid=$row['product_id'];
    $name=$row['name'];
    $price=$row['price'];
	$pdiscount=$row['discount'];
	$discount=$row['discount'];
	$discount=($discount*$price)/100;
	$discount=$price-$discount;
    $mainimg=$row['mainphoto'];
?>
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
								<?php echo "<img src='public/product/".$mainimg."' alt='#' >"?>
									<a href="product_detail.php?pid=<?php echo $pid;?>" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="product_detail.php?pid=<?php echo $pid;?>"><?php echo $name;?></a></h5>
									<p class="price with-discount"><?php echo round($discount);?> PKR</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<?php }?>
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Home List  -->
	<br>

	<!-- Start Shop Services Area  -->
	<section class="shop-services section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free Shipping</h4>
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
						<p>Within 14 days returns</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Secure Payment</h4>
						<p>100% secure payment</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Best Price</h4>
						<p>Guaranteed price</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Newsletter -->

    <?php include "include/footer.php";?>

	
    <?php include "include/scripts.php";?>
</body>
</html>