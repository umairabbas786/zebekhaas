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
								<h4 class="title"><span>make your <br> site stunning with <br> large title</span></h4>
								<div class="button">
									<a href="product.php" class="btn">Shop Now</a>
								</div>
							</div>
						</div>
						<div class="big-content" style="background-image: url('public/images/home/img9.jpeg');">
							<div class="inner">
								<h4 class="title"><span>make your <br> site stunning with <br> large title</span></h4>
								<div class="button">
									<a href="product.php" class="btn">Shop Now</a>
								</div>
							</div>
						</div>
						<div class="big-content" style="background-image: url('public/images/home/img3.jpeg');">
							<div class="inner">
								<h4 class="title"><span>make your <br> site stunning with <br> large title</span></h4>
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
	<br>
	<!-- Start Small Banner  -->
	<section class="small-banner section">
		<div class="container">
		<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Overview</h2>
					</div>
				</div>
            </div>
			<div class="row">
				<!-- Single Banner  -->
				<div class="col-lg-4 col-md-6 col-12">
					<div class="single-banner main-img">
						<a href="product.php" style=""><img src="public/images/home/img4.jpeg" alt="#"></a>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-4 col-md-6 col-12">
					<div class="single-banner main-img">
					<a href="product.php"><img src="public/images/home/img5.jpeg" alt="#"></a>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-4 col-12">
					<div class="single-banner main-img">
					<a href="product.php"><img src="public/images/home/img6.jpeg" alt="#"></a>
					</div>
				</div>
				<!-- /End Single Banner  -->
			</div>
		</div>
	</section>
	<!-- End Small Banner -->
	<br><br>
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

	<br>

    <?php include "include/footer.php";?>

	
    <?php include "include/scripts.php";?>
</body>
</html>