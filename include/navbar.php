<?php 
if(isset($_GET['remove'])){
    $id=$_GET['remove'];
    unset($_SESSION['mycart'][$id]);
}
if(empty($_SESSION['mycart'])){
    unset($_SESSION['mycart']);
}
?>
	<!-- Header -->
	<header class="header shop v3">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="inner-content">
					<div class="row">
					    <div class="col-lg-6 col-md-12 col-12"></div>
						<!--<div class="col-lg-6 col-md-12 col-12">-->
							<!-- Top Left -->
						<!--	<div class="top-left">-->
						<!--		<ul class="list-main">-->
						<!--			<li><a href="tel:+923017971212"><i class="ti-headphone-alt"></i> +92 301 7971212</a></li>-->
						<!--			<li><a href="mailto:support@zebekhaas.com"><i class="ti-email"></i> support@zebekhaas.com</a></li>-->
						<!--		</ul>-->
						<!--	</div>-->
							<!--/ End Top Left -->
						<!--</div>-->
						<div class="col-lg-6 col-md-12 col-12">
							<!-- Top Right -->
							<div class="right-content">
								<ul class="list-main">
									<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1 ){?>
									<li><i class="ti-user"></i> <a href="myaccount.php">My account</a></li>
									<li><i class="ti-lock"></i> <a href="logout.php">Logout</a></li>
									<?php }else{?>
									<li><i class="ti-power-off"></i><a href="login.php">Login</a></li>
									<li><i class="ti-user"></i><a href="register.php">Register</a></li>
									<?php }?>
								</ul>
							</div>
							<!-- End Top Right -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="index.php"><img src="public/images/zeb-e-khass.jpg" alt="logo"></a>
						</div>
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top" style="top:93%">
							<div class="top-search"><a href="#"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
								<form class="search-form">
									<input type="text" placeholder="Search here..." name="search">
									<button value="search" type="submit"><i class="ti-search"></i></button>
								</form>
							</div>
							<!--/ End Search Form -->
						</div>
						<!--/ End Search Form -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-8 col-md-7 col-12">
						<div class="search-bar-top">
							<div class="search-bar">
								<select>
									<option selected="selected">All Category</option>
									<!-- <?php
												$sql="select * from category";
												$result=$conn->query($sql);
												while($row=mysqli_fetch_assoc($result))
												{
													$name=$row['category_name'];
												?>
									<option value="<?php echo $name;?>"><?php echo $name;?></option>
									<?php }?> -->
								</select>
								<form>
									<input name="search" placeholder="Search Products Here....." type="search">
									<button class="btnn"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-12">
						<div class="right-bar">
							<!-- Search Form -->
							<div class="sinlge-bar">
								<?php 
								if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1 ){
								$useremail=$_SESSION['puser'];
								$sql="select user_id from users where email='$useremail'";
								$result=$conn->query($sql);
								$row = mysqli_fetch_assoc($result);
								$id = $row["user_id"];
								$ssql="select count(id) from wishlist where user_id='$id'";
								$show=$conn->query($ssql);
								if($r=mysqli_fetch_assoc($show))
								{
    								$count=$r['count(id)'];
								}
							}
								?>
							<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1 ){?>
								<a href="wishlist.php" class="single-icon"><i class="far fa-heart" aria-hidden="true"></i> <span class="total-count"><?php echo $count;?></span></a>
							<?php }else{?>
								<a href="login.php?direct=1" class="single-icon"><i class="far fa-heart" aria-hidden="true"></i> <span class="total-count">0</span></a>
							<?php }?>
							</div>
							<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1 ){?>
							<div class="sinlge-bar">
								<a href="myaccount.php" class="single-icon"><i class="far fa-user"></i></a>
							</div>
							<?php }else{?>
							<div class="sinlge-bar">
								<a href="login.php" class="single-icon"><i class="far fa-user"></i></a>
							</div>
							<?php }?>
							<div class="sinlge-bar shopping">
								<a href="viewcart.php" class="single-icon"><i class="ti-bag"></i> <span class="total-count"><?php if(isset($_SESSION['mycart'])){echo count($_SESSION['mycart']);}else{echo "0";}?></span></a>
								<!-- Shopping Item -->
								<div class="shopping-item">
									<?php if(isset($_SESSION['mycart'])){?>
									<div class="dropdown-cart-header">
										<span><?php echo count($_SESSION['mycart']);?> Items</span>
									</div>
									<ul class="shopping-list">
									<?php $total=0; foreach($_SESSION['mycart'] as $key => $value){
                                $sql="select * from product where product_id=$key";
                                $result=$conn->query($sql);
                                $row=mysqli_fetch_assoc($result);
                                $name=$row['name'];
                                $desc=$row['description'];
                                $price=$row['price'];
                                $mainimg=$row['mainphoto'];
                                $pdiscount=$row['discount'];
                                if($pdiscount!=0){
                                    $discount=$row['discount'];
                                    $discount=($discount * $price) / 100;
                                    $discount=$price-$discount;
                                    $price=round($discount);
                                }
                                $quantity=$row['quantity'];
                                $total+=$value['quan'] * $price;
                        ?>
										<li>
											<?php if(isset($_GET['pid'])){?>
											<a href="?pid=<?php echo $_GET['pid']?>&&remove=<?php echo $key;?>" class="remove" title="Remove this item"><i class="fas fa-trash"></i></a>
											<?php }else{?>
												<a href="?remove=<?php echo $key;?>" class="remove" title="Remove this item"><i class="fas fa-trash"></i></a>
												<?php }?>
											<a class="cart-img" href="product_detail.php?pid=<?php echo $key ?>"><?php echo "<img src='public/product/".$mainimg."' alt='#' >"?></a>
											<h4><a href="product_detail.php?pid=<?php echo $key ?>"><?php echo $name?></a></h4>
											<p class="quantity"><?php echo $value['quan'];?>x - <span class="amount"><?php echo $price;?> PKR</span></p>
										</li>
										<?php } ?>
									</ul>
									<div class="bottom">
										<div class="total">
											<span>Total</span>
											<span class="total-amount"><?php echo $total;?> PKR</span>
										</div>
										<a href="viewcart.php" class="btn animate">Go To Cart</a>
									</div>
									<?php }else{ ?>
										<p class="text-center">Cart is Empty!</p>
									<?php } ?>
								</div>
								<!--/ End Shopping Item -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						<div class="col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">	
										<div class="nav-inner">	
											<ul class="nav main-menu menu navbar-nav">
												<li <?php if($_SERVER['REQUEST_URI'] == "/index.php"){echo "class='active'";}?>><a href="index.php"><i class="fas fa-home" style="font-size:16px"></i> Home</a></li>
												<li <?php if($_SERVER['REQUEST_URI'] == "/product_list.php"){echo "class='active'";}?>><a href="product_list.php"><i class="fas fa-box-open" style="font-size:16px"></i> Products<span class="new">New</span></a></li>											
												<li <?php if($_SERVER['REQUEST_URI'] == "/aboutus.php"){echo "class='active'";}?>><a href="aboutus.php"><i class="fas fa-info-circle" style="font-size:16px"></i> About Us</a></li>								
												<li <?php if($_SERVER['REQUEST_URI'] == "/contact.php"){echo "class='active'";}?>><a href="contact.php"><i class="fas fa-user-circle" style="font-size:16px"></i> Contact Us</a></li>
												<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1 ){?>
												<li <?php if($_SERVER['REQUEST_URI'] == "/wishlist.php"){echo "class='active'";}?>><a href="wishlist.php"><i class="fas fa-heart" style="font-size:16px"></i> Wishlist</a></li>
												<?php }else{?>
												<li><a href="login.php?direct=1"><i class="fas fa-heart" style="font-size:16px"></i> Wishlist</a></li>
												<?php }?>
												<li <?php if($_SERVER['REQUEST_URI'] == "/viewcart.php"){echo "class='active'";}?>><a href="viewcart.php"><i class="fas fa-cart-arrow-down" style="font-size:16px"></i> Cart</a></li>
											</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!--/ End Header -->
	<!--end navbar-->