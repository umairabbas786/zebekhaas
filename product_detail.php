<?php
include "include/conn.php";
if(isset($_POST['submit_rating']))
{
	$pid=$_GET['pid'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$rating=$_POST['rating'];
	$msg=$_POST['message'];
	$status=1;
	$sql="insert into reviews(product_id,reviewer_name,reviewer_email,reviewer_comment,rating,status) values ('$pid','$name','$email','$msg','$rating','$status')";
	$result=$conn->query($sql);
    if($result)
    {
		$redirect="product_detail.php?pid="."$pid";
		header("Location:"."$redirect");
        die();
    }
    else{
		$_SESSION['msg']="Something Went Wrong";
        echo $conn->error;
    }
}

?>


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
								<li class="active"><a href="#">Product Details</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
				
		<!-- Shop Single -->
		<?php
		$pid=$_GET['pid'];
$sql="select * from product where product_id='$pid'";
$show=$conn->query($sql);
$current=date('m');
while ($row = mysqli_fetch_assoc($show)) {
    $catid=$row['category_id'];
    $sql1="select category_name from category where id='$catid'";
    $result=$conn->query($sql1);
    if($roww=mysqli_fetch_assoc($result)){
        $cat=$roww['category_name'];
    }
    $name=$row['name'];
    $desc=$row['description'];
    $price=$row['price'];
	$pdiscount=$row['discount'];
	$discount=$row['discount'];
	$discount=($discount*$price)/100;
	$discount=$price-$discount;
    $mainimg="public/product/" . $row['mainphoto'];
	if($row['extraphoto']!=null){
    $eimg=explode(',',$row['extraphoto']);
	}
    $date=$row['upload_date'];
    $quantity=$row['quantity'];
?>
		<section class="shop single section">
					<div class="container">
					<?php if(isset($_SESSION['msg'])){?>
			<div class="alert alert-success" role="alert">
			<?php echo $_SESSION['msg'];?>
			</div>
		<?php }unset($_SESSION['msg']);?>
		<?php if(isset($_SESSION['wishlist'])){?>
			<div class="alert alert-success" role="alert">
			<?php echo $_SESSION['wishlist'];?>
			</div>
		<?php }unset($_SESSION['wishlist']);?>
						<div class="row"> 
							<div class="col-12">
								<div class="row">
									<div class="col-lg-6 col-12">
										<!-- Product Slider -->
										<div class="product-gallery">
											<!-- Images slider -->
											<div class="flexslider-thumbnails">
												<ul class="slides">
												<li data-thumb="<?php echo $mainimg;?>">
												<a href="<?php echo $mainimg;?>" data-lightbox="<?php echo $mainimg;?>"><img src="<?php echo $mainimg;?>" alt="#"  height="50%" class="img-thumbnail img-responsive"></a>
													</li>
													<?php
													if($row['extraphoto']!=null){	
											$length=count($eimg);
                                            $i=0;
                                            while($i<$length){
													echo "
													<li data-thumb='public/product/".$eimg[$i]."'>
													<a href='public/product/".$eimg[$i]."' data-lightbox='".$eimg[$i]."'><img src='public/product/".$eimg[$i]."' alt='#' class='img-thumbnail img-responsive'></a>
													</li>";
													$i++;
											}
										}
													?>
												</ul>
											</div>
											<!-- End Images slider -->
										</div>
										<!-- End Product slider -->
									</div>
									<div class="col-lg-6 col-12">
										<div class="product-des">
											<!-- Description -->
											<div class="short">
												<h4><?php echo $name;?></h4>
												<div class="rating-main">
													<ul class="rating">
														<?php 
															$pid=$_GET['pid'];
															$status=1;
															$sql="select count(review_id) from reviews where product_id=$pid and status=$status";
															$result=$conn->query($sql);
															if($row=mysqli_fetch_assoc($result)){
																$count=$row['count(review_id)'];
															}
														?>
														<?php 
															$pid=$_GET['pid'];
															$status=1;
															$sql="select rating from reviews where product_id=$pid and status=$status";
															$result=$conn->query($sql);
															$rate=0;
															while($row=mysqli_fetch_assoc($result)){
																$rate+=$row['rating'];
															}
															if($count!=0){
															$rate=$rate/$count;
															$rate=round($rate);
															}
														?>
														<?php
															$i=0;
															$x=5;
															if($count!=0){
															while($i<$x){
															if($i<$rate){
															?>
															<li><i class="fas fa-star"></i></li>
															<?php
															}
															else{
															?>
															<li><i class="far fa-star"></i></li>
															<?php
															}
															?>
															<?php
															$i++;
															}
															?>
															<?php }else{?>
																<li><i class="far fa-star"></i></li>
																<li><i class="far fa-star"></i></li>
																<li><i class="far fa-star"></i></li>
																<li><i class="far fa-star"></i></li>
																<li><i class="far fa-star"></i></li>
															<?php }?>
													</ul>
													<a href="" style="pointer-events: none;" class="total-review">(<?php echo $count;?>) Review</a>
													<?php if($quantity == 0){ ?>
                    <span class="ml-5"><i class="fas fa-times-circle text-danger"></i> Out of Stock</span>
                    <?php }else {?>
                        <span class="ml-5"><i class="fas fa-check-circle text-success"></i> In Stock</span>
                    <?php }?>
												</div>
												<?php
													if($pdiscount!=0){
												?>
												<p class="price"><span class="discount"><?php  echo round($discount); ?> PKR</span><s><?php echo $price;?> PKR</s> </p>
												<?php }
													else{ 
												?>
												<p class="price"><?php echo $price;?> PKR</p>
												<?php } ?>
												<p class="description"><?php echo $desc;?></p>
											</div>
											<!--/ End Description -->
											<!-- Product Buy -->
											<div class="product-buy">
												<div class="add-to-cart">
												<form action="addtocart_detail.php" method="POST" id="cartform">
												<input type="hidden" name="productid" id="productid" value="" />
												</form>
												<?php if($quantity!=0){?>
												<a title="Add to cart" href="addtocart.php?productid=<?php echo $_GET['pid']; ?>&&location=<?php echo $_SERVER['REQUEST_URI'];?>" class="formforcart btn">Add to cart</a>
												<?php }else{?>
													<a title="Add to cart"  style="pointer-events: none;" href="addtocart.php?productid=<?php echo $row['product_id']; ?>&&location=<?php echo $_SERVER['REQUEST_URI'];?>" class="formforcart btn">Add to cart</a>
												<?php }?>
												<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1 ){
													$useremail=$_SESSION['puser'];
													$qq="select user_id from users where email='$useremail'";
													$rr=$conn->query($qq);
													$data = mysqli_fetch_assoc($rr);
													$id = $data["user_id"];
													$pppid=$_GET['pid'];
													$ssss="select count(id) from wishlist where user_id='$id' and product_id='$pppid'";
													$show=$conn->query($ssss);
													if($r=mysqli_fetch_assoc($show))
														{
														$count=$r['count(id)'];
														}
													if($count<1){
													?>
													<a title="Add to Wishlist" href="addtowishlist.php?wishlist=<?php echo $_GET['pid'];?>&&location=<?php echo $_SERVER['REQUEST_URI'];?>" class="btn min"><i class="far fa-heart" style="font-size:20px"></i></a>
													<?php }else{?>
														<a title="Already in Wishlist" href="#" style="pointer-events: none;" class="btn min"><i class="fas fa-heart" style="color:red;font-size:20px"></i></a>
													<?php }?>
													<?php }else{?>
														<a href="login.php?wishlist=<?php echo $_GET['pid']?>" class="btn min"><i class="far fa-heart" style="font-size:20px"></i></a>
												<?php }?>
												</div>
												<p class="cat">Category :<a href="product.php?cat=<?php $page=1; echo $catid; ?>&&page=<?php echo $page;?>"><?php echo $cat;?></a></p>
												<p class="availability">Availability : <?php echo $quantity;?> Products In Stock</p>
											</div>
											<div class="default-social mt-2">
											<h4 class="share-now">Share:</h4>
											<ul>
												<li><a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=example.org" target="_blank"><i class="fab fa-facebook"></i></a></li>
												<li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
												<li><a class="youtube" href="#"><i class="fab fa-instagram"></i></a></li>
												<li><a class="dribbble" href="#"><i class="fab fa-whatsapp"></i></a></li>
											</ul>
										</div>
											<!--/ End Product Buy -->
										</div>
									</div>
								</div>
								<?php }?>



								<div class="row">
									<div class="col-12">
										<div class="product-info">
											<div class="nav-main">
												<!-- Tab Nav -->
												<ul class="nav nav-tabs" id="myTab" role="tablist">
													<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#description" role="tab">Description</a></li>
													<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#reviews" role="tab">Reviews</a></li>
												</ul>
												<!--/ End Tab Nav -->
											</div>
											<div class="tab-content" id="myTabContent">
												<!-- Description Tab -->
												<div class="tab-pane fade" id="description" role="tabpanel">
													<div class="tab-single">
														<div class="row">
															<div class="col-md-8 offset-md-2">
																<div class="single-des ">
																	<p class="lead text-center"><?php echo $desc;?></p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!--/ End Description Tab -->
												<!-- Reviews Tab -->
												<div class="tab-pane fade show active" id="reviews" role="tabpanel">
													<div class="tab-single review-panel">
														<div class="row">
															<div class="col-12">
																<div class="ratting-main">
																	<div class="avg-ratting">
																		<?php 
																		$pid=$_GET['pid'];
																		$status=1;
																		$sql="select count(review_id) from reviews where product_id=$pid and status=$status";
																		$result=$conn->query($sql);
																		if($row=mysqli_fetch_assoc($result)){
																			$count=$row['count(review_id)'];
																		}
																		?>
																		<h4><?php echo $count?> <span>Reviews</span></h4>
																		<span>Shown Below:</span>
																	</div>
																	<?php 
																		if($count>0){
																	?>
																	<?php 
																		$pid=$_GET['pid'];
																		$status=1;
																		$sql="select * from reviews where product_id=$pid and status=$status";
																		$result=$conn->query($sql);
																		while($row=mysqli_fetch_assoc($result)){
																			$name=$row['reviewer_name'];
																			$comment=$row['reviewer_comment'];
																			$rating=$row['rating'];
																	?>
																	<!-- Single Rating -->
																	<div class="single-rating">
																		<div class="rating-author">
																			<img src="public/images/user.png" alt="#">
																		</div>
																		<div class="rating-des">
																			<h6><?php echo $name ?></h6>
																			<div class="ratings">
																				<ul class="rating">
																					<?php
																					$i=0;
																					$x=5;
																					while($i<$x){
																						if($i<$rating){
																					?>
																					<li><i class="fas fa-star"></i></li>
																					<?php
																						}
																						else{
																					?>
																					<li><i class="far fa-star"></i></li>
																					<?php
																						}
																					?>
																					<?php
																					$i++;
																					}
																					?>
																				</ul>
																				<div class="rate-count">(<span><?php echo $rating;?></span>)</div>
																			</div>
																			<p><?php echo $comment;?></p>
																		</div>
																	</div>
																	<!--/ End Single Rating -->
																	<?php }?>
																	<?php }
																	else{
																		?>
																		<h3 class="text-center lead">No Review Found!</h3>
																	<?php
																	}
																	?>
																	
																</div>
																<!-- Review -->
																<div class="comment-review">
																	<div class="add-review">
																		<h5>Add A Review</h5>
																		<p>Your email address will not be published. Required fields are marked</p>
																	</div>
																</div>
																<!--/ End Review -->
																<!-- Form -->
																<form class="form" method="POST" action="#">
																	<div class="row">
																		<div class="col-lg-4 col-12">
																			<div class="form-group">
																				<label>Your Name<span>*</span></label>
																				<input class="form-control" type="text" name="name" required="required" placeholder="">
																			</div>
																		</div>
																		<div class="col-lg-4 col-12">
																			<div class="form-group">
																				<label>Your Email<span>*</span></label>
																				<input class="form-control" type="email" name="email" required="required" placeholder="">
																			</div>
																		</div>
																		<div class="col-lg-4 col-12">
																			<div class="form-group">
																				<label>Your Rating<span>*</span></label>
																				<input class="form-control" pattern="1|2|3|4|5" title='must be "1","2","3","4","5"'  list="rate" name="rating" required="required" placeholder="">
																				<datalist id="rate">
     																			<option value="1">Bad</option>
    																			<option value="2">Poor</option>
      																			<option value="3">Ok</option>
      																			<option value="4" selected>Good</option>
      																			<option value="5">Excellent</option>
																				</datalist>
																			</div>
																		</div>
																		<div class="col-lg-12 col-12">
																			<div class="form-group">
																				<label>Write a review<span>*</span></label>
																				<textarea name="message" rows="6" placeholder="" Required></textarea>
																			</div>
																		</div>
																		<div class="col-lg-3 col-12">
																			<div class="form-group button5">
																			<input type="submit" name="submit_rating" class="btn bg-dark text-light" onclick=" alert('Review Submitted Successfully.')">
																			</div>
																		</div>
																	</div>
																</form>
																<!--/ End Form -->
															</div>
														</div>
													</div>
												</div>
												<!--/ End Reviews Tab -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
		</section>
		<!--/ End Shop Single -->

	<!-- Start Most Popular -->
	<div class="product-area most-popular related-product section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Related Products</h2>
					</div>
				</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
					<?php 
$sql="select * from product where category_id='$catid' and product_id!='$pid' limit 5";
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
	<!-- End Most Popular Area -->
	
    <?php include "include/footer.php";?>

    <?php include "include/scripts.php";?>

	<script>
		$(".alert").delay(5000).slideUp(200, function() {
    		$(this).alert('close');
		});
	</script>
</body>
</html>