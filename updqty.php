<?php 
session_start();
include "include/conn.php";

$pid=$_POST['cart_id'];
$qty=$_POST['qty'];
$_SESSION['mycart'][$pid]['quan']=$qty;


?>

<div class="container">
			<div class="row">
				<div class="col-12">
                <?php if(isset($_SESSION['mycart'])){ ?>
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
                                <th>Sr No.</th>
								<th>PRODUCT</th>
								<th>NAME</th>
								<th class="text-center">UNIT PRICE</th>
								<th class="text-center">QUANTITY</th>
								<th class="text-center">TOTAL</th> 
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody>
                        <?php $i=1; $total=0; $saving=0; foreach($_SESSION['mycart'] as $key => $value){
                                $sql="select * from product where product_id=$key";
                                $result=$conn->query($sql);
                                $row=mysqli_fetch_assoc($result);
                                $name=$row['name'];
                                $desc=$row['description'];
                                $price=$row['price'];
                                $mainimg=$row['mainphoto'];
								$saving = $saving + ( ($row['discount'] * $row['price']) / 100 );
								$saving *=$value['quan'];
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
							<tr>
                                <td><p><?php echo $i; $i++;?></p></td>
								<td class="image" data-title="No"><?php echo "<img src='public/product/".$mainimg."' alt='#' >"?></td>
								<td class="product-des" data-title="Description">
									<p class="product-name"><a href="product_detail.php?pid=<?php echo $key;?>"><?php echo $name;?></a></p>
									<p class="product-des"><?php echo $desc;?></p>
								</td>
								<td class="price" data-title="Price"><span><?php echo $price;?> PKR</span></td>
								<td class="qty" data-title="Qty"><!-- Input Order -->
									<div class="input-group">
                                        <form id="frm<?php echo $key;?>">
                                        <input type="hidden" name="cart_id" value="<?php echo $key;?>">
                                        <input type="number" name="qty" id="qty" onchange="updcart(<?php echo $key;?>)" onkeyup="updcart(<?php echo $key;?>)" class="input-number"  min="1" max="<?php echo $quantity;?>" value="<?php echo $value['quan'];?>">
                                        </form>
									</div>
									<!--/ End Input Order -->
								</td>
								<td class="total-amount" data-title="Total"><span><?php echo $value['quan'] * $price;?> PKR</span></td>
								<td class="action" data-title="Remove"><a href="?remove=<?php echo $key;?>"><i class="ti-trash remove-icon"></i></a></td>
							</tr>
                            <?php } ?>
						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
						<div class="row">
							<div class="col-md-5 offset-md-7 col-12">
								<div class="right">
									<ul>
										<li>Cart Subtotal:<span><?php echo $total;?> PKR</span></li>
										<li>Total Saving:<span><?php echo round($saving);?> PKR</span></li>
										<li class="last font-weight-bold" style="font-size:18px">You Pay<span> <?php echo $total;?> PKR</span></li>
									</ul>
									<div class="button5">
									<form action="checkout.php" method="POST">
											<input type="hidden" value="<?php echo $_SESSION['mycart'];?>" name="items">
											<input type="hidden" value="<?php echo $total;?>" name="total">
											<button type="submit" class="btn" name="checkout">Checkout</button>
										</form>
										<a href="product.php" class="btn">Continue Shopping</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ End Total Amount -->
                    <?php }else{?>
                        <h5 class="text-center lead mb-5">Your Cart is Empty.</h5>
                        <div class="button5 text-white text-center">
                        <a href="product.php" class="btn">Continue Shopping</a>
                        </div>
                        <?php }?>
				</div>
			</div>
		</div>