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
							<li class="active"><a href="#">Wishlist</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
	<!-- Shopping Cart -->
	<div class="shopping-cart section" id="crt_table">
		<div class="container">
        <?php if(isset($_SESSION['wsuccess'])){?>
			<div class="alert alert-success" role="alert">
			<?php echo $_SESSION['wsuccess'];?>
			</div>
		<?php }unset($_SESSION['wsuccess']);?>
		<?php if(isset($_SESSION['cartadded'])){?>
			<div class="alert alert-success" role="alert">
			<?php echo $_SESSION['cartadded'];?>
			</div>
		<?php }unset($_SESSION['cartadded']);?>
			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
                    <?php
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
                        if($count>=1){
                    ?>
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th class="text-center">PRODUCT</th>
								<th class="text-center">NAME</th>
								<th class="text-center">UNIT PRICE</th>
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody>
                        <?php
                            $useremail=$_SESSION['puser'];
                            $sql="select user_id from users where email='$useremail'";
                            $result=$conn->query($sql);
                            $row = mysqli_fetch_assoc($result);
                            $id = $row["user_id"];
                            $ssql="select * from wishlist where user_id='$id'";
                            $show=$conn->query($ssql);
                            while($roww=mysqli_fetch_assoc($show)){
								$array[]=$roww['product_id'];
								$allp=implode($array,',');
                                $pid=$roww['product_id'];
                                $q="select * from product where product_id='$pid'";
                                $p=$conn->query($q);
                                while($r=mysqli_fetch_assoc($p)){
                                    $name=$r['name'];
                                    $desc=$r['description'];
                                $price=$r['price'];
                                $mainimg=$r['mainphoto'];
                                $pdiscount=$r['discount'];
                                if($pdiscount!=0){
                                    $discount=$r['discount'];
                                    $discount=($discount * $price) / 100;
                                    $discount=$price-$discount;
                                    $price=round($discount);
                                }
                        ?>
							<tr>
								<td class="image" data-title="No"><?php echo "<img src='public/product/".$mainimg."' alt='#' >"?></td>
								<td class="product-des" data-title="Description">
								<p class="product-name"><a href="product_detail.php?pid=<?php echo $pid;?>"><?php echo $name;?></a></p>
								<p class="product-des"><?php echo $desc;?></p>
								</td>
								<td class="price" data-title="Price"><span><?php echo $price;?> PKR</span></td>
								<td class="action" data-title="Remove"><a href="removewishlist.php?rw=<?php echo $pid;?>"><i class="ti-trash remove-icon"></i></a></td>
							</tr>
                             <?php } ?>
                             <?php }?>
						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<!-- Total Amount -->
						<div class="row text-center">
							<div class="col-md-6 offset-md-3 col-12">
								<div class="right">
									<div class="button5 mt-3">
										<a href="#" id="modalbtn" class="btn text-white show">Add To Cart</a>
										<a href="product.php" class="btn text-white">Continue Shopping</a>
										<input type="hidden" value=<?php echo $allp; ?> id="allproduct">
									</div>
								</div>
							</div>
						</div>
					<!--/ End Total Amount -->
                    <?php }else{?>
                        <h5 class="text-center lead mb-5">Your Wishlist is Empty.</h5>
                        <div class="button5 text-white text-center">
                            <a href="product.php" class="btn">Continue Shopping</a>
                        </div>
                        <?php }?>
				</div>
			</div>
		</div>
	</div>
	<!--/ End Shopping Cart -->
			
	<!-- Start Shop Services Area  -->
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
	<!-- End Shop Newsletter -->

	<!--Modal Start-->

<!-- Modal -->
<div id="success_tic" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content back">
      <a class="close" href="#" data-dismiss="modal">&times;</a>
      <div class="page-body">
    <div class="head"> 
      <h3 class="mb-3 text-white">All Items Added to cart Successfully.</h3>
    </div>

  <h1 style="text-align:center;"><div class="checkmark-circle">
  <div class="background"></div>
  <div class="checkmark draw"></div>
</div><h1>

  </div>
</div>
    </div>

  </div>
	<!--Modal End-->


	<!-- End Shop Newsletter -->
    <?php include "include/footer.php";?>

<?php include "include/scripts.php";?>


<script>
    $(".alert").delay(5000).slideUp(200, function() {
    		$(this).alert('close');
		});
$(document).ready(function(){
  $(".show").click(function(){
    $("#success_tic").modal("show");
	var id = $("#allproduct").val();
	setTimeout(function(){ window.location.href='addtocart.php?allp='+id; }, 8000);
	  });
});
</script>
</body>
</html>