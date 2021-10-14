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
								<li class="active"><a href="blog-single.html">Shop List</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
        <!-- Product Style 1 -->
		<section class="product-area shop-sidebar shop-list shop section">
			<div class="container">
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
					<div class="col-lg-3 col-md-4 col-12">
						<div class="shop-sidebar">
								<!-- Single Widget -->
								<div class="single-widget category">
									<h3 class="title">Categories</h3>
									<?php
												$sql="select * from category";
												$result=$conn->query($sql);
												while($row=mysqli_fetch_assoc($result))
												{
													$id=$row['id'];
													$name=$row['category_name'];
												?>
									<ul class="categor-list">
									<?php
									$sqll="select count(product_id) from product where category_id=$id";
									$resultt=$conn->query($sqll);
									$roww=mysqli_fetch_assoc($resultt);
									$count=$roww['count(product_id)'];
									?>
										<li><a href="product_list.php?cat=<?php echo $row['id']; ?>&&page=<?php echo 1;?>" <?php $class="style='color:orange;'"; if(isset($_GET["cat"]) and $_GET["cat"] == $row['id']) echo $class; ?> > <?php echo $name; ?> <span>(<?php echo $count; ?>)</span></a></li>
									<?php }?>
									</ul>
								</div>
								<!--/ End Single Widget -->
								<!-- Single Widget -->
								<div class="single-widget recent-post">
									<h3 class="title">Recent Posts</h3>

<?php 
	$sql="select * from product order by rand() limit 3";
	$result=$conn->query($sql);
	while($row=mysqli_fetch_assoc($result)){
		$name=$row['name'];
		$price=$row['price'];
		$img=$row['mainphoto'];
		$pid=$row['product_id'];
		$pdiscount=$row['discount'];
		$discount=$row['discount'];
		$discount=($discount * $price) / 100;
		$discount=$price-$discount;
?>

									<!-- Single Post -->
									<div class="single-post first">
										<div class="image">
											<?php echo "<img src='public/product/".$img."' class='default-img img-thumbnail' alt='#' >"?>
										</div>
										<div class="content">
											<h5><a href="product_detail.php?pid=<?php echo $pid;?>"><?php echo $name;?></a></h5>
											<?php
													if($pdiscount!=0){
												?>
										<p class="price"><?php  echo round($discount); ?> PKR</p>
										<?php }else{?>
											<p class="price"><?php echo $price;?> PKR</p>
											<?php }?>
											
											<ul class="reviews">
											<?php
															$status=1;
															$sql1="select count(review_id) from reviews where product_id=$pid and status=$status";
															$result1=$conn->query($sql1);
															if($row1=mysqli_fetch_assoc($result1)){
																$count=$row1['count(review_id)'];
															}
														?>
														<?php 
															$status=1;
															$sql2="select rating from reviews where product_id=$pid and status=$status";
															$result2=$conn->query($sql2);
															$rate=0;
															while($row=mysqli_fetch_assoc($result2)){
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
															<li class="yellow"><i class="ti-star"></i></li>
															<?php
															}
															else{
															?>
															<li><i class="ti-star"></i></li>
															<?php
															}
															?>
															<?php
															$i++;
															}
															?>
															<?php }else{?>
																<li><i class="ti-star"></i></li>
																<li><i class="ti-star"></i></li>
																<li><i class="ti-star"></i></li>
																<li><i class="ti-star"></i></li>
																<li><i class="ti-star"></i></li>
															<?php }?>
											</ul>
										</div>
									</div>
									<!-- End Single Post -->
									<?php }?>
								</div>
								<!--End Single Widget-->
						</div>
					</div>
					<div class="col-lg-9 col-md-8 col-12">
						<div class="row">
							<div class="col-12">
								<!-- Shop Top -->
								<div class="shop-top">
									<div class="shop-shorter">
										<div class="single-shorter">
										<form method="post" action="#" id="limitform">
											<label>Show :</label>
											<select name="limit" id="limit">
												<?php $l=0; foreach([5,10,15] as $l) : ?>
												<option <?php if(isset($_POST["limit"]) and $_POST["limit"] == $l ) echo "selected" ?> value="<?php echo $l;?>"><?php echo $l;?></option>
												<?php endforeach ?>
											</select>
											</form>
										</div>
										<div class="single-shorter">
										<form method="post" action="#" id="sortform">
											<label>Sort By :</label>
											<select name="sortby" id="sortby">
											<?php foreach(['Latest','Name','Price'] as $sort) : ?>
												<option <?php if(isset($_POST["sortby"]) and $_POST["sortby"] == $sort ) echo "selected"?> value="<?php echo $sort;?>"><?php echo $sort;?></option>
												<?php endforeach ?>
											</select>
											</form>
										</div>
									</div>
									<ul class="view-mode">
									<?php if(isset($_GET['cat'])){ $cat=$_GET['cat'];?>
										<li><a href="product.php?cat=<?php echo $cat;?>"><i class="fa fa-th-large"></i></a></li>
										<?php }else{?>
											<li><a href="product.php"><i class="fa fa-th-large"></i></a></li>
										<?php }?>
										<li class="active"><a href="#"><i class="fa fa-th-list"></i></a></li>
									</ul>
								</div>
								<!--/ End Shop Top -->
							</div>
						</div>
		
						<div class="row">
                        <?php
if(isset($_GET['cat'])){
$cat=$_GET['cat'];
if(isset($_POST['limit'])){
	$limit=$_POST['limit'];
	}else{
		$limit=9;
	}
	if(isset($_GET['page'])){
	$page=$_GET['page'];
	}
	else{
		$page=1;
	}
	$start=($page - 1) * $limit;
	if(isset($_POST['sortby'])){
		$sort=$_POST['sortby'];
		$now="Latest";
		if($_POST['sortby'] == $now){
			$sort="product_id desc";
		}
		$sql="select * from product where category_id=$cat order by $sort limit $start,$limit";
	}
	else{
		$sql="select * from product where category_id=$cat order by product_id desc limit $start,$limit";
	}
	//count entries..
	$sql1="select count(product_id) from product where category_id=$cat";
	$result=$conn->query($sql1);
	if($row=mysqli_fetch_assoc($result)){
		$total=$row['count(product_id)'];
	}
	$pages= ceil ($total / $limit);

	$previous=$page-1;
	if($previous<=1){
		$previous=1;
	}
	$next=$page+1;
	if($next>$pages){
		$next=$pages;
	}
//$sql="select * from product where category_id=$cat";
}
else{
	if(isset($_POST['limit'])){
		$limit=$_POST['limit'];
		}else{
			$limit=5;
		}
		if(isset($_GET['page'])){
		$page=$_GET['page'];
		}
		else{
			$page=1;
		}
		$start=($page - 1) * $limit;
		if(isset($_POST['sortby'])){
			$sort=$_POST['sortby'];
			$now="Latest";
			if($_POST['sortby'] == $now){
			$sort="product_id desc";
			}
			$sql="select * from product order by $sort limit $start,$limit";
		}
		else{
			$sql="select * from product order by product_id desc limit $start,$limit";
		}
		//count entries..
		$sql1="select count(product_id) from product";
		$result=$conn->query($sql1);
		if($row=mysqli_fetch_assoc($result)){
			$total=$row['count(product_id)'];
		}
		$pages= ceil ($total / $limit);
	
		$previous=$page-1;
		if($previous<=1){
			$previous=1;
		}
		$next=$page+1;
		if($next>$pages){
			$next=$pages;
		}
}
$show=$conn->query($sql);
$current=date('m');
while ($row = mysqli_fetch_assoc($show)) {
	$pid=$row['product_id'];
    $name=$row['name'];
    $price=$row['price'];
	$quan=$row['quantity'];
    $desc=$row['description'];
    $mainimg=$row['mainphoto'];
	$date=$row['upload_date'];
	$timestamp = strtotime($date);
	$pdiscount=$row['discount'];
	$discount=$row['discount'];
	$discount=($discount*$price)/100;
	$discount=$price-$discount;
?>
								<!-- Start Single List -->
								<div class="col-12">
									<div class="row">
										<div class="col-lg-4 col-md-6 col-sm-6">
											<div class="single-product">
												<div class="product-img">
													<a href="product_detail.php?pid=<?php echo $row['product_id']; ?>">
                                                    <?php echo "<img src='public/product/".$mainimg."' class='default-img img-thumbnail' alt='#' >"?>
													<?php 
											if($quan==0){
										?>
										<span class="out-of-stock">Out Of Stock</span>
										<?php }?>
										<?php 
											if($current==date("m", $timestamp) and $quan!=0){
										?>
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
															$ppppid=$row['product_id'];
															$ssss="select count(id) from wishlist where user_id='$id' and product_id='$ppppid'";
															$showw=$conn->query($ssss);
															if($r=mysqli_fetch_assoc($showw))
																{
																$count=$r['count(id)'];
																}
															if($count<1){
														?>
														<a title="Wishlist" href="addtowishlist.php?wishlist=<?php echo $row['product_id'];?>&&location=<?php echo $_SERVER['REQUEST_URI'];?>"><i class="far fa-heart" style="font-size:20px;"></i><span>Add to Wishlist</span></a>
														<?php }else{?>
															<a title="Wishlist" href="#" style="pointer-events:none;"><i class="fas fa-heart" style="font-size:20px;color:red;"></i><span>Add to Wishlist</span></a>
														<?php }?>
														<?php }else{?>
															<a title="Wishlist" href="login.php?wishlist=<?php echo $row['product_id'];?>"><i class="far fa-heart" style="font-size:20px;"></i><span>Add to Wishlist</span></a>
														<?php }?>
														</div>
														<div class="product-action-2">
														<form action="addtocart.php" method="POST" id="cartform">
												<input type="hidden" name="productid" id="productid" value="" />
												</form>
												<?php if($quan!=0){?>
												<a title="Add to cart" href="addtocart.php?productid=<?php echo $row['product_id']; ?>&&location=<?php echo $_SERVER['REQUEST_URI'];?>">Add to cart</a>
												<?php }else{?>
													<a title="Add to cart" style="pointer-events: none;" href="addtocart.php?productid=<?php echo $row['product_id']; ?>&&location=<?php echo $_SERVER['REQUEST_URI'];?>" >Add to cart</a>
												<?php }?>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-8 col-md-6 col-12">
											<div class="list-content">
												<div class="product-content">
													<div class="product-price">
													<?php
													if($pdiscount!=0){
												?>
										<h5 style="color:#F7941D;"><?php  echo round($discount); ?> PKR &nbsp;&nbsp;<s style="color:black;"><?php echo $price;?> PKR</s></h5>
										<?php }else{?>

														<h5 style="color:#F7941D;"><?php echo $price;?> PKR</h5>
														<?php }?>
													</div>
													<h3 class="title"><a href="product_detail.php?pid=<?php echo $row['product_id']; ?>"><?php echo $name;?></a></h3>
													<div class="review-inner">
														<div class="ratings">
														<ul class="rating">
														<?php
															$status=1;
															$sql="select count(review_id) from reviews where product_id=$pid and status=$status";
															$result=$conn->query($sql);
															if($row=mysqli_fetch_assoc($result)){
																$count=$row['count(review_id)'];
															}
														?>
														<?php 
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
														</div>
													</div>
												</div>
												<p class="des"><?php echo $desc;?></p>
												<?php if($quan!=0){?>
												<a href="addtocart.php?productid=<?php echo $pid; ?>&&location=<?php echo $_SERVER['REQUEST_URI'];?>" class=" btn">Add to cart</a>
												<?php }else{?>
													<a style="pointer-events: none;" href="addtocart.php?productid=<?php echo $pid; ?>&&location=<?php echo $_SERVER['REQUEST_URI'];?>" class=" btn">Add to cart</a>
												<?php }?>
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
													<a title="Wishlist" href="addtowishlist.php?wishlist=<?php echo $pid;?>&&location=<?php echo $_SERVER['REQUEST_URI'];?>" class="btn"><i class="far fa-heart"></i></a>
													<?php }else{?>
														<a title="Wishlist" style="pointer-events:none" href="#" class="btn"><i class="fas fa-heart" style="color:red;"></i></a>
														<?php }?>
												<?php }else{?>
													<a title="Wishlist" href="login.php?wishlist=<?php echo $pid;?>" class="btn"><i class="far fa-heart"></i></a>
												<?php }?>
											</div>
										</div>
									</div>
								</div>
								
                                <?php }?>
								<!-- End Single List -->
								
								<div class="col-12 text-center">
									<!-- Pagination -->
									<div class="pagination" style="float:right;">
										<ul class="pagination-list">
										<?php if(isset($_GET['cat'])){ $cat=$_GET['cat'];?>
											<li><a href="product_list.php?cat=<?php echo $cat;?>&&page=<?php echo $previous;?>"><i class="ti-arrow-left"></i></a></li>
											<?php $i=1; while($i<=$pages){?>
											<li <?php $class="class='active'"; if(isset($_GET["page"]) and $_GET["page"] == $i) echo $class; ?>><a href="product_list.php?cat=<?php echo $cat;?>&&page=<?php echo $i;?>"><?php echo $i;?></a></li>
											<?php $i++;
											}?>
											<li><a href="product_list.php?cat=<?php echo $cat;?>&&page=<?php echo $next;?>"><i class="ti-arrow-right"></i></a></li>
											
											<?php }else{?>
												<li><a href="product_list.php?page=<?php echo $previous;?>"><i class="ti-arrow-left"></i></a></li>
											<?php $i=1; while($i<=$pages){?>
											<li <?php $class="class='active'"; if(isset($_GET["page"]) and $_GET["page"] == $i) echo $class; ?>><a href="product_list.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
											<?php $i++;
											}?>
											<li><a href="product_list.php?page=<?php echo $next;?>"><i class="ti-arrow-right"></i></a></li>
												<?php }?>
										</ul>
									</div>
									<!--/ End Pagination -->
								</div>
							</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Product Style 1  -->	
		
    <?php include "include/footer.php";?>


    <?php include "include/scripts.php";?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#limit").change(function(){
				$('form#limitform').submit();
			})
		})
		$(document).ready(function(){
			$("#sortby").change(function(){
				//alert(this.value);
				$('form#sortform').submit();
			})
		})
		$(".alert").delay(5000).slideUp(200, function() {
    		$(this).alert('close');
		});
	</script>
</body>
</html>